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

$displayName = $_SESSION['fullname'] ?? 'Giảng viên'; 
// đường dẫn ảnh avatar mặc định nếu chưa có
$userAvatar  = !empty($_SESSION['avatar']) ? '/onlinecourse/assets/avatars/' . $_SESSION['avatar'] : 'https://t4.ftcdn.net/jpg/05/49/98/39/360_F_549983970_bRCkYfk0P6PP5fveM072efagRg8JuC8e.jpg';
$courseModel = new Course();
$courses = $courseModel->getAll();
$current_action = 'course_manage';
require_once __DIR__ . '../create.php';
require_once __DIR__ . '../edit.php';
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
    
    <style>
        :root {
            --primary-bg: #f3effb;
            --header-bg: #fff;
            --purple-text: #5e2d87;
        }

        body {
            background-color: var(--primary-bg);
        }
        
        .toolbar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            font-size: 1.2rem;
        }
        .search-box {
            position: relative;
            background: white;
            border-radius: 8px;
            padding: 8px 15px;
            width: 400px;
            display: flex;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.02);
        }
        .search-box input {
            border: none;
            outline: none;
            width: 100%;
            padding-left: 10px;
            color: #666;
        }
        .search-box i.fa-search { 
            color: #aaa; 
        }
        .search-box i.fa-filter { 
            color: #666; 
            margin-left: 10px; 
            cursor: pointer;

        }

        /* add course */
        .btn-add-course {
            background-color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            color: #333;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }

        .btn-add-course:hover {
            background-color: #fafafa;
            transform: translateY(-1px);
        }

        .table-container {
            background: white;
            border-radius: 12px;
            padding: 0;
            overflow-x: auto; 
            box-shadow: 0 4px 20px rgba(0,0,0,0.05); 
        }
                
        .table {
            margin-bottom: 0;
            width: 100%;
        }
        .table thead th {
            background-color: #f8f9fa;
            color: #444;
            font-weight: 700;
            font-size: 1.1rem;
            border-bottom: 2px solid #dee2e6;
            padding: 20px 15px; 
            text-align: left;
            white-space: nowrap; 
            vertical-align: middle;
            
        }
       .table tbody td {
            vertical-align: middle;
            padding: 20px 15px; 
            font-size: 1rem;
            color: #333;
            border-bottom: 1px solid #f0f0f0;
            
        }

        .col-id { 
            width: 60px; 
            font-weight: bold;
            color: #888;
        }

        .col-img img { 
            width: 60px; 
            height: 50px; 
            object-fit: cover; 
            border-radius: 4px; }
        .col-action { 
            text-align: center; 
            width: 100px; 
        }
        
        .action-btn {
            border: 1px solid #ddd;
            background: white;
            width: 30px;
            height: 30px;
            border-radius: 4px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #555;
            margin: 0 2px;
            transition: all 0.2s;
            font-size: 1.1rem;
        }
        .action-btn:hover { 
            background: #f0f0f0; 
        }
        .modal-content {
            border-radius: 15px;
            border: none;
            overflow: hidden;
        }
        .modal-header {
            background-color: #f3effb; 
            border-bottom: none;
            padding: 20px 30px;
        }

        .modal-title {
            font-weight: 700;
            font-size: 1.5rem;
            color: #000;
        }
        .modal-body {
            background-color: #f3effb;
            padding: 10px 30px 30px 30px;
        }
        .modal-footer {
            background-color: #f3effb;
            border-top: none;
            padding: 0 30px 30px 30px;
            justify-content: flex-end;
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 5px;
            color: #333;
            font-size: 1.2rem;
        }
        .form-control {
            border-radius: 6px;
            border: 1px solid #e0e0e0;
            padding: 10px;
            background-color: white;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #aaa;
        }
        .btn-modal-cancel {
            background-color: white;
            color: #333;
            border: none;
            padding: 10px 25px;
            border-radius: 6px;
            font-weight: 600;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        .btn-modal-add {
            background-color: #1ed760; 
            color: white;
            border: none;
            padding: 10px 30px;
            border-radius: 6px;
            font-weight: 600;
            margin-left: 10px;
        }
        .btn-modal-save {
            background-color: #4da6ff; 
            border: none;
            padding: 10px 30px;
            border-radius: 6px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 5px;
        }
    </style>
</head>
<body>
    <div class="container" style="margin-top: 100px; padding-bottom: 50px;">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold m-0" style="font-size: 2rem;">Danh sách khóa học</h4>
        </div>
        <div class="toolbar-container">
        

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

    <div class="modal fade" id="filterModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-filter me-2 text-primary"></i>Bộ lọc tìm kiếm
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="GET"> <div class="modal-body">
                    
                    <div class="mb-3">
                        <label class="form-label">Danh mục</label>
                        <select name="category_id" class="form-select form-control">
                            <option value="">-- Tất cả danh mục --</option>
                            <option value="1">Lập trình Web</option>
                            <option value="2">Thiết kế Đồ họa</option>
                            <option value="3">Khoa học Dữ liệu</option>
                            <option value="4">Ngoại ngữ</option>
                            <option value="5">Marketing</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Trình độ</label>
                        <select name="level" class="form-select form-control">
                            <option value="">-- Tất cả trình độ --</option>
                            <option value="Beginner">Cơ bản (Beginner)</option>
                            <option value="Intermediate">Trung bình (Intermediate)</option>
                            <option value="Advanced">Nâng cao (Advanced)</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Khoảng giá (VNĐ)</label>
                        <div class="d-flex gap-2">
                            <input type="number" name="min_price" class="form-control" placeholder="Từ (0đ)">
                            <span class="align-self-center">-</span>
                            <input type="number" name="max_price" class="form-control" placeholder="Đến">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Sắp xếp theo</label>
                        <div class="d-flex gap-3 mt-1">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sort" id="sortNew" value="newest" checked>
                                <label class="form-check-label" for="sortNew">Mới nhất</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sort" id="sortPriceAsc" value="price_asc">
                                <label class="form-check-label" for="sortPriceAsc">Giá tăng dần</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sort" id="sortPriceDesc" value="price_desc">
                                <label class="form-check-label" for="sortPriceDesc">Giá giảm dần</label>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn-modal-save" style="background-color: #6f42c1;">
                        <i class="fas fa-check me-1"></i> Áp dụng
                    </button>
                </div>
            </form>
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
<?php require_once '../users/manage.php'; 
require_once __DIR__ . '/../materials/upload_teacher.php'; ?>
