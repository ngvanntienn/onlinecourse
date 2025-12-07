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
        .valid { 
            color: green; 
        }
        .invalid { 
            color: red; 
        }
        /* Thông báo lỗi và thành công */
        .alert {
            padding: 10px 15px;
            margin-bottom: 15px;
            border-radius: 5px;
            font-size: 14px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="left-panel register-mode">
            <div class="text-overlay">
                <p class="intro-text">
                    Tham gia cùng hàng ngàn học viên và giảng viên trên 
                    nền tảng học trực tuyến hàng đầu Việt Nam
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
            <p class="tagline">Nền tảng học trực tuyến s
                ố 1 Việt Nam</p>
            <h2 class="form-heading">Đổi mật khẩu</h2>

            <!-- Thông báo lỗi hoặc thành công -->
            <?php if(isset($_SESSION['error'])): ?>
                <div class="alert alert-error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
            <?php endif; ?>
            <?php if(isset($_SESSION['success'])): ?>
                <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
            <?php endif; ?>

            <form class="register-form" action="/onlinecourse/index.php?controller=auth&action=process_changepass" method="POST">

                <div class="form-group">
                    <label for="new_password">Nhập mật khẩu mới</label>
                    <div class="input-container">
                        <input type="password" id="new_password" name="new_password" placeholder="Nhập mật khẩu" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Nhập lại mật khẩu mới</label>
                    <div class="input-container">
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="Nhập mật khẩu" required>
                    </div>
                </div>

                <!-- checklist mật khẩu -->
                <div class="password-requirements">
                    <p>Mật khẩu phải đủ 8 ký tự, bao gồm:</p>
                    <ul>
                        <li id="length" class="invalid">Ít nhất 8 ký tự</li>
                        <li id="uppercase" class="invalid">Ít nhất 1 chữ hoa</li>
                        <li id="number" class="invalid">Ít nhất 1 số</li>
                        <li id="special" class="invalid">Ít nhất 1 ký tự đặc biệt (@,#,.,_,%,...)</li>
                    </ul>
                </div>

                <button type="submit" class="btn-login">Đổi mật khẩu</button>

            </form>
        </div>
    </div>
    <script src = "assets/js/script.js"></script>
</body>
</html>
