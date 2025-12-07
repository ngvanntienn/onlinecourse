<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - EasyStudy</title>
    <link rel="stylesheet" href="/onlinecourse/assets/css/auth.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <style>
        .alert {
            padding: 12px;
            margin-bottom: 20px;
            margin-top: 20px;
            border-radius: 8px;
            font-size: 13px;
            text-align: center;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
        }


        .alert-success {
            background-color: #d1e7dd;
            color: #0f5132;
            border: 1px solid #badbcc;
        }


        .alert-danger {
            background-color: #f8d7da;
            color: #842029;
            border: 1px solid #f5c2c7;
        }
        .container {
            display: flex;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 1000px;
            width: 100%;
            height: 900px;
        }
    </style>
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
                <button onclick="window.location.href='/onlinecourse/index.php?controller=auth&action=login'" class="switch-btn">Đăng nhập</button>
                <button class="switch-btn active">Đăng ký</button>
            </div>

            <form class="register-form" action="/onlinecourse/index.php?controller=auth&action=register" method="POST">
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
                            <option value="2">Quản trị viên</option>
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
                <!-- thông báo -->
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                    </div>
                <?php endif; ?>
            </form>
            
            <p class="register-link">Đã có tài khoản ? <a href="/onlinecourse/index.php?controller=auth&action=login">Đăng nhập ngay</a></p>
        </div>
    </div>
</body>
</html>