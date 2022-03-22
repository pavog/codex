<?php

namespace Aternos\Codex\Analysis;

/**
 * Class Information
 *
 * @package Aternos\Codex\Analysis
 */
abstract class Information extends Insight implements InformationInterface
{
    /**
     * @var string
     */
    protected string $label;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * Get the information label
     *
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * Set the information label
     *
     * @param string $label
     * @return Information
     */
    protected function setLabel(string $label): Information
    {
        $this->label = $label;
        return $this;
    }

    /**
     * Get the information value
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the information value
     *
     * @param mixed $value
     * @return $this
     */
    public function setValue($value): Information
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Get a human readable message
     *
     * @return string
     */
    public function getMessage(): string
    {
        return $this->getLabel() . ": " . $this->getValue();
    }

    /**
     * Check if the $insight object is equal with the current object
     *
     * @param InsightInterface $insight
     * @return bool
     */
    public function isEqual(InsightInterface $insight): bool
    {
        return $insight instanceof self
            && $this->getLabel() === $insight->getLabel()
            && $this->getValue() === $insight->getValue();
    }
}