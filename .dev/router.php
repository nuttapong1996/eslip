<?php

$root = dirname(__DIR__);
$path = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/');

// Keep local configuration and development files out of the web server.
if (preg_match('~(^|/)(\.|vendor(?:/|$))~', $path)) {
    http_response_code(404);
    return true;
}

if ($path === '/') {
    $path = '/index.php';
}

$file = realpath($root . $path);
if ($file !== false && str_starts_with($file, $root . DIRECTORY_SEPARATOR) && is_file($file)) {
    return false;
}

// Match the extensionless URLs used by the application's .htaccess file.
if (!str_contains(basename($path), '.')) {
    $script = realpath($root . $path . '.php');
    if ($script !== false && str_starts_with($script, $root . DIRECTORY_SEPARATOR) && is_file($script)) {
        $_SERVER['SCRIPT_FILENAME'] = $script;
        $_SERVER['SCRIPT_NAME'] = $path . '.php';
        require $script;
        return true;
    }
}

http_response_code(404);
return true;
