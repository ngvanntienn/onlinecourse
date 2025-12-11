<?php
require_once 'models/Material.php';

class MaterialController {

    // Gọi hàm upload
    public function save() {
        $this->upload();
    }

    // Upload tài liệu
    public function upload() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $lessonId = intval($_POST['lesson_id']);
            $courseId = intval($_POST['course_id']);
            
            $filename = trim($_POST['filename'] ?? '');
            $fileType = trim($_POST['file_type'] ?? '');
            $filePath = trim($_POST['file_path'] ?? '');

            $materialModel = new Material();

            if (isset($_FILES['document_file']) && $_FILES['document_file']['error'] == 0) {
                $file = $_FILES['document_file'];
                $originalName = $file['name'];
                $tmpName = $file['tmp_name'];
                $fileType = $file['type'];

                $newFileName = time() . '_' . $originalName;
                $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/onlinecourse/views/instructor/materials/';

                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $destination = $uploadDir . $newFileName;

                if (move_uploaded_file($tmpName, $destination)) {
                    $filePath = 'views/instructor/materials/' . $newFileName;
                    $filename = $originalName;
                } else {
                    $_SESSION['flash_message'] = "Upload file thất bại!";
                    header("Location: /onlinecourse/index.php?controller=lesson&action=manage&course_id=" . $courseId);
                    exit;
                }
            }

            $materialModel->deleteByLessonId($lessonId);
            $materialModel->create($lessonId, $filename, $filePath, $fileType);

            $_SESSION['flash_message'] = "Lưu tài liệu thành công!";
            header("Location: /onlinecourse/index.php?controller=lesson&action=manage&course_id=" . $courseId);
            exit;
        }
    }

    // Hàm tạo tài liệu
    public function create($lessonId, $filename, $filePath, $fileType) {
        $sql = "INSERT INTO materials (lesson_id, filename, file_path, file_type, uploaded_at) 
                VALUES (:lesson_id, :filename, :file_path, :file_type, NOW())";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'lesson_id' => $lessonId,
            'filename' => $filename,
            'file_path' => $filePath,
            'file_type' => $fileType
        ]);
    }
}
?>
