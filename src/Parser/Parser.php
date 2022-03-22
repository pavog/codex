<?php

namespace Aternos\Codex\Parser;

use Aternos\Codex\Log\LogInterface;

/**
 * Class Parser
 *
 * @package Aternos\Codex\Parser
 */
abstract class Parser implements ParserInterface
{
    /**
     * @var LogInterface|null $log
     */
    protected ?LogInterface $log;

    /**
     * Set the output log object
     *
     * @param LogInterface $log
     * @return $this
     */
    public function setLog(LogInterface $log): Parser
    {
        $this->log = $log;
        return $this;
    }

    /**
     * Get the log content as string
     *
     * @return string
     */
    protected function getLogContent(): string
    {
        return $this->log->getLogFile()->getContent();
    }

    /**
     * Get the log content as array split by line
     *
     * @return string[]
     */
    protected function getLogContentAsArray(): array
    {
        return explode(PHP_EOL, $this->getLogContent());
    }
}