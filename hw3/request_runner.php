<?php

if ($argc < 2) {
    fwrite(STDERR, "Missing payload\n");
    exit(1);
}

$payload = json_decode(base64_decode($argv[1]), true);
$uri = $payload['uri'] ?? '/employee/list';

$_GET = [];
$_POST = [];
$_REQUEST = [];
$_COOKIE = [];
$_FILES = [];
$_SERVER['REQUEST_METHOD'] = 'GET';
$_SERVER['REQUEST_URI'] = '/' . ltrim($uri, '/');
$_SERVER['SCRIPT_NAME'] = '/router.php';

chdir(__DIR__);
ob_start();
include __DIR__ . '/router.php';
echo ob_get_clean();
