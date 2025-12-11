<?php
require_once __DIR__ . '/../config/Database.php';   
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

    public function getUserById($id) {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateAvatar($userId, $avatarFileName) {
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

    public function updatePasswordById($userId, $hashedPassword) {
        $stmt = $this->conn->prepare("UPDATE users SET password = :password WHERE id = :id");
        return $stmt->execute([
            ':password' => $hashedPassword,
            ':id'       => $userId
        ]);
    }

    public function updatePasswordByEmail($email, $hashedPassword) {
        $stmt = $this->conn->prepare("UPDATE users SET password = :password WHERE email = :email");
        return $stmt->execute([
            ':password' => $hashedPassword,
            ':email'    => $email
        ]);
    }

    public function getUserByUsernameOrEmail($username, $email, $excludeId) {
        $sql = "SELECT id FROM users WHERE (username = :username OR email = :email) AND id != :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':username'=>$username, ':email'=>$email, ':id'=>$excludeId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProfile($id, $fullname, $username, $email) {
        $sql = "UPDATE users SET fullname = :fullname, username = :username, email = :email WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':fullname' => $fullname,
            ':username' => $username,
            ':email' => $email,
            ':id' => $id
        ]);
    }

    public function getUsers($keyword = '', $role = 'all', $status = 'all') {
        $sql = "SELECT * FROM users WHERE 1=1";
        $params = [];

        if (!empty($keyword)) {
            $sql .= " AND (fullname LIKE :keyword1 OR email LIKE :keyword2)";
            $params[':keyword1'] = "%$keyword%";
            $params[':keyword2'] = "%$keyword%";
        }

        if ($role !== 'all') {
            $sql .= " AND role = :role";
            $params[':role'] = $role;
        }

        if ($status !== 'all') {
            $sql .= " AND status = :status";
            $params[':status'] = $status;
        }

        $sql .= " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($sql);

        foreach ($params as $key => $val) {
            $stmt->bindValue($key, $val);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStatus($id, $status) {
        $stmt = $this->conn->prepare("UPDATE users SET status = :status WHERE id = :id");
        $stmt->bindValue(':status', $status);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }
}
?>
