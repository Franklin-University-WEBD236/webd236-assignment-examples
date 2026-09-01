# How to read an assignment test

Each public testcase answers three questions:

1. **What input is supplied?** Look for a function call, simulated request, route, or database query.
2. **What observable result is required?** Look for `assertSame`, `assertStringContainsString`, or an SQL metadata check.
3. **What does failure mean?** Assertion messages identify the relevant contract requirement.

Tests do not award extra credit for matching an instructor's internal implementation. They check the names and behaviors stated in the contract. Hidden implementation helpers may be organized differently.

For multipart assignments, Ed presents the categories and their point values separately even when the public repository stores them in one PHPUnit class.
