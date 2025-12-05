<?php
session_start(); 

require_once 'config/Database.php';
require_once 'models/User.php';
$controllerName = isset($_GET['controller']) ? ucfirst($_GET['controller']) . 'Controller' : 'HomeController';

$action = isset($_GET['action']) ? $_GET['action'] : 'index';
$controllerPath = "controllers/{$controllerName}.php";

/* kiểm tra controller có đang tồn tại ko */
if (file_exists($controllerPath)) {
    require_once $controllerPath;
    if (class_exists($controllerName)) {
        $controller = new $controllerName();
        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            die("Lỗi: Action '$action' không tồn tại.");
        }
    }
} else {
    die("Lỗi: Controller '$controllerName' không tìm thấy.");
}
?>