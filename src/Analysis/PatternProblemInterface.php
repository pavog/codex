<?php

namespace Aternos\Codex\Analysis;

/**
 * Interface PatternProblemInterface
 *
 * @package Aternos\Codex\Analysis
 */
interface PatternProblemInterface extends ProblemInterface
{
    /**
     * Get an array of possible patterns
     *
     * The array key of the pattern will be passed to setMatches()
     *
     * @return array
     */
    public static function getPatterns(): array;

    /**
     * Apply the matches from the pattern
     *
     * @param array $matches
     * @param $patternKey
     * @return mixed
     */
    public function setMatches(array $matches, $patternKey);
}