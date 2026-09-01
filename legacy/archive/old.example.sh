mv bin/* /bin
chmod a+x /bin/*
FILE=_instructorTests.php

cat << 'EOT' >> $FILE
<?php
include "code.php";

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Assert;

final class CodeTest extends TestCase {

  private static $score = 0;

  public function setUp() {
    CodeTest::$score += 100 / $this->getTestCount();
    $this->writeScore();
  }
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
  protected function onNotSuccessfulTest(Throwable $e) {
    CodeTest::$score -= 100 / $this->getTestCount();
    $debug = fopen("DEBUG", "a");
    fwrite($debug, $e->getMessage() . "\n");
    $p = "Penalty: -" . 100 / $this->getTestCount() .  "% = " . CodeTest::$score . "%";
    fwrite($debug, $p . "\n---\n");
    fclose($debug);
    $this->writeScore();
    throw $e;
  }
  protected function writeScore() {
    $output = fopen("OUTPUT", "w");
    fwrite($output, CodeTest::$score);
    fclose($output);
  }
  protected function getTestCount() {
    $tests = get_class_methods("CodeTest");
    $c = 0;
    foreach($tests as $test) {
      if(strpos($test, "test") === 0){
        $c++;
      }
    }
    return $c;
  }
}
EOT

phpunit.phar $FILE
