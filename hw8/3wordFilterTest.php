<?php
include "code.php";

use PHPUnit\Framework\TestCase;

final class CodeTest extends TestCase
{
    public function testReplacesSingleBlacklistedWord(): void
    {
        $this->assertSame('*****', wordFilter('fudge'));
    }

    public function testMatchingIsCaseInsensitive(): void
    {
        $this->assertSame('**** it! *****!', wordFilter('Darn it! SHOOT!'));
    }

    public function testReplacesMultipleWordsAndPreservesPunctuation(): void
    {
        $input = "Oh, shoot! That's darn unfortunate—fudge.";
        $this->assertSame("Oh, *****! That's **** unfortunate—*****.", wordFilter($input));
    }

    public function testOnlyReplacesWholeWords(): void
    {
        $input = 'Darnel can overshoot while eating a fudgesicle.';
        $this->assertSame($input, wordFilter($input));
    }

    public function testEmptyAndCleanInputRemainUnchanged(): void
    {
        $this->assertSame('', wordFilter(''));
        $this->assertSame('Everything is fine.', wordFilter('Everything is fine.'));
    }
}
