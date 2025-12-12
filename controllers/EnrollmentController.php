<?php
require_once 'models/Enrollment.php';

class EnrollmentController {

    public function join($courseId) {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /onlinecourse/index.php?url=auth/login");
            exit;
        }

        $enrollModel = new Enrollment();
        if (!$enrollModel->checkEnrollment($_SESSION['user_id'], $courseId)) {
            $enrollModel->add($_SESSION['user_id'], $courseId);
        }

        header("Location: /onlinecourse/index.php?url=student/my_courses");
        exit;
    }
    public function students() {
        if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) {
            header("Location: /onlinecourse/index.php");
            exit;
        }

        $enrollmentModel = new Enrollment();
        $students = $enrollmentModel->getAllEnrollments();

        require_once 'views/instructor/students/index.php';
    }
    public function remove_student() {
        if (isset($_GET['id'])) {
            $enrollmentId = intval($_GET['id']);
            
            $enrollmentModel = new Enrollment();
            if ($enrollmentModel->removeStudent($enrollmentId)) {
                $_SESSION['success'] = "Đã hủy đăng ký thành công!";
            } else {
                $_SESSION['error'] = "Lỗi hệ thống!";
            }
        }
        header("Location: /onlinecourse/index.php?controller=teacher&action=students");
        exit;
    }
    
}

?>