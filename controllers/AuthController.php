<?php
class User {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->pdo;
    }
    public function register($fullname, $email, $username, $password, $role) {
        $sql_check = "SELECT id FROM users WHERE username = :username OR email = :email";
        $stmt_check = $this->conn->prepare($sql_check);
        $stmt_check->execute([':username' => $username, ':email' => $email]);
        
        if ($stmt_check->rowCount() > 0) {
            return "Tên đăng nhập hoặc Email này đã tồn tại."; 
        }

        // thêm mới
        $sql = "INSERT INTO users (fullname, email, username, password, role) VALUES (:fullname, :email, :username, :password, :role)";
        $stmt = $this->conn->prepare($sql);
        if ($stmt->execute([
            ':fullname' => $fullname,
            ':email'    => $email,
            ':username' => $username,
            ':password' => $password, 
            ':role'     => $role
        ])) {
            return true; 
        }
        return "Lỗi hệ thống, vui lòng thử lại sau.";
    }

    public function login($usernameOrEmail, $password) {
        $sql = "SELECT * FROM users WHERE username = :username OR email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':username' => $usernameOrEmail,
            ':email'    => $usernameOrEmail
        ]);
        
        $user = $stmt->fetch();
        if ($user && $user['password'] === $password) {
            return $user;
        }
        return false;
=======
require_once 'models/User.php';

class AuthController {
    
    public function login() {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $userModel = new User();
            $user = $userModel->findByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
          
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role']; 
                $_SESSION['fullname'] = $user['fullname'];

                // Điều hướng
                if ($user['role'] == 1) {
                    header("Location: /onlinecourse/index.php?url=admin/dashboard");
                } elseif ($user['role'] == 2) {
                    header("Location: /onlinecourse/index.php?url=instructor/dashboard");
                } else {
                    header("Location: /onlinecourse/");
                }
                exit;
            } else {
                $error = "Email hoặc mật khẩu không đúng!";
            }
        }
 
        require_once 'views/auth/login.php';
    }

    public function register() {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fullname = $_POST['fullname'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $role = 3;

            $userModel = new User();
            

            if ($userModel->findByEmail($email)) {
                $error = "Email đã tồn tại!";
            } else {
                if ($userModel->create($username, $email, $password, $fullname, $role)) {
                    header("Location: /onlinecourse/index.php?url=auth/login");
                    exit;
                } else {
                    $error = "Đăng ký thất bại!";
                }
            }
        }
        require_once 'views/auth/register.php';
    }

    public function logout() {
        session_destroy();
        header("Location: /onlinecourse/");
        exit;
    }
}
?>