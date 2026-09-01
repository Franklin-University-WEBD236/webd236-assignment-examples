<?php
include "code.php";

use PHPUnit\Framework\TestCase;

final class CodeTest extends TestCase
{
    public function testAcceptsNineDigitsWithBothDashes(): void
    {
        $this->assertTrue(matchSSN('123-45-6789'));
        $this->assertTrue(matchSSN('437-88-9182'));
    }

    public function testAcceptsNineDigitsWithoutDashes(): void
    {
        $this->assertTrue(matchSSN('123456789'));
        $this->assertTrue(matchSSN('437889182'));
    }

    public function testRejectsMalformedOrMixedSeparators(): void
    {
        foreach (['123-456789', '12345-6789', '123.45.6789', '123 45 6789', '123-4Q-6789'] as $ssn) {
            $this->assertFalse(matchSSN($ssn), "$ssn should be rejected");
        }
    }

    public function testRejectsDisallowedNumberGroups(): void
    {
        foreach (['000-12-3456', '666-12-3456', '900-12-3456', '123-00-4567', '123-45-0000'] as $ssn) {
            $this->assertFalse(matchSSN($ssn), "$ssn contains a disallowed group");
        }
    }
}
