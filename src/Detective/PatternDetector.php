<?php

namespace Aternos\Codex\Detective;

/**
 * Class PatternDetector
 *
 * @package Aternos\Codex\Detective
 */
abstract class PatternDetector extends Detector
{
    /**
     * @var string|null
     */
    protected ?string $pattern;

    /**
     * Set the matching pattern for one line
     *
     * @param string $pattern
     * @return $this
     */
    public function setPattern(string $pattern): PatternDetector
    {
        $this->pattern = $pattern;
        return $this;
    }
}