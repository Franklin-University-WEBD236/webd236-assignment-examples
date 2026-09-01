Coding FizzBuzz [12 points]

Create a PHP FizzBuzz page in index.php. The page must contain a form with numeric inputs named start and stop that submits back to index.php. You may use GET or POST.

If no values are submitted, use the inclusive range 1 through 100. Submitted values are also inclusive and must be limited to 1 through 100.

For every number in the selected range, output exactly one list item:

- Fizz when the number is divisible by 3 but not 5
- Buzz when the number is divisible by 5 but not 3
- FizzBuzz when the number is divisible by both 3 and 5
- The number itself otherwise

What the automated tests check

- Form contract (2 points): index.php contains start and stop inputs in a self-submitting form.
- Default range (2 points): an empty request produces all values from 1 through 100, inclusive.
- Standard range (2 points): the range 5 through 15 produces the correct ordered output.
- Inclusive endpoints (2 points): the range 14 through 16 includes both endpoints and handles 15 as FizzBuzz.
- Short custom range (2 points): the range 8 through 10 produces 8, Fizz, Buzz.
- Bounds (2 points): values below 1 or above 100 are limited to the documented range.

The tests inspect the list-item text, so whitespace and visual styling do not affect the grade.
