<?php
class StudentController {
    public function dashboard() {
        $userModel = new User();
        $user = $userModel->getUserById($_SESSION['user_id']);
        $avatar = $_SESSION['avatar'] ?? $user['avatar'] ?? '';
        $avatarDisplay = $avatar 
            ? '/onlinecourse/assets/avatars/' . $avatar 
            : 'https://t4.ftcdn.net/jpg/05/49/98/39/360_F_549983970_bRCkYfk0P6PP5fveM072efagRg8JuC8e.jpg';

        require_once 'views/instructor/students/dashboard.php';
    }

    // upload avatar
    public function upload_avatar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_FILES['avatar']['name'])) {
            $file = $_FILES['avatar'];
            $allowed = ['image/jpeg','image/jpg','image/png'];

            if ($file['error'] === 0 && in_array($file['type'], $allowed)) {
                $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                $newName = 'avatar_' . $_SESSION['user_id'] . '_' . time() . '.' . $ext;

                $uploadDir = 'assets/avatars/';
                if (!file_exists($uploadDir)) mkdir($uploadDir, 0777, true);

                $uploadPath = $uploadDir . $newName;

                if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
                    $userModel = new User();
                    if ($userModel->updateAvatar($_SESSION['user_id'], $newFilename)) {
                        $_SESSION['avatar'] = $newFilename; // cập nhật session
                        $_SESSION['success'] = "Cập nhật ảnh đại diện thành công!";
                    } else {
                        $_SESSION['error'] = "Lỗi không lưu được vào database.";
                    }
                }
            }
        }
        header("Location: index.php?controller=student&action=dashboard");
        exit;
    }
}
?>
