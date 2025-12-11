<div class="modal fade" id="accountInfoModal" tabindex="-1" aria-labelledby="accountInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header bg-purple text-white">
                <h5 class="modal-title" id="accountInfoModalLabel">Thông tin tài khoản</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="/onlinecourse/index.php?controller=auth&action=updateProfile">
                <div class="modal-body">
                    <?php
                    $userModel = new User();
                    $userId = $_SESSION['user_id'];
                    $user = $userModel->getUserById($userId);
                    ?>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Họ và tên</label>
                            <input type="text" class="form-control" name="fullname" value="<?= htmlspecialchars($user['fullname']) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tên đăng nhập</label>
                            <input type="text" class="form-control" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Vai trò</label>
                            <input type="text" class="form-control" value="<?= $user['role'] == 2 ? 'Admin' : ($user['role'] == 1 ? 'Giảng viên' : 'Học viên') ?>" disabled>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>