<?php

namespace Aternos\Codex\Analyser;

use Aternos\Codex\Analysis\Analysis;
use Aternos\Codex\Analysis\PatternInsightInterface;
use Aternos\Codex\Log\EntryInterface;

/**
 * Class PatternAnalyser
 *
 * @package Aternos\Codex\Analyser
 */
class PatternAnalyser extends Analyser
{
    /**
     * Classnames as strings.
     * Must implement PatternInsightInterface.
     *
     * @var string[]
     */
    protected array $possibleInsightClasses = [];

    /**
     * Set possible insight classes
     *
     * Every class must implement PatternInsightInterface
     *
     * @param array $insightClasses
     * @return $this
     */
    public function setPossibleInsightClasses(array $insightClasses): AnalyserInterface
    {
        $this->possibleInsightClasses = [];
        foreach ($insightClasses as $insightClass) {
            $this->addPossibleInsightClass($insightClass);
        }

        return $this;
    }

    /**
     * Add a possible insight class
     *
     * The class must implement PatternInsightInterface
     *
     * @param string $insightClass
     * @return $this
     */
    public function addPossibleInsightClass(string $insightClass): AnalyserInterface
    {
        if (!is_subclass_of($insightClass, PatternInsightInterface::class)) {
            throw new \InvalidArgumentException("Class " . $insightClass . " does not implement " . PatternInsightInterface::class . ".");
        }

        $this->possibleInsightClasses[] = $insightClass;
        return $this;
    }

    /**
     * Find a possible insight class
     *
     * @param string $insightClass
     * @return int|string The key for $insightClass in $this->possibleInsightClasses.
     * If it is found more than once, the first matching key is returned.
     */
    protected function findPossibleInsightClass(string $insightClass)
    {
        $index = array_search($insightClass, $this->possibleInsightClasses);
        if ($index === false) {
            throw new \InvalidArgumentException("Class " . $insightClass . " not found in possible insight classes.");
        }
        return $index;
    }

    /**
     * Remove a possible insight class
     *
     * @param string $insightClass
     */
    public function removePossibleInsightClass(string $insightClass): void
    {
        $index = $this->findPossibleInsightClass($insightClass);
        unset($this->possibleInsightClasses[$index]);
    }

    /**
     * Override a possible insight class with a child class
     *
     * The $childInsightClass has to extend $parentInsightClass
     *
     * @param string $parentInsightClass
     * @param string $childInsightClass
     */
    public function overridePossibleInsightClass(string $parentInsightClass, string $childInsightClass): void
    {
        if (!is_subclass_of($childInsightClass, $parentInsightClass)) {
            throw new \InvalidArgumentException("Class " . $childInsightClass . " does not extend " . $parentInsightClass . ".");
        }

        $index = $this->findPossibleInsightClass($parentInsightClass);
        $this->possibleInsightClasses[$index] = $childInsightClass;
    }

    /**
     * Analyse a log and return an Analysis
     *
     * @return Analysis
     */
    public function analyse(): Analysis
    {
        $analysis = new Analysis();

        foreach ($this->log as $entry) {
            foreach ($this->possibleInsightClasses as $possibleInsightClass) {
                $patterns = $possibleInsightClass::getPatterns();
                foreach ($patterns as $patternKey => $pattern) {
                    $insights = $this->analyseEntry($entry, $possibleInsightClass, $patternKey, $pattern);
                    foreach ($insights as $insight) {
                        $analysis->addInsight($insight);
                    }
                }
            }
        }

        return $analysis;
    }

    /**
     * Compare the entry against the given pattern and create an insight object if it matches
     *
     * @param EntryInterface $entry
     * @param string $possibleInsightClass
     * @param $patternKey
     * @param string $pattern
     * @return PatternInsightInterface[] The matching insights
     */
    protected function analyseEntry(EntryInterface $entry, string $possibleInsightClass, $patternKey, string $pattern): array
    {
        $result = preg_match_all($pattern, $entry, $matches, PREG_SET_ORDER);
        if ($result === false || $result === 0) {
            return [];
        }

        $return = [];
        foreach ($matches as $match) {
            /** @var PatternInsightInterface $insight */
            $insight = new $possibleInsightClass();
            $insight->setMatches($match, $patternKey);
            $insight->setEntry($entry);

            $return[] = $insight;
        }

        return $return;
    }
}