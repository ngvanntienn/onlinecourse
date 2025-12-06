<?php
require_once './config/Database.php';
$db = new Database();
// Bật session
if (session_status() === PHP_SESSION_NONE) session_start();
// Khởi tạo CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Thiết lập chế độ báo lỗi (cho phát triển)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Định nghĩa thư mục controllers
define('CONTROLLERS_PATH', __DIR__ . '/controllers/');

// Lấy thông tin URL (router cơ bản)
$request_uri = trim($_SERVER['REQUEST_URI'], '/');
// Tách lấy phần đường dẫn sau /onlinecourse/
$path_parts = explode('/', $request_uri);
// Giả sử BASE_DIR là onlinecourse
$base_dir_index = array_search('onlinecourse', $path_parts);
$route = '';

if ($base_dir_index !== false && isset($path_parts[$base_dir_index + 1])) {
    $route = $path_parts[$base_dir_index + 1];
}

// Lấy Controller và Action (rất đơn giản)
// Ví dụ: onlinecourse/auth/login -> Controller: Auth, Action: login
if (!empty($route)) {
    $parts = explode('/', $route);
    $controllerName = ucfirst($parts[0]) . 'Controller'; // Ví dụ: auth -> AuthController
    $actionName = $parts[1] ?? 'index'; // Mặc định là index
    
    $controllerFile = CONTROLLERS_PATH . $controllerName . '.php';

    if (file_exists($controllerFile)) {
        require_once $controllerFile;
        
        $controller = new $controllerName();
        
        if (method_exists($controller, $actionName)) {
            // Chạy action
            $controller->$actionName();
            exit();
        }
    }
}


// Nếu không khớp route nào, mặc định chạy HomeController
// Hoặc điều hướng đến trang chủ/danh sách khóa học
require_once CONTROLLERS_PATH . 'HomeController.php';
$home = new HomeController();
$home->index(); // Cần tạo file HomeController.php và hàm index()
?>