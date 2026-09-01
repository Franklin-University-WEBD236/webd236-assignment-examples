FizzBuzz from a REST service [13 points]

Write getFizzBuzz($start, $stop) in code.php. The function must obtain its values from the local FizzBuzz service at http://0.0.0.0:8000/fizzBuzzService.php; do not calculate FizzBuzz locally.

Required service contract:

- Send start and stop as POST fields using cURL.
- Enable CURLOPT_RETURNTRANSFER so the response is returned as a string.
- Decode the JSON response with json_decode(..., true).
- Traverse the decoded response in its original order.
- Return one exact HTML unordered-list string: <ul> followed by one <li>value</li> per service value and then </ul>.
- Include a newline after the opening <ul>, after every <li>, and after the closing </ul>.
- Use the values returned by the service. The grader may return service-provided values that differ from locally calculated FizzBuzz to verify that the response is actually consumed.

The six visible automatic tests are:

1. cURL and JSON service integration (3 points)
2. Inclusive range 1 through 16 (2 points)
3. Inclusive range 1 through 31 (2 points)
4. Inclusive range 9 through 31 (2 points)
5. Inclusive range 5 through 11 (2 points)
6. Inclusive range 3 through 10 (2 points)

The Ed grading containers have no Internet access. The local service is started automatically while the tests run; no API key or external connection is needed.
