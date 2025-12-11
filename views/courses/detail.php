<?php
require_once 'views/layouts/header_students.php'; 
?>
<style>
    .hero-image-wrapper {
        position: relative;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1;
        padding: 20px;
    }
    .hero-banner-card {
        width: 100%;
        max-width: 480px;
        height: auto;
        object-fit: cover;
        border-radius: 15px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
        border: 4px solid rgba(255, 255, 255, 0.2);
        background: #fff;
    }
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
        100% { transform: translateY(0px); }
    }
    .floating-banner {
        animation: float 4s ease-in-out infinite;
    }
    @media (max-width: 991px) {
        .hero-image-wrapper {
            display: none;
        }
    }
    .btn-register-main {
        background: #d63384; 
        color: white;
        border: none;
        border-radius: 50px;
        padding: 12px;
        font-weight: 700;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(214, 51, 132, 0.3);
    }
    .btn-register-main:hover {
        background: #c21b6c;
        color: white;
        transform: translateY(-2px);
    }
</style>
<div class="hero-wrapper-full" 
     style="
        background-image: linear-gradient(135deg,#00000088,#00000088), url('<?= $course['banner_img'] ?>');
        background-size: cover;
        background-position: center;
     ">
    <div class="container">
        <div class="row align-items-center position-relative">
            <div class="col-md-7 text-white z-index-2">
                <p class="hero-sub mb-1"><?= $course['sub_title'] ?></p>
                <h1 class="hero-title-main scroll-explore" style="cursor:pointer;">
                <?= $course['title'] ?>
                </h1>

                <p class="hero-teacher mt-3">Giáo viên: <strong><?= $course['teacher_name'] ?></strong></p>
            </div>

            <div class="col-md-5 d-none d-md-block">
                <div class="hero-image-wrapper">
                    <img src="<?= $course['banner_img'] ?>" 
                         alt="Course Banner" 
                         class="hero-banner-card floating-banner">
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
                <h5 class="fw-bold mb-3 d-flex align-items-center text-dark">
                    <i class="fas fa-book me-2"></i> Giới thiệu khóa học:
                </h5>
                <p class="text-secondary lh-base" style="font-size: 1.1rem;">
                    <?= $course['description'] ?>
                </p>
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
                <h6 class="fw-bold mb-3 d-flex align-items-center text-dark">
                    <i class="fas fa-star text-warning me-2"></i> 
                    Hoàn thành khóa học, bạn sẽ:
                </h6>
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

            <div id="explore-section" class="mt-5 pt-4 border-top">
                <h2 class="section-title mb-4">
                    <span class="text-purple-light">Khám phá</span> khóa học khác
                </h2>

                <div class="search-input-wrapper mb-5">
                    <i class="fas fa-search icon-search"></i>
                    <input type="text" class="search-input" placeholder="Tìm khóa học mới">
                    <i class="fas fa-filter icon-filter" data-bs-toggle="modal" data-bs-target="#filterModal"></i>
                </div>

                <div id="course-list"></div>

                <div class="text-center mt-4 pb-4">
                    <button id="load-more" class="fw-bold text-dark" 
                        style="border:none; background:none; font-size: 1.2rem;">
                        Xem thêm
                    </button>
                    <div class="mt-1">
                        <i class="fas fa-arrow-down text-dark"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="sidebar-sticky" style="top: 100px;">

                <div class="mb-3 d-flex align-items-center text-dark">
                    <i class="far fa-clock me-2 fs-5"></i>
                    <span class="fw-bold">
                        Thời lượng: <?= $course['duration_weeks'] ?? '8' ?> tuần
                    </span>
                </div>

                <?php if (isset($course['is_enrolled']) && $course['is_enrolled']): ?>
                    <a href="/onlinecourse/index.php?controller=lesson&action=view&course_id=<?= $course['id'] ?>" 
                       class="btn btn-success w-100 mb-3 py-3 fw-bold text-white text-decoration-none d-block text-center"
                       style="border-radius: 50px; font-size: 1.2rem; box-shadow: 0 4px 15px rgba(25, 135, 84, 0.4);">
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
                    <h6 class="fw-bold mb-3">
                        <i class="fas fa-bolt me-2"></i> Quyền lợi học viên
                    </h6>
                    <ul class="list-unstyled text-secondary small">
                        <li>• Học mọi lúc, mọi nơi</li>
                        <li>• Hỗ trợ 1-1 khi cần</li>
                        <li>• Bài tập thực hành & Project</li>
                    </ul>
                </div>

                <div class="d-flex align-items-start bg-light p-3 rounded-3">
                    <img src="<?= $course['teacher_avatar'] ?? 'https://via.placeholder.com/50' ?>" class="rounded-circle me-3" 
                         style="width:50px; height:50px; object-fit:cover;">
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
        <div class="modal-content border-0 shadow-lg" style="border-radius: 15px; overflow: hidden;">
            <div class="modal-header bg-primary text-white border-0">
                <h5 class="modal-title fw-bold">
                    <i class="fas fa-shopping-cart me-2"></i> Xác nhận đăng ký
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body p-4 text-center">
                <div class="mb-3">
                    <img src="https://cdn-icons-png.flaticon.com/512/2921/2921222.png" alt="Confirm" width="80">
                </div>
                <h4 class="fw-bold text-dark mb-2" id="modalCourseTitle">Tên khóa học</h4>
                <p class="text-muted">Bạn có chắc chắn muốn đăng ký khóa học này?</p>
                
                <div class="d-flex justify-content-between align-items-center bg-light p-3 rounded mt-3">
                    <span class="text-secondary fw-bold">Học phí:</span>
                    <span class="text-danger fw-bold fs-4" id="modalCoursePrice">0đ</span>
                </div>
                
                <p class="small text-muted mt-2 fst-italic">
                    * Tài khoản của bạn sẽ được kích hoạt ngay sau khi xác nhận thanh toán.
                </p>
            </div>
            
            <div class="modal-footer border-0 justify-content-center pb-4">
                <button type="button" class="btn btn-outline-secondary px-4 rounded-pill" data-bs-dismiss="modal">Hủy bỏ</button>
                <a href="#" id="btnConfirmEnroll" class="btn btn-primary px-5 rounded-pill fw-bold shadow-sm">
                    Thanh toán & Vào học
                </a>
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
        confirmModal.querySelector('#btnConfirmEnroll').href =
            '/onlinecourse/index.php?controller=enrollment&action=create&course_id=' + courseId;
    });
});
</script>



<script src="/onlinecourse/assets/js/detail.js?v=<?= time() ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<?php require_once 'views/layouts/footer.php'; ?>
<?php require_once 'filter.php'; ?>
