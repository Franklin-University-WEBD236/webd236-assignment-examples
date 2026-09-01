<?php
include "code.php";

use PHPUnit\Framework\TestCase;

final class CodeTest extends TestCase
{
    public function testReturnsWordsWithMatchingSoundex(): void
    {
        $dictionary = ['Robert', 'Rupert', 'Rubin', 'Ashcraft'];
        $this->assertSame(['Robert', 'Rupert'], findSpellings('Ropert', $dictionary));
    }

    public function testExcludesWordsWithDifferentSoundex(): void
    {
        $dictionary = ['Euler', 'Ellery', 'Gauss', 'Ghosh'];
        $result = findSpellings('Ealer', $dictionary);
        $this->assertContains('Euler', $result);
        $this->assertContains('Ellery', $result);
        $this->assertNotContains('Gauss', $result);
        $this->assertNotContains('Ghosh', $result);
    }

    public function testReturnsEmptyArrayWhenNothingMatches(): void
    {
        $this->assertSame([], findSpellings('Robert', ['Smith', 'Jones', 'Taylor']));
    }

    public function testPreservesDictionaryOrderAndReindexesResults(): void
    {
        $dictionary = [4 => 'Rupert', 8 => 'Rubin', 12 => 'Robert'];
        $this->assertSame(['Rupert', 'Robert'], findSpellings('Ropert', $dictionary));
    }

    public function testWorksWithTheCourseDictionaryFixture(): void
    {
        $words = preg_split('/[ \t\n\r]+/', trim(file_get_contents('words.txt')));
        $matches = findSpellings('mispeled', $words);
        $this->assertNotEmpty($matches);
        foreach ($matches as $match) {
            $this->assertSame(soundex('mispeled'), soundex($match));
        }
    }
}
