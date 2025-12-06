<?php
// Bổ sung namespace nếu có
require_once __DIR__ . '/../config/Database.php'; // Đảm bảo đã có file config/Database.php

class User {
    private $conn;
    private $table_name = "users";

    public $id;
    public $username;
    public $email;
    public $password; // Chỉ lưu hash
    public $fullname;
    public $role;
    public $created_at;

    // Hàm khởi tạo, nhận đối tượng kết nối PDO
    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Kiểm tra xem username hoặc email đã tồn tại chưa
     * @param string $username
     * @param string $email
     * @return array|false Thông tin user nếu tồn tại, hoặc false
     */
    public function isExist($username, $email) {
        $query = "SELECT id, username, email, password, role FROM " . $this->table_name . " WHERE username = :username OR email = :email LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return $row;
        }
        return false;
    }

    /**
     * Đăng ký người dùng mới
     * @return bool Thành công hay thất bại
     */
    public function create() {
        // Query INSERT
        $query = "INSERT INTO " . $this->table_name . " 
                  SET username = :username, email = :email, password = :password, fullname = :fullname, role = :role, created_at = :created_at";

        $stmt = $this->conn->prepare($query);

        // Làm sạch dữ liệu
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->fullname = htmlspecialchars(strip_tags($this->fullname));
        $this->role = (int)$this->role; // Đảm bảo role là số nguyên

        // Hash mật khẩu (Sử dụng bcrypt hoặc argon2)
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        $date_now = date('Y-m-d H:i:s');

        // Gán giá trị
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":fullname", $this->fullname);
        $stmt->bindParam(":role", $this->role);
        $stmt->bindParam(":created_at", $date_now);

        try {
            if ($stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            // Có thể log lỗi chi tiết hơn ở đây
            echo "Error: " . $e->getMessage();
        }

        return false;
    }

    /**
     * Tìm người dùng bằng username hoặc email và kiểm tra mật khẩu
     * @param string $login_id username hoặc email
     * @param string $password mật khẩu thô
     * @return array|false Thông tin user nếu thành công, hoặc false
     */
    public function login($login_id, $password) {
        // Query tìm người dùng bằng username HOẶC email
        $query = "SELECT id, username, email, password, fullname, role 
                  FROM " . $this->table_name . " 
                  WHERE username = :login_id OR email = :login_id 
                  LIMIT 0,1";
        
        $stmt = $this->conn->prepare($query);
        
        // Làm sạch và gán giá trị
        $login_id = htmlspecialchars(strip_tags($login_id));
        $stmt->bindParam(':login_id', $login_id);
        
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Kiểm tra xem có tìm thấy người dùng không và xác minh mật khẩu
        if ($row && password_verify($password, $row['password'])) {
            // Đăng nhập thành công, loại bỏ mật khẩu đã hash trước khi trả về
            unset($row['password']); 
            return $row;
        }

        return false;
    }

    // Các hàm khác như findById, update, delete sẽ được thêm sau
}
?>