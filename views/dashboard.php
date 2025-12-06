<?php
session_start();

// 1. Cấu hình Tab Active (Để Header biết đang ở trang nào)
$current_page = 'dashboard'; 

// 2. Lấy thông tin giảng viên
$displayName = $_SESSION['fullname'] ?? 'Giảng viên'; 
$userAvatar  = !empty($_SESSION['avatar']) ? '/onlinecourse/assets/uploads/avatars/' . $_SESSION['avatar'] : 'https://t4.ftcdn.net/jpg/05/49/98/39/360_F_549983970_bRCkYfk0P6PP5fveM072efagRg8JuC8e.jpg';

// 3. Gọi Header Teacher
require_once './layouts/header_teacher.php';
?>
</style>

<!-- form tương tự header students -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="hero-title"><span class = "text-title">Xin chào, </span><?= $displayName ?></h1>
                <p class="hero-subtitle" style = "font-size:1.5rem;">Chào mừng quay trở lại EasyStudy! 
                        <br>Đăng tải bài học mới ngay nào?
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
    
    <div class="row dashboard-cards g-4">
        
        <div class="col-md-4">
            <a href="../views/instructor/course/manage.php" class="manage-card card-orange">
                <div class="card-content">
                    <h3 class="card-title">Quản lý Khóa học</h3>
                    <i class="fas fa-book-open card-icon-bg"></i>
                </div>
                <div class="card-footer-link">
                    Xem chi tiết <i class="fas fa-arrow-right"></i>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="/onlinecourse/index.php?controller=lesson&action=manage" class="manage-card card-green">
                <div class="card-content">
                    <h3 class="card-title">Quản lý Bài giảng</h3>
                    <i class="fab fa-youtube card-icon-bg"></i>
                </div>
                <div class="card-footer-link">
                    Xem chi tiết <i class="fas fa-arrow-right"></i>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="/onlinecourse/index.php?controller=instructor&action=students" class="manage-card card-blue">
                <div class="card-content">
                    <h3 class="card-title">Quản lý Học viên</h3>
                    <i class="fas fa-folder card-icon-bg"></i>
                </div>
                <div class="card-footer-link">
                    Xem chi tiết <i class="fas fa-arrow-right"></i>
                </div>
            </a>
        </div>
    </div>

    <div class="reviews-container">
        <h3 class="section-header-text">Đánh giá gần đây</h3>
        
        <div class="row">
            <div class="col-md-8">
                
                <div class="review-item">
                    <div class="d-flex">
                        <img src="/onlinecourse/assets/image/evaluate/stmtp.png" class="reviewer-avatar">
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between">
                                <span class="reviewer-name">Sơn Tùng MTP</span>
                                <span class="review-time"><i class="far fa-clock me-1"></i> 3 Tháng trước</span>
                            </div>
                            <div class="star-rating">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                            <p class="review-text">
                                Khóa học rất bổ ích, giảng viên nhiệt tình hỗ trợ. Nội dung bài giảng dễ hiểu và sát thực tế.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="review-item border-0">
                    <div class="d-flex">
                        <img src="/onlinecourse/assets/image/evaluate/jk.png" class="reviewer-avatar">
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between">
                                <span class="reviewer-name">Jeon Jung-kook</span>
                                <span class="review-time"><i class="far fa-clock me-1"></i> 3 Tháng trước</span>
                            </div>
                            <div class="star-rating">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                            <p class="review-text">
                                Cảm ơn thầy vì những kiến thức tuyệt vời. Tôi đã áp dụng được ngay vào đồ án của mình.
                            </p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-4">
                <div class="rating-summary-box">
                    <div class="rating-number">4 out of 5</div>
                    <div class="star-rating fs-5 my-2">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                    </div>
                    <div class="top-rating-text">Top Rating</div>
                </div>

                <div class="rating-progress-row">
                    <span style="width: 50px;">5 Stars</span>
                    <div class="progress-bar-bg"><div class="progress-fill" style="width: 80%;"></div></div>
                </div>
                <div class="rating-progress-row">
                    <span style="width: 50px;">4 Stars</span>
                    <div class="progress-bar-bg"><div class="progress-fill" style="width: 60%;"></div></div>
                </div>
                <div class="rating-progress-row">
                    <span style="width: 50px;">3 Stars</span>
                    <div class="progress-bar-bg"><div class="progress-fill" style="width: 10%;"></div></div>
                </div>
                <div class="rating-progress-row">
                    <span style="width: 50px;">2 Stars</span>
                    <div class="progress-bar-bg"><div class="progress-fill" style="width: 5%;"></div></div>
                </div>
                <div class="rating-progress-row">
                    <span style="width: 50px;">1 Stars</span>
                    <div class="progress-bar-bg"><div class="progress-fill" style="width: 0%;"></div></div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<?php require_once './layouts/footer.php'; ?>