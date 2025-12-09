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
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (fullname, email, username, password, role) VALUES (:fullname, :email, :username, :password, :role)";
        $stmt = $this->conn->prepare($sql);
        if ($stmt->execute([
            ':fullname' => $fullname,
            ':email'    => $email,
            ':username' => $username,
            ':password' => $hashed_pass,
            ':role'     => $role
        ])) {
            return true; 
        }

    }

    public function login($usernameOrEmail, $password) {
        $sql = "SELECT * FROM users WHERE username = :username OR email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':username' => $usernameOrEmail,
            ':email'    => $usernameOrEmail
        ]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                unset($user['password']);
                return $user;
            } else {
                return false; 
            }
        }
    }

    /* update ảnh đại diện */
    public function getUserById($id) {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    
    public function updateAvatar($userId, $avatarFileName)
    {
        $stmt = $this->conn->prepare("UPDATE users SET avatar = :avatar WHERE id = :id");
        return $stmt->execute([
            ':avatar' => $avatarFileName,
            ':id' => $userId
        ]);

    } 
    public function getUserByEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function updatePasswordByEmail($email, $hashedPassword) {
    $stmt = $this->conn->prepare("UPDATE users SET password = :password WHERE email = :email");
    return $stmt->execute([
        ':password' => $hashedPassword,
        ':email'    => $email
    ]);
}
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