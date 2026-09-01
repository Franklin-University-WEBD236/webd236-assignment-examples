<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/code.php';

final class CodeTest extends TestCase
{
    private function sourceWithoutComments(): string
    {
        $tokens = token_get_all(file_get_contents(__DIR__ . '/code.php'));
        $source = '';

        foreach ($tokens as $token) {
            if (is_array($token)) {
                if (in_array($token[0], [T_COMMENT, T_DOC_COMMENT], true)) {
                    continue;
                }
                $source .= $token[1];
            } else {
                $source .= $token;
            }
        }

        return $source;
    }

    private function expectedFizzBuzz(int $start, int $stop): string
    {
        $values = [];
        for ($number = $start; $number <= $stop; $number++) {
            if ($number % 15 === 0) {
                $values[] = 'FizzBuzz';
            } elseif ($number % 3 === 0) {
                $values[] = 'Fizz';
            } elseif ($number % 5 === 0) {
                $values[] = 'Buzz';
            } else {
                $values[] = (string) $number;
            }
        }

        return $this->expectedHtml($values);
    }

    private function expectedHtml(array $values): string
    {
        $html = "<ul>\n";
        foreach ($values as $value) {
            $html .= "<li>{$value}</li>\n";
        }
        return $html . "</ul>\n";
    }

    public function testServiceIntegrationContract(): void
    {
        $source = $this->sourceWithoutComments();

        $this->assertMatchesRegularExpression('/curl_init\s*\(/i', $source, 'Initialize a cURL request.');
        $this->assertStringContainsString('http://0.0.0.0:8000/fizzBuzzService.php', $source, 'Use the local service URL.');
        $this->assertStringContainsString('CURLOPT_POST', $source, 'Send a POST request.');
        $this->assertStringContainsString('CURLOPT_POSTFIELDS', $source, 'Send start and stop as POST fields.');
        $this->assertStringContainsString('CURLOPT_RETURNTRANSFER', $source, 'Return the service response instead of echoing it.');
        $this->assertMatchesRegularExpression('/curl_exec\s*\(/i', $source, 'Execute the cURL request.');
        $this->assertMatchesRegularExpression('/json_decode\s*\(/i', $source, 'Decode the JSON response.');

        $actual = getFizzBuzz(42, 44);
        $expected = $this->expectedHtml(['SERVICE-42', 'SERVICE-43', 'SERVICE-44']);
        $this->assertSame($expected, $actual, 'Build the HTML from the values returned by the service.');
    }

    public function testRangeOneToSixteen(): void
    {
        $this->assertSame($this->expectedFizzBuzz(1, 16), getFizzBuzz(1, 16));
    }

    public function testRangeOneToThirtyOne(): void
    {
        $this->assertSame($this->expectedFizzBuzz(1, 31), getFizzBuzz(1, 31));
    }

    public function testRangeNineToThirtyOne(): void
    {
        $this->assertSame($this->expectedFizzBuzz(9, 31), getFizzBuzz(9, 31));
    }

    public function testRangeFiveToEleven(): void
    {
        $this->assertSame($this->expectedFizzBuzz(5, 11), getFizzBuzz(5, 11));
    }

    public function testRangeThreeToTen(): void
    {
        $this->assertSame($this->expectedFizzBuzz(3, 10), getFizzBuzz(3, 10));
    }
}
