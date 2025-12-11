<?php
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../models/User.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header("Location: /onlinecourse/index.php?controller=auth&action=login");
    exit;
}
$course_id = isset($_GET['course_id']) ? intval($_GET['course_id']) : 0;

// THÊM ĐOẠN NÀY: Nếu không có ID khóa học, chặn luôn hoặc báo lỗi
if ($course_id <= 0) {
    echo "<div class='alert alert-danger container mt-5'>Không tìm thấy ID khóa học. Vui lòng chọn khóa học từ trang danh sách.</div>";
    require_once '../layouts/footer.php'; // Đảm bảo footer vẫn hiện nếu cần
    exit; // Dừng trang web tại đây
}

$displayName = $_SESSION['fullname'] ?? 'Giảng viên'; 
$userAvatar  = !empty($_SESSION['avatar'])
    ? '/onlinecourse/assets/avatars/' . $_SESSION['avatar']
    : 'https://via.placeholder.com/150';

$userModel = new User();

// 1. DANH SÁCH HỌC VIÊN TRONG LỚP
$my_students = []; 
// $my_students = $courseModel->getStudentsByCourse($course_id);

// 2. DANH SÁCH TẤT CẢ TÀI KHOẢN
$available_students = $userModel->getAllStudents();

require_once '../layouts/header_teacher.php';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Quản lý học viên - EasyStudy</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    /* 1. CẤU HÌNH CHUNG: Tăng cỡ chữ nền tảng */
    body { 
        background-color: #f3effb; 
        padding-top: 90px; 
        font-size: 1.1rem; /* Chữ to hơn mặc định (thường là 1rem) */
    }

    /* --- Toolbar --- */
    .toolbar-container {
        display: flex; justify-content: space-between; align-items: center;
        margin-bottom: 25px;
    }
    .search-box {
        background: #fff; padding: 10px 20px; /* To hơn */
        width: 400px; /* Rộng hơn */
        border-radius: 50px; 
        display: flex; align-items: center; border: 1px solid #e0e0e0;
        transition: 0.3s;
        box-shadow: 0 2px 5px rgba(0,0,0,0.02);
    }
    .search-box:focus-within { border-color: #d63384; box-shadow: 0 0 0 3px rgba(214, 51, 132, 0.1); }
    .search-box input { 
        border: none; outline: none; margin-left: 12px; width: 100%; 
        font-size: 1.1rem; /* Input chữ to */
    }

    /* NÚT THÊM: To và rõ hơn */
    .btn-add {
        background: #d63384; color: white; border: none; 
        padding: 12px 30px; /* Nút to hơn */
        font-size: 1.1rem;
        border-radius: 50px; font-weight: 600;
        box-shadow: 0 4px 10px rgba(214, 51, 132, 0.2);
        transition: all 0.3s;
    }
    .btn-add:hover { background-color: #c21b6c; transform: translateY(-2px); color: white; }

    /* --- Table Main --- */
    .table-container {
        background: #fff; border-radius: 16px;
        overflow: hidden; 
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        margin-bottom: 40px; 
    }
    .table { margin-bottom: 0; }
    
    /* Header bảng: Chữ to, thoáng */
    .table thead th {
        background: #fdf2f7; 
        font-size: 1.05rem; text-transform: uppercase;
        font-weight: 700; color: #a6447d; 
        border-bottom: 2px solid #f8d7da; 
        padding: 20px; /* Tăng khoảng cách */
    }
    
    /* Nội dung bảng: Chữ to, dòng cao */
    .table tbody td { 
        padding: 20px; /* Ô thoáng hơn */
        vertical-align: middle; 
        border-bottom: 1px solid #f2f2f2;
        font-size: 1.15rem; /* Chữ trong bảng to hơn */
    }
    .table tbody tr:last-child td { border-bottom: none; }

    /* Avatar trong bảng to hơn */
    .col-avatar img {
        width: 55px; height: 55px;
        border-radius: 50%; object-fit: cover; border: 3px solid #fff;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    /* Nút Xóa to hơn */
    .action-btn {
        width: 42px; height: 42px; border-radius: 10px;
        display: inline-flex; align-items: center; justify-content: center;
        transition: 0.2s; text-decoration: none; border: 1px solid #eee; color: #888;
        font-size: 1.2rem;
    }
    .action-btn:hover { background: #ffe6e9; border-color: #f5c2c7; color: #dc3545; }

    /* --- Modal List Design --- */
    .modal-content { border: none; border-radius: 20px; box-shadow: 0 10px 40px rgba(0,0,0,0.15); }
    .modal-header { padding: 25px 30px; background: #fff; }
    .modal-title { color: #d63384; font-size: 1.5rem; } /* Tiêu đề modal to */

    .modal-search {
        padding: 20px 30px; border-bottom: 1px solid #f0f0f0; background: #fff;
    }
    .modal-search input {
        border-radius: 10px; border: 1px solid #ddd; padding: 14px; font-size: 1.1rem;
    }

    .student-select-list {
        max-height: 500px; overflow-y: auto; padding: 10px 0;
    }
    
    /* Item trong danh sách Modal: Rộng và to */
    .user-list-item {
        padding: 16px 30px; /* Tăng padding */
        display: flex; align-items: center; justify-content: space-between;
        transition: background 0.2s;
        cursor: pointer;
    }
    .user-list-item:hover { background-color: #fff0f6; } 

    .user-info { display: flex; align-items: center; }
    .user-info img {
        width: 60px; height: 60px; /* Avatar modal to đùng */
        border-radius: 50%; object-fit: cover;
        margin-right: 20px; border: 1px solid #eee;
    }
    .user-text h6 { font-size: 1.25rem; margin: 0; font-weight: 700; color: #333; }
    .user-text span { font-size: 1rem; color: #777; }

    /* Nút thêm bé trong modal */
    .btn-add-mini {
        padding: 8px 20px; font-size: 1rem; border-radius: 30px;
        background: #fce4ec; color: #d63384; font-weight: 600;
        text-decoration: none; transition: 0.2s;
    }
    .btn-add-mini:hover { background: #d63384; color: white; }

</style>
</head>

<body>

<div class="container">

    <h2 class="fw-bold mb-4" style="color: #333; font-size: 2.2rem; letter-spacing: 0.5px;">Quản lý học viên</h2>

    <div class="toolbar-container">
        <div class="search-box">
            <i class="fas fa-search text-muted ms-2 fs-5"></i>
            <input type="text" placeholder="Tìm kiếm học viên trong lớp...">
        </div>

        <button class="btn-add" data-bs-toggle="modal" data-bs-target="#addModal">
            <i class="fas fa-plus me-2"></i>Thêm học viên
        </button>
    </div>

    <div class="table-container">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="ps-4">Thông tin học viên</th> 
                    <th>Email</th>
                    <th>Ngày thêm</th>
                    <th class="text-center">Hành động</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($my_students)): ?>
                    <?php foreach ($my_students as $s): ?>
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="col-avatar me-3">
                                        <img src="<?= $s['avatar'] ?: 'https://via.placeholder.com/60' ?>">
                                    </div>
                                    <span class="fw-bold text-dark fs-5"><?= htmlspecialchars($s['fullname']) ?></span>
                                </div>
                            </td>
                            <td class="text-secondary"><?= htmlspecialchars($s['email']) ?></td>
                            <td><span class="badge bg-light text-dark border p-2 fs-6"><?= date("d/m/Y", strtotime($s['created_at'])) ?></span></td>
                            <td class="text-center">
                                <a href="/onlinecourse/index.php?controller=student&action=delete&course_id=<?= $course_id ?>&student_id=<?= $s['id'] ?>
   class="action-btn"
   onclick="return confirm('Bạn có chắc muốn xóa học viên này?')">
   <i class="fas fa-trash"></i>
</a>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center py-5">
                            <div class="text-muted">
                                <i class="fas fa-clipboard-list fa-4x mb-4" style="opacity: 0.2;"></i><br>
                                <span class="fs-4">Danh sách lớp hiện đang trống.</span>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable"> <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-bold">Thêm thành viên</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-search">
                <input type="text" class="form-control" placeholder="Nhập tên hoặc email để tìm kiếm...">
            </div>

            <div class="modal-body p-0">
                <div class="student-select-list">
                    
                    <?php if(!empty($available_students)): ?>
                        <?php foreach ($available_students as $acc): ?>
                            <div class="user-list-item">
                                <div class="user-info">
                                    <img src="<?= $acc['avatar'] ?: 'https://via.placeholder.com/70' ?>" alt="Avatar">
                                    <div class="user-text">
                                        <h6><?= htmlspecialchars($acc['fullname']) ?></h6>
                                        <span><?= htmlspecialchars($acc['email']) ?></span>
                                    </div>
                                </div>
                                
                               <form method="POST" action="/onlinecourse/index.php?controller=student&action=add">
    <input type="hidden" name="course_id" value="<?= $course_id ?>">

    <input type="hidden" name="student_id" value="<?= $acc['id'] ?>">

    <button class="btn-add-mini">Thêm</button>
</form>

                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center py-5 text-muted fs-5">Không tìm thấy tài khoản nào.</div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>