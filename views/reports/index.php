<div class="container mt-4">
    <h2 class="mb-4">Danh sách đánh giá của học viên</h2>

    <?php if (!empty($reviews)): ?>
        <?php foreach ($reviews as $r): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h5><?php echo htmlspecialchars($r['name']); ?></h5>
                    <p><?php echo nl2br(htmlspecialchars($r['content'])); ?></p>
                    <small class="text-muted">Ngày gửi: <?php echo $r['created_at']; ?></small>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="alert alert-info">Chưa có đánh giá nào.</div>
    <?php endif; ?>
</div>
