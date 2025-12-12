<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once __DIR__ . '/../vendor/autoload.php';

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
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        session_destroy();
        header("Location: index.php?controller=auth&action=login");
        exit;
    }

    public function forgotPassword() {
        require_once 'views/auth/forgot.php';
    }

    public function send_otp() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];

            $userModel = new User();
            $user = $userModel->getUserByEmail($email);

            if (!$user) {
                $_SESSION['error'] = "Email không tồn tại trong hệ thống!";
                header("Location: index.php?controller=auth&action=forgotPassword");
                exit;
            }

            $otp = rand(100000, 999999);
            $_SESSION['otp_code']  = $otp;
            $_SESSION['otp_email'] = $email;
            $_SESSION['otp_time']  = time();
            $_SESSION['start_timer'] = true;

            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'ngvanntienn05@gmail.com';
                $mail->Password   = 'vffp vdnv bkzl kahj';
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;

                $mail->setFrom('ngvanntienn05@gmail.com', 'EasyStudy');
                $mail->addAddress($email, $user['fullname']);

                $mail->isHTML(true);
                $mail->Subject = 'Mã OTP lấy lại mật khẩu EasyStudy';
                $mail->Body    = "<p>Chào <b>{$user['fullname']}</b>,</p>
                                  <p>Mã OTP của bạn: <b>{$otp}</b></p>
                                  <p>Không chia sẻ mã này với bất kỳ ai.</p>";

                $mail->send();
                $_SESSION['success'] = "OTP đã được gửi tới email của bạn!";

            } catch (Exception $e) {
                $_SESSION['error'] = "Không thể gửi email. Lỗi: {$mail->ErrorInfo}";
            }

            header("Location: index.php?controller=auth&action=forgotPassword");
            exit;
        }
    }

    public function verify_otp_process() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email_input = $_POST['email'];
            $otp_input   = $_POST['otp_code'];
            if (isset($_SESSION['otp_code']) &&
                $_SESSION['otp_code'] == $otp_input &&
                $_SESSION['otp_email'] == $email_input) {

                $_SESSION['otp_verified'] = true;
                $_SESSION['reset_email']  = $email_input;

                unset($_SESSION['otp_email']);
                unset($_SESSION['otp_code']);

                header("Location: index.php?controller=auth&action=changepass");
                exit;
            }
            else {
                $_SESSION['error'] = "Mã xác thực không chính xác!";
                header("Location: index.php?controller=auth&action=forgotPassword");
                exit;
            }
        }
    }

    public function changepass() {
        if (!isset($_SESSION['otp_verified'])) {
            $_SESSION['error'] = "Bạn cần xác thực OTP trước.";
            header("Location: index.php?controller=auth&action=forgotPassword");
            exit;
        }
        require_once 'views/auth/changepass.php';
    }

    public function process_changepass() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email        = $_POST['email'];
            $new_pass     = $_POST['new_password'];
            $confirm_pass = $_POST['confirm_password'];

            if ($new_pass !== $confirm_pass) {
                $_SESSION['error'] = "Mật khẩu không khớp!";
                header("Location: index.php?controller=auth&action=changepass");
                exit;
            }

            $errors = [];
            if (strlen($new_pass) < 8) $errors[] = "Mật khẩu phải đủ 8 ký tự.";
            if (!preg_match('/[A-Z]/', $new_pass)) $errors[] = "Cần ít nhất 1 chữ hoa.";
            if (!preg_match('/[0-9]/', $new_pass)) $errors[] = "Cần ít nhất 1 số.";
            if (!preg_match('/[@#._%$!]/', $new_pass)) $errors[] = "Cần ít nhất 1 ký tự đặc biệt.";

            if (!empty($errors)) {
                $_SESSION['error'] = implode('<br>', $errors);
                header("Location: index.php?controller=auth&action=changepass");
                exit;
            }

            $hashed_pass = password_hash($new_pass, PASSWORD_DEFAULT);
            $userModel = new User();
            $updated   = $userModel->updatePasswordByEmail($email, $hashed_pass);

            if ($updated) {
                unset($_SESSION['otp_verified']);
                unset($_SESSION['reset_email']);
             $_SESSION['success'] = "Đổi mật khẩu thành công!";
                header("Location: index.php?controller=auth&action=login");
                exit;
            }
        }
    }

    private function redirectToDashboard() {
        if (!isset($_SESSION['role'])) {
            header("Location: index.php");
            exit;
        }

        switch ($_SESSION['role']) {
            case '2':
                header("Location: index.php?controller=admin&action=dashboard");
                break;
            case '1':
                header("Location: index.php?controller=teacher&action=dashboard");
                break;
            case '0':
                header("Location: index.php?controller=student&action=dashboard");
                break;
            default:
                header("Location: index.php");
        }
        exit;
    }

    public function updatePassword() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userId       = $_SESSION['user_id'];
            $old_pass     = $_POST['old_password'];
            $new_pass     = $_POST['new_password'];
            $confirm_pass = $_POST['confirm_password'];

            $userModel = new User();
            $user      = $userModel->getUserById($userId);

            if (!password_verify($old_pass, $user['password'])) {
                $_SESSION['error'] = "Mật khẩu cũ không đúng!";
                $this->redirectToDashboard();
            }

            if ($new_pass !== $confirm_pass) {
                $_SESSION['error'] = "Mật khẩu mới không khớp!";
                $this->redirectToDashboard();
            }

            $errors = [];
            if (strlen($new_pass) < 8) $errors[] = "Phải đủ 8 ký tự.";
            if (!preg_match('/[A-Z]/', $new_pass)) $errors[] = "Cần ít nhất 1 chữ hoa.";
            if (!preg_match('/[0-9]/', $new_pass)) $errors[] = "Cần ít nhất 1 số.";
            if (!preg_match('/[@#._%$!]/', $new_pass)) $errors[] = "Cần ít nhất 1 ký tự đặc biệt.";

            if (!empty($errors)) {
                $_SESSION['error'] = implode('<br>', $errors);
                $this->redirectToDashboard();
            }

            $hashed_pass = password_hash($new_pass, PASSWORD_DEFAULT);
            $updated = $userModel->updatePasswordById($userId, $hashed_pass);

            if ($updated) {
                $_SESSION['success'] = "Đổi mật khẩu thành công!";
            } else {
                $_SESSION['error'] = "Đổi mật khẩu thất bại!";
            }

            $this->redirectToDashboard();
        }
    }
    public function updateProfile() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId   = $_SESSION['user_id'];
            $fullname = trim($_POST['fullname']);
            $username = trim($_POST['username']);
            $email    = trim($_POST['email']);

            $userModel = new User();
            $existingUser = $userModel->getUserByUsernameOrEmail($username, $email, $userId);

            if ($existingUser) {
                $_SESSION['error'] = "Tên đăng nhập hoặc email đã tồn tại!";
                $this->redirectToDashboard();
            }

            $updated = $userModel->updateProfile($userId, $fullname, $username, $email);

            if ($updated) {
                $_SESSION['success'] = "Cập nhật thông tin thành công!";
                $_SESSION['fullname'] = $fullname;
                $_SESSION['username'] = $username;
            } else {
                $_SESSION['error'] = "Cập nhật thất bại, vui lòng thử lại!";
            }

            $this->redirectToDashboard();
        }
    }
}
?>
