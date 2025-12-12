<?php require_once 'views/layouts/header_students.php'; ?>

<style>
    body {
        background-color: #f5f7fa;
        padding-top: 140px; 
    }

    .page-header-block h2 {
        font-size: 2.5rem;
        font-weight: 800;
        color: #000000ff;
        margin-bottom: 12px;
    }

    .page-header-block p {
        font-size: 1.5rem;
        color: #6c757d;
        margin-bottom: 0;
    }
    .course-card-wrapper {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid #eef0f2;
        transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.3s ease;
        display: flex;
        flex-direction: column;
        height: 100%;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.66);
    }

    .course-card-wrapper:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        border-color: #fff;
    }

    .card-thumb-box {
        position: relative;
        height: 180px;
        overflow: hidden;
    }

    .card-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .course-card-wrapper:hover .card-img {
        transform: scale(1.1);
    }

    .badge-status {
        position: absolute;
        top: 12px;
        right: 12px;
        background: rgba(40, 167, 69, 0.95);
        color: #fff;
        font-size: 0.8rem;
        font-weight: 700;
        padding: 5px 12px;
        border-radius: 50px;
        backdrop-filter: blur(4px);
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }

    .card-content {
        padding: 24px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .course-name {
        font-size: 1.3rem;
        font-weight: 700;
        color: #080808ff;
        margin-bottom: 12px;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        height: 3.2rem;
    }

    .teacher-info {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.95rem;
        color: #202020ff;
        margin-bottom: 20px;
    }

    .teacher-avatar-sm {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        object-fit: cover;
    }

    .progress-section {
        margin-top: auto;
    }

    .progress-labels {
        display: flex;
        justify-content: space-between;
        font-size: 0.9rem;
        font-weight: 600;
        color: #555;
        margin-bottom: 6px;
    }

    .progress-bar-bg {
        height: 8px;
        background-color: #ecf0f1;
        border-radius: 10px;
        overflow: hidden;
    }

    .progress-bar-fill {
        height: 100%;
        background: linear-gradient(90deg, #d63384, #ff6b6b);
        border-radius: 10px;
        transition: width 0.5s ease;
    }

    .card-action {
        padding: 15px 24px 24px;
        background: #fff;
    }

    .btn-course-action {
        display: block;
        width: 100%;
        text-align: center;
        padding: 10px 0;
        border-radius: 50px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .btn-start {
        background: linear-gradient(90deg, #c466eaff, #882cd4ff);
        color: #fff;
        box-shadow: 0 4px 15px rgba(214, 51, 132, 0.3);
    }

    .btn-start:hover {
        background: linear-gradient(90deg, #c21b6c, #d81b60);
        transform: translateY(-2px);
        color: #fff;
    }

    .btn-continue {
        background: #fff;
        color: #d63384;
        border-color: #d63384;
    }

    .btn-continue:hover {
        background: #d63384;
        color: #fff;
    }
</style>

<div class="page-header-block">
    <div class="container">
        <h2 class="fw-bold mb-2 text-dark" style="margin-top: 20px;">Khóa học của tôi</h2>
        <p class="text-muted mb-0" style="font-size: 1.4rem;">
            Chào mừng trở lại! Bạn đang có <strong class="text-primary"><?= count($enrolledCourses ?? []) ?></strong> khóa học đang kích hoạt.
        </p>
    </div>
</div>

<div class="container pb-5">
    
    <?php if(isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show mb-4 shadow-sm border-0" role="alert" style="border-radius: 12px;">
            <i class="fas fa-check-circle me-2"></i> <?= $_SESSION['success']; unset($_SESSION['success']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row g-4">
        <?php if (!empty($enrolledCourses)): ?>
            <?php foreach ($enrolledCourses as $course): ?>
                <?php 
                    $imgSrc = !empty($course['image']) 
                        ? (strpos($course['image'], 'http') === 0 ? $course['image'] : '/onlinecourse/assets/uploads/courses/' . $course['image'])
                        : '/onlinecourse/assets/image/course/default.png';
                    $percent = $course['progress_percent'] ?? 0;
                ?>

                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="course-card-wrapper">
                        <div class="card-thumb-box">
                            <img src="<?= htmlspecialchars($imgSrc) ?>" class="card-img" alt="Course Image">
                            <?php if($percent >= 100): ?>
                                <span class="badge-status"><i class="fas fa-check me-1"></i> Hoàn thành</span>
                            <?php endif; ?>
                        </div>

                        <div class="card-content">
                            <h5 class="course-name" title="<?= htmlspecialchars($course['title']) ?>">
                                <?= htmlspecialchars($course['title']) ?>
                            </h5>
                            
                            <div class="teacher-info">
                                <img src="https://ui-avatars.com/api/?name=<?= urlencode($course['instructor_name']) ?>&background=random" class="teacher-avatar-sm">
                                <span><?= htmlspecialchars($course['instructor_name']) ?></span>
                            </div>

                            <div class="progress-section">
                                <div class="progress-labels">
                                    <span><?= $percent ?>% hoàn thành</span>
                                    <span><?= $course['current_chapter'] ?>/<?= $course['total_chapters'] ?> bài</span>
                                </div>
                                <div class="progress-bar-bg">
                                    <div class="progress-bar-fill" style="width: <?= $percent ?>%"></div>
                                </div>
                            </div>
                        </div>

                        <div class="card-action">
                            <?php if($percent > 0): ?>
                                <a href="/onlinecourse/index.php?controller=lesson&action=view&course_id=<?= $course['course_id'] ?>" 
                                   class="btn-course-action btn-continue">
                                    <i class="fas fa-play me-1"></i> Tiếp tục học
                                </a>
                            <?php else: ?>
                                <a href="/onlinecourse/index.php?controller=lesson&action=view&course_id=<?= $course['course_id'] ?>" 
                                   class="btn-course-action btn-start">
                                    Bắt đầu học
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="text-center py-5 bg-white rounded-4 shadow-sm">
                    <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="120" class="mb-4 opacity-75">
                    <h3 class="fw-bold text-dark">Bạn chưa đăng ký khóa học nào</h3>
                    <p class="text-muted mb-4">Khám phá ngay kho tàng kiến thức để nâng cấp bản thân!</p>
                    <a href="/onlinecourse/index.php?controller=student&action=dashboard" 
                       class="btn btn-primary btn-lg rounded-pill px-5 fw-bold">
                        Khám phá khóa học
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<?php require_once 'views/users/manage.php'; ?>
<?php require_once 'views/layouts/footer.php'; ?>
<?php require_once 'views/instructor/materials/upload_student.php'; ?>

