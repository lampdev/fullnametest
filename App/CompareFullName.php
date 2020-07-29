<?php

/**
 * This file is main class for compare two full name records
 * and determine if it's the same person.
 *
 *
 * @author Sergey Gerashchenko <sergey.gerashchenko@lamp-dev.com>, 2020
 */

namespace App;

class CompareFullName
{
    /** @var string first full name for comparison. */
    private $fullName1;

    /** @var string second full name for comparison. */
    private $fullName2;

    /**
     *
     * @param string $fullName1
     * @param string $fullName2
     * @return void
     */
    public function __construct(string $fullName1, string $fullName2)
    {
        $this->fullName1 = $fullName1;
        $this->fullName2 = $fullName2;
    }

    /**
     * Method for comparing two full names which can have different length, words count, words order
     * and can contain commas/dots/extra spaces
     *
     * @return bool
     */
    public function compare(): bool
    {
        $this->fullName1 = $this->clearNotLetters($this->fullName1);
        $this->fullName2 = $this->clearNotLetters($this->fullName2);
        $fullName1Words = str_word_count(strtoupper($this->fullName1), 1);
        $fullName2Words = str_word_count(strtoupper($this->fullName2), 1);
        return (
            $fullName1Words === array_intersect($fullName1Words, $fullName2Words)
            || $fullName2Words === array_intersect($fullName2Words, $fullName1Words)
        );
    }

    /**
     * Method for clear full name from commas/dots/other non letters and space characters
     *
     * @param  string $fullName
     * @return string
     */
    private function clearNotLetters(string $fullName): string
    {
        return preg_replace('/[^a-zA-Z\s]+/', '', $fullName);
    }
}
