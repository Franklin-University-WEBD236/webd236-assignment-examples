<?php

use PHPUnit\Framework\TestCase;

final class CodeTest extends TestCase
{
    private function render(array $request): string
    {
        $_GET = [];
        $_POST = $request;
        $_REQUEST = $request;
        ob_start();
        include 'index.php';
        return (string) ob_get_clean();
    }

    private function xpath(string $html): DOMXPath
    {
        libxml_use_internal_errors(true);
        $dom = new DOMDocument();
        $dom->loadHTML($html);
        return new DOMXPath($dom);
    }

    private function outputItems(string $html): array
    {
        $xpath = $this->xpath($html);
        $nodes = $xpath->query("(//div[contains(concat(' ', normalize-space(@class), ' '), ' row ')][.//ul])[last()]//li");
        $items = [];
        foreach ($nodes as $node) {
            $items[] = trim((string) preg_replace('/\s+/', ' ', $node->textContent));
        }
        return $items;
    }

    private function fizzBuzz(int $start, int $stop): array
    {
        $items = [];
        for ($number = $start; $number <= $stop; $number++) {
            if ($number % 15 === 0) {
                $items[] = 'FizzBuzz';
            } elseif ($number % 3 === 0) {
                $items[] = 'Fizz';
            } elseif ($number % 5 === 0) {
                $items[] = 'Buzz';
            } else {
                $items[] = (string) $number;
            }
        }
        return $items;
    }

    public function testFormContract(): void
    {
        $xpath = $this->xpath($this->render([]));
        $this->assertGreaterThan(0, $xpath->query('//form//input[@name="start"]')->length, 'The form needs an input named start.');
        $this->assertGreaterThan(0, $xpath->query('//form//input[@name="stop"]')->length, 'The form needs an input named stop.');
        $this->assertGreaterThan(0, $xpath->query('//form')->length, 'index.php needs a form that submits the range.');
    }

    public function testDefaultRange(): void
    {
        $this->assertSame($this->fizzBuzz(1, 100), $this->outputItems($this->render([])), 'An empty request must use the inclusive range 1 through 100.');
    }

    public function testRangeFiveToFifteen(): void
    {
        $this->assertSame($this->fizzBuzz(5, 15), $this->outputItems($this->render(['start' => '5', 'stop' => '15'])));
    }

    public function testInclusiveEndpoints(): void
    {
        $this->assertSame(['14', 'FizzBuzz', '16'], $this->outputItems($this->render(['start' => '14', 'stop' => '16'])));
    }

    public function testShortCustomRange(): void
    {
        $this->assertSame(['8', 'Fizz', 'Buzz'], $this->outputItems($this->render(['start' => '8', 'stop' => '10'])));
    }

    public function testBoundsAreLimited(): void
    {
        $this->assertSame($this->fizzBuzz(1, 3), $this->outputItems($this->render(['start' => '-5', 'stop' => '3'])), 'Values below 1 must be limited to 1.');
        $this->assertSame($this->fizzBuzz(99, 100), $this->outputItems($this->render(['start' => '99', 'stop' => '105'])), 'Values above 100 must be limited to 100.');
    }
}
