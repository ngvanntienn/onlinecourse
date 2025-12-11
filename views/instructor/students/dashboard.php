<?php 
require_once 'views/layouts/header_students.php'; 
?>

<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="hero-title"><span class="text-title">Xin chào, </span><?= htmlspecialchars($displayName) ?></h1>
                <p class="hero-subtitle" style="font-size:1.5rem;">
                    Sẵn sàng cho bài học tiếp theo <br>của bạn ?
                </p>
            </div>
            <div class="col-md-6">
                <div class="hero-image-wrapper">
                    <img src="/onlinecourse/assets/image/hero/student.png" alt="Student" class="img-fluid hero-girl-img">
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <div class="row floating-container g-3">
        <div class="col-md-4">
            <a href="#discovery-section" class="float-card">
                <i class="fas fa-search card-icon"></i>
                <span class="card-text">Khám phá khóa<br>học mới</span>
            </a>
        </div>
        <div class="col-md-4">
            <a href="/onlinecourse/index.php?controller=student&action=progress" class="float-card">
                <i class="fas fa-chart-bar card-icon"></i>
                <span class="card-text">Theo dõi tiến độ<br>khóa học</span>
            </a>
        </div>
        <div class="col-md-4">
            <a href="/onlinecourse/index.php?controller=student&action=my_courses" class="float-card">
                <i class="fas fa-bookmark card-icon"></i>
                <span class="card-text">Khóa học của tôi</span>
            </a>
        </div>
    </div>

    <div class="main-content-box">
        <h2 class="section-title">
            Khóa học bạn <span class="text-title">đang học</span>
        </h2>

        <div class="row">
            <?php if (!empty($enrolledCourses)): ?>
                <?php foreach($enrolledCourses as $course): ?>
                    <div class="col-md-6">
                        <div class="learning-card">
                            <img src="<?= !empty($course['image']) ? '/onlinecourse/assets/uploads/courses/' . $course['image'] : '/onlinecourse/assets/image/course/default.png' ?>" 
                                 class="learning-thumb-img" alt="<?= htmlspecialchars($course['title']) ?>">
                            <div class="learning-info">
                                <h6 class="course-name-sm"><?= htmlspecialchars($course['title']) ?></h6>
                                <small class="text-muted mb-2"><?= htmlspecialchars($course['teacher_name']) ?></small>
                                <a href="/onlinecourse/index.php?controller=student&action=courseDetail&id=<?= $course['id'] ?>" 
                                   class="btn-continue text-decoration-none text-center">
                                    Tiếp tục học
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-info text-center" style="font-size: 1.6rem;">
                        Bạn chưa đăng ký khóa học nào.
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <h2 class="section-title border-top pt-4" id="discovery-section">
            <span class="text-purple">Khám phá</span> khóa học
        </h2>

        <form action="index.php" method="GET" class="search-input-wrapper mb-4">
            <input type="hidden" name="controller" value="student">
            <input type="hidden" name="action" value="dashboard">
            
            <i class="fas fa-search icon-search"></i>
            <input type="text" class="search-input" name="keyword" placeholder="Tìm khóa học mới"
                   value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>">
            <i class="fas fa-filter icon-filter" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#filterModal"></i>
        </form>

        <div class="row">
            <?php if (count($discoveryCourses) > 0): ?>
                <?php foreach ($discoveryCourses as $course): ?>
                    <?php 
                        $imgSrc = !empty($course['image']) 
                            ? (strpos($course['image'], 'http') === 0 ? $course['image'] : '/onlinecourse/assets/uploads/courses/' . $course['image'])
                            : '/onlinecourse/assets/image/course/default.png';
                    ?>
                    <div class="col-md-6 mb-5">
                        <div class="course-header">
                            <h3 class="course-cat-name"><?= htmlspecialchars($course['title']) ?></h3>
                            <a href="/onlinecourse/index.php?controller=student&action=courseDetail&id=<?= $course['id'] ?>" class="link-detail">
                                XEM CHI TIẾT <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                        <div style="height: 250px; overflow: hidden; border-radius: 0;">
                            <img src="<?= htmlspecialchars($imgSrc) ?>" class="course-banner-img w-100 h-100" style="object-fit: cover;">
                        </div>
                        <button class="btn btn-register-pink w-100"
                                data-bs-toggle="modal"
                                data-bs-target="#confirmEnrollModal"
                                data-id="<?= $course['id'] ?>"
                                data-title="<?= htmlspecialchars($course['title']) ?>"
                                data-price="<?= number_format($course['price'], 0, ',', '.') ?>đ">
                            Đăng ký ngay
                        </button>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        Hiện chưa có khóa học nào phù hợp với tìm kiếm của bạn.
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="text-center mt-4">
            <?php if ($isShowAll): ?>
                <a href="/onlinecourse/index.php?controller=student&action=dashboard#discovery-section" 
                   class="fw-bold mb-0 text-decoration-none text-dark" style="font-size: 1.8rem;">
                    Thu gọn <br> <i class="fas fa-arrow-up"></i>
                </a>
            <?php else: ?>
                <a href="/onlinecourse/index.php?controller=student&action=dashboard&view=all#discovery-section" 
                   class="fw-bold mb-0 text-decoration-none text-dark" style="font-size: 1.8rem;">
                    Xem thêm <br> <i class="fas fa-arrow-down"></i>
                </a>
            <?php endif; ?>
        </div>        
    </div> 
</div> 

<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <?php if(isset($_SESSION['success'])): ?>
        <div id="successToast" class="toast show align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body" style="font-size: 1.5rem;">
                    <?= $_SESSION['success']; unset($_SESSION['success']); ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    <?php endif; ?>

    <?php if(isset($_SESSION['error'])): ?>
        <div id="errorToast" class="toast show align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body" style="font-size: 1.5rem;">
                    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    <?php endif; ?>
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
                    * Tài khoản của bạn sẽ được kích hoạt ngay sau khi xác nhận.
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

<?php require_once 'views/layouts/footer.php'; ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/students.js"></script>

<?php 
require_once 'views/courses/filter.php'; 
require_once 'views/instructor/materials/upload_student.php'; 
?>

<script>
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
