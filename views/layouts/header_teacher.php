<?php
/* bắt đầu phiên */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$defaultAvatar = "https://t4.ftcdn.net/jpg/05/49/98/39/360_F_549983970_bRCkYfk0P6PP5fveM072efagRg8JuC8e.jpg";
$userAvatar = (isset($_SESSION['avatar']) && !empty($_SESSION['avatar'])) 
            ? '/onlinecourse/assets/uploads/avatars/' . $_SESSION['avatar'] 
            : $defaultAvatar;
$avatarDisplay = $userAvatar . '?v=' . time();

/* hiển thị tên mặc định là giảng viên */
$displayName = isset($_SESSION['fullname']) ? $_SESSION['fullname'] : 'Giảng viên';
$current_action = isset($_GET['action']) ? $_GET['action'] : 'dashboard';
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="/onlinecourse/assets/css/style.css">
    <link rel="stylesheet" href="/onlinecourse/assets/css/students.css">
    <link rel="stylesheet" href="/onlinecourse/assets/css/courses.css">
    <link rel="stylesheet" href="/onlinecourse/assets/css/teacher.css">
    <style>
        .student-navbar {
            background-color: #fff;
            height: 90px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            padding: 0 20px;
            z-index: 1000;
        }

        .brand-logo {
            font-weight: 900;
            color: #692e8e;
            font-size: 2rem; 
            text-decoration: none;
            display: flex;
            align-items: center;
            margin-right: 40px;
        }

        /* nút menu */
        .nav-box-link {
            display: inline-block;
            background-color: #fff;
            color: #555;
            font-weight: 600;
            text-decoration: none;
            padding: 10px 25px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            box-shadow: 0 3px 6px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            font-size: 1.3rem;
            white-space: nowrap;
            min-width: 110px;
            text-align: center;
        }

        .nav-box-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
            color: #692e8e;
            border-color: #d3cce3;
        }

        .nav-box-link.active {
            background-color: #f3effb;
            border-color: #692e8e;
            color: #692e8e;
            box-shadow: 0 4px 8px rgba(105, 46, 142, 0.2);
        }

        /* avatar */
        .user-avatar-circle {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            object-fit: cover;
        }

        .user-profile-wrapper {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .user-name-text {
            font-weight: 600;
            font-size: 1.4rem;
            color: #333;
        }

        /* dropdown style */
        .dropdown-menu {
            border-radius: 9px;
            overflow: hidden;
            font-size: 1.3rem;
        }
        .modal-dialog {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: calc(100vh - 1rem);
        }
    </style>
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
                <a href="/onlinecourse/index.php" 
                class="nav-box-link <?= ($current_action == 'dashboard') ? 'active' : '' ?>">
                    Trang chủ
                </a>

                <a href="/onlinecourse/index.php?controller=student&action=my_courses" 
                class="nav-box-link <?= ($current_action == 'my_courses') ? 'active' : '' ?>">
                    Khóa học
                </a>
                <a href="/onlinecourse/index.php?controller=student&action=my_courses" 
                class="nav-box-link <?= ($current_action == 'my_courses') ? 'active' : '' ?>">
                    Bài Giảng
                </a>
                <a href="/onlinecourse/index.php?controller=student&action=my_courses" 
                class="nav-box-link <?= ($current_action == 'my_courses') ? 'active' : '' ?>">
                    Học viên
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

                    <li><a class="dropdown-item py-2" href="/onlinecourse/index.php?controller=student&action=dashboard"><i class="fas fa-columns me-2 text-primary"></i>Thông tin tài khoản</a></li>

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

    <!-- modal -->
    <div class="modal fade" id="uploadAvatarModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="/onlinecourse/index.php?controller=student&action=upload_avatar" method="POST" enctype="multipart/form-data">
            <div class="modal-content">

                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold">Cập nhật ảnh đại diện</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body text-center pt-0">
                    <img id="previewImage" src="<?= $avatarDisplay ?>" 
                        class="rounded-circle mb-3" 
                        style="width: 120px; height: 120px; object-fit: cover; border: 4px solid #f0f0f0;">

                    <p class="text-muted small">Tải lên ảnh mới (JPG, PNG)</p>
                    <input class="form-control" type="file" name="avatar" accept="image/*" required onchange="previewFile(this)">
                </div>

                <div class="modal-footer border-0 justify-content-center pb-4">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn text-white px-4" style="background: #a582e6;">Lưu thay đổi</button>
                </div>

            </div>
        </form>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src = "/onlinecourse/assets/js/students.js"></script>
