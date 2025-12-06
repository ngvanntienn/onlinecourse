<?php
// Bật session và tạo CSRF token
if (session_status() === PHP_SESSION_NONE) session_start();
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Thiết lập đường dẫn cơ sở (base path)
define('BASE_PATH', dirname(dirname(__FILE__)));

// Import Model và Config
require_once BASE_PATH . '/config/Database.php';
require_once BASE_PATH . '/models/User.php';

class AuthController {
    private $db;
    private $user_model;

    public function __construct() {
        // Khởi tạo kết nối CSDL và Model
        $database = new Database();
        $this->db = $database->pdo;
        $this->user_model = new User($this->db);
    }

    /**
     * Hàm hiển thị form đăng ký (chỉ để điều hướng nếu cần)
     */
    public function registerForm() {
        // Chỉ đơn giản là điều hướng đến view, view đã được cung cấp
        // Nếu dùng router, hàm này sẽ được gọi
        header('Location: ' . BASE_PATH . '/views/auth/register.php');
        exit();
    }

    /**
     * Xử lý yêu cầu đăng ký
     */
    public function register() {
        // 1. Kiểm tra phương thức và CSRF token
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
            $_SESSION['error_message'] = "Yêu cầu không hợp lệ hoặc hết phiên làm việc.";
            $this->redirect('/views/auth/register.php');
            return;
        }

        // 2. Lấy và kiểm tra dữ liệu đầu vào
        $fullname = $_POST['fullname'] ?? '';
        $email = $_POST['email'] ?? '';
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $role_input = $_POST['role']; // Mặc định là học viên

        if (empty($fullname) || empty($email) || empty($username) || empty($password)) {
            $_SESSION['error_message'] = "Vui lòng điền đầy đủ các trường.";
            // Lưu lại dữ liệu cũ để hiển thị lại trên form (optional)
            $_SESSION['old'] = ['fullname' => $fullname, 'email' => $email, 'username' => $username, 'role' => $role_input];
            $this->redirect('/onlinecourse/views/auth/register.php');
            return;
        }

        // 3. Xử lý vai trò (role): 0: học viên, 1: giảng viên, 2: quản trị viên
        $role_id = 0; // Mặc định là học viên
        if ($role_input === 'giangvien') {
            $role_id = 1;
        }

        // 4. Kiểm tra user/email đã tồn tại chưa
        if ($this->user_model->isExist($username, $email)) {
            $_SESSION['error_message'] = "Tên đăng nhập hoặc Email đã tồn tại.";
            $_SESSION['old'] = ['fullname' => $fullname, 'email' => $email, 'username' => $username, 'role' => $role_input];
            $this->redirect('/onlinecourse/views/auth/register.php');
            return;
        }

        // 5. Gán dữ liệu cho Model và thực hiện đăng ký
        $this->user_model->username = $username;
        $this->user_model->email = $email;
        $this->user_model->password = $password; // Sẽ được hash trong model
        $this->user_model->fullname = $fullname;
        $this->user_model->role = $role_id;

        if ($this->user_model->create()) {
            $_SESSION['success_message'] = "Đăng ký thành công! Vui lòng đăng nhập.";
            $this->redirect('/views/auth/login.php');
        } else {
            $_SESSION['error_message'] = "Đã xảy ra lỗi trong quá trình đăng ký. Vui lòng thử lại.";
            $_SESSION['old'] = ['fullname' => $fullname, 'email' => $email, 'username' => $username, 'role' => $role_input];
            $this->redirect('/onlinecourse/views/auth/register.php');
        }
    }

    /**
     * Xử lý yêu cầu đăng nhập
     */
    public function login() {
        // 1. Kiểm tra phương thức và CSRF token
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
            $_SESSION['error_message'] = "Yêu cầu không hợp lệ hoặc hết phiên làm việc.";
            $this->redirect('/views/auth/login.php');
            return;
        }
        
        // 2. Lấy và kiểm tra dữ liệu đầu vào
        $login_id = $_POST['username'] ?? ''; // Có thể là username hoặc email
        $password = $_POST['password'] ?? '';
        $remember = isset($_POST['remember']);

        if (empty($login_id) || empty($password)) {
            $_SESSION['error_message'] = "Vui lòng nhập tên đăng nhập/email và mật khẩu.";
            $this->redirect('/views/auth/login.php');
            return;
        }

        // 3. Thực hiện đăng nhập
        $user = $this->user_model->login($login_id, $password);

        if ($user) {
            // 4. Đăng nhập thành công, tạo session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['fullname'] = $user['fullname'];
            $_SESSION['role'] = $user['role']; // 0: học viên, 1: giảng viên, 2: quản trị viên
            $_SESSION['success_message'] = "Đăng nhập thành công!";

            // Xử lý "Nhớ mật khẩu" (Remember me) bằng cookie
            if ($remember) {
                // Ví dụ: Tạo token và lưu vào cookie, và CSDL (tùy chọn)
                $token = bin2hex(random_bytes(64));
                $expire_time = time() + (86400 * 30); // 30 ngày
                setcookie('remember_token', $user['id'] . '|' . $token, $expire_time, '/');
                // LƯU Ý: Cần thêm logic lưu token này vào CSDL để xác thực
            }

            // 5. Điều hướng đến trang dashboard hoặc trang chủ
            $this->redirect($this->getDashboardUrl($user['role']));

        } else {
            // Đăng nhập thất bại
            $_SESSION['error_message'] = "Tên đăng nhập/email hoặc mật khẩu không đúng.";
            $this->redirect('/views/auth/login.php');
        }
    }

    /**
     * Xử lý yêu cầu đăng xuất
     */
    public function logout() {
        // Xóa tất cả các biến session
        $_SESSION = array();

        // Xóa cookie session
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Xóa cookie remember me
        if (isset($_COOKIE['remember_token'])) {
            setcookie('remember_token', '', time() - 3600, '/');
        }

        // Hủy session
        session_destroy();
        
        // Điều hướng về trang đăng nhập
        $_SESSION['success_message'] = "Bạn đã đăng xuất thành công.";
        $this->redirect('/views/auth/login.php');
    }


    /**
     * Hàm điều hướng ngắn gọn
     */
    private function redirect($path) {
        // Điều chỉnh đường dẫn tương đối tùy theo cấu hình web server
        header('Location: ' . $path); 
        exit();
    }

    /**
     * Xác định trang dashboard dựa trên vai trò
     */
    private function getDashboardUrl($role) {
        switch ($role) {
            case 1: // Giảng viên
                return '/views/instructor/dashboard.php';
            case 2: // Quản trị viên
                return '/views/admin/dashboard.php';
            case 0: // Học viên
            default:
                return '/views/student/dashboard.php';
        }
    }
}

// Xử lý yêu cầu từ form (router đơn giản)
if (isset($_POST['action'])) {
    $controller = new AuthController();
    $action = $_POST['action'];

    if ($action == 'register') {
        $controller->register();
    } elseif ($action == 'login') {
        $controller->login();
    } else {
        // Xử lý action không hợp lệ
        header('Location: /views/auth/login.php');
    }
} elseif (isset($_GET['action']) && $_GET['action'] == 'logout') {
    // Xử lý đăng xuất (ví dụ: /controllers/AuthController.php?action=logout)
    $controller = new AuthController();
    $controller->logout();
} else {
    // Không có action nào được gọi, điều hướng về trang chủ/đăng nhập
    // header('Location: /index.php');
}
?>