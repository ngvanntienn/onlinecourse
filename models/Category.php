<?php
require_once __DIR__ . '/../config/Database.php';

class Category {
    private $conn;

    public function __construct() {
        // Kết nối Database
        $db = new Database();
        $this->conn = $db->pdo;
    }

    // Lấy tất cả danh mục, có thể lọc theo từ khóa
    public function getAll($keyword = '') {
        $sql = "SELECT * FROM categories WHERE 1=1";
        if (!empty($keyword)) {
            $sql .= " AND name LIKE :keyword";
        }
        $sql .= " ORDER BY created_at DESC";
        
        $stmt = $this->conn->prepare($sql);
        if (!empty($keyword)) {
            $stmt->bindValue(':keyword', "%$keyword%");
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Thêm danh mục mới
    public function create($name, $description) {
        $sql = "INSERT INTO categories (name, description) VALUES (:name, :description)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':name' => $name,
            ':description' => $description
        ]);
    }

    // Cập nhật danh mục theo ID
    public function update($id, $name, $description) {
        $sql = "UPDATE categories SET name = :name, description = :description WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':name' => $name,
            ':description' => $description,
            ':id' => $id
        ]);
    }

    // Xóa danh mục theo ID
    public function delete($id) {
        // Kiểm tra xem danh mục có đang được sử dụng bởi khóa học nào không trước khi xóa (Optional)
        $sql = "DELETE FROM categories WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    // Lấy danh mục theo ID
    public function getById($id) {
        $sql = "SELECT * FROM categories WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
