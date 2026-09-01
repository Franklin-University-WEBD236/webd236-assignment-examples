<?php
include "code.php";

use PHPUnit\Framework\TestCase;

final class CodeTest extends TestCase
{
    public function testRemovesEveryOccurrenceOfDuplicateValues(): void
    {
        $input = ['a' => 'one', 'b' => 'two', 'c' => 'three', 'd' => 'two', 'e' => 'four', 'g' => 'three'];
        $this->assertSame(['a' => 'one', 'e' => 'four'], removeDuplicates($input));
    }

    public function testNoDuplicatesLeavesArrayUnchanged(): void
    {
        $input = ['a' => 'one', 'b' => 'two', 'c' => 'three'];
        $this->assertSame($input, removeDuplicates($input));
    }

    public function testAllDuplicatesReturnsEmptyArray(): void
    {
        $this->assertSame([], removeDuplicates(['a' => 'x', 'b' => 'x', 'c' => 'y', 'd' => 'y']));
    }

    public function testPreservesKeysOfUniqueValues(): void
    {
        $input = [10 => 'alpha', 20 => 'beta', 40 => 'alpha', 80 => 'gamma'];
        $this->assertSame([20 => 'beta', 80 => 'gamma'], removeDuplicates($input));
    }

    public function testHandlesValuesRepeatedMoreThanTwice(): void
    {
        $input = ['a' => 'x', 'b' => 'x', 'c' => 'keep', 'd' => 'x'];
        $this->assertSame(['c' => 'keep'], removeDuplicates($input));
    }
}
