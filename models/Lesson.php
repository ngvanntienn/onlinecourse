<?php
require_once 'config/Database.php';

class Lesson {
    private $conn;

    public function __construct() {
        // Kết nối Database
        $db = new Database();
        $this->conn = $db->pdo;
    }

    // Lấy tất cả bài học theo ID khóa học
    public function getByCourseId($courseId) {
        $sql = "SELECT * FROM lessons WHERE course_id = :course_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['course_id' => $courseId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy 1 bài học theo ID
    public function getById($lessonId) {
        $sql = "SELECT * FROM lessons WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $lessonId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Thêm bài học mới
    public function create($courseId, $title, $content, $videoUrl, $order = 0) {
        $sql = "INSERT INTO lessons (course_id, title, content, video_url, `order`) 
                VALUES (:course_id, :title, :content, :video_url, :order)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'course_id' => $courseId,
            'title' => $title,
            'content' => $content,
            'video_url' => $videoUrl,
            'order' => $order
        ]);
        return $this->conn->lastInsertId();
    }

    // Cập nhật bài học
    public function update($lessonId, $title, $content, $videoUrl, $order = 0) {
        $sql = "UPDATE lessons SET title=:title, content=:content, video_url=:video_url, `order`=:order
                WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'title' => $title,
            'content' => $content,
            'video_url' => $videoUrl,
            'order' => $order,
            'id' => $lessonId
        ]);
    }

    // Xóa bài học
    public function delete($lessonId) {
        $sql = "DELETE FROM lessons WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => $lessonId]);
    }
    public function getLessonsByCourse($courseId) {
        $sql = "SELECT * FROM lessons WHERE course_id = :course_id ORDER BY id ASC"; 
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':course_id' => $courseId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
