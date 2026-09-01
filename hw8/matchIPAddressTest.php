<?php

include "code.php";

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Assert;

final class matchIPAddressTest extends TestCase {

  function test_matchIPAddress1() {
    $data = array('192.168.1.1', '10.0.0.1', '127.0.0.1', '172.16.0.254');
    foreach ($data as $ipa) {
      $this->assertTrue(matchIPAddress($ipa), "$ipa should be a valid IP address");
    }
  }

  function test_matchIPAddress2() {
    $data = array('192.168.01.1', '10.001.0.1', '127.00.0.1', '345.0.0.1', '192.678.0.1', '192.168.456.1');
    foreach ($data as $ipa) {
      $this->assertFalse(matchIPAddress($ipa), "$ipa should not be a valid IP address");
    }
  }

}

?>
