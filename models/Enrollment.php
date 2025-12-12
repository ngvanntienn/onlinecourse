<?php
require_once './config/Database.php';
require_once './models/User.php';
require_once './models/Course.php';


class Enrollment {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->pdo;
    }

    // Kiểm tra xem học viên đã đăng ký khóa học này chưa
    public function isEnrolled($studentId, $courseId) {
        $sql = "SELECT COUNT(*) FROM enrollments WHERE student_id = :student_id AND course_id = :course_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':student_id' => $studentId,
            ':course_id' => $courseId
        ]);
        return $stmt->fetchColumn() > 0;
    }

    // Tạo mới đăng ký
    public function create($studentId, $courseId) {
        try {
            $sql = "INSERT INTO enrollments (student_id, course_id, status, enrolled_date, progress) 
                    VALUES (:student_id, :course_id, 'active', NOW(), 0)";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                ':student_id' => $studentId,
                ':course_id' => $courseId
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }
  public function getAllEnrollments() {
    $sql = "SELECT 
                e.id as enrollment_id,
                e.enrolled_date,
                u.id as student_id,
                u.fullname,
                u.email,
                u.avatar,
                c.title as course_name
            FROM enrollments e
            JOIN users u ON e.student_id = u.id
            JOIN courses c ON e.course_id = c.id
            ORDER BY e.enrolled_date DESC";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    // Các hàm khác giữ nguyên...
    public function removeStudent($enrollmentId) {
        $sql = "DELETE FROM enrollments WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => $enrollmentId]);
    }
}
?>
