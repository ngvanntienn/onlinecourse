<?php
session_start();
// kiểm tra dữ liệu session 
$displayName = $_SESSION['fullname'] ?? 'Học viên'; 
// đường dẫn ảnh avatar mặc định nếu chưa có
$userAvatar  = !empty($_SESSION['avatar']) ? '/onlinecourse/assets/uploads/avatars/' . $_SESSION['avatar'] : 'https://t4.ftcdn.net/jpg/05/49/98/39/360_F_549983970_bRCkYfk0P6PP5fveM072efagRg8JuC8e.jpg';
require_once '../../layouts/header_students.php';
?>

<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="hero-title"><span class = "text-title">Xin chào, </span><?= $displayName ?></h1>
                <p class="hero-subtitle" style = "font-size:1.5rem;">Sẵn sàng cho bài học tiếp theo 
                    <br>của bạn ?</p>
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
            <a href="#" class="float-card">
                <i class="fas fa-search card-icon"></i>
                <span class="card-text">Khám phá khóa<br>học mới</span>
            </a>
        </div>
        <div class="col-md-4">
            <a href="#" class="float-card">
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

        <div class="row mb-5 g-4">
            <div class="col-md-6">
                <div class="learning-card">
                    <img src="/onlinecourse/assets/image/course/tagt.png" class="learning-thumb-img" alt="TA">
                    
                    <div class="learning-info">
                        <h6 class="course-name-sm">Tiếng Anh giao tiếp</h6>
                        <small class="text-muted mb-2">Mai Phương</small>
                        <button class="btn-continue">Tiếp tục học</button>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="learning-card">
                    <img src="/onlinecourse/assets/image/course/py.png" class="learning-thumb-img" alt="Python">
                    
                    <div class="learning-info">
                        <h6 class="course-name-sm">Lập trình Python</h6>
                        <small class="text-muted mb-2">Nguyễn Văn Tiến</small>
                        <button class="btn-continue">Tiếp tục học</button>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="section-title border-top pt-4">
            <span class="text-purple">Khám phá</span> khóa học
        </h2>

        <div class="search-input-wrapper">
            <i class="fas fa-search icon-search"></i>
            <input type="text" class="search-input" placeholder="Tìm khóa học mới">
            <i class="fas fa-filter icon-filter" data-bs-toggle="modal" data-bs-target="#filterModal"></i>
        </div>

        <div class="mb-5">
            <div class="course-header">
                <h3 class="course-cat-name">Lập trình Web</h3>
                <a href="#" class="link-detail">XEM CHI TIẾT <i class="fas fa-arrow-right ml-1"></i></a>
            </div>
            <img src="/onlinecourse/assets/image/course/web.png" class="course-banner-img">
            <button class="btn-register-pink mt-2">Đăng ký ngay</button>
        </div>

        <div class="mb-5">
            <div class="course-header">
                <h3 class="course-cat-name">Photoshop & thiết kế cơ bản</h3>
                <a href="#" class="link-detail">XEM CHI TIẾT <i class="fas fa-arrow-right ml-1"></i></a>
            </div>
            <img src="/onlinecourse/assets/image/course/pts.png" class="course-banner-img">
            <button class="btn-register-pink mt-2">Đăng ký ngay</button>
        </div>

        <div class="text-center mt-4">
            <a href = "#" class="fw-bold mb-0">Xem thêm</a>
            <br>
            <i class="fas fa-arrow-down"></i>
        </div>

    </div>
</div>

<div class="modal fade" id="filterModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Bộ lọc tìm kiếm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-2">
                <form action="" method="GET">
                    <div class="mb-3">
                        <label class="fw-bold mb-2">Danh mục</label>
                        <div class="d-flex flex-wrap gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="cat_it">
                                <label class="form-check-label" for="cat_it">IT</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="cat_eng">
                                <label class="form-check-label" for="cat_eng">Tiếng Anh</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="cat_math">
                                <label class="form-check-label" for="cat_math">Toán</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="cat_lit">
                                <label class="form-check-label" for="cat_lit">Văn</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="cat_other">
                                <label class="form-check-label" for="cat_other">Khác</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold mb-2">Cấp độ</label>
                        <div class="d-flex flex-wrap gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="lvl_basic">
                                <label class="form-check-label" for="lvl_basic">Cơ bản</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="lvl_inter">
                                <label class="form-check-label" for="lvl_inter">Trung cấp</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="lvl_adv">
                                <label class="form-check-label" for="lvl_adv">Nâng cao</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="lvl_all">
                                <label class="form-check-label" for="lvl_all">Mọi cấp độ</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold mb-2">Giá cả</label>
                        <div class="d-flex flex-wrap gap-5">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="price_free">
                                <label class="form-check-label" for="price_free">Miễn phí</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="price_paid">
                                <label class="form-check-label" for="price_paid">Có phí</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="price_all">
                                <label class="form-check-label" for="price_all">Tất cả</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold mb-2">Đánh giá</label>
                        <div class="d-flex flex-column gap-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="star_5">
                                <label class="form-check-label" for="star_5">5 sao</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="star_4">
                                <label class="form-check-label" for="star_4">4 sao trở lên</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="star_3">
                                <label class="form-check-label" for="star_3">3 sao trở lên</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="star_2">
                                <label class="form-check-label" for="star_2">2 sao trở lên</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="star_1">
                                <label class="form-check-label" for="star_1">1 sao trở lên</label>
                            </div>
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-apply-filter">Áp dụng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<?php require_once '../../layouts/footer.php'; ?>