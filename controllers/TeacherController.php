<?php
require_once './config/Database.php';
require_once './models/User.php';

require_once './models/Course.php';
require_once './models/Enrollment.php';

class TeacherController {

    private $userModel;

    public function __construct() {
        $this->userModel = new User();

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            header("Location: /onlinecourse/index.php?controller=auth&action=login");
            exit;
        }
    }
    
    public function dashboard() {
        $displayName = $_SESSION['fullname'] ?? 'Giảng viên';
        $userAvatar = !empty($_SESSION['avatar']) 
            ? '/onlinecourse/assets/avatars/' . $_SESSION['avatar'] 
            : 'https://t4.ftcdn.net/jpg/05/49/98/39/360_F_549983970_bRCkYfk0P6PP5fveM072efagRg8JuC8e.jpg';
        $avatarDisplay = $userAvatar . '?v=' . time();

        $db = new Database();
        $conn = $db->pdo;

        $isShowAll = isset($_GET['view']) && $_GET['view'] == 'all';
        $limit = $isShowAll ? 12 : 2;

        $sql = "SELECT * FROM courses ORDER BY created_at DESC LIMIT :limit";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $discoveryCourses = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require_once 'views/layouts/header_students.php';
        require_once 'views/dashboard.php';
        require_once 'views/layouts/footer.php';
    }

    // xử lý upload ảnh đại diện
    public function upload_avatar() {
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['avatar']['tmp_name'];
            $fileName = $_FILES['avatar']['name'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            $allowedExtensions = ['jpg', 'jpeg', 'png'];
            if (!in_array($fileExtension, $allowedExtensions)) {
                $_SESSION['error'] = "Chỉ cho phép file JPG, PNG.";
                header("Location: /onlinecourse/index.php?controller=teacher&action=dashboard");
                exit;
            }

            $newFileName = "avatar_" . $_SESSION['user_id'] . "_" . time() . "." . $fileExtension;
            $uploadFileDir = $_SERVER['DOCUMENT_ROOT'] . '/onlinecourse/assets/avatars/';
            if (!is_dir($uploadFileDir)) mkdir($uploadFileDir, 0755, true);

            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $this->userModel->updateAvatar($_SESSION['user_id'], $newFileName);
                $_SESSION['avatar'] = $newFileName;
                $_SESSION['success'] = "Cập nhật ảnh đại diện thành công!";
            } else {
                $_SESSION['error'] = "Có lỗi khi tải ảnh lên, vui lòng thử lại.";
            }
        } else {
            $_SESSION['error'] = "Vui lòng chọn file ảnh.";
        }
        header("Location: /onlinecourse/index.php?controller=teacher&action=dashboard");
        exit;
    }


    /**
     * Quản lý danh sách khóa học của giảng viên
     */
    public function course_manage() {
        $courseModel = new Course();
        $courses = $courseModel->getCoursesByTeacher($_SESSION['user_id']);

        // Load view quản lý khóa học
        require_once 'views/instructor/course/manage.php';
    }
   public function students() {
        // Kiểm tra quyền
        if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) {
            header("Location: /onlinecourse/index.php");
            exit;
        }

        // Luôn khởi tạo mảng rỗng
        $students = [];

        // Load model
        $enrollmentModel = new Enrollment();
        $students = $enrollmentModel->getAllEnrollments();

        // Load view
        require_once 'views/instructor/students/index.php';
    }

    public function remove_student() {
        if (isset($_GET['id'])) {
            $enrollmentId = intval($_GET['id']);
            
            $enrollmentModel = new Enrollment();
            if ($enrollmentModel->removeStudent($enrollmentId)) {
                $_SESSION['success'] = "Đã hủy đăng ký thành công!";
            } else {
                $_SESSION['error'] = "Lỗi hệ thống!";
            }
        }
        header("Location: /onlinecourse/index.php?controller=teacher&action=students");
        exit;
    }

}
?>
