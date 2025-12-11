<?php
// index.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Load config
require_once 'config/config.php';

// Simple autoload
spl_autoload_register(function ($class) {
    $paths = [
        'controllers/' . $class . '.php',
        'models/' . $class . '.php'
    ];
    
    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return true;
        }
    }
    return false;
});

// Get controller and action
$controllerName = $_GET['controller'] ?? 'course';
$action = $_GET['action'] ?? 'detail';

// Format controller name
$controllerClass = ucfirst($controllerName) . 'Controller';

// Check if controller exists
if (class_exists($controllerClass)) {
    $controller = new $controllerClass();
    
    // Check if action exists
    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        die("Action '{$action}' không tồn tại trong controller '{$controllerClass}'");
    }
} else {
    die("Controller '{$controllerClass}' không tồn tại");
}
?>