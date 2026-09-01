Using the MicroUniversity database, write a SQL query that returns every student’s full name as STUDENT and that student’s advisor’s full name as ADVISOR. STUDENT.EMP_NUM identifies the advising employee. [2 points]

Required result columns

- STUDENT: the student’s first and last names separated by one space
- ADVISOR: the advisor’s first and last names separated by one space

Sort the rows by the student’s last name and then first name. Use query.sql for your submission. The DB Admin tool in the Ed workspace can be used to inspect the database.

What the automated tests check

- MicroUniversity dataset (1 point): correct students, advisors, aliases, and ordering on the provided database.
- Alternate dataset (1 point): the joins and ordering also work with different records, preventing hard-coded answers.
