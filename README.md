# PHP Unit Tests - WEBD 236

Unit test suites for homework assignments in the **WEBD 236: Web Application Development** course at Franklin University.

## Overview

This repository contains PHPUnit test cases that validate the functionality of student-submitted homework assignments for WEBD 236. Each homework folder includes comprehensive unit tests designed to verify correct implementation of course concepts.

## Course Information

- **Course Code:** WEBD 236
- **Course Title:** Web Application Development
- **Institution:** Franklin University
- **Language:** PHP

## Repository Structure

The repository is organized by homework assignment:

### HW5: String Functions
Tests implementation of string manipulation functions:
- `isPalindrome()` - Validates palindrome detection
- `myReverse()` - Tests string reversal functionality
- `isLetter()` - Checks letter classification
- `longestRun()` - Finds the longest consecutive character sequence
- `countdownFront()` - Tests countdown string generation

### HW6: Array Operations
Tests array manipulation and file processing:
- `removeDuplicates()` - Removes duplicate values from arrays
- `removeAllValuesMatching()` - Filters array by matching pattern
- `findSpellings()` - Validates word matching against dictionary (uses `words.txt`)

### HW7: Object-Oriented Programming
Tests class design and functional programming concepts:
- `Car` class - Tests object properties and methods
- `modeMaker()` - Calculates the mode (most frequent value) of a dataset
- `reduce()` - Tests functional reduce/fold operations

### HW8: Regular Expressions
Tests pattern matching and validation:
- `matchIPAddress()` - Validates IP address format
- `matchSSN()` - Validates Social Security Number format
- `wordFilter()` - Filters words based on regex patterns

### HW9: JSON and Advanced Processing
Tests JSON parsing and data processing:
- `fizzBuzzService()` - Implements FizzBuzz logic with service class
- JSON data processing with multiple result sets

### Archive
Contains previous or archived test files from earlier course iterations.

## Running the Tests

These tests are automatically run in the EdStem environment where the homework assignments are hosted. 

To run the tests locally, ensure you have PHPUnit installed and execute:

```bash
phpunit [path-to-assignment-tests]
```

For example, to run tests for hw5:

```bash
phpunit hw5
```

## Requirements

- PHP 7.0 or higher
- PHPUnit (installed via Composer or standalone)

## Contributing

These tests are maintained by Tyler Whitney and Franklin University instructors. Students should not modify these test files. If you find an issue with a test, please contact your instructor.

## License

These materials are provided for educational purposes by Tyler Whitney and Franklin University.
