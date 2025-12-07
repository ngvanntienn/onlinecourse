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
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['fullname'] = $user['fullname'];
                $_SESSION['avatar'] = isset($user['avatar']) ? $user['avatar'] : null;

                if ($user['role'] == 2) {
                    header("Location: index.php?controller=admin&action=dashboard");
                } elseif ($user['role'] == 1) { 
                    header("Location: index.php?controller=instructor&action=dashboard");
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
        // Khởi động session nếu chưa tồn tại
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION = [];
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000, 
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
                );
            }
            session_destroy();
            header("Location: index.php?controller=auth&action=login");
            exit;
    }

    
    public function forgotPassword() {
        require_once 'views/auth/forgot.php';
    }

    // Gửi OTP
    public function send_otp() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];

            /* khóa nút khi ấn 10s */
            if (isset($_SESSION['otp_time']) && (time() - $_SESSION['otp_time'] < 10)) {
                $_SESSION['error'] = "Vui lòng đợi 10 giây trước khi gửi lại mã.";
                header("Location: index.php?controller=auth&action=forgotPassword");
                exit;
            }

            // Tạo OTP 6 số random
            $otp = rand(100000, 999999);

            // Lưu vào Session
            $_SESSION['otp_code'] = $otp;
            $_SESSION['otp_email'] = $email;
            $_SESSION['otp_time'] = time();
            $_SESSION['show_otp_modal'] = true;
            $_SESSION['start_timer'] = true;

            header("Location: index.php?controller=auth&action=forgotPassword");
            exit;
        }
    }

    /* kiểm tra mã otp vừa nhập */
    public function verify_otp_process() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email_input = $_POST['email'];
            $otp_input = $_POST['otp_code'];

            // chỉ kiểm tra OTP hiện tại
            if (isset($_SESSION['otp_code']) &&
                $_SESSION['otp_code'] == $otp_input &&
                $_SESSION['otp_email'] == $email_input) {
                
                $_SESSION['otp_verified'] = true;
                unset($_SESSION['otp_code']); // xóa OTP sau khi xác thực thành công

                header("Location: index.php?controller=auth&action=changepass");
                exit;
            } else {
                $_SESSION['error'] = "Mã xác thực không chính xác!";
                header("Location: index.php?controller=auth&action=forgotPassword");
                exit;
            }
        }
    }

    /* quên mk */
    public function changepass() {
        if (!isset($_SESSION['otp_verified'])) {
            $_SESSION['error'] = "Bạn cần xác thực OTP trước.";
            header("Location: index.php?controller=auth&action=forgotPassword");
            exit;
        }
        require_once 'views/auth/changepass.php';
    }

    /* đổi mật khẩu */
    public function process_changepass() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $new_pass = $_POST['new_password'];
        $confirm_pass = $_POST['confirm_password'];

        // Kiểm tra mật khẩu khớp
        if ($new_pass !== $confirm_pass) {
            $_SESSION['error'] = "Mật khẩu không khớp!";
            header("Location: index.php?controller=auth&action=changepass");
            exit;
        }

        /* độ mạnh yếu */
        $errors = [];
        if (strlen($new_pass) < 8) {
            $errors[] = "Mật khẩu phải đủ 8 ký tự.";
        }
        if (!preg_match('/[A-Z]/', $new_pass)) {
            $errors[] = "Phải có ít nhất 1 chữ cái viết hoa.";
        }
        if (!preg_match('/[0-9]/', $new_pass)) {
            $errors[] = "Phải có ít nhất 1 số.";
        }
        if (!preg_match('/[@#._%$!]/', $new_pass)) {
            $errors[] = "Phải có ít nhất 1 ký tự đặc biệt (@,#,.,_,%,...).";
        }

        if (!empty($errors)) {
            $_SESSION['error'] = implode('<br>', $errors);
            header("Location: index.php?controller=auth&action=changepass");
            exit;
        }

        // hash mật khẩu trước khi lưu
        $hashed_pass = password_hash($new_pass, PASSWORD_DEFAULT);

        // Cập nhật vào DB
        $userModel = new User();
        $updated = $userModel->updatePasswordByEmail($email, $hashed_pass);

        if ($updated) {
            unset($_SESSION['otp_verified']);
            unset($_SESSION['otp_email']);
            $_SESSION['success'] = "Đổi mật khẩu thành công!";
            header("Location: index.php?controller=auth&action=login");
            exit;
        }
    }
}
}
