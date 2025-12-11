<?php
require_once __DIR__ . '/../../../config/Database.php';
require_once __DIR__ . '/../../../models/Course.php';
require_once __DIR__ . '/../../../models/User.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: /onlinecourse/index.php?controller=auth&action=login");
    exit;
}
$current_action = 'lesson_manage';
// Dữ liệu session
$displayName = $_SESSION['fullname'] ?? 'Giảng viên';
$userAvatar  = !empty($_SESSION['avatar']) 
                ? '/onlinecourse/assets/avatars/' . $_SESSION['avatar'] 
                : 'https://t4.ftcdn.net/jpg/05/49/98/39/360_F_549983970_bRCkYfk0P6PP5fveM072efagRg8JuC8e.jpg';

// Lấy danh sách khóa học
$courseModel = new Course();
$courses = $courseModel->getAll();

require_once __DIR__ . '/../../layouts/header_teacher.php';
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="/onlinecourse/assets/css/teacher.css?v=<?= time() ?>">
    <style>
        :root {
            --bg-purple-light: #F3E5F5;        
            --btn-purple: #BA68C8;            
            --btn-purple-hover: #9C27B0;       
        }
        body {
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            font-size: 1.1rem;                  
            padding-top: 80px;
        }
        
    </style>
</head>
<body>

<div class="lesson-manage-container">
    <div class="lesson-manage-inner">
        <h2 class="page-title">Danh sách các khóa học</h2>
        <div class="row g-4">
            <?php if (!empty($courses)): ?>
                <?php foreach ($courses as $course): ?>
                    <div class="col-lg-6 col-12">
                        <div class="course-card">
                            <div class="card-img-wrapper">
                                <img src="<?= htmlspecialchars($course['image'] ?? 'assets/image/default_course.jpg') ?>" 
                                     alt="Course Image"
                                     onerror="this.src='https://via.placeholder.com/300x200?text=No+Image'">
                            </div>
                            <div class="card-content-wrapper">
                                <h3 class="course-title" title="<?= htmlspecialchars($course['title']) ?>">
                                    <?= htmlspecialchars($course['title']) ?>
                                </h3>
                                <a href="/onlinecourse/index.php?controller=lesson&action=course_detail&course_id=<?= $course['id'] ?>" 
                                   class="btn-detail-purple">
                                    Đi đến quản lý bài giảng <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <p class="text-muted fs-5">Chưa có khóa học nào.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php 
require_once '../../users/manage.php';
require_once '../materials/upload_teacher.php';
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>


