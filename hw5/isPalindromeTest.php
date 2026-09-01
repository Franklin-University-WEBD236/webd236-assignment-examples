<?php
include "code.php";

use PHPUnit\Framework\TestCase;

final class CodeTest extends TestCase
{
    public function testSimplePalindromes(): void
    {
        foreach (['racecar', 'mom', 'level'] as $value) {
            $this->assertTrue(isPalindrome($value), "'$value' should be a palindrome");
        }
    }

    public function testIgnoresNonLetters(): void
    {
        $this->assertTrue(isPalindrome('A man, a plan, a canal, Panama!'));
        $this->assertTrue(isPalindrome("Madam, I'm Adam."));
    }

    public function testCaseInsensitive(): void
    {
        $this->assertTrue(isPalindrome('Able was I, ere I saw Elba'));
    }

    public function testRejectsNonPalindromes(): void
    {
        $this->assertFalse(isPalindrome('hello there'));
        $this->assertFalse(isPalindrome('palindrome'));
    }
}
