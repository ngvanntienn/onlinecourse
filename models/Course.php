<?php
class Course {
    public static function getAll() {
        return [
            'lap-trinh-web' => [
                'id' => 'lap-trinh-web',
                'title' => 'Lập Trình Web',
                'sub_title' => 'Hiểu về',
                'teacher_name' => 'Trịnh Thị Vân',
                'teacher_avatar' => 'https://t4.ftcdn.net/jpg/05/49/98/39/360_F_549983970_bRCkYfk0P6PP5fveM072efagRg8JuC8e.jpg',
                'teacher_bio' => [
                    'Thạc sĩ Khoa học máy tính, École Nationale, Supérieure des Mines de Saint-Étienne, Pháp',
                    '5 năm kinh nghiệm giảng dạy'
                ],
                'banner_img' => 'https://vtc.edu.vn/wp-content/uploads/2022/12/thumbnail-lap-trinh-web-la-gi.jpg',
                'bg_color' => 'linear-gradient(135deg, #0f204b 0%, #2c1a66 100%)',
                'duration' => '30 giờ',
                'chapters' => '10 chương',
                'description' => 'Khóa học Lập Trình Web dành cho người mới bắt đầu...',
                'learn_goals' => [
                    'Nền tảng Web: HTML, CSS, JavaScript',
                    'Tư duy cấu trúc và thiết kế giao diện',
                    'Cách làm việc với thư viện, tổ chức dự án',
                    'Thực hành liên tục với bài tập và 01 dự án lớn cuối khóa'
                ],
                'outcomes' => [
                    'Thành thạo HTML5, semantic chuẩn',
                    'Làm chủ CSS3, Flexbox, Grid',
                    'Hiểu rõ JavaScript cơ bản',
                    'Biết chuyển từ thiết kế sang code',
                    'Tự xây dựng website hoàn chỉnh',
                    'Tư duy code gọn gàng'
                ]
            ],
            'photoshop-co-ban' => [
                'id' => 'photoshop-co-ban',
                'title' => 'Photoshop & Thiết kế',
                'sub_title' => 'Làm chủ',
                'teacher_name' => 'Nguyễn Văn Tiến',
                'teacher_avatar' => 'https://cdn-icons-png.flaticon.com/512/3135/3135715.png',
                'teacher_bio' => ['Graphic Designer chuyên nghiệp', '8 năm kinh nghiệm'],
                'banner_img' => 'https://static1.makeuseofimages.com/wordpress/wp-content/uploads/2016/10/photoshop-cc-guide.jpg',
                'bg_color' => 'linear-gradient(135deg, #1a237e 0%, #2c1a66 100%)',
                'duration' => '24 giờ',
                'chapters' => '8 chương',
                'description' => 'Khóa học Photoshop cơ bản giúp bạn làm chủ công cụ chỉnh sửa ảnh...',
                'learn_goals' => [
                    'Hiểu về giao diện Photoshop',
                    'Kỹ thuật cắt ghép ảnh',
                    'Lý thuyết màu sắc',
                    'Thiết kế ấn phẩm'
                ],
                'outcomes' => [
                    'Sử dụng thành thạo Layer, Mask',
                    'Retouch ảnh chân dung',
                    'Tự thiết kế banner',
                    'Tư duy thẩm mỹ tốt'
                ]
            ]
        ];
    }

    // lấy chi tiết 1 khóa học theo ID
    public static function getById($id) {
        $courses = self::getAll();
        return isset($courses[$id]) ? $courses[$id] : $courses['lap-trinh-web'];
    }
}
?>