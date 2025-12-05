<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChangePassword - EasyStudy</title>
    <link rel="stylesheet" href="/onlinecourse/assets/css/auth.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <style>
        .form-heading {
            text-align: center;
            font-size: 28px;
            font-weight: 700;
            color: #333;
            margin-top: 10px;
            margin-bottom: 22px ; 
        }
    </style>
</head>
<body>

<div class="container">
    <div class="left-panel register-mode">
        <div class="text-overlay">
            <p class="intro-text">
                Tham gia cùng hàng ngàn học viên và giảng viên trên nền tảng học trực tuyến hàng đầu Việt Nam
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
        <h2 class="form-heading">Đổi mật khẩu</h2>

        <form class="register-form" action="index.php?controller=auth&action=process_changepass" method="POST">
            
            <div class="form-group">
                <label for="email">Nhập Email</label>
                <div class="input-container">
                    <input type="email" id="email" name="email" placeholder="Nhập địa chỉ email" required>
                </div>
            </div>
            <div class="form-group">
                <label for="new_password">Nhập mật khẩu mới</label>
                <div class="input-container">
                    <input type="password" id="new_password" name="new_password" placeholder="Nhập mật khẩu" required>
                </div>
                <div class="password-requirements">
                    Mật khẩu phải đủ 8 ký tự, bao gồm :
                    <ul>
                        <li>Ít nhất 1 ký tự viết hoa</li>
                        <li>Chữ cái và số</li>
                        <li>1 ký tự đặc biệt : @, #, ., _, %,....</li>
                    </ul>
                </div>
            </div>
            <div class="form-group">
                <label for="confirm_password">Nhập lại mật khẩu mới</label>
                <div class="input-container">
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Nhập mật khẩu" required>
                </div>
            </div>
            <button type="submit" class="btn-login">Đăng nhập</button>

        </form>
    </div>
</div>

</body>
</html>