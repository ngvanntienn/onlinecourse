<?php

require_once './config/Database.php';
require_once 'models/Course.php'; 

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
$userAvatar  = !empty($_SESSION['avatar']) ? '/onlinecourse/assets/avatars/' . $_SESSION['avatar'] : 'https://t4.ftcdn.net/jpg/05/49/98/39/360_F_549983970_bRCkYfk0P6PP5fveM072efagRg8JuC8e.jpg';

$db = new Database();
$conn = $db->pdo;

// kiểm tra URL có ?view=all không
$isShowAll = isset($_GET['view']) && $_GET['view'] == 'all';
$limit = $isShowAll ? 12 : 2; 

$sql = "SELECT * FROM courses ORDER BY created_at DESC LIMIT :limit";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->execute();
$discoveryCourses = $stmt->fetchAll(PDO::FETCH_ASSOC);

require_once 'views/layouts/header_students.php'; 

?>

<div class="container">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="hero-title"><span class="text-title">Xin chào, </span><?= $displayName ?></h1>
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

<div class="container pb-5">
    <h3 class="section-heading">Theo dõi tiến độ tổng quan</h3>

    <div class="stats-box">
        <div class="d-flex flex-column align-items-center me-5">
            <div class="target-icon-wrapper">
                <i class="fas fa-bullseye target-icon"></i>
            </div>
            <span class="percent-big"><?= $overallProgress ?>%</span>
        </div>
        <div class="stats-text border-start ps-4" style="border-color: #d1c4e9 !important;">
            <p class="mb-3">
                Chúc mừng ! Bạn đã hoàn thành <strong><?= $completedCount ?> trên tổng số <?= $totalRegistered ?> khóa học</strong> đã đăng ký.
            </p>
            <p class="mb-0">
                Hãy tiếp tục hoàn thành các khóa học đã đăng ký nhé &lt;3
            </p>
        </div>
    </div>

    <h3 class="section-heading">Khóa học bạn <span class="text-pink-highlight">đã đăng ký</span></h3>

    <?php if (count($enrolledCourses) > 0): ?>
        <?php foreach ($enrolledCourses as $course): ?>
            <div class="course-card-item">
                <img src="<?= htmlspecialchars($course['image']) ?>" alt="Course Img" class="course-thumb">

                <div class="course-info-col">
                    <div>
                        <h4 class="course-title"><?= htmlspecialchars($course['title']) ?></h4>
                        <p class="instructor-name"><?= htmlspecialchars($course['instructor_name']) ?></p>
                        <p class="progress-text">
                            Tiến độ: Chương <?= $course['current_chapter'] ?> / Chương <?= $course['total_chapters'] ?>
                        </p>
                    </div>

                    <a href="/onlinecourse/index.php?controller=lesson&action=view&course_id=<?= $course['course_id'] ?>" class="btn-continue-learning">
                        <i class="fas fa-play"></i> Tiếp tục học
                    </a>
                </div>

                <div class="course-action-col ms-3">
                    <a href="#" class="btn-outline-custom">
                        <i class="fas fa-file-alt"></i> Tài liệu
                    </a>
                    <a href="/onlinecourse/index.php?controller=course&action=detail&id=<?= $course['course_id'] ?>" class="btn-outline-custom">
                        <i class="fas fa-bars"></i> Chi tiết
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="alert alert-light text-center border">
            Bạn chưa đăng ký khóa học nào. <a href="/onlinecourse/index.php" class="text-decoration-none fw-bold">Khám phá ngay!</a>
        </div>
    <?php endif; ?>

</div>

<?php 
require_once 'views/layouts/footer.php';  
?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<?php require_once 'views/instructor/materials/upload_student.php'; ?>
