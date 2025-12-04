<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập - EasyStudy</title>
    <link rel="stylesheet" href="/onlinecourse/assets/css/auth.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

</head>
<body>
    <div class="container">
        <div class="left-panel">
            <div class="text-overlay">
                <p class="big-text">Khám Phá Thế Giới
                    <br> Kiến Thức Mới
                </p>
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
                <button class="switch-btn active">Đăng nhập</button>
                <button onclick="window.location.href='register.php'" class="switch-btn">Đăng ký</button>
            </div>

            <form class="login-form" action="index.php?controller=auth&action=login" method="POST">
                <div class="form-group">
                    <label for="username">Tên đăng nhập hoặc Email</label>
                    <div class="input-container">
                        <input type="text" id="username" name="username" placeholder="Nhập tên đăng nhập hoặc email" required>
                        <i class="fa-regular fa-user"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <div class="input-container">
                        <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required>
                        <i class="fa-regular fa-eye-slash"></i>
                    </div>
                </div>

                <div class="form-options">
                    <label class="terms">
                        <input type="checkbox" name="remember">
                        Nhớ mật khẩu
                    </label>
                    <a href="./forgot.php" class="register-link" style="text-align: right;">Quên mật khẩu ?</a>
                </div>

                <button type="submit" class="btn-login">Đăng nhập</button>
            </form>

            <div class="divider">
                <span>Hoặc đăng nhập với</span>
            </div>
            <div class="social-login">

                <button class="btn-social">
                    <i class="fa-brands fa-google"></i>
                    Google
                </button>
                <button class="btn-social">
                    <i class="fa-brands fa-facebook-f"></i>
                    Facebook
                </button>
            </div>            
            <p class="register-link">Bạn chưa có tài khoản ? <a href="register.php">Tạo tài khoản mới</a></p>
        </div>
    </div>
  
</body>
</html>