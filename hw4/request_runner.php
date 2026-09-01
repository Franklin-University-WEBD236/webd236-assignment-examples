<?php

if ($argc < 2) {
    fwrite(STDERR, "Missing payload\n");
    exit(1);
}

$decoded = json_decode(base64_decode($argv[1]), true);
$_GET = [];
$_POST = $decoded['post'] ?? [];
$_REQUEST = $_POST;
$_COOKIE = [];
$_FILES = [];
$_SERVER['REQUEST_METHOD'] = $decoded['method'] ?? 'GET';
$_SERVER['REQUEST_URI'] = $decoded['uri'] ?? '/index';
$_SERVER['SCRIPT_NAME'] = '/router.php';

ob_start();
include __DIR__ . '/router.php';
echo ob_get_clean();
