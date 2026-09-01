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

    private function request(string $uri): string
    {
        $payload = base64_encode(json_encode(['uri' => $uri]));
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
        foreach ($this->xpath($html)->query('//a[contains(@href,"employee/view/")]') as $anchor) {
            if (preg_match('~employee/view/(\d+)~', $anchor->getAttribute('href'), $match)) {
                $links[(int) $match[1]] = $this->normalize($anchor->textContent);
            }
        }
        ksort($links);
        return $links;
    }

    private function assertFunctions(string $file, array $functions): void
    {
        $source = file_get_contents($file);
        foreach ($functions as $function) {
            $this->assertMatchesRegularExpression('/function\s+' . preg_quote($function, '/') . '\s*\(/i', $source, "{$file} must define {$function}().");
        }
    }

    public function testMvcFileStructure(): void
    {
        foreach (['controllers/employee.php', 'models/employee.php', 'views/employeelist.php', 'views/employeeview.php'] as $file) {
            $this->assertFileExists($file, "Missing required MVC file: {$file}");
        }
    }

    public function testMvcFunctionContract(): void
    {
        $this->assertFunctions('controllers/employee.php', ['get_list', 'get_view']);
        $this->assertFunctions('models/employee.php', ['findAllEmployees', 'findEmployeeByNumber']);
    }

    public function testCompleteEmployeeList(): void
    {
        $actualNames = array_values($this->employeeLinks($this->request('/employee/list')));
        $expectedNames = array_values(self::EMPLOYEES);
        sort($actualNames);
        sort($expectedNames);
        $this->assertSame($expectedNames, $actualNames, 'employee/list must display every employee exactly once.');
    }

    public function testEmployeeLinks(): void
    {
        $actual = $this->employeeLinks($this->request('/employee/list'));
        $expected = self::EMPLOYEES;
        ksort($expected);
        $this->assertSame($expected, $actual, 'Each employee must link to employee/view/EMP_NUM.');
    }

    public function testEmployee100Details(): void
    {
        $html = $this->request('/employee/view/100');
        foreach (['James', 'Worley', 'F', 'CUST'] as $value) {
            $this->assertStringContainsString($value, $html, "Employee 100 detail page is missing {$value}.");
        }
    }

    public function testEmployee104Details(): void
    {
        $html = $this->request('/employee/view/104');
        foreach (['Preston', 'Yukon', 'D', 'PROF'] as $value) {
            $this->assertStringContainsString($value, $html, "Employee 104 detail page is missing {$value}.");
        }
    }
}
