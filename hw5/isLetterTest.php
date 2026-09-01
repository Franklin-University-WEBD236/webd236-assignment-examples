<?php

include "code.php";

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Assert;

final class letterTest extends TestCase {

  public function testIsLetterWithNumber() {
    $this->assertFalse(isLetter("1"), "isLetter('1') should be false");
  }
  public function testIsLetterLowerCaseEdge() {
    $this->assertTrue(isLetter("z"), "isLetter('z') should be true");
  }
  public function testIsLetterCapitalEdge() {
    $this->assertTrue(isLetter("A"), "isLetter('A') should be true");
  }
  public function testIsLetterTest() {
    $this->assertTrue(isLetter("g"), "isLetter('g') should be true");
  }

}

?>
