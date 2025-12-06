<?php
session_start();
// 1. Cấu hình Tab Active
$current_page = 'course'; 

// Giả lập dữ liệu từ Database (Thay phần này bằng câu lệnh SQL SELECT của bạn)
$courses = [
    [
        'id' => 1,
        'name' => 'Khóa học Lập trình Python',
        'description' => 'Khóa học giới thiệu Python cho người mới bắt đầu.',
        'price' => 3000000,
        'duration' => '3 tuần',
        'level' => 'Cơ bản',
        'image' => 'https://upload.wikimedia.org/wikipedia/commons/c/c3/Python-logo-notext.svg',
        'created_at' => '21/10/2025'
    ],
    [
        'id' => 2,
        'name' => 'Khóa học thiết kế UI/UX',
        'description' => 'Học tư duy thiết kế, wireframe, prototype và Figma.',
        'price' => 4000000,
        'duration' => '6 tuần',
        'level' => 'Trung cấp',
        'image' => 'https://cdn-icons-png.flaticon.com/512/5968/5968705.png',
        'created_at' => '22/10/2025'
    ],
    [
        'id' => 3,
        'name' => 'Khóa học HTML/CSS/Javascript',
        'description' => 'Xây dựng trang web từ cơ bản đến nâng cao.',
        'price' => 4000000,
        'duration' => '7 tuần',
        'level' => 'Trung cấp',
        'image' => 'https://cdn-icons-png.flaticon.com/512/732/732212.png',
        'created_at' => '15/11/2025'
    ]
];

// Gọi Header (Giả sử bạn đã có file này như các phần trước)
require_once '../../layouts/header_teacher.php';
?>

