<?php
require_once __DIR__ . '/../../../config/Database.php';
require_once __DIR__ . '/../../../models/Course.php';
require_once __DIR__ . '/../../../models/Lesson.php';
require_once __DIR__ . '/../../../models/User.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header("Location: /onlinecourse/index.php?controller=auth&action=login");
    exit;
}


$courseId = intval($_GET['course_id'] ?? 0);

// Khởi tạo model Course
$courseModel = new Course();
$course = $courseModel->getById($courseId);

$current_action = 'lesson_manage';


// Lấy danh sách bài học của khóa học
$lessonModel = new Lesson();
$lessons = $lessonModel->getByCourseId($courseId); 

// Include Header
require_once __DIR__ . '/../../layouts/header_teacher.php'; 
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/onlinecourse/assets/css/teacher.css?v=<?= time() ?>">
    <style>
        :root {
            --bg-purple-light: #F3E5F5;
            --btn-green: #1AD03F;
            --text-dark: #333;
            --circle-black: #000;
        }

        body {
            background-color: var(--bg-purple-light);
            padding-top: 80px;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
    </style>
</head>
<body>

<div class="manage-container">
    <div class="container">
        <div class="d-flex justify-content-between align-items-start mb-4">
            <div>
                <h2 class="page-title">Quản lý bài học</h2>
                <div class="course-subtitle">Khóa học: <?= htmlspecialchars($course['title']) ?></div>
            </div>
            
            <button class="btn btn-add-new" data-bs-toggle="modal" data-bs-target="#lessonModal" onclick="prepareModal('add')">
                <i class="fas fa-plus"></i> Thêm bài học mới
            </button>
        </div>
        
        <div class="lesson-list" id="accordionLessons">
            <?php if (count($lessons) > 0): ?>
                <?php foreach ($lessons as $index => $lesson): ?>
                    <div class="lesson-item">
                        <div class="lesson-header collapsed" 
                     data-bs-toggle="collapse" 
                     data-bs-target="#collapseLesson<?= $lesson['id'] ?>" 
                     aria-expanded="false">
                            
                            <div class="d-flex align-items-center flex-grow-1">
                                <div class="lesson-number"><?= $index + 1 ?></div>
                                <div class="lesson-title">
                                    <?= htmlspecialchars($lesson['title']) ?>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center">
                                <i class="fas fa-chevron-down chevron-icon"></i>
                                <div class="action-group" onclick="event.stopPropagation()">
                                    <button class="action-btn btn-edit-icon" onclick='prepareModal("edit", <?= json_encode($lesson) ?>)' title="Sửa bài học">
                                        <i class="fa-regular fa-pen-to-square fa-lg"></i>
                                    </button>
                                    <button class="action-btn btn-delete-icon" onclick="deleteLesson(<?= $lesson['id'] ?>)" title="Xóa bài học">
                                        <i class="fa-solid fa-trash fa-lg"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div id="collapseLesson<?= $lesson['id'] ?>" class="collapse" data-bs-parent="#accordionLessons">
                            <div class="lesson-details-body">
                                <div class="row align-items-stretch"> 
                                    <div class="col-md-8">
                                        <div class="info-box desc-box">
                                            <div class="info-box-title">
                                                <i class="fas fa-align-left"></i> Mô tả nội dung
                                            </div>
                                            <p class="mb-0" style="line-height: 1.6; white-space: pre-line;">
                                                <?= !empty($lesson['content']) ? htmlspecialchars($lesson['content']) : '<span class="text-muted fst-italic">Chưa có mô tả</span>' ?>
                                            </p>
                                        </div>

                                        <div class="info-box doc-box mb-0" 
                                             onclick='prepareMaterialModal(<?= $lesson['id'] ?>, <?= json_encode($lesson['material'] ?? null) ?>)'>
                                            <div class="info-box-title">
                                                <i class="fas fa-paperclip"></i> Tài liệu học tập
                                                <span class="badge bg-warning text-dark ms-auto" style="font-weight: normal; font-size: 0.7rem;">Click để nhập chi tiết</span>
                                            </div>
                                            
                                            <?php if (!empty($lesson['material'])): ?>
                                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                                    <div class="text-truncate" style="max-width: 60%;">
                                                        <span class="fst-italic small fw-bold">
                                                            <i class="far fa-file-pdf me-1"></i> <?= htmlspecialchars($lesson['material']['filename']) ?>
                                                        </span>
                                                    </div>
                                                    <div class="d-flex gap-2">
                                                        <span class="text-muted small align-self-center">
                                                            <?= htmlspecialchars($lesson['material']['file_type']) ?>
                                                        </span>
                                                        <span class="btn btn-sm btn-outline-primary" style="border-radius: 6px;">
                                                            <i class="fas fa-edit"></i> Sửa
                                                        </span>
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <div class="d-flex flex-column align-items-center justify-content-center py-3" style="opacity: 0.7;">
                                                    <i class="fas fa-file-invoice fa-2x mb-2 text-primary"></i>
                                                    <div class="fw-bold text-primary" style ="font-size: 1rem";>Chưa có tài liệu</div>
                                                    <small class="text-muted"style ="font-size: 1rem";>Nhấn để điền thông tin</small>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="info-box video-box">
                                            <div class="info-box-title">
                                                <i class="fab fa-youtube"></i> Video bài giảng
                                            </div>
                                            <?php if (!empty($lesson['video_url'])): ?>
                                                <a href="<?= htmlspecialchars($lesson['video_url']) ?>" target="_blank" class="video-link-card">
                                                    <i class="fab fa-youtube icon-youtube"></i>
                                                    <div style="flex-grow:1; min-width:0;">
                                                        <div class="fw-bold text-truncate" style="font-size: 1rem;">Xem Video</div>
                                                        <div class="small text-muted text-truncate" style="font-size: 1rem;">Click mở tab mới</div>
                                                    </div>
                                                    <i class="fas fa-external-link-alt text-muted small"></i>
                                                </a>
                                            <?php else: ?>
                                                <div class="d-flex flex-column align-items-center justify-content-center h-75 text-muted" style="opacity: 0.7;">
                                                    <i class="fas fa-video-slash fa-2x mb-2"></i>
                                                    <div>Chưa có video</div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center py-5">
                    <img src="https://cdn-icons-png.flaticon.com/512/7486/7486747.png" alt="Empty" width="80" style="opacity: 0.3;">
                    <p class="text-muted mt-3 fs-5">Chưa có bài học nào trong khóa học này.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<form id="deleteForm" method="POST" action="" style="display:none;">
    <input type="hidden" name="action_type" value="delete">
    <input type="hidden" name="lesson_id" id="delete_lesson_id" value="">
</form>

<div class="modal fade" id="lessonModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-custom">
            <form method="POST" action="">
                <div class="modal-header modal-header-custom">
                    <h5 class="modal-title modal-title-custom" id="modalTitle">Form Thêm bài học</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body modal-body-custom">
                    <input type="hidden" name="action_type" id="action_type" value="add">
                    <input type="hidden" name="lesson_id" id="lesson_id" value="">

                    <div class="mb-3">
                        <label class="form-label-custom">Tên bài học</label>
                        <input type="text" class="form-control form-control-custom" name="title" id="lesson_title" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label-custom">Mô tả</label>
                        <textarea class="form-control form-control-custom" name="content" id="lesson_content" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label-custom">Video (URL)</label>
                        <input type="text" class="form-control form-control-custom" name="video_url" id="lesson_video">
                    </div>
                    <div class="mb-3">
                        <label class="form-label-custom">Thứ tự (Order)</label>
                        <input type="number" class="form-control form-control-custom" name="order" id="lesson_order" value="0">
                    </div>
                </div>
                <div class="modal-footer modal-footer-custom">
                    <button type="button" class="btn btn-modal-cancel" data-bs-dismiss="modal">Hủy bỏ</button>
                    <button type="submit" class="btn btn-modal-add" id="btnSubmit">Thêm</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="materialModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-custom">
            <form action="index.php?controller=material&action=upload" method="POST" enctype="multipart/form-data">
                <div class="modal-header modal-header-custom">
                    <h5 class="modal-title modal-title-custom" id="materialModalTitle">Tài liệu học tập</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body modal-body-custom">
                    <input type="hidden" name="course_id" value="<?= $courseId ?>">
                    <input type="hidden" name="lesson_id" id="mat_lesson_id">
                    <input type="hidden" name="material_id" id="mat_id">
                    <input type="hidden" name="uploaded_at" id="mat_uploaded_at">

                    <div class="mb-3">
                        <label class="form-label-custom">Tên file</label>
                        <input type="text" class="form-control form-control-custom" name="filename" id="mat_filename">
                    </div>

                    <div class="mb-3">
                        <label class="form-label-custom">Đường dẫn file (File Path)</label>
                        <input type="text" class="form-control form-control-custom" name="file_path" id="mat_file_path">
                        <label class="form-label-custom small text-muted">Hoặc tải file lên:</label>
                        <input type="file" class="form-control form-control-custom" name="document_file">
                    </div>

                    <div class="mb-3">
                        <label class="form-label-custom">Loại file</label>
                        <input type="text" class="form-control form-control-custom" name="file_type" id="mat_file_type">
                    </div>
                </div>

                <div class="modal-footer modal-footer-custom">
                    <button type="button" class="btn btn-modal-cancel" data-bs-dismiss="modal">Hủy bỏ</button>
                    <button type="submit" class="btn btn-modal-add">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="flashModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
        <div class="modal-content border-0" style="background-color: #BA68C8; color: white; border-radius: 12px;">
            <div class="modal-body text-center py-3">
                <i class="fas fa-check-circle fa-lg me-2"></i>
                <span id="flashMessageText" style="font-weight: 600;"></span>
            </div>
        </div>
    </div>
</div>
<?php 
    // Nhúng Modal quản lý User (Thông tin tài khoản) vào đây để nó nằm trong cấu trúc trang
    require_once 'views/users/manage.php'; 
    
    // Nhúng Modal Upload teacher
    require_once 'views/instructor/materials/upload_teacher.php'; 
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Modal Bài Học
    function prepareModal(type, data = null) {
        const modalTitle = document.getElementById('modalTitle');
        const actionType = document.getElementById('action_type');
        const lessonId = document.getElementById('lesson_id');
        const titleInput = document.getElementById('lesson_title');
        const videoInput = document.getElementById('lesson_video');
        const orderInput = document.getElementById('lesson_order');
        const contentInput = document.getElementById('lesson_content');
        const btnSubmit = document.getElementById('btnSubmit');

        if (type === 'add') {
            modalTitle.innerText = "Form Thêm bài học";
            btnSubmit.innerText = "Thêm";
            actionType.value = "add";
            lessonId.value = "";
            titleInput.value = "";
            videoInput.value = "";
            orderInput.value = ""; 
            contentInput.value = "";
        } else if (type === 'edit' && data) {
            modalTitle.innerText = "Cập nhật bài học";
            btnSubmit.innerText = "Lưu";
            actionType.value = "edit";
            lessonId.value = data.id;
            titleInput.value = data.title;
            videoInput.value = data.video_url;
            orderInput.value = data.order;
            contentInput.value = data.content;
            
            const myModal = new bootstrap.Modal(document.getElementById('lessonModal'));
            myModal.show();
        }
    }

    // Modal Tài Liệu (MỚI)
    function prepareMaterialModal(lessonId, materialData) {
        // Reset form
        document.getElementById('mat_id').value = '';
        document.getElementById('mat_filename').value = '';
        document.getElementById('mat_file_path').value = '';
        document.getElementById('mat_file_type').value = '';
        document.getElementById('mat_uploaded_at').value = '';

        // Set Lesson ID
        document.getElementById('mat_lesson_id').value = lessonId;

        // Nếu đã có dữ liệu material thì điền vào form
        if (materialData) {
            document.getElementById('mat_id').value = materialData.id || '';
            document.getElementById('mat_filename').value = materialData.filename || '';
            document.getElementById('mat_file_path').value = materialData.file_path || '';
            document.getElementById('mat_file_type').value = materialData.file_type || '';
            document.getElementById('mat_uploaded_at').value = materialData.uploaded_at || '';
        }

        const matModal = new bootstrap.Modal(document.getElementById('materialModal'));
        matModal.show();
    }

    function deleteLesson(id) {
        if (confirm("Bạn có chắc chắn muốn xóa bài học này?")) {
            document.getElementById('delete_lesson_id').value = id;
            document.getElementById('deleteForm').submit();
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        <?php if (!empty($_SESSION['flash_message'])): ?>
            const flashMessage = "<?= addslashes($_SESSION['flash_message']) ?>";
            document.getElementById('flashMessageText').innerText = flashMessage;
            const flashModal = new bootstrap.Modal(document.getElementById('flashModal'));
            flashModal.show();
            setTimeout(() => { flashModal.hide(); }, 2500);
        <?php unset($_SESSION['flash_message']); endif; ?>
    });
    
</script>

</body>
</html>
