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
    }
}
?>