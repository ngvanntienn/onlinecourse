<?php 
require_once 'views/layouts/header_students.php'; 
?>
<style>
    .overview-box {
        background-color: #F3E5F5; 
        border-radius: 10px;
        padding: 40px;
        display: flex;
        align-items: center;
        margin-bottom: 50px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
    }

    .target-icon-wrapper {
        margin-bottom: 10px;
    }
    
    .icon-target {
        font-size: 5rem;
        color: #FF1744; 
    }

    .big-percent {
        font-size: 5rem;
        font-weight: 800;
        color: #212529;
        line-height: 1;
    }

    .overview-text {
        font-size: 1.9rem;
        color: #555;
        line-height: 1.6;
        margin-left: 60px;
        border-left: none;
    }

    .section-heading {
        font-size: 2rem;
        font-weight: 800;
        color: #333;
        margin-bottom: 30px;
    }

    .text-pink-highlight {
        color: #ff4081;
    }

    .course-progress-card {
        background: #fff;
        border-radius: 20px;
        padding: 20px;
        margin-bottom: 30px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.06);
        border: 1px solid #eee;
        transition: transform 0.2s;
        display: flex;
        align-items: stretch;
    }

    .course-progress-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    }

    .progress-img-wrapper {
        width: 300px;
        height: 250px;
        flex-shrink: 0;
        border-radius: 12px;
        overflow: hidden;
        background-color: #e0e0e0;
    }

    .progress-course-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .progress-content-wrapper {
        flex-grow: 1;
        padding-left: 30px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .course-title-lg {
        font-size: 1.8rem;
        font-weight: 700;
        color: #444;
        margin-bottom: 5px;
    }

    .teacher-name-sm {
        color: #666;
        font-size: 1.4rem;
        margin-bottom: 20px;
    }

    .progress-status-text {
        font-size: 1.3rem;
        font-weight: 600;
        color: #777;
    }

    .btn-action-group {
        display: flex;
        gap: 10px;
    }

    .btn-action-sm {
        background-color: #eee;
        color: #333;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-action-sm:hover {
        background-color: #ddd;
        color: #000;
    }
    
    .btn-action-sm i {
        margin-right: 6px;
    }

    .btn-continue-purple {
        background-color: #B39DDB; /* Màu tím nhạt chuẩn mẫu */
        color: #333;
        font-weight: 700;
        width: 100%;
        padding: 12px;
        border-radius: 8px;
        border: none;
        text-align: center;
        text-decoration: none;
        display: block;
        transition: background 0.3s;
        margin-top: auto;
        font-size: 1.3rem;
    }

    .btn-continue-purple:hover {
        background-color: #9575cd;
        color: #fff;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .overview-box {
            flex-direction: column;
            text-align: center;
            padding: 20px;
        }
        .overview-text {
            margin-left: 0;
            margin-top: 20px;
        }
        .course-progress-card {
            flex-direction: column;
            height: auto;
        }
        .progress-img-wrapper {
            width: 100%;
            height: 200px;
            margin-bottom: 20px;
        }
        .progress-content-wrapper {
            padding-left: 0;
        }
    }
</style>

<div class="container my-5" style="max-width: 1000px;">
    
    <h3 class="fw-bold mb-4 text-dark" style="font-size: 1.8rem;">Theo dõi tiến độ tổng quan</h3>
    
    <div class="overview-box">
        <div class="d-flex flex-column align-items-center" style="min-width: 200px;">
            <div class="target-icon-wrapper">
                <i class="fas fa-bullseye icon-target"></i>
            </div>
            <div class="big-percent"><?= $overallProgress ?>%</div>
        </div>

        <div class="overview-text">
            <p class="mb-3" style="font-size: 1.7rem;">
                Chúc mừng ! Bạn đã hoàn thành <strong><?= $completedCount ?> trên tổng số <?= $totalRegistered ?> khóa học</strong> đã đăng ký.
            </p>
            <p class="mb-0">
                Hãy tiếp tục hoàn thành các khóa học đã đăng ký nhé &lt;3
            </p>
        </div>
    </div>

    <h3 class="section-heading">
        Khóa học bạn <span class="text-pink-highlight">đã đăng ký</span>
    </h3>

    <div class="course-list">
        <?php if (!empty($enrolledCourses)): ?>
            <?php foreach ($enrolledCourses as $course): ?>
                <?php 
                    $imgSrc = !empty($course['image']) 
                        ? (strpos($course['image'], 'http') === 0 ? $course['image'] : '/onlinecourse/assets/uploads/courses/' . $course['image'])
                        : '/onlinecourse/assets/image/course/default.png';
                ?>

                <div class="course-progress-card">
                    <div class="progress-img-wrapper">
                        <img src="<?= htmlspecialchars($imgSrc) ?>" alt="Course Image" class="progress-course-img">
                    </div>

                    <div class="progress-content-wrapper">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h4 class="course-title-lg"><?= htmlspecialchars($course['title']) ?></h4>
                                <div class="teacher-name-sm"><?= htmlspecialchars($course['instructor_name']) ?></div>
                                <div class="progress-status-text">
                                    Tiến độ: Chương <?= $course['current_chapter'] ?> / Chương <?= $course['total_chapters'] ?>
                                </div>
                            </div>
                        </div>

                        <div>
                            <a href="/onlinecourse/index.php?controller=lesson&action=view&course_id=<?= $course['course_id'] ?>" class="btn-continue-purple">
                                <i class="fas fa-play me-2" style="font-size: 0.8rem;"></i> Tiếp tục học
                            </a>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-info text-center py-5" style="border-radius: 15px; background-color: #e3f2fd; border: none;">
                <i class="fas fa-graduation-cap fa-3x mb-3 text-primary opacity-50"></i>
                <h4 class="fw-bold text-dark">Bạn chưa đăng ký khóa học nào.</h4>
                <a href="/onlinecourse/index.php?controller=student&action=dashboard" class="btn btn-primary mt-3 px-4 rounded-pill fw-bold">Khám phá ngay</a>
            </div>
        <?php endif; ?>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<?php require_once 'views/users/manage.php'; ?>
<?php require_once 'views/layouts/footer.php'; ?>
<?php require_once 'views/instructor/materials/upload_student.php'; ?>
