<?php

use PHPUnit\Framework\TestCase;

final class CodeTest extends TestCase
{
    private function request(string $method, string $uri, array $post = []): string
    {
        $payload = base64_encode(json_encode([
            'method' => strtoupper($method),
            'uri' => $uri,
            'post' => $post,
        ]));
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

    private function groupName(string $html): string
    {
        $xpath = $this->xpath($html);
        if ($xpath->query('//input[@name="data[email]"]')->length > 0) {
            return 'data';
        }
        if ($xpath->query('//input[@name="form[email]"]')->length > 0) {
            return 'form';
        }
        $this->fail('The email input must be named data[email] or form[email].');
    }

    private function postForm(array $values): string
    {
        $group = $this->groupName($this->request('GET', '/index'));
        return $this->request('POST', '/process/account', [$group => $values]);
    }

    private function isChecked(string $html, array $names, string $value): bool
    {
        $xpath = $this->xpath($html);
        foreach ($names as $name) {
            $nodes = $xpath->query('//input[@name="' . $name . '" and @value="' . $value . '"]');
            if ($nodes->length > 0 && $nodes->item(0)->hasAttribute('checked')) {
                return true;
            }
        }
        return false;
    }

    private function inputValue(string $html, array $names): ?string
    {
        $xpath = $this->xpath($html);
        foreach ($names as $name) {
            $nodes = $xpath->query('//input[@name="' . $name . '"]');
            if ($nodes->length > 0) {
                return $nodes->item(0)->getAttribute('value');
            }
        }
        return null;
    }

    public function testFormStructure(): void
    {
        $html = $this->request('GET', '/index');
        $group = $this->groupName($html);
        $xpath = $this->xpath($html);
        $this->assertGreaterThan(0, $xpath->query('//input[@name="' . $group . '[email]"]')->length, 'Missing grouped email input.');
        $this->assertGreaterThan(0, $xpath->query('//input[@type="radio" and @name="' . $group . '[reason]"]')->length, 'Reason choices must be grouped radio buttons.');
        $this->assertGreaterThan(0, $xpath->query('//input[@type="checkbox" and (@name="' . $group . '[list][]" or @name="' . $group . '[lists][]")]')->length, 'Mailing lists must be grouped checkboxes.');
        $this->assertGreaterThanOrEqual(3, $xpath->query('//label[@for and string-length(@for) > 0]')->length, 'Use labels with for attributes connected to input ids.');
    }

    public function testRequiredFieldValidation(): void
    {
        $html = strtolower($this->postForm([]));
        foreach (['email', 'reason', 'list'] as $word) {
            $this->assertStringContainsString($word, $html, "The empty submission needs a {$word} validation message.");
        }
    }

    public function testSelectionsRetained(): void
    {
        $html = $this->postForm([
            'list' => ['marketing', 'products'],
            'lists' => ['marketing', 'products'],
            'reason' => 'too_many',
        ]);
        $this->assertTrue($this->isChecked($html, ['data[list][]', 'data[lists][]', 'form[list][]', 'form[lists][]'], 'marketing'), 'Marketing must remain selected.');
        $this->assertTrue($this->isChecked($html, ['data[list][]', 'data[lists][]', 'form[list][]', 'form[lists][]'], 'products'), 'Products must remain selected.');
        $this->assertTrue($this->isChecked($html, ['data[reason]', 'form[reason]'], 'too_many'), 'The reason must remain selected.');
    }

    public function testEmailRetained(): void
    {
        $html = $this->postForm(['email' => 'student@example.com']);
        $this->assertSame('student@example.com', $this->inputValue($html, ['data[email]', 'form[email]']), 'Retain the submitted email when other validation fails.');
    }

    public function testSuccessConfirmation(): void
    {
        $html = $this->postForm([
            'email' => 'student@example.com',
            'list' => ['marketing', 'products'],
            'lists' => ['marketing', 'products'],
            'reason' => 'too_many',
        ]);
        $this->assertMatchesRegularExpression('/confirm.*unsubscribe|unsubscribe.*confirm/i', $html, 'Display an unsubscribe confirmation.');
        $this->assertStringContainsString('student@example.com', $html, 'Display the submitted email on the confirmation.');
    }

    public function testSelectedListsDisplayed(): void
    {
        $html = strtolower($this->postForm([
            'email' => 'student@example.com',
            'list' => ['marketing', 'products'],
            'lists' => ['marketing', 'products'],
            'reason' => 'too_many',
        ]));
        $this->assertStringContainsString('marketing', $html, 'Display the selected marketing list on the confirmation.');
        $this->assertStringContainsString('products', $html, 'Display the selected products list on the confirmation.');
    }
}
