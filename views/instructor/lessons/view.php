<?php require_once 'views/layouts/header_students.php'; ?>

<style>
    body {
        background-color: #f0f2f5;
        padding-top: 90px;
    }

    /* GIAO DIỆN HỌC TẬP */
    .learning-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 15px;
    }

    /* VIDEO PLAYER */
    .video-section {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        overflow: hidden;
        margin-bottom: 30px;
    }

    .video-player-wrapper {
        background-color: #000;
        position: relative;
        padding-bottom: 56.25%;
        height: 0;
        width: 100%;
    }

    .video-player-wrapper iframe {
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        border: none;
    }

    .lesson-info-box {
        padding: 25px 30px;
    }

    .lesson-title-main {
        font-size: 1.6rem;
        font-weight: 700;
        color: #2d2f31;
        margin-bottom: 15px;
    }

    .lesson-desc-box {
        background-color: #f8f9fa;
        border-radius: 12px;
        padding: 20px;
        color: #555;
        line-height: 1.6;
        border-left: 4px solid #d63384;
    }

    /* Nút điều hướng */
    .nav-buttons {
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .btn-back {
        background: #fff;
        border: 1px solid #ddd;
        color: #555;
        padding: 8px 16px;
        border-radius: 30px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        margin-top: 50px;
        align-items: center;
        font-size: 1.6rem;
        transition: all 0.2s;
    }

    .btn-back:hover {
        background: #f1f1f1;
        color: #000;
        border-color: #ccc;
    }

    /* DANH SÁCH BÀI HỌC */
    .playlist-wrapper {
        background: #fff;
        border-radius: 16px;
        position: sticky;
        top: 12px; 
        height: calc(100vh - 12px);
        display: flex;
        flex-direction: column;
    }

    .playlist-header {
        padding: 20px;
        background: #47bf43ff;
        color: #fff;
        border-bottom: 1px solid #3e4143;
    }

    .playlist-scroll-area {
        flex: 1;
        overflow-y: auto;
        padding: 0;
        background: #fff;
    }

    .lesson-item {
        display: flex;
        padding: 15px 20px;
        border-bottom: 1px solid #f0f0f0;
        cursor: pointer;
        text-decoration: none;
        color: #444;
        align-items: flex-start;
        transition: all 0.2s;
    }

    .lesson-item:hover {
        background-color: #f8f9fa;
    }

    .lesson-item.active {
        background-color: #fff0f6;
        border-left: 4px solid #d63384;
    }

    .lesson-item.active .lesson-name {
        color: #d63384;
        font-weight: 700;
    }

    .lesson-number {
        font-size: 0.9rem;
        color: #888;
        margin-right: 12px;
        margin-top: 3px;
        min-width: 20px;
    }

    .lesson-content {
        flex: 1;
    }

    .lesson-name {
        font-size: 0.95rem;
        line-height: 1.4;
        margin-bottom: 4px;
        display: block;
    }

    /* Responsive */
    @media (max-width: 991px) {
        .playlist-wrapper {
            position: relative;
            top: 0;
            height: auto;
            max-height: 500px;
            margin-top: 20px;
        }
    }
    .lesson-info-box ul li a {
    display: flex;
    align-items: center;
    color: #2d2f31;
    transition: color 0.2s;
}

.lesson-info-box ul li a:hover {
    color: #d63384;
}

.lesson-info-box h5 {
    font-size: 1.3rem;
}

</style>

<div class="learning-container">
    <div class="row">
        <div class="col-lg-8">
            <div class="nav-buttons">
                <a href="/onlinecourse/index.php?controller=student&action=progress" class="btn-back">
                    <i class="fas fa-arrow-left me-2" style="font-size: 1.4rem;"></i> Bạn có thể quay lại
                </a>
            </div>

            <div class="video-section">
    <?php if ($currentLesson): ?>
        <div class="video-player-wrapper">
            <iframe src="<?= htmlspecialchars($currentLesson['video_url'] ?? '') ?>" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                    allowfullscreen>
            </iframe>
        </div>

        <!-- PHẦN TÀI LIỆU ĐÍNH KÈM -->
        <?php if (!empty($lessonMaterials)): ?>
    <div class="lesson-info-box">
        <h5 class="mb-3 fw-bold">Tài liệu đính kèm</h5>
        <ul class="list-unstyled">
            <?php foreach ($lessonMaterials as $material): ?>
                <li class="mb-2">
                    <a href="/onlinecourse/<?= htmlspecialchars($material['file_path']) ?>" target="_blank" class="text-decoration-none">
    <i class="fas fa-file-alt me-2"></i>
    <?= htmlspecialchars($material['filename']) ?>
    <small class="text-muted">(<?= htmlspecialchars($material['file_type']) ?>)</small>
</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

    <?php else: ?>
        <div class="text-center py-5 px-3">
            <img src="https://cdn-icons-png.flaticon.com/512/3255/3255675.png" width="80" class="mb-3 opacity-75">
            <h4 class="fw-bold text-dark">Đang cập nhật bài giảng</h4>
            <p class="text-muted">Giáo viên đang biên soạn nội dung cho phần này.</p>
            <a href="/onlinecourse/index.php?controller=student&action=progress" class="btn btn-outline-primary rounded-pill mt-2" style="font-size: 1.2rem;">
                Quay lại sau nhé
            </a>
        </div>
    <?php endif; ?>
</div>

        </div>

        <div class="col-lg-4">
            <div class="playlist-wrapper">
                <div class="playlist-header">
                    <h5 class="mb-1 fw-bold">Nội dung khóa học</h5>
                    <small class="opacity-75">
                        <?= count($lessons) ?> bài học • <?= htmlspecialchars($course['title']) ?>
                    </small>
                </div>

                <div class="playlist-scroll-area">
                    <?php if (!empty($lessons)): ?>
                        <?php foreach ($lessons as $index => $lesson): ?>
                            <?php 
                                $isActive = ($currentLesson && $lesson['id'] == $currentLesson['id']);
                                $activeClass = $isActive ? 'active' : '';
                                $lessonUrl = "index.php?controller=lesson&action=view&course_id={$course['id']}&lesson_id={$lesson['id']}";
                                $displayIndex = $index + 1;
                            ?>
                            <a href="<?= $lessonUrl ?>" class="lesson-item <?= $activeClass ?>">
                                <div class="lesson-number">
                                    <?php if($isActive): ?>
                                        <i class="fas fa-play icon-status" style="font-size: 0.8rem;"></i>
                                    <?php else: ?>
                                        <?= $displayIndex ?>
                                    <?php endif; ?>
                                </div>
                                <div class="lesson-content">
                                    <span class="lesson-name" style="font-size: 1.25rem;"><?= htmlspecialchars($lesson['title']) ?></span>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center py-5 text-muted">
                            <i class="fas fa-inbox fa-2x mb-2 opacity-50"></i>
                            <p>Danh sách trống</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<?php require_once 'views/users/manage.php'; ?>
<?php require_once 'views/layouts/footer.php'; ?>
<?php require_once 'views/instructor/materials/upload_student.php'; ?>

