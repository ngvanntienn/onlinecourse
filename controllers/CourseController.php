<?php
require_once 'models/Course.php';

class CourseController {

    public function index() {
        $courseModel = new Course();
        $courses = $courseModel->getAll();

        require_once 'views/layouts/header.php';
        require_once 'views/instructor/course/manage.php';

    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $courseModel = new Course();
            $courseModel->create($_POST);

            header("Location: index.php?controller=course&action=index");
            exit;
        }
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $courseModel = new Course();
            $courseModel->update($_POST['id'], $_POST);

            header("Location: index.php?controller=course&action=index");
            exit;
        }
    }

    public function delete() {
        if (isset($_GET['id'])) {
            $courseModel = new Course();
            $courseModel->delete($_GET['id']);
        }

        header("Location: index.php?controller=course&action=index");
        exit;
    }
}
