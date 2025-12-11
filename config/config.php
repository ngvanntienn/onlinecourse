<?php
// config/config.php
session_start();

// Base URL
define('BASE_URL', 'http://localhost/onlinecourse/');

// Database config (nếu có)
define('DB_HOST', 'localhost');
define('DB_NAME', 'onlinecourse');
define('DB_USER', 'root');
define('DB_PASS', '');

// Helper functions
function escape($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

function url($controller = 'course', $action = 'detail', $params = []) {
    $url = BASE_URL . "index.php?controller={$controller}&action={$action}";
    if (!empty($params)) {
        $url .= '&' . http_build_query($params);
    }
    return $url;
}

function asset($path) {
    return BASE_URL . 'assets/' . ltrim($path, '/');
}

// Set default timezone
date_default_timezone_set('Asia/Ho_Chi_Minh');
?>