# Homework 8: Regular expressions

This folder contains the public assignment contract and the exact PHPUnit tests Ed runs for Homework 8. The tests are meant to make the grading behavior visible; they do not contain completed solutions.

| Assignment | Public test | Behaviors graded |
| --- | --- | --- |
| `matchSSN()` | `matchSSNTest.php` | dashed/undashed forms, separator consistency, disallowed groups |
| `matchIPAddress()` | `matchIPAddressTest.php` | four octets, numeric bounds, canonical leading-zero rules, full-string matching |
| `wordFilter()` | `3wordFilterTest.php` | case-insensitive replacements, punctuation, whole words, clean input |

For IPv4, an octet may be exactly `0`, but a multi-digit octet may not begin with zero. Thus `192.168.0.1` is valid and `192.168.01.01` is invalid.

Students do not need to download or submit these tests. In Ed, each visible test category runs the correspondingly named PHPUnit method.
