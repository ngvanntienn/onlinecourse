<?php

require_once './config/Database.php';

require_once './models/Course.php'; 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header("Location: /onlinecourse/index.php?controller=auth&action=login");
    exit;
}

// kiểm tra dữ liệu session 
$displayName = $_SESSION['fullname'] ?? 'Học viên'; 
// đường dẫn ảnh avatar mặc định nếu chưa có
$userAvatar  = !empty($_SESSION['avatar']) ? '/onlinecourse/assets/uploads/avatars/' . $_SESSION['avatar'] : 'https://t4.ftcdn.net/jpg/05/49/98/39/360_F_549983970_bRCkYfk0P6PP5fveM072efagRg8JuC8e.jpg';

$db = new Database();
$conn = $db->pdo;

// Kiểm tra URL có ?view=all không
$isShowAll = isset($_GET['view']) && $_GET['view'] == 'all';

// Nếu có view=all thì lấy 12, ngược lại chỉ lấy 2
$limit = $isShowAll ? 12 : 2; 

$sql = "SELECT * FROM courses ORDER BY created_at DESC LIMIT :limit";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->execute();
$discoveryCourses = $stmt->fetchAll(PDO::FETCH_ASSOC);

require_once 'views/layouts/header_students.php'; 
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

        <h2 class="section-title border-top pt-4" id="discovery-section">
            <span class="text-purple">Khám phá</span> khóa học
        </h2>

        <div class="search-input-wrapper">
            <i class="fas fa-search icon-search"></i>
            <input type="text" class="search-input" placeholder="Tìm khóa học mới">
            <i class="fas fa-filter icon-filter" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#filterModal"></i>
        </div>

        <?php if (count($discoveryCourses) > 0): ?>
            <?php foreach ($discoveryCourses as $course): ?>
                <?php 
                    $imgSrc = !empty($course['image']) 
                        ? (strpos($course['image'], 'http') === 0 ? $course['image'] : '/onlinecourse/assets/uploads/courses/' . $course['image'])
                        : '/onlinecourse/assets/image/course/default.png';
                ?>
                <div class="mb-5">
                    <div class="course-header">
                        <h3 class="course-cat-name"><?= htmlspecialchars($course['title']) ?></h3>
                        <a href="/onlinecourse/index.php?controller=course&action=detail&id=<?= $course['id'] ?>" class="link-detail">
                            XEM CHI TIẾT <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                    <div style="height: 250px; overflow: hidden; border-radius: 0;">
                        <img src="<?= htmlspecialchars($imgSrc) ?>" class="course-banner-img w-100 h-100" style="object-fit: cover;">
                    </div>
                    <a href="/onlinecourse/index.php?controller=enrollment&action=create&course_id=<?= $course['id'] ?>" class="btn btn-register-pink mt-2 d-block text-center text-decoration-none">
                        Đăng ký ngay
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-info text-center">Hiện chưa có khóa học nào được đăng tải.</div>
        <?php endif; ?>

        <div class="text-center mt-4">
            <?php if (isset($_GET['view']) && $_GET['view'] == 'all'): ?>
                <a href="dashboard.php#discovery-section" class="fw-bold mb-0 text-decoration-none text-dark"style = "font-size: 1.8rem;">
                    Thu gọn <br> <i class="fas fa-arrow-up"></i>
                </a>
            <?php else: ?>
                <a href="?view=all#discovery-section" id="btnwatchAdd2" class="fw-bold mb-0 text-decoration-none text-dark"style = "font-size: 1.8rem;">
                    Xem thêm <br> <i class="fas fa-arrow-down"></i>
                </a>
            <?php endif; ?>
        </div>
              
    </div> 
</div> 
<?php require_once 'views/layouts/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<?php require_once 'views/courses/filter.php'; ?>
<?php require_once 'views/instructor/materials/upload.php'; ?>


