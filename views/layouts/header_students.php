<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$defaultAvatar = "https://t4.ftcdn.net/jpg/05/49/98/39/360_F_549983970_bRCkYfk0P6PP5fveM072efagRg8JuC8e.jpg";
$userAvatar = (isset($_SESSION['avatar']) && !empty($_SESSION['avatar'])) 
            ? '/onlinecourse/assets/avatars/' . $_SESSION['avatar'] 
            : $defaultAvatar;
$avatarDisplay = $userAvatar . '?v=' . time();
$displayName = isset($_SESSION['fullname']) ? $_SESSION['fullname'] : 'Học viên';
$current_action = isset($_GET['action']) ? $_GET['action'] : 'dashboard';
$role = $_SESSION['role'] ?? 0; 
$dashboardLink = ($role == 2) 
    ? '/onlinecourse/index.php?controller=admin&action=dashboard' 
    : '/onlinecourse/index.php?controller=student&action=dashboard';
?>
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="/onlinecourse/assets/css/style.css?v=<?= time() ?>">
    <link rel="stylesheet" href="/onlinecourse/assets/css/students.css?v=<?= time() ?>">
    <link rel="stylesheet" href="/onlinecourse/assets/css/courses.css?v=<?= time() ?>">
</head>
<body>

<!-- navbar -->
<nav class="navbar fixed-top student-navbar">
    <div class="container h-100">
        <a class="brand-logo me-auto" href="/onlinecourse/index.php">
            <i class="fas fa-graduation-cap me-2"></i>EasyStudy
        </a>

        <div class="d-flex align-items-center">

            <div class="d-none d-md-flex gap-2">
                <a href="<?= $dashboardLink ?>" 
                    class="nav-box-link <?= ($current_action == 'dashboard') ? 'active' : '' ?>">
                    Trang chủ
                </a>

                <a href="#discovery-section"
                class="nav-box-link <?= ($current_action == 'my_courses') ? 'active' : '' ?>">
                    Khóa học
                </a>
            </div>

            <!-- avatar dropdown -->
            <div class="dropdown ms-3">
                <div class="user-profile-wrapper dropdown-toggle" data-bs-toggle="dropdown">
                    <img src="<?= $avatarDisplay ?>" class="user-avatar-circle">
                    <span class="user-name-text d-none d-sm-block ms-2"><?= $displayName ?></span>
                </div>

                <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-3">
                    <li>
                        <div class="px-3 py-2 border-bottom bg-light">
                            <small class="text-muted">Xin chào,</small><br>
                            <strong><?= $displayName ?></strong>
                        </div>
                    </li>
                <li>
        <a class="dropdown-item py-2" href="#" data-bs-toggle="modal" data-bs-target="#accountInfoModal">
            <i class="fas fa-columns fa-fw me-2 text-primary"></i>Thông tin tài khoản
        </a>
        </li>

        <li>
        <a class="dropdown-item py-2" href="#" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
            <i class="fas fa-key fa-fw me-2 text-primary"></i>Đổi mật khẩu
        </a>
        </li>
                            <li><a class="dropdown-item py-2" href="#" data-bs-toggle="modal" data-bs-target="#uploadAvatarModal">
                        <i class="fas fa-camera me-2 text-info"></i>Đổi ảnh đại diện
                    </a></li>

                    <li><hr class="dropdown-divider my-1"></li>

                    <li><a class="dropdown-item py-2 text-danger" href="/onlinecourse/index.php?controller=auth&action=logout">
                        <i class="fas fa-sign-out-alt me-2"></i>Đăng xuất
                    </a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header bg-purple text-white">
                <h5 class="modal-title" id="changePasswordModalLabel">Đổi mật khẩu</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="/onlinecourse/index.php?controller=auth&action=updatePassword">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Mật khẩu cũ</label>
                        <input type="password" class="form-control" name="old_password" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mật khẩu mới</label>
                        <input type="password" class="form-control" name="new_password" required>
                        <small class="text-muted">Tối thiểu 8 ký tự, có chữ hoa, số, ký tự đặc biệt.</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Xác nhận mật khẩu mới</label>
                        <input type="password" class="form-control" name="confirm_password" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script src = "/onlinecourse/assets/js/students.js"></script>
