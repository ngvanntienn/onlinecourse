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

// kiểm tra dữ liệu session 
$displayName = $_SESSION['fullname'] ?? 'Giảng viên'; 
// đường dẫn ảnh avatar mặc định nếu chưa có
$userAvatar  = !empty($_SESSION['avatar']) ? '/onlinecourse/assets/avatars/' . $_SESSION['avatar'] : 'https://t4.ftcdn.net/jpg/05/49/98/39/360_F_549983970_bRCkYfk0P6PP5fveM072efagRg8JuC8e.jpg';
$courseModel = new Course();
$courses = $courseModel->getAll();
$current_action = 'course_manage';
require_once __DIR__ . '/../../layouts/header_teacher.php'; 
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý khóa học - EasyStudy</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    
</head>
<body>
    <div class="container" style="margin-top: 100px; padding-bottom: 50px;">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold m-0" style="font-size: 2rem;">Danh sách khóa học</h4>
        </div>
        <div class="toolbar-container">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Tìm kiếm khóa học...">
                <i class="fas fa-filter" 
                   data-bs-toggle="modal" 
                   data-bs-target="#filterModal" 
                   style="cursor: pointer;" 
                   title="Mở bộ lọc">
                </i>
            </div>

            <button class="btn-add-course" data-bs-toggle="modal" data-bs-target="#addModal">
                <i class="fas fa-plus"></i> Tạo khóa học mới
            </button>
        </div>

        <div class="table-container">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="col-id">id</th>
                        <th style="text-align: left;">Tên khóa học</th>
                        <th style="text-align: left;">Mô tả</th>
                        <th>Học phí</th>
                        <th>Thời lượng</th>
                        <th>Trình độ</th>
                        <th>Ảnh</th>
                        <th>Ngày tạo</th>
                        <th>Hành động</th> </tr>
                </thead>
                <tbody>
                    <?php if (!empty($courses)): ?>
                        <?php foreach ($courses as $course): ?>
                        <tr>
                            <td class="col-id"style="font-size: 1.1rem;"><?= $course['id'] ?></td>
                            <td class="fw-bold"style="font-size: 1.1rem;"><?= htmlspecialchars($course['title']) ?></td>
                            <td style="font-size: 1.1rem;"><?= htmlspecialchars(mb_strimwidth($course['description'], 0, 50, "...")) ?></td>
                            <td style="font-size: 1.1rem;"><?= number_format($course['price'], 0, ',', '.') ?> đ</td>
                            <td style="font-size: 1.1rem;"><?= $course['duration_weeks'] ?> tuần</td>
                            <td style="font-size: 1.1rem;"><?= $course['level'] ?></td>
                            <td class="col-img">
                                <?php if($course['image']): ?>
                                    <img src="<?= $course['image'] ?>" alt="Course Img">
                                <?php else: ?>
                                    <img src="https://via.placeholder.com/60x40" alt="No Img">
                                <?php endif; ?>
                            </td>
                            <td style="font-size: 1.1rem;"><?= date('d/m/Y', strtotime($course['created_at'])) ?></td>
                            <td class="col-action">
                                <button class="action-btn btn-edit" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editModal"
                                    data-id="<?= $course['id'] ?>"
                                    data-title="<?= htmlspecialchars($course['title']) ?>"
                                    data-desc="<?= htmlspecialchars($course['description']) ?>"
                                    data-price="<?= $course['price'] ?>"
                                    data-duration="<?= $course['duration_weeks'] ?>"
                                    data-level="<?= $course['level'] ?>"
                                    data-image="<?= htmlspecialchars($course['image']) ?>"
                                >
                                    <i class="fas fa-edit"></i>
                                </button>

                                <a href="/onlinecourse/index.php?controller=course&action=delete&id=<?= $course['id'] ?>" 
                                   class="action-btn" 
                                   onclick="return confirm('Bạn có chắc muốn xóa?')">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="10" class="text-center">Chưa có khóa học nào.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>               
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-edit').forEach(btn => {
            btn.addEventListener('click', () => {
                // hiển thị dữ liệu
                const id = btn.dataset.id;
                const title = btn.dataset.title;
                const desc = btn.dataset.desc;
                const price = btn.dataset.price;
                const duration = btn.dataset.duration;
                const level = btn.dataset.level;
                const image = btn.dataset.image;

                // gán dữ liệu
                document.getElementById('edit-id').value = id;
                document.getElementById('edit-title').value = title;
                document.getElementById('edit-desc').value = desc;
                document.getElementById('edit-price').value = price;
                
                if(document.getElementById('edit-duration')) 
                    document.getElementById('edit-duration').value = duration;
                
                if(document.getElementById('edit-level')) 
                    document.getElementById('edit-level').value = level;
                
                if(document.getElementById('edit-image')) 
                    document.getElementById('edit-image').value = image;
            });
        });
    });
</script>
</body>
</html>
<?php require_once __DIR__ . '/../materials/upload_teacher.php'; ?>
