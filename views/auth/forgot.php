<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ForgotPassword - EasyStudy</title>
    <link rel="stylesheet" href="/onlinecourse/assets/css/auth.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <style>
        .form-heading {
            text-align: center;
            font-size: 28px;
            font-weight: 700;
            color: #333;
            margin-top: 10px;
            margin-bottom: 30px; 
        }
        

        .bottom-link {
            text-align: right;
            margin-top: 15px;
        }

        .bottom-link a {
            color: #e74c3c;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .bottom-link a:hover {
            color: #c0392b; 
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="left-panel register-mode">
        <div class="text-overlay">
            <p class="intro-text">
                Tham gia cùng hàng ngàn học viên và giảng viên
                 trên nền tảng học trực tuyến hàng đầu Việt Nam
            </p>
        </div>
    </div>
    <div class="right-panel">
        <div class="logo-container">
            <div class="logo-circle">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <h1 class="brand-name">EasyStudy</h1>
        </div>
        <p class="tagline">Nền tảng học trực tuyến số 1 Việt Nam</p>
        <h2 class="form-heading">Quên mật khẩu ?</h2>
        <form class="register-form" action="/onlinecourse/index.php?controller=auth&action=process_forgot" method="POST">
            <div class="form-group">
                <label for="email">Nhập Email để nhận mã</label>
                <div class="input-container">
                    <input type="email" id="email" name="email" placeholder="Nhập địa chỉ email" required>
                </div>
            </div>
            <div class="form-group">
                <label for="otp_code">Nhập mã vừa nhận</label>
                <div class="input-container">
                    <input type="text" id="otp_code" name="otp_code" placeholder="Nhập mã xác thực" required>
                </div>
            </div>
            <button type="submit" class="btn-login">Đăng nhập</button>
            <div class="bottom-link">
                <a href="/onlinecourse/index.php?controller=auth&action=changepass">Đổi mật khẩu mới ?</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>