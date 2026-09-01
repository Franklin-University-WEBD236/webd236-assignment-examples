<?php
include "code.php";

use PHPUnit\Framework\TestCase;

final class CodeTest extends TestCase
{
    public function testNamedMinAndMaxCallbacks(): void
    {
        $values = [2, 8, 10, 5, 3, 1];
        $this->assertSame(10, reduce($values, 'max'));
        $this->assertSame(1, reduce($values, 'min'));
    }

    public function testAnonymousSumCallback(): void
    {
        $this->assertSame(15, reduce([1, 2, 3, 4, 5], fn($current, $new) => $current + $new));
    }

    public function testPassesCurrentResultBeforeNextElement(): void
    {
        $result = reduce(['A', 'B', 'C'], fn($current, $new) => "($current>$new)");
        $this->assertSame('((A>B)>C)', $result);
    }
}
