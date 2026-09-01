<?php
include "code.php";

use PHPUnit\Framework\TestCase;

final class CodeTest extends TestCase
{
    public function testOrdinaryString(): void
    {
        $this->assertSame('olleh', myReverse('hello'));
    }

    public function testPalindromeString(): void
    {
        $this->assertSame('toot', myReverse('toot'));
    }

    public function testEmptyAndSingleCharacter(): void
    {
        $this->assertSame('', myReverse(''));
        $this->assertSame('x', myReverse('x'));
    }

    public function testSpacesAndPunctuation(): void
    {
        $this->assertSame('!dlrow ,olleH', myReverse('Hello, world!'));
    }
}
