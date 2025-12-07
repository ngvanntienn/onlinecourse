<?php
session_start();
require_once '../../models/Course.php'; 

/* mặc định lập trình web khi mở mỗi detail */
$course_id = isset($_GET['id']) ? $_GET['id'] : 'lap-trinh-web';
$course = Course::getById($course_id);
$courses_data = Course::getAll();

require_once '../layouts/header_students.php'; 
?>

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
                <h1 class="hero-title-main"><?= $course['title'] ?></h1>
                <p class="hero-teacher mt-3">Giáo viên: <strong><?= $course['teacher_name'] ?></strong></p>
            </div>

            <div class="col-md-5 d-none d-md-block text-end">
                <img src="<?= $course['banner_img'] ?>" alt="Course Banner" class="hero-3d-image">
            </div>
        </div>
    </div>
</div>


<div class="container my-5">
    <div class="row">

        <!-- MAIN CONTENT -->
        <div class="col-lg-8 pe-lg-5">

            <h3 class="fw-bold mb-4 text-dark">Tổng quan</h3>

            <!-- mô tả -->
            <div class="mb-5">
                <h5 class="fw-bold mb-3 d-flex align-items-center text-dark">
                    <i class="fas fa-book me-2"></i> Giới thiệu khóa học:
                </h5>
                <p class="text-secondary lh-base" style="font-size: 1.6rem;">
                    <?= $course['description'] ?>
                </p>
            </div>

            <!-- bạn sẽ học -->
            <div class="mb-5">
                <h6 class="fw-bold mb-3 text-dark">Bạn sẽ tiếp cận:</h6>
                <ul class="list-unstyled d-flex flex-column gap-2">
                    <?php foreach($course['learn_goals'] as $goal): ?>
                    <li class="d-flex align-items-start">
                        <i class="far fa-check-circle text-success mt-1 me-2"></i>
                        <span class="text-secondary"><?= $goal ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- outcomes -->
            <div class="mb-5">
                <h6 class="fw-bold mb-3 d-flex align-items-center text-dark">
                    <i class="fas fa-star text-warning me-2"></i> 
                    Hoàn thành khóa học, bạn sẽ:
                </h6>
                <ul class="list-unstyled d-flex flex-column gap-2">
                    <?php foreach($course['outcomes'] as $outcome): ?>
                    <li class="d-flex align-items-start">
                        <span class="me-2 fw-bold text-dark">•</span>
                        <span class="text-secondary"><?= $outcome ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>


            <!-- khóa học khác -->
            <div class="mt-5 pt-4 border-top">
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
                        style="border:none; background:none; font-size: 1.5rem;">
                        Xem thêm
                    </button>
                    <div class="mt-1">
                        <i class="fas fa-arrow-down text-dark"></i>
                    </div>
                </div>
            </div>

        </div>


        <!-- slidebar -->
        <div class="col-lg-4">
            <div class="sidebar-sticky" style="top: 100px;">

                <div class="mb-3 d-flex align-items-center text-dark">
                    <i class="far fa-clock me-2 fs-5"></i>
                    <span class="fw-bold">
                        Thời lượng: <?= $course['duration'] ?> / <?= $course['chapters'] ?>
                    </span>
                </div>

                <button class="btn btn-register-main w-100 mb-3">ĐĂNG KÝ NGAY</button>
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
                    <img src="<?= $course['teacher_avatar'] ?>" class="rounded-circle me-3" 
                         style="width:50px; height:50px; object-fit:cover;">
                    <div>
                        <h6 class="fw-bold mb-1 text-uppercase text-dark"><?= $course['teacher_name'] ?></h6>
                        <?php foreach($course['teacher_bio'] as $bio): ?>
                            <small class="text-secondary d-block lh-sm">• <?= $bio ?></small>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <?php require_once './filter.php'; ?>
</div>
<script>
    window.otherCourses = <?= json_encode($courses_data) ?>;
    window.currentCourseId = "<?= $course_id ?>";
</script>

<!-- load JS -->
<script src="/onlinecourse/assets/js/detail.js"></script>

<?php require_once '../layouts/footer.php'; ?>
