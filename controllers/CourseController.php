<?php
require_once 'models/Course.php';
require_once 'models/Lesson.php';

class CourseController {

    public function index() {
        $courseModel = new Course();
        $courses = $courseModel->getAll(); 

        require_once 'views/layouts/header.php';
        require_once 'views/courses/index.php';
        require_once 'views/layouts/footer.php';
    }


    public function detail($id) {
        $courseModel = new Course();
        $course = $courseModel->getById($id);

        $lessonModel = new Lesson();
        $lessons = $lessonModel->getByCourseId($id);


        require_once 'views/layouts/header.php';
        require_once 'views/courses/detail.php';
        require_once 'views/layouts/footer.php';
    }


    public function search() {
        $keyword = $_GET['q'] ?? '';
        $courseModel = new Course();
        $courses = $courseModel->search($keyword);

        require_once 'views/layouts/header.php';
        require_once 'views/courses/search.php';
        require_once 'views/layouts/footer.php';
    }
}
?>