<?php

include "json_decode.php";
include "code.php";

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Assert;

final class fizzBuzzServiceTest extends TestCase {
  function test_getFizzBuzz() {
    $c = 1;
    $results = [];
    while($c < 6){
     $results[$c] = file_get_contents("results" . $c . ".txt");
     $c++; 
    }
    $this->assertEquals($results[1], getFizzBuzz(1,16), "The HTML output is not correct");
    $this->assertEquals($results[2], getFizzBuzz(1,31), "The HTML output is not correct");
    $this->assertEquals($results[3], getFizzBuzz(9,31), "The HTML output is not correct");
    $this->assertEquals($results[4], getFizzBuzz(5,11), "The HTML output is not correct");
    $this->assertEquals($results[5], getFizzBuzz(3,10), "The HTML output is not correct");
  }
}

?>
