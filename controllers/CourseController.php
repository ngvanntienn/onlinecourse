<?php
require_once 'views/models/Course.php';
require_once 'views/models/Lesson.php';

class CourseController {

    public function index() {
        $courseModel = new Course();
        $courses = $courseModel->getAll();

        require_once 'views/layouts/header.php';
        require_once 'views/courses/index.php';
        require_once 'views/layouts/footer.php';
    }
    public function detail() {
        $id = $_GET['id'] ?? null;
        $courseModel = new Course();
        $course = $courseModel->getById($id);

        if (!$course) {
            die("Khóa học không tồn tại");
        }

        $lessonModel = new Lesson();
        $lessons = $lessonModel->getByCourseId($id);

        $courses_data = $courseModel->getAll(); // tải khóa học khác

        require_once 'views/layouts/header_students.php';
        require_once 'views/courses/detail.php';
        require_once 'views/layouts/footer.php';
    }
}
?>
