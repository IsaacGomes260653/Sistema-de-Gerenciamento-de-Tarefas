<?php
/**
 * Application bootstrap: env, error handling, session, security headers.
 * Every entry-point page includes this file first.
 */
require_once __DIR__ . '/env.php';

$appEnv = env('APP_ENV', 'local');

if ($appEnv === 'local') {
    ini_set('display_errors', '1');
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', '0');
    error_reporting(E_ALL);
    ini_set('log_errors', '1');
    ini_set('error_log', __DIR__ . '/../storage/php-error.log');
}

// Security headers — cheap to add, close off common attack classes.
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('Referrer-Policy: strict-origin-when-cross-origin');

if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'httponly' => true,
        'samesite' => 'Lax',
        'secure'   => !empty($_SERVER['HTTPS']),
    ]);
    session_start();
}

// Base URL of the app, works whether it's served from the domain root or a subfolder
// (e.g. http://localhost/SGT/) — every link/redirect in the app is built from this.
$appRoot  = str_replace('\\', '/', realpath(__DIR__ . '/..'));
$docRoot  = str_replace('\\', '/', rtrim((string) ($_SERVER['DOCUMENT_ROOT'] ?? ''), '/'));
$basePath = $docRoot !== '' && str_starts_with($appRoot, $docRoot)
    ? substr($appRoot, strlen($docRoot))
    : '';
define('BASE_URL', rtrim($basePath, '/'));

require_once __DIR__ . '/database.php';
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/csrf.php';
require_once __DIR__ . '/../includes/icons.php';
