<?php
class CourseController {
    // ... các hàm khác (index, search...)

    public function detail() {
        // 1. Lấy ID khóa học từ URL (ví dụ: index.php?controller=course&action=detail&id=1)
        $current_id = isset($_GET['id']) ? (int)$_GET['id'] : 1;

        // --- GIẢ LẬP DỮ LIỆU TỪ DATABASE (Thay thế phần này bằng Model của bạn) ---
        
        // Danh sách tất cả khóa học
        $all_courses = [
            1 => [
                'id' => 1,
                'title' => 'Lập trình Web (PHP & MySQL)',
                'instructor' => 'Trịnh Khánh An',
                'image' => '/onlinecourse/assets/image/course/web.png',
                'banner_color' => 'banner-blue', // class CSS
                'desc' => 'Khóa học bao gồm HTML, CSS, JS và PHP Backend cơ bản.',
                'price' => 'Miễn phí',
                'lessons' => 12,
                'duration' => '30 giờ'
            ],
            2 => [
                'id' => 2,
                'title' => 'Photoshop và thiết kế cơ bản',
                'instructor' => 'Nguyễn Văn B',
                'image' => '/onlinecourse/assets/image/course/pts.png',
                'banner_color' => 'banner-dark',
                'desc' => 'Thành thạo công cụ Photoshop để thiết kế banner, poster.',
                'price' => '500.000đ',
                'lessons' => 8,
                'duration' => '15 giờ'
            ],
            3 => [
                'id' => 3,
                'title' => 'Tiếng Anh giao tiếp',
                'instructor' => 'Mai Phương',
                'image' => '/onlinecourse/assets/image/course/english.png', // Thay ảnh thật
                'banner_color' => 'banner-blue',
                'desc' => 'Tự tin giao tiếp tiếng Anh trong môi trường công sở.',
                'price' => '1.200.000đ',
                'lessons' => 20,
                'duration' => '45 giờ'
            ]
        ];

        // 2. Lấy thông tin khóa học hiện tại
        $course = isset($all_courses[$current_id]) ? $all_courses[$current_id] : null;

        // Nếu không tìm thấy khóa học, chuyển về trang chủ hoặc báo lỗi
        if (!$course) {
            header("Location: index.php");
            exit();
        }

        // 3. LỌC DANH SÁCH "KHÁM PHÁ" (Loại bỏ khóa học đang xem)
        $other_courses = [];
        foreach ($all_courses as $c) {
            if ($c['id'] != $current_id) {
                $other_courses[] = $c;
            }
        }

        // 4. Gọi View
        require_once 'views/course/detail.php';
    }
}
?>