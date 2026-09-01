# Homework 6: Arrays and file processing

This folder contains the public assignment contract and the exact PHPUnit tests Ed runs for Homework 6. The tests are meant to make the grading behavior visible; they do not contain completed solutions.

| Assignment | Public test | Behaviors graded |
| --- | --- | --- |
| `removeAllValuesMatching()` | `removeAllValuesMatchingTest.php` | every match, no/all matches, preserved keys, strict comparison |
| `removeDuplicates()` | `removeDuplicatesTest.php` | removal of every duplicated value, unique values, keys, repeated values |
| `findSpellings()` | `findSpellingsTest.php` | matching/excluded Soundex codes, empty results, order and indexing, fixture use |

`findSpellingsTest.php` also uses the included `words.txt` course fixture. Students do not need to download or submit these files. In Ed, each visible test category runs the correspondingly named PHPUnit method.
