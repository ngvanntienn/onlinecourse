<form action="index.php?controller=auth&action=register" method="POST" autocomplete="off">
    <div class="mb-3">
        <input type="text" name="fullname" placeholder="Họ và tên" class="form-control" required>
    </div>
    <div class="mb-3">
        <input type="text" name="username" placeholder="Tên đăng nhập" class="form-control" required>
    </div>
    <div class="mb-3">
        <input type="email" name="email" placeholder="Email" class="form-control" required>
    </div>
    <div class="mb-3">
        <input type="password" name="password" placeholder="Mật khẩu" class="form-control" required autocomplete="new-password">
    </div>
    <div class="mb-3">
        <input type="password" name="confirm_password" placeholder="Nhập lại mật khẩu" class="form-control" required autocomplete="new-password">
    </div>
    <button type="submit" class="btn btn-purple w-100">Đăng ký</button>
</form>
<p class="text-center mt-2">
    <a href="index.php?controller=auth&action=login">Đăng nhập</a>
</p>
