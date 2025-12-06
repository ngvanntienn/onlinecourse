<?php 
// 1. Gọi Header chung
include '../instructor/header.php'; 

// --- DỮ LIỆU GIẢ LẬP (MOCK DATA) ĐỂ BẠN TEST NGAY ---
// (Sau này bạn chuyển logic này vào Controller nhé)
$current_id = isset($_GET['id']) ? $_GET['id'] : 1;

$courses_db = [
    1 => [
        'id' => 1,
        'title' => 'Lập Trình Web',
        'sub_title' => 'Hiểu về',
        'instructor' => 'Trịnh Khánh An',
        'image_hero' => '/onlinecourse/assets/image/hero/web_hero_3d.png', // Thay ảnh 3D laptop của bạn vào đây
        'price' => 'Miễn phí',
        'duration' => '30 giờ / 10 chương',
        'desc' => 'Khóa học Lập Trình Web dành cho người mới bắt đầu giúp bạn làm quen và xây dựng nền tảng vững chắc...',
        'benefits' => [
            'Nền tảng Web: HTML, CSS, JavaScript',
            'Tư duy cấu trúc và thiết kế giao diện',
            'Cách làm việc với thư viện, tổ chức dự án',
            'Thực hành liên tục với bài tập thực tế'
        ]
    ],
    2 => [
        'id' => 2,
        'title' => 'Photoshop và thiết kế cơ bản',
        'sub_title' => 'Thành thạo',
        'instructor' => 'Nguyễn Văn B',
        'image_thumb' => '/onlinecourse/assets/image/course/pts.png',
        'price' => '500.000đ',
        'duration' => '15 giờ'
    ],
    3 => [
        'id' => 3,
        'title' => 'Tiếng Anh giao tiếp',
        'sub_title' => 'Tự tin',
        'instructor' => 'Mai Phương',
        'image_thumb' => '/onlinecourse/assets/image/course/english.png',
        'price' => '1.200.000đ',
        'duration' => '45 giờ'
    ]
];

