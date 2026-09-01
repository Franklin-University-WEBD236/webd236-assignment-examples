Using the MicroUniversity database, write a SQL query that returns each class taught in the business school. [2 points]

Return these columns:

- PROFESSOR: the professor’s first and last names separated by one space
- CRS_DESCRIPTION: course description
- CLASS_SECTION: class section
- TOTAL_ENROLLMENT: number of enrollment records for that class

Use the table relationships to restrict results to SCHOOL_CODE = "BUS", group by the class, and sort by the professor’s last name and then first name. Use query.sql for your submission. The DB Admin tool in the Ed workspace can be used to inspect the database.

What the automated tests check

- MicroUniversity dataset (1 point): correct business-school classes, professors, sections, and enrollment counts.
- Alternate dataset (1 point): grouping and school filtering work with different data and exclude non-business classes.
