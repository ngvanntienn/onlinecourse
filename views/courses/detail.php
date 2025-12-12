<?php

require_once 'views/layouts/header_students.php'; 
?>
<style>
    .btn-register-main {
        background: #933ec1ff; 
        color: white;
        border: none;
        border-radius: 10px;
        padding: 15px;
        font-size: 1.3rem;
        font-weight: 700;
        transition: all 0.3s;
        box-shadow: 0 6px 20px rgba(49, 49, 49, 0.4);
    }

    .btn-register-main:hover {
        background: #000000ff;
        color: white;
        transform: translateY(-3px);
    }

    .btn-try-free {
        background: #ffffffff;
        border: 2px solid #933ec1ff;
        color: #000;
        font-weight: 600;
        font-size: 1.2rem;
        padding: 12px;
        border-radius: 10px;
        transition: all 0.3s;
    }

    .btn-try-free:hover {
        background: #e0a800;
        transform: translateY(-2px);
    }

    /* Sidebar & overview */
    .sidebar-sticky h6, .sidebar-sticky .fw-bold {
        font-size: 1.15rem;
        font-weight: 600;
    }

    .sidebar-sticky small {
        font-size: 1rem;
    }

    h3, h5, h6 {
        font-weight: 700;
    }

    p, li {
        font-size: 1.2rem;
        line-height: 1.6;
    }

    /* List icons */
    .fa-check-circle, .fa-star {
        font-size: 1.1rem;
    }

    /* Modal */
    #confirmEnrollModal .modal-content {
        border-radius: 20px;
    }

    #confirmEnrollModal h4 {
        font-size: 1.5rem;
        font-weight: 700;
    }

    #confirmEnrollModal .btn {
        font-size: 1.15rem;
        padding: 10px 20px;
    }
</style>

