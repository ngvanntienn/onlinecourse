<?php
// models/User.php
class User {
    // Database connection
    private $conn;
    
    public function __construct() {
        // Khởi tạo kết nối database
        try {
            $this->conn = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
                DB_USER,
                DB_PASS
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
    
    public function login($email, $password) {
        // Tạm thời trả về mock data
        return [
            'success' => true,
            'user' => [
                'id' => 1,
                'name' => 'Người dùng Demo',
                'email' => $email
            ]
        ];
    }
    
    public function register($userData) {
        // Tạm thời trả về mock data
        return [
            'success' => true,
            'message' => 'Đăng ký thành công!',
            'user_id' => 2
        ];
    }
    
    public function getById($userId) {
        // Tạm thời trả về mock data
        return [
            'id' => $userId,
            'name' => 'Người dùng ' . $userId,
            'email' => 'user' . $userId . '@example.com'
        ];
    }
}
?>