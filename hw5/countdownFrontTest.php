<?php
include "code.php";

use PHPUnit\Framework\TestCase;

final class CodeTest extends TestCase
{
    public function testZeroAndOne(): void
    {
        $this->assertSame('', countdownFront('Pancake', 0));
        $this->assertSame('P', countdownFront('Pancake', 1));
    }

    public function testTwoAndThree(): void
    {
        $this->assertSame('PaP', countdownFront('Pancake', 2));
        $this->assertSame('PanPaP', countdownFront('Pancake', 3));
    }

    public function testFourAndFive(): void
    {
        $this->assertSame('PancPanPaP', countdownFront('Pancake', 4));
        $this->assertSame('PancaPancPanPaP', countdownFront('Pancake', 5));
    }

    public function testSixAndFullLength(): void
    {
        $this->assertSame('PancakPancaPancPanPaP', countdownFront('Pancake', 6));
        $this->assertSame('PancakePancakPancaPancPanPaP', countdownFront('Pancake', 7));
    }
}