<style>
    body {
        background-color: #F8F5FF; /* Màu nền tím nhạt toàn trang */
    }

    /* Tiêu đề và thanh công cụ */
    .page-header-row {
        margin-top: 30px;
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .page-title {
        font-weight: 700;
        font-size: 1.5rem;
        color: #333;
    }

    /* Ô tìm kiếm */
    .search-box {
        position: relative;
        max-width: 400px;
        width: 100%;
    }
    .search-box input {
        border-radius: 8px;
        padding-right: 40px; /* Chừa chỗ cho icon filter */
        border: 1px solid #ddd;
    }
    .search-box .filter-icon {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #666;
        cursor: pointer;
    }

    /* Nút Thêm khóa học */
    .btn-add-course {
        background-color: white;
        color: #333;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-weight: 600;
        padding: 8px 20px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        transition: all 0.3s;
    }
    .btn-add-course:hover {
        background-color: #f0f0f0;
    }

    /* Bảng dữ liệu */
    .table-container {
        background: white;
        border-radius: 0; /* Bo góc bằng 0 như ảnh hoặc chỉnh nhẹ */
        /* Border xanh bao quanh bảng như trong ảnh */
        border: 2px solid #4D96FF; 
        padding: 0;
        overflow: hidden;
    }
    
    .custom-table thead th {
        background-color: #fff;
        border-bottom: 2px solid #eee;
        font-weight: 600;
        font-size: 0.85rem;
        color: #555;
        vertical-align: middle;
        text-align: center;
        padding: 15px;
    }
    
    .custom-table tbody td {
        vertical-align: middle;
        font-size: 0.9rem;
        color: #333;
        padding: 15px 10px;
        border-bottom: 1px solid #f2f2f2;
    }

    /* Hình ảnh thumbnail */
    .course-thumb {
        width: 40px;
        height: 40px;
        object-fit: contain;
    }

    /* Nút hành động trong bảng */
    .action-btn {
        border: 1px solid #ddd;
        background: white;
        color: #555;
        padding: 5px 10px;
        border-radius: 6px;
        margin: 0 2px;
        transition: 0.2s;
    }
    .action-btn:hover { background-color: #eee; }

    /* ========== STYLE CHO MODAL (POPUP) ========== */
    .modal-content {
        border-radius: 16px;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        background-color: #F3E8FF; /* Nền tím nhạt trong modal */
    }
    
    .modal-header {
        border-bottom: none;
        padding: 20px 30px 0 30px;
    }
    
    .modal-title {
        font-weight: 800;
        font-size: 1.4rem;
    }
    
    .modal-body {
        padding: 30px;
    }

    .form-group-custom {
        margin-bottom: 15px;
    }
    .form-group-custom label {
        font-weight: 600;
        margin-bottom: 5px;
        font-size: 0.9rem;
        color: #444;
    }
    .form-control-custom {
        border-radius: 6px;
        border: 1px solid #ddd;
        padding: 10px;
        background: white;
    }

    /* Nút trong Modal */
    .btn-cancel {
        background: white;
        border: 1px solid #ddd;
        color: #333;
        font-weight: 600;
        padding: 8px 25px;
        border-radius: 6px;
    }
    .btn-save-green {
        background: #1DBF73; /* Màu xanh lá nút Thêm */
        color: white;
        border: none;
        font-weight: 600;
        padding: 8px 25px;
        border-radius: 6px;
    }
    .btn-save-blue {
        background: #4D96FF; /* Màu xanh dương nút Lưu */
        color: white;
        border: none;
        font-weight: 600;
        padding: 8px 25px;
        border-radius: 6px;
    }
</style>

<div class="container pb-5">
    
    <div class="page-header-row">
        <div class="page-title">Danh sách khóa học</div>
        
        <div class="d-flex gap-3 align-items-center">
            <div class="search-box">
                <input type="text" class="form-control" placeholder="Tìm kiếm">
                <i class="fas fa-filter filter-icon"></i>
            </div>
            
            <button class="btn btn-add-course" data-bs-toggle="modal" data-bs-target="#addCourseModal">
                <i class="fas fa-plus me-1"></i> Tạo khóa học mới
            </button>
        </div>
    </div>

    <div class="table-container">
        <table class="table custom-table table-hover mb-0">
            <thead>
                <tr>
                    <th width="5%">id</th>
                    <th width="20%" class="text-start">Tên khóa học</th>
                    <th width="25%" class="text-start">Mô tả</th>
                    <th width="10%">Học phí</th>
                    <th width="10%">Thời lượng</th>
                    <th width="10%">Trình độ</th>
                    <th width="5%">Ảnh</th>
                    <th width="10%">Ngày tạo</th>
                    <th width="5%"></th> </tr>
            </thead>
            <tbody>
                <?php foreach ($courses as $course): ?>
                <tr>
                    <td class="text-center"><?= $course['id'] ?></td>
                    <td class="fw-bold"><?= $course['name'] ?></td>
                    <td class="text-muted small"><?= $course['description'] ?></td>
                    <td class="text-center"><?= number_format($course['price'], 0, ',', '.') ?></td>
                    <td class="text-center"><?= $course['duration'] ?></td>
                    <td class="text-center"><?= $course['level'] ?></td>
                    <td class="text-center">
                        <img src="<?= $course['image'] ?>" class="course-thumb" alt="icon">
                    </td>
                    <td class="text-center"><?= $course['created_at'] ?></td>
                    <td class="text-end">
                        <button class="action-btn text-danger"><i class="fas fa-trash-alt"></i></button>
                        
                        <button class="action-btn text-dark btn-edit-course" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editCourseModal"
                                data-id="<?= $course['id'] ?>"
                                data-name="<?= $course['name'] ?>"
                                data-desc="<?= $course['description'] ?>"
                                data-price="<?= $course['price'] ?>"
                                data-duration="<?= $course['duration'] ?>"
                                data-level="<?= $course['level'] ?>"
                                data-image="<?= $course['image'] ?>">
                            <i class="far fa-edit"></i>
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="addCourseModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Thêm khóa học</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="index.php?controller=course&action=store" method="POST" enctype="multipart/form-data">
                    <div class="form-group-custom">
                        <label>Tên khóa học</label>
                        <input type="text" name="name" class="form-control form-control-custom">
                    </div>
                    <div class="form-group-custom">
                        <label>Mô tả</label>
                        <textarea name="description" rows="3" class="form-control form-control-custom"></textarea>
                    </div>
                    <div class="form-group-custom">
                        <label>Học phí</label>
                        <input type="number" name="price" class="form-control form-control-custom">
                    </div>
                    <div class="form-group-custom">
                        <label>Thời lượng</label>
                        <input type="text" name="duration" class="form-control form-control-custom">
                    </div>
                    <div class="form-group-custom">
                        <label>Trình độ</label>
                        <input type="text" name="level" class="form-control form-control-custom">
                    </div>
                    <div class="form-group-custom">
                        <label>Ảnh minh họa</label>
                        <input type="file" name="image" class="form-control form-control-custom">
                    </div>
                    
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Hủy bỏ</button>
                        <button type="submit" class="btn btn-save-green">Thêm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editCourseModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Cập nhật khóa học</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="index.php?controller=course&action=update" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="edit-id">

                    <div class="form-group-custom">
                        <label>Tên khóa học</label>
                        <input type="text" name="name" id="edit-name" class="form-control form-control-custom">
                    </div>
                    <div class="form-group-custom">
                        <label>Mô tả</label>
                        <textarea name="description" id="edit-desc" rows="3" class="form-control form-control-custom"></textarea>
                    </div>
                    <div class="form-group-custom">
                        <label>Học phí</label>
                        <input type="number" name="price" id="edit-price" class="form-control form-control-custom">
                    </div>
                    <div class="form-group-custom">
                        <label>Thời lượng</label>
                        <input type="text" name="duration" id="edit-duration" class="form-control form-control-custom">
                    </div>
                    <div class="form-group-custom">
                        <label>Trình độ</label>
                        <input type="text" name="level" id="edit-level" class="form-control form-control-custom">
                    </div>
                    <div class="form-group-custom">
                        <label>Ảnh minh họa</label>
                        <input type="file" name="image" class="form-control form-control-custom">
                        <small class="text-muted" id="edit-image-label"></small>
                    </div>
                    
                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-save-blue">
                            <i class="fas fa-save me-1"></i> Lưu dữ liệu
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.btn-edit-course');
        
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Lấy dữ liệu từ data attribute của nút
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const desc = this.getAttribute('data-desc');
                const price = this.getAttribute('data-price');
                const duration = this.getAttribute('data-duration');
                const level = this.getAttribute('data-level');
                const image = this.getAttribute('data-image');

                // Điền vào các ô input trong Modal Edit
                document.getElementById('edit-id').value = id;
                document.getElementById('edit-name').value = name;
                document.getElementById('edit-desc').value = desc;
                document.getElementById('edit-price').value = price;
                document.getElementById('edit-duration').value = duration;
                document.getElementById('edit-level').value = level;
                // Ảnh thì chỉ hiển thị link tham khảo vì input file không set value được
                document.getElementById('edit-image-label').textContent = "Ảnh hiện tại: " + image;
            });
        });
    });
</script>