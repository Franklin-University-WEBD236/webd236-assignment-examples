<?php
include "code.php";

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Assert;

final class CodeTest extends TestCase {

  public function testIsPalindrome1() {
    $strings = ['racecar', 'mom', 'level', ''];
    foreach ($strings as $str) {
      $this->assertTrue(isPalindrome($str), "'$str' is a palindrome");
    }
  }
  public function testIsPalindrome2() {
    $strings = ['able was i ere i saw elba', 'Able was I, ere I saw Elba', "Madam, I'm Adam"];
    foreach ($strings as $str) {
      $this->assertTrue(isPalindrome($str), "'$str' is a palindrome");
    }
  }
  public function testIsPalindrome3() {
    $this->assertFalse(isPalindrome("ello there"), "'ello there' is not a palindrome");
  }
  public function testIsPalindrome4() {
    $this->assertFalse(isPalindrome("another test"), "'another test' is not a palindrome");
  }

}
