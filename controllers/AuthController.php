<?php
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
                if (isset($user['status']) && $user['status'] == 0) {
                    $_SESSION['error'] = "Tài khoản của bạn hiện đang bị vô hiệu hóa! Vui lòng liên hệ admin";
                    header("Location: index.php?controller=auth&action=login");
                    exit;
                }

                $_SESSION['user_id']  = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role']     = $user['role'];
                $_SESSION['fullname'] = $user['fullname'];
                $_SESSION['avatar']   = isset($user['avatar']) ? $user['avatar'] : null;

                if ($user['role'] == 2) {
                    header("Location: index.php?controller=admin&action=dashboard");
                } elseif ($user['role'] == 1) {
                    header("Location: index.php?controller=teacher&action=dashboard");
                } else {
                    header("Location: index.php?controller=student&action=dashboard");
                }
                exit;
            }
            else {
                $_SESSION['error'] = "Tên đăng nhập hoặc mật khẩu không đúng!";
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