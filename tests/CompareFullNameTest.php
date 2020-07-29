<?php

/**
 * This file is main class for testing compare two full name records
 * on different cases
 *
 *
 * @author Sergey Gerashchenko <sergey.gerashchenko@lamp-dev.com>, 2020
 */

namespace App\Tests;

use App\CompareFullName;
use PHPUnit\Framework\TestCase;

class CompareFullNameTest extends TestCase
{
    /**
     * Test method for comparing set of full names records
     *
     * @covers CompareFullName::compare
     * @dataProvider fullnamesProvider
     * @param string $name1
     * @param string $name2
     * @param bool $expected
     * @return void
     */
    public function testCompare(string $name1, string $name2, bool $expected): void
    {
        $checker = new CompareFullName($name1, $name2);
        $this->assertSame($expected, $checker->compare());
    }

    public function fullnamesProvider(): array
    {
        return [
            'ZAINAB == ZAINAB ZAINAB, Abdulsalam' => [
                "ZAINAB",
                "ZAINAB ZAINAB, Abdulsalam",
                true
            ],
            'ZAINAB! Abdulsalam == ABdulsalam   ZAINAB, Abdulsalam' => [
                "ZAINAB! Abdulsalam",
                "ABdulsalam   ZAINAB",
                true
            ],
            'ZAINA Abdulsalam != ABdulsalam   ZAINAB' => [
                "ZAINA Abdulsalam",
                "ABdulsalam   ZAINAB",
                false
            ],
            'IDOWU == IDOWU' => [
                "IDOWU",
                "IDOWU",
                true
            ],
            'IDOWU EBUNOLUWA == EBUNOLUWA IDOWU' => [
                "IDOWU EBUNOLUWA",
                "EBUNOLUWA IDOWU",
                true
            ],
            'IDOWU EBUNOLUWA == IDOWU EBUNOLUWA' => [
                "IDOWU EBUNOLUWA",
                "IDOWU EBUNOLUWA",
                true
            ],
            'IDOWU SARAH EBUNOLUWA == EBUNOLUWA IDOWU' => [
                "IDOWU SARAH EBUNOLUWA",
                "EBUNOLUWA IDOWU",
                true
            ],
            'IDOWU EBUNOLUWA SARAH == SARAH, EBUNOLUWA IDOWU' => [
                "IDOWU EBUNOLUWA SARAH",
                "SARAH, EBUNOLUWA IDOWU",
                true
            ],
            'IDOWU EBUNOLUWA SARAH == SARA, EBUNOLUWA IDOWU' => [
                "IDOWU EBUNOLUWA SARAH",
                "SARA, EBUNOLUWA IDOWU",
                false
            ]
        ];
    }
}
