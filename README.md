# WEBD 236 Assignment Examples and Tests

Student-facing assignment contracts, examples, and automated tests for Franklin University's **WEBD 236: Web Application Development** course.

This repository is intentionally public. Students may read the tests. The tests are part of each assignment's specification: they show the required function names, routes, output structure, boundary cases, and error handling.

## Repository map

| Assignment | Topics | Public materials |
| --- | --- | --- |
| HW1 | Forms and FizzBuzz | Contract and page-level PHPUnit tests |
| HW2 | SQL and PHP database output | Three SQL contracts/alternate datasets and faculty-page tests |
| HW3 | MVC routing | Contract, request harness, and route tests |
| HW4 | Form processing and validation | Contract, request harness, and validation tests |
| HW5 | String functions | PHPUnit tests |
| HW6 | Arrays and file processing | PHPUnit tests and word fixture |
| HW7 | Objects and functional programming | PHPUnit tests |
| HW8 | Regular expressions | PHPUnit tests |
| HW9 | DDL and REST/JSON | Database contract queries and REST integration tests |

Each assignment directory contains either a `contract.md` or `README.md`. Read that document before reading the tests; it explains what is tested and which implementation choices remain yours.

## Using the tests

These files are designed to run beside an assignment submission. Ed supplies PHPUnit as `phpunit.phar`; local instructions are in [docs/local-testing.md](docs/local-testing.md).

The tests intentionally favor observable behavior over a particular coding style. A solution may use different internal helpers as long as it satisfies the documented public contract.

## Instructor infrastructure

Ed testcase JSON, point allocations, deployment runners, reference schemas, and course/slide mappings are maintained separately in the private `webd236-autograding` repository. Public test code is mirrored there when needed to create a self-contained Ed bundle.

## Legacy material

Older Mimir-era runners and the previous HW9 fixture-based test are retained under [`legacy/`](legacy/) for historical reference. They are not the current grading configuration.

## Contributions

See [CONTRIBUTING.md](CONTRIBUTING.md). Changes should update the assignment contract and its tests together.
