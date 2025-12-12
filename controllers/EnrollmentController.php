<?php
// Đảm bảo đường dẫn trỏ đúng về file model vừa tạo ở Bước 1
require_once __DIR__ . '/../models/Enrollment.php'; 
require_once __DIR__ . '/../models/Course.php'; 

class EnrollmentController {

    public function create() {
        // 1. Kiểm tra đăng nhập
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = "Vui lòng đăng nhập để đăng ký khóa học!";
            header("Location: index.php?controller=auth&action=login");
            exit;
        }

        // 2. Lấy thông tin từ URL
        if (!isset($_GET['course_id'])) {
            $_SESSION['error'] = "Khóa học không hợp lệ!";
            header("Location: index.php?controller=student&action=dashboard");
            exit;
        }

        $courseId = $_GET['course_id'];
        $studentId = $_SESSION['user_id'];

        // 3. Gọi Model xử lý
        // Lệnh này sẽ chạy thành công sau khi bạn làm Bước 1
        $enrollmentModel = new Enrollment();

        // Kiểm tra xem đã đăng ký chưa
        if ($enrollmentModel->isEnrolled($studentId, $courseId)) {
            $_SESSION['error'] = "Bạn đã đăng ký khóa học này rồi!";
            header("Location: index.php?controller=student&action=dashboard"); 
            exit;
        }

        // Thực hiện đăng ký
        if ($enrollmentModel->create($studentId, $courseId)) {
            $_SESSION['success'] = "Đăng ký khóa học thành công! Chào mừng bạn.";
            header("Location: index.php?controller=student&action=dashboard");
        } else {
            $_SESSION['error'] = "Có lỗi xảy ra khi đăng ký. Vui lòng thử lại!";
            header("Location: index.php?controller=student&action=dashboard");
        }

        exit;
    }
}
?>