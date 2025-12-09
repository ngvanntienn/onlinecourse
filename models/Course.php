<?php
class Course {
    private $db;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->pdo;
    }
    public static function getAll() {

        $db = new Database();
        $stmt = $db->pdo->prepare("SELECT * FROM courses ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->conn->pdo->prepare("SELECT * FROM courses WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $sql = "INSERT INTO courses (title, description, price, duration_weeks, level, image, created_at) 
                VALUES (:title, :description, :price, :duration_weeks, :level, :image, NOW())";
        $stmt = $this->db->pdo->prepare($sql);
        return $stmt->execute([
            ':title' => $data['title'],
            ':description' => $data['description'],
            ':price' => $data['price'],
            ':duration_weeks' => $data['duration'],
            ':level' => $data['level'],
            ':image' => $data['image']
        ]);
    }

    public function update($id, $data) {
        $sql = "UPDATE courses SET title=:title, description=:description, price=:price, 
                duration_weeks=:duration_weeks, level=:level, image=:image, updated_at=NOW() 
                WHERE id=:id";
        $stmt = $this->db->pdo->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':title' => $data['title'],
            ':description' => $data['description'],
            ':price' => $data['price'],
            ':duration_weeks' => $data['duration'],
            ':level' => $data['level'],
            ':image' => $data['image']
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->pdo->prepare("DELETE FROM courses WHERE id=:id");
        return $stmt->execute([':id' => $id]);
    }
}
?>
