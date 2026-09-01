<?php

use PHPUnit\Framework\TestCase;

final class CodeTest extends TestCase
{
    private const EMPLOYEES = [
        100 => 'James Worley', 101 => 'Henry Ramso', 102 => 'Rosemary Edwards',
        103 => 'Ronald Donelly', 104 => 'Preston Yukon', 105 => 'Arnelle Heffington',
        106 => 'Ross Washington', 108 => 'Elaine Robertson', 110 => 'Van Thieu',
        114 => 'Gerald Graztevski', 122 => 'Todd Wilson', 123 => 'Suzanne Jones',
        124 => 'Elsa Smith', 126 => 'James Ardano', 155 => 'Annelise Ritula',
        160 => 'Robert Smith', 161 => 'George Watson', 162 => 'Peter Rob',
        165 => 'Kathryn Williamson', 166 => 'Jill Herndon', 173 => 'Weston Teng',
        191 => 'Willa Dexter', 195 => 'Herman Williams', 209 => 'Melanie Smith',
        228 => 'Carlos Coronel', 231 => 'Rebecca Shebert', 297 => 'Hermine Jones',
        299 => 'Doreen Stoddard', 301 => 'Ismael Osaki', 333 => 'Julian Jordan',
        335 => 'Ronald Okomoto', 342 => 'Robert Smith', 387 => 'George Smithson',
        401 => 'James Blalock', 412 => 'Robert Smith', 425 => 'Ralph Matler',
        435 => 'Anne Doornberg',
    ];

    private function request(string $script, array $get = []): string
    {
        $payload = base64_encode(json_encode(['script' => $script, 'get' => $get]));
        $command = 'php ' . escapeshellarg(__DIR__ . '/request_runner.php') . ' ' . escapeshellarg($payload) . ' 2>&1';
        return shell_exec($command) ?? '';
    }

    private function xpath(string $html): DOMXPath
    {
        libxml_use_internal_errors(true);
        $dom = new DOMDocument();
        $dom->loadHTML($html);
        return new DOMXPath($dom);
    }

    private function normalize(string $text): string
    {
        return trim((string) preg_replace('/\s+/', ' ', $text));
    }

    private function employeeLinks(string $html): array
    {
        $links = [];
        foreach ($this->xpath($html)->query('//a[contains(@href,"viewEmp.php") and contains(@href,"EMP_NUM=")]') as $anchor) {
            parse_str((string) parse_url($anchor->getAttribute('href'), PHP_URL_QUERY), $query);
            if (isset($query['EMP_NUM'])) {
                $links[(int) $query['EMP_NUM']] = $this->normalize($anchor->textContent);
            }
        }
        ksort($links);
        return $links;
    }

    public function testCompleteEmployeeList(): void
    {
        $html = $this->request('index.php');
        $this->assertStringContainsStringIgnoringCase('Employee Listing', $html);
        $actualNames = array_values($this->employeeLinks($html));
        $expectedNames = array_values(self::EMPLOYEES);
        sort($actualNames);
        sort($expectedNames);
        $this->assertSame($expectedNames, $actualNames, 'index.php must display every employee exactly once.');
    }

    public function testEmployeeLinksUseMatchingNumbers(): void
    {
        $actual = $this->employeeLinks($this->request('index.php'));
        $expected = self::EMPLOYEES;
        ksort($expected);
        $this->assertSame($expected, $actual, 'Each employee name must link to its matching EMP_NUM.');
    }

    public function testEmployee100Details(): void
    {
        $html = $this->request('viewEmp.php', ['EMP_NUM' => '100']);
        foreach (['James', 'Worley', 'F', 'CUST'] as $value) {
            $this->assertStringContainsString($value, $html, "Employee 100 detail page is missing {$value}.");
        }
    }

    public function testEmployee104Details(): void
    {
        $html = $this->request('viewEmp.php', ['EMP_NUM' => '104']);
        foreach (['Preston', 'Yukon', 'D', 'PROF'] as $value) {
            $this->assertStringContainsString($value, $html, "Employee 104 detail page is missing {$value}.");
        }
    }

    public function testDetailFieldContract(): void
    {
        $html = $this->request('viewEmp.php', ['EMP_NUM' => '100']);
        foreach (['First name', 'Last name', 'Middle initial', 'Date of birth', 'Job Code', 'Date of Hire'] as $label) {
            $this->assertStringContainsStringIgnoringCase($label, $html, "The detail page is missing the {$label} field.");
        }
    }

    public function testMissingEmployeeNumber(): void
    {
        $html = $this->request('viewEmp.php');
        $this->assertStringNotContainsString('Fatal error', $html);
        $this->assertStringNotContainsString('Warning:', $html);
        $this->assertMatchesRegularExpression('/(employee|faculty).*(not found|number|missing|given)/i', $html, 'Display a helpful message when EMP_NUM is missing.');
    }
}
