<?php
include "code.php";

use PHPUnit\Framework\TestCase;

final class CodeTest extends TestCase
{
    public function testAcceptsCanonicalAddressesAndBoundaries(): void
    {
        foreach (['0.0.0.0', '10.0.0.1', '192.168.1.1', '255.255.255.255'] as $address) {
            $this->assertTrue(matchIPAddress($address), "$address should be valid");
        }
    }

    public function testRejectsOutOfRangeOctets(): void
    {
        foreach (['256.0.0.1', '10.999.0.1', '192.168.0.300', '-1.2.3.4'] as $address) {
            $this->assertFalse(matchIPAddress($address), "$address has an invalid octet");
        }
    }

    public function testRejectsLeadingZeroOctets(): void
    {
        foreach (['192.168.01.01', '01.2.3.4', '10.00.0.1', '001.2.3.4'] as $address) {
            $this->assertFalse(matchIPAddress($address), "$address is not canonical IPv4 notation");
        }
    }

    public function testRejectsWrongNumberOfOctets(): void
    {
        foreach (['192.168.1', '192.168.1.1.5', '192..1.1', ''] as $address) {
            $this->assertFalse(matchIPAddress($address), "$address must contain exactly four octets");
        }
    }

    public function testRejectsWhitespaceAndExtraCharacters(): void
    {
        foreach ([' 192.168.1.1', '192.168.1.1 ', 'x192.168.1.1', '192.168.1.1/24', '192,168,1,1'] as $address) {
            $this->assertFalse(matchIPAddress($address), "$address must match in full");
        }
    }
}