<div class="hero-wrapper-full" style="background-image: linear-gradient(135deg,#00000088,#00000088), url('<?= $course['banner_img'] ?>'); background-size: cover; background-position: center;">
    <div class="container">
        <div class="row align-items-center position-relative">
            <div class="col-md-7 text-white z-index-2">
               
                <h1 class="hero-title-main scroll-explore" style="cursor:pointer;"><?= $course['title'] ?></h1>
                <p class="hero-teacher mt-3">Giáo viên: <strong><?= $course['teacher_name'] ?></strong></p>
            </div>
            <div class="col-md-5 d-none d-md-block">
                <div class="hero-image-wrapper">
                    <img src="<?= $course['banner_img'] ?>" alt="Course Banner" class="hero-banner-card floating-banner">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row">
        <div class="col-lg-8 pe-lg-5">
            <h3 class="fw-bold mb-4 text-dark">Tổng quan</h3>

            <div class="mb-5">
                <h5 class="fw-bold mb-3 d-flex align-items-center text-dark"><i class="fas fa-book me-2"></i> Giới thiệu khóa học:</h5>
                <p class="text-secondary lh-base" style="font-size: 1.5rem;"><?= $course['description'] ?></p>
            </div>

            <div class="mb-5">
                <h6 class="fw-bold mb-3 text-dark">Bạn sẽ tiếp cận:</h6>
                <ul class="list-unstyled d-flex flex-column gap-2">
                    <?php if(isset($course['learn_goals']) && is_array($course['learn_goals'])): ?>
                        <?php foreach($course['learn_goals'] as $goal): ?>
                            <li class="d-flex align-items-start">
                                <i class="far fa-check-circle text-success mt-1 me-2"></i>
                                <span class="text-secondary"><?= $goal ?></span>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>

            <div class="mb-5">
                <h6 class="fw-bold mb-3 d-flex align-items-center text-dark"><i class="fas fa-star text-warning me-2"></i> Hoàn thành khóa học, bạn sẽ:</h6>
                <ul class="list-unstyled d-flex flex-column gap-2">
                    <?php if(isset($course['outcomes']) && is_array($course['outcomes'])): ?>
                        <?php foreach($course['outcomes'] as $outcome): ?>
                            <li class="d-flex align-items-start">
                                <span class="me-2 fw-bold text-dark">•</span>
                                <span class="text-secondary"><?= $outcome ?></span>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="sidebar-sticky" style="top: 100px;">
                <div class="mb-3 d-flex align-items-center text-dark">
                    <i class="far fa-clock me-2 fs-5"></i>
                    <span class="fw-bold">Thời lượng: <?= $course['duration_weeks'] ?? '8' ?> tuần / 12 chương</span>
                </div>

                <?php if (isset($course['is_enrolled']) && $course['is_enrolled']): ?>
                    <a href="/onlinecourse/index.php?controller=lesson&action=view&course_id=<?= $course['id'] ?>" class="btn btn-success w-100 mb-3 py-3 fw-bold text-white text-decoration-none d-block text-center" style="border-radius: 50px; font-size: 1.3rem; box-shadow: 0 6px 20px rgba(25, 135, 84, 0.4);">
                        <i class="fas fa-play-circle me-2"></i> TIẾP TỤC HỌC
                    </a>
                <?php else: ?>
                    <button class="btn btn-register-main w-100 mb-3"
                        data-bs-toggle="modal"
                        data-bs-target="#confirmEnrollModal"
                        data-id="<?= $course['id'] ?>"
                        data-title="<?= htmlspecialchars($course['title']) ?>"
                        data-price="<?= $course['price_display'] ?>">
                        ĐĂNG KÝ NGAY <br>
                        <span class="fs-5"><?= $course['price_display'] ?></span>
                    </button>
                <?php endif; ?>

                <button class="btn btn-try-free w-100 mb-4">Xem thử (Bài học miễn phí)</button>

                <div class="mb-4">
                    <h6 class="fw-bold mb-3"><i class="fas fa-bolt me-2"></i> Quyền lợi học viên</h6>
                    <ul class="list-unstyled text-secondary small">
                        <li>• Học mọi lúc, mọi nơi</li>
                        <li>• Hỗ trợ 1-1 khi cần</li>
                        <li>• Bài tập thực hành & Project</li>
                    </ul>
                </div>

                <div class="d-flex align-items-start bg-light p-3 rounded-3">
                    <img src="<?= $course['teacher_avatar'] ?? 'https://via.placeholder.com/50' ?>" class="rounded-circle me-3" style="width:50px; height:50px; object-fit:cover;">
                    <div>
                        <h6 class="fw-bold mb-1 text-uppercase text-dark"><?= $course['teacher_name'] ?></h6>
                        <?php if(isset($course['teacher_bio']) && is_array($course['teacher_bio'])): ?>
                            <?php foreach($course['teacher_bio'] as $bio): ?>
                                <small class="text-secondary d-block lh-sm">• <?= $bio ?></small>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmEnrollModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Xác nhận đăng ký</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Bạn muốn đăng ký khóa học: <b id="modalCourseTitle" class="text-primary"></b>?</p>
                <p class="fs-5">Học phí: <span id="modalCoursePrice" class="text-danger fw-bold"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <a href="#" id="btnConfirmEnroll" class="btn btn-danger">Thanh toán & Vào học</a>
            </div>
        </div>
    </div>
</div>

<script>
    window.otherCourses = <?= json_encode($courses_data ?? []) ?>;
    window.currentCourseId = "<?= $course['id'] ?>";

    document.addEventListener('DOMContentLoaded', function () {
        var confirmModal = document.getElementById('confirmEnrollModal');
        if (!confirmModal) return;

        confirmModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var courseId    = button.getAttribute('data-id');
            var courseTitle = button.getAttribute('data-title');
            var coursePrice = button.getAttribute('data-price');

            confirmModal.querySelector('#modalCourseTitle').textContent = courseTitle;
            confirmModal.querySelector('#modalCoursePrice').textContent = coursePrice;
            confirmModal.querySelector('#btnConfirmEnroll').href = '/onlinecourse/index.php?controller=enrollment&action=create&course_id=' + courseId;
        });
    });
</script>

<script src="/onlinecourse/assets/js/detail.js?v=<?= time() ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<?php 
require_once __DIR__ . '/../users/manage.php';

require_once 'views/layouts/footer.php'; 
require_once __DIR__ . '/../instructor/materials/upload_student.php';
?>
