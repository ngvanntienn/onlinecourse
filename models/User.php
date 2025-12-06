<?php
//require_once __DIR__ . '/../vendor/autoload.php';
class AuthController {
   
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fullname = $_POST['fullname'];
            $email    = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $role     = $_POST['role'];

            $userModel = new User();
            $result = $userModel->register($fullname, $email, $username, $password, $role);

            if ($result === true) {
                $_SESSION['success'] = "Đăng ký thành công! Hãy đăng nhập ngay.";
                header("Location: index.php?controller=auth&action=login"); 
                exit;
            } else {
                $_SESSION['error'] = $result; 
                header("Location: index.php?controller=auth&action=register");
                exit;
            }
        }
        require_once 'views/auth/register.php';
    }
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $userModel = new User();
            $user = $userModel->login($username, $password);

            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['fullname'] = $user['fullname'];
                // Redirect all successfully authenticated users to the homepage
                header("Location: index.php?controller=home&action=index");
                exit;
            } else {
                $_SESSION['error'] = "Sai tên đăng nhập hoặc mật khẩu!";
                header("Location: index.php?controller=auth&action=login");
                exit;
            }
        }
        require_once 'views/auth/login.php';
    }

    public function logout() {
        session_destroy();
        header("Location: index.php?controller=auth&action=login");
        exit;
    }
}
?>