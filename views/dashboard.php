<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header("Location: /onlinecourse/index.php?controller=auth&action=login");
    exit;
}

$current_page = 'dashboard'; 
$displayName = $_SESSION['fullname'] ?? 'Giảng viên'; 
$avatarDisplay = !empty($_SESSION['avatar'])
    ? '/onlinecourse/assets/avatars/' . $_SESSION['avatar'] . '?t=' . time()
    : (!empty($user['avatar'])
        ? '/onlinecourse/assets/avatars/' . $user['avatar'] . '?t=' . time()
        : 'https://t4.ftcdn.net/jpg/05/49/98/39/360_F_549983970_bRCkYfk0P6PP5fveM072efagRg8JuC8e.jpg');
require_once 'views/layouts/header_teacher.php';
?>

<!-- form tương tự header students -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="hero-title"><span class = "text-title">Xin chào, </span><?= $displayName ?></h1>
                <p class="hero-subtitle" style = "font-size:1.5rem;">Chào mừng quay trở lại EasyStudy! 
                        <br>Đăng tải bài học mới ngay nào?
                    </p>
            </div>
            <div class="col-md-6">
                <div class="hero-image-wrapper">
                    <img src="/onlinecourse/assets/image/hero/student.png" alt="Student" class="img-fluid hero-girl-img">
                </div>
            </div>
        </div>
    </div>
</section>


<div class="container">
    
    <div class="row dashboard-cards g-4">
        
        <div class="col-md-4">
            <a href="views/instructor/course/manage.php" class="manage-card card-orange">
                <div class="card-content">
                    <h3 class="card-title">Quản lý Khóa học</h3>
                    <i class="fas fa-book-open card-icon-bg"></i>
                </div>
                <div class="card-footer-link">
                    Xem chi tiết <i class="fas fa-arrow-right"></i>
                <?php
                if (session_status() == PHP_SESSION_NONE) session_start();
                if (!isset($_SESSION['user_id'])) {
                    header("Location: /onlinecourse/index.php?controller=auth&action=login");
                    exit;
                }

                $role = $_SESSION['role'] ?? 0;

                // The outer header/footer are included by HomeController::dashboard()
                // Include role-specific partials (create these under views/partials)
                if ($role == 2) {
                    require_once 'views/partials/dashboard_admin.php';
                } elseif ($role == 1) {
                    require_once 'views/partials/dashboard_instructor.php';
                } else {
                    require_once 'views/partials/dashboard_student.php';
                }

                ?>
                    <i class="fas fa-folder card-icon-bg"></i>
