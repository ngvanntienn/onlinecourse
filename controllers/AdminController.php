<?php
require_once 'models/User.php';
require_once 'models/Course.php';

class AdminController {

    public function __construct() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 1) {
            echo "Bạn không có quyền truy cập!";
            exit;
        }
    }

    public function dashboard() {
        require_once 'views/layouts/header.php';
        require_once 'views/admin/dashboard.php';
        require_once 'views/layouts/footer.php';
    }

    public function manage_users() {
        $userModel = new User();
        $users = $userModel->getAll();

        require_once 'views/layouts/header.php';
        require_once 'views/admin/users/manage.php';
        require_once 'views/layouts/footer.php';
    }
}
?>