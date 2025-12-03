<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - EasyStudy </title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">

</head>
<body>
    <div class ="container">
        <div class = "img-text">
            <div class = "logo-container">
                <h1>Khám phá thế giới
                    <br> Kiến thức mới
                </h1>
            </div>
        </div>

        <div class = "form-section">
            <img src="../assets/avatars/logologin.png" alt="EasyStudy" class="logo">
                <p class = "title-logo">
                    Nền tảng học trực tuyến số 1 Việt Nam
                </p>
            </div>

            <div class="auth-tabs">
                <a href="#" class="tab active">Đăng nhập</a>
                <a href="#" class="tab">Đăng ký</a>
            </div>


            <form action = "#" method = "POST">
                <div class = "form-group">
                    <label class = "form-label">Tên đăng nhập hoặc Email</label>
                    <div class = "input-login">
                        
                        <input type = "text" class = "form-input" placeholder = "Nhập tên đăng nhập hoặc email" required>
                        <i class="fa-regular fa-user input-icon"></i>
                    </div>
                </div>
                <div class = "form-group">
                    <label class = "form-label">Mật khẩu</label>
                    <div class = "input-login">
                        
                        <input type = "text" class = "form-input" placeholder = "Nhập mật khẩu" required>
                        <i class="fa-regular fa-eye"></i>
                    </div>
                </div>

                <div class = "form-action">
                    <label class = "rmb-me"><input type = "checkbox">Nhớ mật khẩu</label>
                    <a href = "#" class ="forgot-password">Quên mật khẩu ?</a>

                </div>

                <button type = "submit" class = "login-btn">Đăng nhập</button>
                <div class ="or-login">Hoặc đăng nhập với</div>
                <div class = "social-login">
                    <a href = "#" class = "btn-social btn-google"><i class="fa-brands fa-google"></i>Google</a>
                    <a href="#" class="btn-social btn-facebook"><i class="fa-brands fa-facebook-f"></i>Facebook</a>
                </div>

                <div class="signup-link">Bạn chưa có tài khoản ? <a href="#">Tạo tài khoản mới</a></div>
            </form>
        </div>

        
    </div>
</body>
</html>