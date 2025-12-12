<?php  

require_once 'views/layouts/header_students.php';  

?>
<style>
    .search-container {
    position: relative;
    width: 100%;
    margin: 0 auto 40px;
}

.search-input {
    width: 100%;
    padding: 16px 55px; /* cân lại padding icon */
    border-radius: 40px;
    border: 2px solid #b794f4;
    font-size: 1.15rem;
    font-weight: 600;
    background: #ffffff;
    transition: 0.25s ease;
}

.search-input:focus {
    border-color: #9f7aea;
    box-shadow: 0 0 12px rgba(159,122,234,0.32);
    outline: none;
}

.search-icon-left {
    position: absolute;
    top: 50%;
    left: 20px;
    transform: translateY(-50%);
    font-size: 1.35rem;
    color: #7a7a7a;
}

.filter-icon-right {
    position: absolute;
    top: 50%;
    right: 20px;
    transform: translateY(-50%);
    font-size: 1.35rem;
    color: #7a7a7a;
}

/* Hover mềm cho input */
.search-input:hover {
    border-color: #a281e6;
}


    .filter-icon-right {
        right: 20px;
        cursor: pointer;
    }

    .course-block {
        margin-bottom: 50px;
    }

    .course-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 10px;
    }

    .course-title-top {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-weight: 700;
        font-size: 1.6rem;
        color: #2c3e50;
        text-transform: uppercase;
    }

    .course-link-detail {
        font-size: 0.9rem;
        font-weight: 500;
        color: #693db3ff;
        text-decoration: none;
    }

    .course-link-detail:hover {
        color: #9f7aea;
    }

    .course-visual-group {

        overflow: hidden;
        box-shadow: 0 6px 20px rgba(0,0,0,0.12);
        background: #fff;
    }

    .course-banner-wrapper {
        width: 100%;
        height: 300px;
        overflow: hidden;
    }

    .course-banner-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s;
    }

    .course-banner-img:hover {
        transform: scale(1.05);
    }

    .btn-register-block {
        display: block;
        width: 100%;
        background: #ff4778;
        color: #fff;
        text-align: center;
        padding: 20px 0;
        font-weight: 600;
        font-size: 1.5rem;
        border: none;
        border-radius: 0 0 12px 12px;
        transition: 0.3s;
    }

    .btn-register-block:hover {
        background: #67051fff;
        transform: scale(1.02);
    }

    .text-center a {
        font-weight: 700;
        color: #333;
        text-decoration: none;
        transition: 0.3s;
        font-size: 1.3rem;
    }

    .text-center a:hover {
        color: #9f7aea;
    }

    body {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    main {
        flex: 1;
    }
</style>
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="hero-title"><span class="text-title">Xin chào, </span><?= $displayName ?></h1>
                <p class="hero-subtitle" style="font-size:1.5rem;">Sẵn sàng cho bài học tiếp theo của bạn ?</p>
            </div>
            <div class="col-md-6">
                <div class="hero-image-wrapper">
                    <img src="/onlinecourse/assets/image/hero/student.png" alt="Student" class="img-fluid hero-girl-img">
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container mb-5">
    <div class="row floating-container g-3">
        <div class="col-md-4">
          <a href="#discovery" class="float-card">
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
</div>

<div class="container" id="discovery">

    <h3 class="fw-bold mb-4" style="font-size:2rem;"><span style="color:#b794f4">Khám phá</span> khóa học</h3>

    <!-- Search -->
    <form action="index.php" method="GET" class="search-container">
        <input type="hidden" name="controller" value="student">
        <input type="hidden" name="action" value="dashboard">
        <i class="fas fa-search search-icon-left"></i>
        <input type="text" class="search-input" name="keyword" placeholder="Tìm khóa học mới" value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>">
        <i class="fas fa-filter filter-icon-right" data-bs-toggle="modal" data-bs-target="#filterModal"></i>
    </form>

    <!-- Courses -->
    <div class="row">
        <?php if (count($discoveryCourses) > 0): ?>
            <?php foreach ($discoveryCourses as $course): 
                $imgSrc = !empty($course['image']) ? (strpos($course['image'], 'http') === 0 ? $course['image'] : '/onlinecourse/assets/uploads/courses/' . $course['image']) : '/onlinecourse/assets/image/course/default.png';
            ?>
                <div class="col-md-6 course-block">
                    <div class="course-header">
                        <h5 class="course-title-top"><?= htmlspecialchars($course['title']) ?></h5>
                        <a href="/onlinecourse/index.php?controller=student&action=courseDetail&id=<?= $course['id'] ?>" class="course-link-detail">XEM CHI TIẾT <i class="fas fa-arrow-right"></i></a>
                    </div>
                    <div class="course-visual-group">
                        <div class="course-banner-wrapper">
                            <img src="<?= htmlspecialchars($imgSrc) ?>" class="course-banner-img" alt="<?= htmlspecialchars($course['title']) ?>">
                        </div>
                        <button class="btn-register-block" data-bs-toggle="modal" data-bs-target="#confirmEnrollModal" data-id="<?= $course['id'] ?>" data-title="<?= htmlspecialchars($course['title']) ?>" data-price="<?= number_format($course['price'], 0, ',', '.') ?>đ">Đăng ký ngay</button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center py-4">
                <p class="text-muted" style="font-size:1.5rem;">Không tìm thấy khóa học nào.</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Show more / Collapse -->
    <div class="text-center mt-4 mb-5">
        <?php if ($isShowAll): ?>
            <a href="/onlinecourse/index.php?controller=student&action=dashboard" class="text-dark fw-bold text-decoration-none" style="font-size:1.2rem;">Thu gọn <i class="fas fa-chevron-up"></i></a>
        <?php else: ?>
            <a href="/onlinecourse/index.php?controller=student&action=dashboard&view=all" class="text-dark fw-bold text-decoration-none" style="font-size:1.2rem;">Xem thêm <i class="fas fa-arrow-down"></i></a>
        <?php endif; ?>
    </div>
</div>

<!-- Modal đăng ký -->
<div class="modal fade" id="confirmEnrollModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-size:1.5rem;">Xác nhận đăng ký</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" style="font-size:1.2rem;">
                <p>Bạn muốn đăng ký khóa học: <b id="modalCourseTitle"></b>?</p>
                <p>Giá: <span id="modalCoursePrice" class="text-danger fw-bold"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-lg" data-bs-dismiss="modal">Hủy</button>
                <a href="#" id="btnConfirmEnroll" class="btn btn-danger btn-lg">Thanh toán & Vào học</a>
            </div>
        </div>
    </div>
</div>

<!-- Toast thông báo -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <?php if(isset($_SESSION['success'])): ?>
        <div class="toast show align-items-center text-bg-success border-0">
            <div class="d-flex">
                <div class="toast-body" style="font-size:1.2rem;"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    <?php endif; ?>
    <?php if(isset($_SESSION['error'])): ?>
        <div class="toast show align-items-center text-bg-danger border-0">
            <div class="d-flex">
                <div class="toast-body" style="font-size:1.2rem;"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Modal filter -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Bộ lọc khóa học</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="index.php" method="GET" id="filterForm">
                    <input type="hidden" name="controller" value="student">
                    <input type="hidden" name="action" value="dashboard">

                    <div class="mb-4">
                        <label class="fw-bold mb-2">Danh mục</label>
                        <div class="d-flex flex-wrap gap-2">
                            <?php function isChecked($paramName, $value) { return isset($_GET[$paramName]) && is_array($_GET[$paramName]) && in_array($value, $_GET[$paramName]) ? 'checked' : ''; } ?>
                            <div class="form-check me-3"><input class="form-check-input" type="checkbox" id="cat_it" name="category[]" value="1" <?= isChecked('category',1) ?>><label class="form-check-label" for="cat_it">IT</label></div>
                            <div class="form-check me-3"><input class="form-check-input" type="checkbox" id="cat_eng" name="category[]" value="4" <?= isChecked('category',4) ?>><label class="form-check-label" for="cat_eng">Tiếng Anh</label></div>
                            <div class="form-check me-3"><input class="form-check-input" type="checkbox" id="cat_math" name="category[]" value="3" <?= isChecked('category',3) ?>><label class="form-check-label" for="cat_math">Toán</label></div>
                            <div class="form-check me-3"><input class="form-check-input" type="checkbox" id="cat_lit" name="category[]" value="2" <?= isChecked('category',2) ?>><label class="form-check-label" for="cat_lit">Văn</label></div>
                            <div class="form-check me-3"><input class="form-check-input" type="checkbox" id="cat_other" name="category[]" value="5" <?= isChecked('category',5) ?>><label class="form-check-label" for="cat_other">Khác</label></div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="fw-bold mb-2">Cấp độ</label>
                        <div class="d-flex flex-wrap gap-2">
                            <div class="form-check me-3"><input class="form-check-input" type="checkbox" id="lvl_basic" name="level[]" value="Beginner" <?= isChecked('level','Beginner') ?>><label class="form-check-label" for="lvl_basic">Cơ bản</label></div>
                            <div class="form-check me-3"><input class="form-check-input" type="checkbox" id="lvl_inter" name="level[]" value="Intermediate" <?= isChecked('level','Intermediate') ?>><label class="form-check-label" for="lvl_inter">Trung cấp</label></div>
                            <div class="form-check me-3"><input class="form-check-input" type="checkbox" id="lvl_adv" name="level[]" value="Advanced" <?= isChecked('level','Advanced') ?>><label class="form-check-label" for="lvl_adv">Nâng cao</label></div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="fw-bold mb-2">Giá cả</label>
                        <div class="d-flex flex-wrap gap-2">
                            <div class="form-check me-3"><input class="form-check-input" type="checkbox" id="price_free" name="price[]" value="free" <?= isChecked('price','free') ?>><label class="form-check-label" for="price_free">Miễn phí</label></div>
                            <div class="form-check me-3"><input class="form-check-input" type="checkbox" id="price_paid" name="price[]" value="paid" <?= isChecked('price','paid') ?>><label class="form-check-label" for="price_paid">Có phí</label></div>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary" style="background:#d63384;border:none;">Áp dụng bộ lọc</button>
                        <a href="index.php?controller=student&action=dashboard" class="btn btn-outline-secondary">Xóa bộ lọc</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<?php


require_once __DIR__ . '/../../users/manage.php';  
require_once 'views/layouts/footer.php'; 
require_once __DIR__ . '/../../instructor/materials/upload_student.php'; ?>

<script>
document.addEventListener('DOMContentLoaded',function(){
    var confirmModal=document.getElementById('confirmEnrollModal');
    if(confirmModal){
        confirmModal.addEventListener('show.bs.modal',function(event){
            var button=event.relatedTarget;
            var courseId=button.getAttribute('data-id');
            var title=button.getAttribute('data-title');
            var price=button.getAttribute('data-price');
            confirmModal.querySelector('#modalCourseTitle').textContent=title;
            confirmModal.querySelector('#modalCoursePrice').textContent=price;
            confirmModal.querySelector('#btnConfirmEnroll').href='/onlinecourse/index.php?controller=enrollment&action=create&course_id='+courseId;
        });
    }
});
</script>
