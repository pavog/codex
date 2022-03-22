<?php

namespace Aternos\Codex\Detective;

/**
 * Class SinglePatternDetector
 *
 * @package Aternos\Codex\Detective
 */
class SinglePatternDetector extends PatternDetector
{
    /**
     * Detect if the log matches
     *
     * Checks if the pattern matches anywhere in the log file
     *
     * Returns either true or false
     *
     * @return bool
     */
    public function detect()
    {
        return preg_match($this->pattern, $this->getLogContent()) === 1;
    }
}