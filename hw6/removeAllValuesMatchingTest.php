<?php
include "code.php";

use PHPUnit\Framework\TestCase;

final class CodeTest extends TestCase
{
    public function testRemovesEveryMatch(): void
    {
        $input = ['a' => 'one', 'b' => 'two', 'c' => 'three', 'd' => 'two'];
        $this->assertSame(['a' => 'one', 'c' => 'three'], removeAllValuesMatching($input, 'two'));
    }

    public function testNoMatchesLeavesArrayUnchanged(): void
    {
        $input = ['a' => 'one', 'b' => 'two'];
        $this->assertSame($input, removeAllValuesMatching($input, 'missing'));
    }

    public function testAllMatchesReturnsEmptyArray(): void
    {
        $this->assertSame([], removeAllValuesMatching(['a' => 'x', 'b' => 'x'], 'x'));
    }

    public function testPreservesAssociativeKeys(): void
    {
        $input = [10 => 'keep', 20 => 'remove', 40 => 'also keep'];
        $this->assertSame([10 => 'keep', 40 => 'also keep'], removeAllValuesMatching($input, 'remove'));
    }

    public function testUsesStrictValueMatching(): void
    {
        $input = ['integer' => 2, 'string' => '2', 'other' => 3];
        $this->assertSame(['string' => '2', 'other' => 3], removeAllValuesMatching($input, 2));
    }
}
