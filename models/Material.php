<?php
require_once __DIR__ . '/../config/Database.php';

class Material {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->pdo;
    }

    // Lấy tài liệu theo lesson_id
    public function getByLessonId($lessonId) {
    // Bỏ LIMIT 1 để lấy hết tài liệu của bài học đó
    $sql = "SELECT * FROM materials WHERE lesson_id = :lesson_id"; 
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['lesson_id' => $lessonId]);
    
    // QUAN TRỌNG: Dùng fetchAll để trả về mảng danh sách
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
}
    // Thêm mới tài liệu
      public function create($lessonId, $filename, $filePath, $fileType) {
        $sql = "INSERT INTO materials (lesson_id, filename, file_path, file_type, uploaded_at)
                VALUES (:lesson_id, :filename, :file_path, :file_type, NOW())";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'lesson_id' => $lessonId,
            'filename' => $filename,
            'file_path' => $filePath,
            'file_type' => $fileType
        ]);
    }

    // Xóa tài liệu 
     public function deleteByLessonId($lessonId) {
        $sql = "DELETE FROM materials WHERE lesson_id = :lesson_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['lesson_id' => $lessonId]);
    }
}
?>