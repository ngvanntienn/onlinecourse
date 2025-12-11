<?php
// controllers/CourseController.php
require_once 'models/Course.php';

class CourseController {
    private $courseModel;
    
    public function __construct() {
        $this->courseModel = new Course();
    }
    
    public function detail() {
        // Lấy dữ liệu từ Model
        $result = $this->courseModel->getById(1);
        
        // Xử lý dữ liệu trả về (có thể có hoặc không có key 'data')
        if (isset($result['data'])) {
            $course = $result['data'];
        } else {
            $course = $result; // Giả sử toàn bộ mảng là course data
        }
        
        // Đảm bảo các trường cần thiết tồn tại
        $course = array_merge([
            'title' => 'Khóa Học Fullstack Developer',
            'description' => 'Từ Zero đến Hero - Làm chủ Frontend, Backend và DevOps',
            'duration' => '30 giờ / 10 chương',
            'price_original' => '3.999.000đ',
            'price_discount' => '2.499.000đ',
            'discount_percent' => '37.5%'
        ], $course);
        
        // Dữ liệu giảng viên
        $teacher = [
            'name' => 'TRỊNH THỊ VÂN',
            'degree' => 'Thạc sĩ Khoa học máy tính - École Nationale Supérieure des Mines de Saint-Étienne, Pháp',
            'experience' => '5 năm kinh nghiệm giảng dạy và phát triển phần mềm',
            'specialization' => 'Fullstack Development',
            'students_trained' => '2,500+',
            'initials' => 'TV',
            'avatar_color' => 'from-purple-200 to-pink-100'
        ];
        
        // Dữ liệu quyền lợi
        $benefits = [
            'Học mọi lúc, mọi nơi trên mọi thiết bị',
            'Hỗ trợ 1-1 trực tiếp với mentor',
            'Bài tập thực hành & Project thực tế',
            'Truy cập trọn đời tài liệu khóa học',
            'Chứng chỉ hoàn thành có giá trị'
        ];
        
        // Render view với dữ liệu
        $this->render('courses/detail', [
            'page_title' => 'Chi tiết khóa học - ' . $course['title'],
            'course' => $course,
            'teacher' => $teacher,
            'benefits' => $benefits,
            'guarantee' => 'Đảm bảo hoàn tiền 100% trong 7 ngày'
        ]);
    }
    
    public function register() {
        // Xử lý đăng ký
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Xử lý form đăng ký
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';
            
            // Gọi model để xử lý đăng ký
            $result = $this->courseModel->register(1, [
                'name' => $name,
                'email' => $email,
                'phone' => $phone
            ]);
            
            if ($result['success']) {
                $_SESSION['success_message'] = $result['message'];
                header('Location: ' . BASE_URL . '?controller=course&action=detail');
                exit;
            }
        }
        
        // Hiển thị form đăng ký
        $this->render('courses/register', [
            'page_title' => 'Đăng ký khóa học'
        ]);
    }
    
    public function trial() {
        // Lấy bài học thử
        $result = $this->courseModel->getTrialLesson(1);
        
        if (isset($result['data'])) {
            $lesson = $result['data'];
        } else {
            $lesson = $result;
        }
        
        $this->render('courses/trial', [
            'page_title' => 'Bài học thử miễn phí',
            'lesson' => $lesson
        ]);
    }
    
    private function render($view, $data = []) {
        // Truyền dữ liệu vào view
        extract($data);
        
        // Load view
        $viewPath = "views/{$view}.php";
        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            die("View không tồn tại: {$viewPath}");
        }
    }
}
?>