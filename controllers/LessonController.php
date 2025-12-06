<?php
require_once 'models/Lesson.php';
require_once 'models/Material.php';

class LessonController {
    public function learn($lessonId) {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /onlinecourse/index.php?url=auth/login");
            exit;
        }

        $lessonModel = new Lesson();
        $lesson = $lessonModel->getById($lessonId);

        require_once 'views/layouts/header.php';
        require_once 'views/layouts/footer.php';
    }


    public function create($courseId) {

        if (!isset($_SESSION['role']) || $_SESSION['role'] != 2) {
            header("Location: /onlinecourse/"); 
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $videoUrl = $_POST['video_url'];
            $content = $_POST['content'];

            $lessonModel = new Lesson();
            $lessonModel->create($courseId, $title, $content, $videoUrl);

            header("Location: /onlinecourse/index.php?url=instructor/course/manage");
            exit;
        }

        $current_course_id = $courseId; 
        
        require_once 'views/layouts/header.php';
        require_once 'views/instructor/lessons/create.php';
        require_once 'views/layouts/footer.php';
    }
}
?>