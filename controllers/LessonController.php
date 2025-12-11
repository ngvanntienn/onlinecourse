<?php
require_once 'models/Lesson.php';
require_once 'models/Material.php';
require_once 'models/Course.php';
require_once 'models/Material.php';

class LessonController {

    // Hiển thị bài học
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

    // Tạo bài học mới
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

    // Quản lý bài học
    public function manage($courseId = null) {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /onlinecourse/index.php?controller=auth&action=login");
            exit;
        }

        if (!$courseId) {
            $courseId = isset($_GET['course_id']) ? intval($_GET['course_id']) : 0;
        }

        $lessonModel = new Lesson();
        $courseModel = new Course();

        $course = $courseModel->getById($courseId);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action_type'] ?? 'add';
            $title = trim($_POST['title'] ?? '');
            $videoUrl = trim($_POST['video_url'] ?? '');
            $content = trim($_POST['content'] ?? '');
            $order = intval($_POST['order'] ?? 0);

            if ($action === 'add') {
                $lessonModel->create($courseId, $title, $content, $videoUrl, $order);
                $_SESSION['flash_message'] = "Thêm bài học thành công!";
            } elseif ($action === 'edit') {
                $lessonId = intval($_POST['lesson_id'] ?? 0);
                $lessonModel->update($lessonId, $title, $content, $videoUrl, $order);
                $_SESSION['flash_message'] = "Cập nhật bài học thành công!";
            } elseif ($action === 'delete') {
                $lessonId = intval($_POST['lesson_id']);
                if ($lessonId > 0) {
                    $lessonModel->delete($lessonId);
                    $_SESSION['flash_message'] = "Xóa bài học thành công!";
                }
            }

            header("Location: /onlinecourse/index.php?controller=lesson&action=manage&course_id={$courseId}");
            exit;
        }

        $lessons = $lessonModel->getByCourseId($courseId);

        $materialModel = new Material();
        foreach ($lessons as &$lesson) {
            $lesson['material'] = $materialModel->getByLessonId($lesson['id']);
        }
        unset($lesson);

        require_once 'views/layouts/header_teacher.php';
        require_once 'views/instructor/lessons/manage.php';
    }

    // Chi tiết khóa học
    public function course_detail() {
        $courseId = isset($_GET['course_id']) ? intval($_GET['course_id']) : 0;

        if ($courseId == 0) {
            header("Location: /onlinecourse/index.php?controller=course&action=index");
            exit;
        }

        $this->manage($courseId);
    }
}
?>
