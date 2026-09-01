<?php
include "code.php";

use PHPUnit\Framework\TestCase;

final class CodeTest extends TestCase
{
    public function testFindsBasicMode(): void
    {
        $values = [2, 8, 10, 5, 3, 5, 1, 2, 5, 7, 4];
        $this->assertSame(5, array_reduce($values, modeMaker()));
    }

    public function testModeChangesWhenAnotherValueBecomesMostFrequent(): void
    {
        $values = [2, 8, 10, 5, 3, 5, 1, 2, 5, 7, 4, 2, 2];
        $this->assertSame(2, array_reduce($values, modeMaker()));
    }

    public function testEachClosureKeepsIndependentState(): void
    {
        $first = modeMaker();
        $second = modeMaker();

        $this->assertSame('a', array_reduce(['a', 'b', 'a'], $first));
        $this->assertSame('z', array_reduce(['z', 'y', 'z'], $second));
    }
}
