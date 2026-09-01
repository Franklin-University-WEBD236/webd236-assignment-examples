<?php
include "code.php";

use PHPUnit\Framework\TestCase;

final class CodeTest extends TestCase
{
    public function testNoRepeatedCharacters(): void
    {
        $this->assertSame(1, longestRun('abcde'));
    }

    public function testRepeatedRun(): void
    {
        $this->assertSame(3, longestRun('abbcddde'));
    }

    public function testSeparatedOccurrencesDoNotCombine(): void
    {
        $this->assertSame(2, longestRun('aabbaa'));
        $this->assertSame(3, longestRun('xxabbbxx'));
    }

    public function testEmptyAndSingleCharacter(): void
    {
        $this->assertSame(0, longestRun(''));
        $this->assertSame(1, longestRun('x'));
    }
}
