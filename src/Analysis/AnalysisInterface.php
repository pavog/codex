<?php

namespace Aternos\Codex\Analysis;

/**
 * Interface AnalysisInterface
 *
 * @package Aternos\Codex\Analysis
 */
interface AnalysisInterface extends \Iterator, \Countable, \ArrayAccess
{
    /**
     * Set all insights at once in an array replacing the current insights
     *
     * @param InsightInterface[] $insights
     * @return $this
     */
    public function setInsights(array $insights = []): AnalysisInterface;

    /**
     * Add an insight
     *
     * @param InsightInterface $insight
     * @return $this
     */
    public function addInsight(InsightInterface $insight): AnalysisInterface;

    /**
     * Get all insights
     *
     * @return array
     */
    public function getInsights(): array;
}