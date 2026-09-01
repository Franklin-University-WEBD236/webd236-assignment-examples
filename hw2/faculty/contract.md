MicroUniversity Faculty Listing [12 points]

Starting with the provided MicroUniversity project, add an employee listing below the existing student-search form on index.php.

Requirements

- List every record from EMPLOYEE using the employee’s first and last name.
- Make each name a link to viewEmp.php?EMP_NUM=X, where X is that employee’s EMP_NUM.
- Create viewEmp.php and use the EMP_NUM query parameter to retrieve one employee.
- Display that employee’s first name, last name, middle initial, date of birth, job code, and hire date.
- If EMP_NUM is missing, display a helpful message instead of a PHP error.

What the automated tests check

- Complete employee list (2 points): index.php displays every employee in the supplied database.
- Employee links (2 points): every displayed name links to the matching viewEmp.php EMP_NUM.
- Employee 100 details (2 points): the detail page displays James Worley’s database values.
- Employee 104 details (2 points): the detail page displays Preston Yukon’s database values.
- Detail-field contract (2 points): all six requested employee fields are present.
- Missing employee number (2 points): viewEmp.php handles a missing EMP_NUM without a PHP warning or fatal error.

The tests inspect semantic HTML text, links, and database values. Styling and whitespace do not affect the grade.
