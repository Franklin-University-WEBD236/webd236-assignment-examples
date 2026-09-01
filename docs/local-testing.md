# Running tests locally

The tests expect to be placed beside the files named in the assignment contract, such as `code.php`, `index.php`, or `router.php`.

With a local PHPUnit PHAR:

```sh
php phpunit.phar --testdox CodeTest.php
```

To run one test category:

```sh
php phpunit.phar --testdox --filter testRangeOneToSixteen CodeTest.php
```

Tests involving routes may also require the included `request_runner.php`. HW9 REST tests require the included deterministic local `fizzBuzzService.php`; they do not contact the Internet.

Before PHPUnit, check PHP syntax:

```sh
php -l code.php
php -l CodeTest.php
```

Ed supplies its own PHPUnit PHAR and invokes each visible category separately.
