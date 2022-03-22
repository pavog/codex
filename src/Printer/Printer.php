<?php

namespace Aternos\Codex\Printer;

use Aternos\Codex\Log\EntryInterface;
use Aternos\Codex\Log\LineInterface;
use Aternos\Codex\Log\LogInterface;

/**
 * Class Printer
 *
 * @package Aternos\Codex\Printer
 */
abstract class Printer implements PrinterInterface
{
    /**
     * @var LogInterface|null
     */
    protected ?LogInterface $log;

    /**
     * @var EntryInterface|null
     */
    protected ?EntryInterface $entry = null;

    /**
     * Set the log
     *
     * @param LogInterface $log
     * @return $this
     */
    public function setLog(LogInterface $log): Printer
    {
        $this->log = $log;
        return $this;
    }

    /**
     * Set the entry
     *
     * @param EntryInterface $entry
     * @return $this
     */
    public function setEntry(EntryInterface $entry): Printer
    {
        $this->entry = $entry;
        return $this;
    }

    /**
     * Print the log
     *
     * @return string
     */
    public function print(): string
    {
        if ($this->entry) {
            return $this->printEntry($this->entry);
        }

        return $this->printLog($this->log);
    }

    /**
     * Print a log
     *
     * @param LogInterface $log
     * @return string
     */
    protected function printLog(LogInterface $log): string
    {
        $return = "";
        foreach ($log as $entry) {
            $return .= $this->printEntry($entry);
        }

        return $return;
    }

    /**
     * Print an entry
     *
     * @param EntryInterface $entry
     * @return string
     */
    protected function printEntry(EntryInterface $entry): string
    {
        $return = "";
        foreach ($entry as $line) {
            $return .= $this->printLine($line);
        }

        return $return;
    }

    /**
     * Print a line
     *
     * @param LineInterface $line
     * @return string
     */
    abstract protected function printLine(LineInterface $line): string;
}