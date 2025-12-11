<?php
class StudentController {
    public function dashboard() {
        $view = 'views/instructor/students/dashboard.php';
        if (file_exists($view)) {
            require_once $view;
            return;
        }

        // Nếu view không tồn tại, tránh lỗi include và chuyển hướng an toàn về trang chủ
        header('Location: /onlinecourse/index.php');
        exit;
    }

    // Thêm phương thức index để tránh lỗi khi router gọi action mặc định
    public function index() {
        $this->dashboard();
    }

}
?>
