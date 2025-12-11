<?php
require_once 'models/User.php';
require_once 'models/Course.php';

class AdminController {

    public function __construct() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 2) {
            echo "Bạn không có quyền truy cập!";
            exit;
        }
        $this->userModel = new User();
    }

    public function dashboard() {

        
        $displayName = $_SESSION['fullname'] ?? 'Học viên';
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
        require_once 'views/admin/index.php';
        require_once 'views/layouts/footer.php';
 
    }

    public function manage_users() {
        $userModel = new User();
        $users = $userModel->getAll();

        require_once 'views/layouts/header.php';
        require_once 'views/admin/users/manage.php';
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
                header("Location: /onlinecourse/index.php?controller=admin&action=dashboard");
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
        header("Location: /onlinecourse/index.php?controller=admin&action=dashboard");
        exit;
        
    }
    public function update_status() {
    if (!isset($_GET['id'], $_GET['status'])) return;

    $id = (int)$_GET['id'];
    $status = (int)$_GET['status'];

    $db = new Database();
    $conn = $db->pdo;

    $stmt = $conn->prepare("UPDATE users SET status = :status WHERE id = :id");
    $stmt->execute([
        ':status' => $status,
        ':id' => $id
    ]);
    $id = $_GET['id'] ?? 0;
        $status = $_GET['status'] ?? 1;

        $userModel = new User();
        $userModel->updateStatus($id, $status);


    header("Location: index.php?controller=admin&action=users");
    exit;
}
    public function users() {
        $db = new Database();
        $conn = $db->pdo;

         $keyword = $_GET['keyword'] ?? '';
        $roleFilter = $_GET['role'] ?? 'all';
        $statusFilter = $_GET['status'] ?? 'all';

        // 2. Tạo model và gọi function lấy dữ liệu
        $userModel = new User();
        $usersList = $userModel->getUsers($keyword, $roleFilter, $statusFilter);


        require_once 'views/layouts/header_students.php';
        require_once 'views/admin/index.php';
        require_once 'views/layouts/footer.php';
    }
    }
?>