<?php

include "code.php";

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Assert;

final class matchSSNTest extends TestCase {

  function test_MatchSSN1() {
    $data = array('123-45-6789', '437-88-9182', '123456789', '437889182');
    foreach ($data as $ssn) {
      $this->assertTrue(matchSSN($ssn), "$ssn should be a valid ssn");
    }
  }

  function test_MatchSSN2() {
    $data = array('1234-5-6789', '43789182', '123.45.6789',  '437889182--', '123-4Q-6789');
    foreach ($data as $ssn) {
      $this->assertFalse(matchSSN($ssn), "$ssn should not be a valid ssn");
    }
  }

}

?>
