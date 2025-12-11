<div class="container py-5">
    <h2 class="mb-4">Thêm bài học mới</h2>

    <form method="POST" action="">
        <div class="mb-3">
            <label class="form-label fw-bold">Tiêu đề bài học</label>
            <input type="text" class="form-control" name="title" required placeholder="Ví dụ: Giới thiệu về SQL">
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Link Video (URL)</label>
                <input type="text" class="form-control" name="video_url" placeholder="Youtube, Drive...">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Thứ tự hiển thị</label>
                <input type="number" class="form-control" name="order" value="0">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Nội dung chi tiết / Mô tả</label>
            <textarea class="form-control" name="content" rows="5" placeholder="Nhập nội dung bài học..."></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Lưu bài học</button>
        <a href="/onlinecourse/index.php?controller=lesson&action=manage&course_id=<?= $current_course_id ?>" class="btn btn-secondary">Hủy</a>
    </form>
</div>
