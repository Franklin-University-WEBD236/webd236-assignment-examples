Using the MicroUniversity database, write a SQL query that lists every class taught by Preston Yukon. [2 points]

Return these columns:

- CRS_CODE: course code
- CLASS_SECTION: class section
- CRS_DESCRIPTION: course description

Join EMPLOYEE, CLASS, and COURSE using their keys; do not hard-code the expected course rows. Use query.sql for your submission. The DB Admin tool in the Ed workspace can be used to inspect the database.

What the automated tests check

- MicroUniversity dataset (1 point): the correct Preston Yukon classes and required columns are returned.
- Alternate dataset (1 point): the joins and name filter work with different class records and exclude other instructors.
