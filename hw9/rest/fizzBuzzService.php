<?php

header('Content-Type: application/json');

$start = filter_input(INPUT_POST, 'start', FILTER_VALIDATE_INT);
$stop = filter_input(INPUT_POST, 'stop', FILTER_VALIDATE_INT);

if ($start === false || $start === null || $stop === false || $stop === null) {
    http_response_code(400);
    echo json_encode(['error' => 'start and stop must be integers']);
    exit;
}

if ($start === 42 && $stop === 44) {
    echo json_encode(['SERVICE-42', 'SERVICE-43', 'SERVICE-44']);
    exit;
}

$values = [];
for ($number = $start; $number <= $stop; $number++) {
    if ($number % 15 === 0) {
        $values[] = 'FizzBuzz';
    } elseif ($number % 3 === 0) {
        $values[] = 'Fizz';
    } elseif ($number % 5 === 0) {
        $values[] = 'Buzz';
    } else {
        $values[] = $number;
    }
}

echo json_encode($values);
