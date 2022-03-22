<?php

namespace Aternos\Codex\Detective;

/**
 * Class WeightedSinglePatternDetector
 *
 * @package Aternos\Codex\Detective
 */
class WeightedSinglePatternDetector extends SinglePatternDetector
{
    /**
     * @var float
     */
    protected float $weight;

    /**
     * Set the weight that will be returned if the pattern matches
     *
     * @param float $weight
     * @return $this
     */
    public function setWeight(float $weight): WeightedSinglePatternDetector
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * Detect if the log matches
     *
     * Checks if the pattern matches anywhere in the log file
     *
     * Returns either true or false
     *
     * @return bool|float
     */
    public function detect()
    {
        if (parent::detect()) {
            return $this->weight;
        }

        return false;
    }
}