<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyStudy Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <link rel="stylesheet" href="./style.css">

</head>
<body>
    <div class="card-container">
        <div class="left-column">
            <div class="image-overlay">
                <h2>Khám Phá Thế Giới<br>Kiến Thức Mới</h2>
            </div>
            
        </div>

        <div class="right-column">
            
            <div class="brand-section">
                <i class="fa-solid fa-graduation-cap logo-icon" >EasyStudy</i>
                <p class="slogan">Nền tảng học trực tuyến số 1 Việt Nam</p>
            </div>

            <div class="tabs-container">
                <div class="tabs-wrapper">
                    <button class="tab-btn active">Đăng nhập</button>
                    <button class="tab-btn">Đăng ký</button>
                </div>
            </div>

            <form action="#" class="login-form">
                
                <div class="form-group">
                    <label>Tên đăng nhập hoặc Email</label>
                    <div class="input-wrapper">
                        <input type="text" placeholder="Nhập tên đăng nhập hoặc email">
                        <i class="fa-regular fa-user icon-right"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label>Mật khẩu</label>
                    <div class="input-wrapper">
                        <input type="password" placeholder="Nhập mật khẩu">
                        <i class="fa-regular fa-eye-slash icon-right"></i>
                    </div>
                </div>

                <div class="form-actions">
                    <label class="checkbox-wrapper">
                        <input type="checkbox"> 
                        <span>Nhớ mật khẩu</span>
                    </label>
                    <a href="#" class="forgot-link">Quên mật khẩu ?</a>
                </div>

                <button type="submit" class="btn-primary">Đăng nhập</button>
            </form>

            <div class="divider">
                <span>Hoặc đăng nhập với</span>
            </div>

            <div class="social-buttons">
                <button class="btn-social">
                    <i class="fa-brands fa-google"></i>
                    Google
                </button>
    <button class="btn-social">
                    <i class="fa-brands fa-facebook-f"></i>
                    Facebook
                </button>
            </div>

            <div class="footer-text">
                Bạn chưa có tài khoản ? <a href="#">Tạo tài khoản mới</a>
            </div>
    </div>
</body>
</html>           