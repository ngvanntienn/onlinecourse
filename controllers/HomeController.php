<?php
class HomeController {
    public function index() {
        // Controller gọi View
        // Lưu ý: Đường dẫn tính từ file index.php gốc
        require_once 'views/home/index.php';
    }
}
?>