// Lấy khóa học hiện tại
$course = isset($courses_db[$current_id]) ? $courses_db[$current_id] : $courses_db[1];
?>
<link rel="stylesheet" href="/onlinecourse/assets/css/style.css">
<style>
    /* --- CSS RIÊNG CHO TRANG CHI TIẾT (CHUẨN MẪU) --- */
    body { background-color: #fff; font-family: 'Segoe UI', sans-serif; color: #333; }

    /* 1. HERO SECTION (Nền Xanh Đậm Gradient) */
    .detail-hero {
        /* Gradient từ xanh đậm sang tím than giống hình mẫu */
        background: linear-gradient(135deg, #10183D 0%, #29245A 100%);
        padding-top: 120px; /* Né header */
        padding-bottom: 60px;
        color: white;
        position: relative;
        overflow: hidden;
    }
    
    .breadcrumb-nav { font-size: 0.9rem; margin-bottom: 20px; opacity: 0.8; }
    .breadcrumb-nav a { color: white; text-decoration: none; }
    .breadcrumb-nav span { margin: 0 5px; }

    .hero-sub-title { font-size: 1.5rem; font-weight: 300; opacity: 0.9; margin-bottom: 0; }
    .hero-main-title { font-size: 3.5rem; font-weight: 800; line-height: 1.2; margin-bottom: 10px; }
    .instructor-name { font-weight: 700; font-size: 1.1rem; margin-top: 10px; }

    /* Ảnh 3D bên phải */
    .hero-3d-image {
        max-width: 100%;
        height: auto;
        transform: scale(1.1); /* Phóng to nhẹ */
        filter: drop-shadow(0 10px 20px rgba(0,0,0,0.3));
    }

    /* 2. MAIN LAYOUT */
    .main-container { padding-top: 50px; padding-bottom: 80px; }

    /* CỘT TRÁI: NỘI DUNG */
    .content-title { font-size: 1.5rem; font-weight: 800; color: #333; margin-bottom: 20px; }
    .sub-heading { font-size: 1.1rem; font-weight: 700; display: flex; align-items: center; gap: 10px; margin-bottom: 15px; }
    .sub-heading i { color: #555; }
    
    .course-desc { color: #555; line-height: 1.6; margin-bottom: 30px; text-align: justify; }

    /* List tích xanh */
    .check-list { list-style: none; padding: 0; margin-bottom: 30px; }
    .check-list li { margin-bottom: 12px; display: flex; align-items: flex-start; gap: 10px; color: #444; }
    .check-list li i { color: #27ae60; margin-top: 4px; font-size: 1.1rem; } /* Màu xanh lá */

    /* List sao vàng */
    .star-list { list-style: none; padding: 0; }
    .star-list li { margin-bottom: 10px; position: relative; padding-left: 20px; color: #444; }
    .star-list li::before {
        content: '\2022'; /* Bullet point tròn */
        position: absolute; left: 0; top: 0; color: #555; font-weight: bold;
    }
    .star-heading { color: #f1c40f; font-weight: 800; display: flex; align-items: center; gap: 8px; margin-bottom: 15px; }

    /* CỘT PHẢI: SIDEBAR STICKY */
    .sidebar-card {
        background: #f3effb; /* Nền tím rất nhạt */
        border: 1px solid #e0d8f0;
        border-radius: 15px;
        padding: 25px;
        position: sticky;
        top: 100px; /* Dính khi cuộn */
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }

    .btn-register-purple {
        background: #a582e6; /* Tím chủ đạo */
        color: white; font-weight: 700; width: 100%; border: none;
        padding: 12px; border-radius: 8px; margin-bottom: 10px; font-size: 1.1rem;
        box-shadow: 0 4px 10px rgba(165, 130, 230, 0.4); transition: 0.3s;
    }
    .btn-register-purple:hover { background: #8e6ecf; transform: translateY(-2px); }

    .btn-preview {
        background: rgba(165, 130, 230, 0.1); color: #333; font-weight: 600;
        width: 100%; border: 1px solid #a582e6; padding: 12px; border-radius: 8px;
        transition: 0.3s;
    }
    .btn-preview:hover { background: rgba(165, 130, 230, 0.2); }

    .benefit-list { list-style: none; padding: 0; margin-top: 20px; font-size: 0.95rem; }
    .benefit-list li { margin-bottom: 10px; display: flex; align-items: center; gap: 10px; color: #444; }
    
    .teacher-box { display: flex; align-items: center; gap: 15px; margin-top: 20px; padding-top: 20px; border-top: 1px solid #ddd; }
    .teacher-avatar { width: 50px; height: 50px; background: #ddd; border-radius: 50%; }

    /* PHẦN KHÁM PHÁ (DƯỚI CÙNG) */
    .explore-section { padding-top: 40px; border-top: 1px solid #eee; margin-top: 50px; }
    .explore-title { font-weight: 800; font-size: 1.5rem; color: #a582e6; margin-bottom: 20px; }
    .explore-title span { color: #333; }

    /* Thanh tìm kiếm */
    .search-bar-simple { position: relative; margin-bottom: 30px; }
    .search-bar-simple input { width: 100%; padding: 10px 40px 10px 15px; border: 1px solid #ccc; border-radius: 5px; }
    .search-bar-simple i.fa-search { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); opacity: 0; } /* Ẩn theo mẫu */
    .search-bar-simple i.fa-filter { position: absolute; right: 15px; top: 50%; transform: translateY(-50%); color: #666; cursor: pointer; }

    /* Card Khóa học Khác (Giống mẫu Photoshop) */
    .other-course-card { margin-bottom: 30px; }
    .course-header-row { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 10px; }
    .course-name-bold { font-weight: 800; font-size: 1.2rem; color: #222; }
    .link-arrow { text-decoration: none; font-weight: 700; font-size: 0.8rem; color: #333; text-transform: uppercase; }
    
    .banner-wide-img { 
        width: 100%; height: 200px; object-fit: cover; border-radius: 8px; 
        box-shadow: 0 5px 15px rgba(0,0,0,0.1); display: block;
    }
    
    .btn-register-pink {
        width: 100%; background: #eb5e96; color: white; border: none;
        padding: 10px; border-radius: 5px; font-weight: 700; font-size: 1rem;
        margin-top: 15px; transition: 0.3s;
    }
    .btn-register-pink:hover { background: #d64580; }

</style>

<div class="detail-hero">
    <div class="container">
        <div class="breadcrumb-nav">
            <a href="index.php">Trang chủ</a> <span>></span>
            <a href="#">Khóa học</a> <span>></span>
            <span><?= $_SESSION['fullname'] ?? 'Phương Thảo' ?></span>
        </div>

        <div class="row align-items-center">
            <div class="col-lg-7">
                <h4 class="hero-sub-title"><?= $course['sub_title'] ?></h4>
                <h1 class="hero-main-title"><?= $course['title'] ?></h1>
                <p class="instructor-name">Giảng viên: <?= $course['instructor'] ?></p>
            </div>
            <div class="col-lg-5 text-center">
                <img src="https://cdn3d.iconscout.com/3d/premium/thumb/web-development-4438760-3683536.png" class="hero-3d-image" alt="Course Hero">
            </div>
        </div>
    </div>
</div>

<div class="container main-container">
    <div class="row">
        
        <div class="col-lg-8 pe-lg-5">
            <h2 class="content-title">Tổng quan</h2>
            
            <div class="sub-heading">
                <i class="far fa-file-alt"></i> Giới thiệu khóa học:
            </div>
            
            <p class="course-desc">
                <?= $course['desc'] ?>
            </p>

            <div class="sub-heading" style="font-size: 1rem;">Bạn sẽ tiếp cận:</div>
            <ul class="check-list">
                <?php foreach($course['benefits'] as $benefit): ?>
                    <li><i class="fas fa-check-circle"></i> <?= $benefit ?></li>
                <?php endforeach; ?>
            </ul>

            <div class="star-heading">
                <i class="fas fa-star"></i> Hoàn thành khóa học, bạn sẽ:
            </div>
            <ul class="star-list">
                <li>Thành thạo HTML5, biết viết cấu trúc và semantic chuẩn</li>
                <li>Làm chủ CSS3, Flexbox, Grid, Responsive</li>
                <li>Hiểu rõ JavaScript cơ bản: biến, hàm, DOM, event</li>
                <li>Biết chuyển từ thiết kế (Figma) sang giao diện thực tế</li>
                <li>Tự xây dựng một website hoàn chỉnh</li>
                <li>Áp dụng tư duy viết code gọn gàng, dễ mở rộng và bảo trì</li>
            </ul>
        </div>

        <div class="col-lg-4">
            <div class="sidebar-card">
                <div class="mb-3 fw-bold"><i class="far fa-clock me-2"></i> Thời lượng: <?= $course['duration'] ?></div>
                
                <button class="btn-register-purple">ĐĂNG KÝ NGAY</button>
                <button class="btn-preview">Xem thử (Bài học miễn phí)</button>

                <div class="mt-4 fw-bold mb-2"><i class="fas fa-bolt me-1"></i> Quyền lợi học viên</div>
                <ul class="benefit-list">
                    <li><i class="fas fa-circle" style="font-size: 5px;"></i> Học mọi lúc, mọi nơi</li>
                    <li><i class="fas fa-circle" style="font-size: 5px;"></i> Hỗ trợ 1-1 khi cần</li>
                    <li><i class="fas fa-circle" style="font-size: 5px;"></i> Bài tập thực hành & Project</li>
                </ul>

                <div class="teacher-box">
                    <div class="teacher-avatar"></div> <div>
                        <div class="fw-bold text-uppercase"><?= $course['instructor'] ?></div>
                        <small class="text-muted">Giảng viên kinh nghiệm giảng dạy</small>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="explore-section">
        <div class="explore-title">Khám phá <span>khóa học khác</span></div>
        
        <div class="search-bar-simple">
            <i class="fas fa-search" style="left: 15px; opacity: 1;"></i>
            <input type="text" placeholder="Tìm khóa học mới">
            <i class="fas fa-filter"></i>
        </div>

        <?php foreach ($courses_db as $item): ?>
            <?php if ($item['id'] != $current_id): // CHỈ HIỆN KHÓA KHÁC ?>
                <div class="other-course-card">
                    <div class="course-header-row">
                        <div class="course-name-bold"><?= $item['title'] ?></div>
                        <a href="index.php?controller=course&action=detail&id=<?= $item['id'] ?>" class="link-arrow">XEM CHI TIẾT <i class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                    
                    <div style="position: relative;">
                        <?php if($item['id'] == 2): ?>
                            <img src="/onlinecourse/assets/image/course/pts_banner_wide.png" class="banner-wide-img" 
                                 onerror="this.src='https://img.freepik.com/free-photo/photographer-using-laptop-editing-photos_23-2149027876.jpg'">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/af/Adobe_Photoshop_CC_icon.svg/1200px-Adobe_Photoshop_CC_icon.svg.png" 
                                 style="position: absolute; right: 30px; bottom: 20px; height: 100px; z-index: 2;">
                        <?php else: ?>
                            <img src="<?= $item['image_thumb'] ?>" class="banner-wide-img">
                        <?php endif; ?>
                    </div>

                    <button class="btn-register-pink">Đăng ký ngay</button>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>

        <div class="text-center mt-4 fw-bold">
            Xem thêm <br> <i class="fas fa-arrow-down"></i>
        </div>
    </div>

</div>

<?php include '../layouts/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>