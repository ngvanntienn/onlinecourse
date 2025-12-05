<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - EasyStudy</title>
    <link rel="stylesheet" href="/onlinecourse/assets/css/auth.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

</head>
<body>
    <div class="container">
        <div class="left-panel register-mode">
            <div class="text-overlay">

                <p class="intro-text">Tham gia cùng hàng ngàn học viên và giảng viên trên nền tảng học trực tuyến hàng đầu Việt Nam</p>
            </div>
        </div>
        <div class="right-panel">
            <div class="logo-container">
                <div class="logo-circle">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <h1 class="brand-name">EasyStudy</h1>
            </div>
            <p class="tagline">Nền tảng học trực tuyến số 1 Việt Nam</p>
            
            <div class="auth-switch">
                <button onclick="window.location.href='login.php'" class="switch-btn">Đăng nhập</button>
                <button class="switch-btn active">Đăng ký</button>
            </div>

            <form class="register-form" action="index.php?controller=auth&action=register" method="POST">
                <div class="form-group">
                    <label for="fullname">Họ và tên</label>
                    <div class="input-container">
                        <input type="text" id="fullname" name="fullname" placeholder="Nhập họ và tên đầy đủ">
                        <i class="fa-regular fa-id-card"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Địa chỉ email</label>
                    <div class="input-container">
                        <input type="email" id="email" name="email" placeholder="Nhập địa chỉ email">
                        <i class="fa-regular fa-envelope"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="username">Tên đăng nhập</label>
                    <div class="input-container">
                        <input type="text" id="username" name="username" placeholder="Nhập tên đăng nhập">
                        <i class="fa-regular fa-user"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <div class="input-container">
                        <input type="password" id="password" name="password" placeholder="Tạo mật khẩu">
                        <i class="fa-regular fa-eye-slash"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="role">Đăng ký với vai trò</label>
                    <div class="input-container">
                        <select id="role" name="role">
                            <option value="0">Học viên</option>
                            <option value="1">Giảng viên</option>
                        </select>
                        <i class="fa-solid fa-chevron-down select-arrow"></i>
                    </div>
                </div>

                <div class="form-options">
                    <label class="terms">
                        <input type="checkbox" required>
                        Tôi đồng ý với <a href="#">Điều khoản dịch vụ</a>
                    </label>
                </div>

                <button type="submit" class="btn-login">Đăng ký</button>
            </form>
            
            <p class="register-link">Đã có tài khoản ? <a href="./login.php">Đăng nhập ngay</a></p>
        </div>
    </div>
</body>
</html>