Model 2 Faculty Listing [12 points]

Rewrite the Week 2 employee-listing application using the provided Model 2 MVC framework. Preserve the same student-facing functionality while separating routing, database access, and HTML presentation.

Required structure

- controllers/employee.php with get_list() and get_view($num)
- models/employee.php with findAllEmployees() and findEmployeeByNumber($num)
- views/employeelist.php for the employee list
- views/employeeview.php for one employee’s details
- index.php that directs users to the employee list

Required routes and behavior

- employee/list displays every employee’s first and last name.
- Each name links to employee/view/EMP_NUM using that employee’s number.
- employee/view/EMP_NUM displays the requested employee’s first name, last name, middle initial, date of birth, job code, and hire date.
- The employee model performs the database queries; controllers pass results to the views.

What the automated tests check

- MVC file structure (2 points): all required controller, model, and view files exist.
- MVC function contract (2 points): the required controller and model functions are defined.
- Complete employee list (2 points): employee/list displays every supplied employee.
- Employee links (2 points): each list item links to its matching employee/view/EMP_NUM route.
- Employee 100 details (2 points): employee/view/100 displays James Worley’s data.
- Employee 104 details (2 points): employee/view/104 displays Preston Yukon’s data.

The tests inspect files, function declarations, semantic link targets, and rendered database values. Styling and whitespace do not affect the grade.
