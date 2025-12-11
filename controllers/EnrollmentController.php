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
}
?>