<?php

include "code.php";

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Assert;

$words = preg_split("/[ \t\n\r]/", file_get_contents("words.txt"));

final class letterTest extends TestCase {

  function test_findSpellings1() {
    global $words;
    $matches = findSpellings("mispeled", $words);
    $this->assertEquals(27, count($matches));
  }

  function test_findSpellings2() {
    global $words;
    $matches = findSpellings("globall", $words);
    $this->assertEquals(16, count($matches));
  }

  function test_findSpellings3() {
    global $words;
    $matches = findSpellings(":-)", $words);
    $this->assertEquals(0, count($matches));
  }

}

?>
