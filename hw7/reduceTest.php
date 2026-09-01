<?php

include "code.php";

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Assert;

final class reduceTest extends TestCase {

  function test_reduce1() {
    $arr = [2, 8, 10, 5, 3, 5, 1, 2, 5, 7, 4];
    $this->assertEquals(10, reduce($arr, 'max'), "maximum should be 10");
    $this->assertEquals(1,  reduce($arr, 'min'), "minimum should be 1");
    $this->assertEquals(52, reduce($arr, function($x, $y) { return $x + $y; }), "sum should be 52");
  }

}

?>
