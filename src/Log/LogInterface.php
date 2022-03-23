<?php

namespace Aternos\Codex\Log;

use Aternos\Codex\Log\File\LogFileInterface;
use Aternos\Codex\Parser\ParserInterface;

/**
 * Interface LogInterface
 *
 * @package Aternos\Codex\Log
 */
interface LogInterface extends \Iterator, \Countable, \ArrayAccess
{
    /**
     * Get the default parser
     *
     * @return ParserInterface
     */
    public static function getDefaultParser(): ParserInterface;

    /**
     * Set the log file
     *
     * @param LogFileInterface $logFile
     * @return $this
     */
    public function setLogFile(LogFileInterface $logFile): LogInterface;

    /**
     * Get the log file
     *
     * @return LogFileInterface|null
     */
    public function getLogFile(): ?LogFileInterface;

    /**
     * Parse a log file with a parser
     *
     * Every log type should have a default parser,
     * but the $parser argument can be used to override
     * the default parser
     *
     * @param ParserInterface|null $parser
     * @return $this
     */
    public function parse(ParserInterface $parser = null): LogInterface;

    /**
     * Set all entries of the log at once replacing the current entries
     *
     * @param EntryInterface[] $entries
     * @return $this
     */
    public function setEntries(array $entries = []): LogInterface;

    /**
     * Add an entry to the log
     *
     * @param EntryInterface $entry
     * @return $this
     */
    public function addEntry(EntryInterface $entry): LogInterface;

    /**
     * Get all entries of the log
     *
     * @return EntryInterface[]
     */
    public function getEntries(): array;

    /**
     * @return string
     */
    public function __toString(): string;

    /**
     * Return the current element
     *
     * @return EntryInterface
     */
    public function current(): EntryInterface;

    /**
     * Offset to set
     *
     * @param $offset
     * @param EntryInterface $value
     */
    public function offsetSet($offset, $value): void;

    /**
     * Offset to retrieve
     *
     * @param mixed $offset
     * @return EntryInterface
     */
    public function offsetGet($offset): EntryInterface;
}