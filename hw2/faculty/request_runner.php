<?php

if ($argc < 2) {
    fwrite(STDERR, "Missing payload\n");
    exit(1);
}

$payload = json_decode(base64_decode($argv[1]), true);
$script = $payload['script'] ?? '';
if (!in_array($script, ['index.php', 'viewEmp.php'], true)) {
    fwrite(STDERR, "Unsupported script\n");
    exit(1);
}

$_GET = $payload['get'] ?? [];
$_POST = [];
$_REQUEST = $_GET;
$_COOKIE = [];
$_FILES = [];
$_SERVER['REQUEST_METHOD'] = 'GET';
$_SERVER['REQUEST_URI'] = '/' . $script . (empty($_GET) ? '' : '?' . http_build_query($_GET));
$_SERVER['SCRIPT_NAME'] = '/' . $script;

chdir(__DIR__);
ob_start();
include __DIR__ . '/' . $script;
echo ob_get_clean();
