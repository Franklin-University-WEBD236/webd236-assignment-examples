<?php
include "code.php";

use PHPUnit\Framework\TestCase;

final class CodeTest extends TestCase
{
    public function testUppercaseLetters(): void
    {
        foreach (['A', 'M', 'Z'] as $character) {
            $this->assertTrue(isLetter($character), "$character should be an ASCII letter");
        }
    }

    public function testLowercaseLetters(): void
    {
        foreach (['a', 'm', 'z'] as $character) {
            $this->assertTrue(isLetter($character), "$character should be an ASCII letter");
        }
    }

    public function testBoundaryNonLetters(): void
    {
        foreach (['@', '[', '\\', '`', '{'] as $character) {
            $this->assertFalse(isLetter($character), "$character is just outside an ASCII letter range");
        }
    }

    public function testOtherInvalidCharacters(): void
    {
        foreach (['0', '-', ' ', '', 'ab'] as $character) {
            $this->assertFalse(isLetter($character), "'$character' is not exactly one ASCII letter");
        }
    }
}
