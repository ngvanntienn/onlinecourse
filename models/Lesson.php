<?php
require_once 'config/Database.php';

class Lesson {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->pdo;
    }
    public function getByCourseId($courseId) {
        $sql = "SELECT * FROM lessons WHERE course_id = :course_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['course_id' => $courseId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
