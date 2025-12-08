<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>ForgotPass - EasyStudy</title>
    <link rel="stylesheet" href="/onlinecourse/assets/css/auth.css?v=<?= time() ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <style>
        .form-heading { 
            text-align: center; 
            font-size: 28px; 
            font-weight: 700; color: #333; 
            margin: 10px 0 30px; 
        }
        .bottom-link { 
            text-align: right; 
            margin-top: 15px; }
        .bottom-link a { 
            color: #e74c3c; 
            font-weight: 600; 
            text-decoration: none; 
            font-size: 1rem;
        }
        /* modal otp */
        .modal-overlay {
            display: none; 
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.6); z-index: 9999;
            justify-content: center; align-items: center;
        }
        .modal-box {
            background: #fff; padding: 30px; border-radius: 12px;
            width: 400px; text-align: center;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3); position: relative;
            animation: slideDown 0.3s;
        }
        .close-modal { 
            position: absolute; 
            top: 15px; 
            right: 20px; 
            font-size: 24px; 
            cursor: pointer; 
            color: #aaa; 
        }
        .otp-display {
            background: #e8f5e9; 
            color: #2e7d32; 
            border: 1px dashed #2e7d32;
            padding: 15px; 
            margin: 20px 0; 
            font-weight: bold; 
            font-size: 1.2rem; 
            border-radius: 8px;
        }
    </style>
</head>
<body>

<?php
    $emailValue = '';
    if (isset($_SESSION['otp_email'])) {
        $emailValue = $_SESSION['otp_email'];
        if (!isset($_SESSION['show_otp_modal'])) {
            unset($_SESSION['otp_email']);
        }
    }
    ?>

    <div id="otpModal" class="modal-overlay">
        <div class="modal-box">
            <span class="close-modal" onclick="closeModal()">&times;</span>
            <h3 style="color: #333; font-size: 1.5rem;">Mã xác thực của bạn</h3>
            
            <?php if(isset($_SESSION['otp_code'])): ?>
                <div class="otp-display">
                    <?= $_SESSION['otp_code']; ?>
                </div>
            <?php endif; ?>
            <button onclick="closeModal()" class="btn-login" style="margin-top: 10px; width: 100px;">Đóng</button>
        </div>
    </div>

    <div class="container">
        <div class="left-panel register-mode">
            <div class="text-overlay">
                <p class="intro-text">Lấy lại mật khẩu dễ dàng với EasyStudy</p>
            </div>
        </div>
        <div class="right-panel">
            <div class="logo-container">
                <div class="logo-circle"><i class="fas fa-graduation-cap"></i></div>
                <h1 class="brand-name">EasyStudy</h1>
            </div>
            
            <h2 class="form-heading">Quên mật khẩu?</h2>

            <?php if(isset($_SESSION['error'])): ?>
                <div style="color: red; text-align: center; margin-bottom: 10px;">
                    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <?php if(isset($_SESSION['success'])): ?>
                <div style="color: green; text-align: center; margin-bottom: 10px;">
                    <?= $_SESSION['success']; unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>

            <form id="forgotForm" class="register-form" action="/onlinecourse/index.php?controller=auth&action=verify_otp_process" method="POST">
                <div class="form-group">
                    <label for="email">Nhập Email để nhận mã</label>
                    <div class="input-container">
                        <input type="email" id="email" name="email" 
                            value="<?= $emailValue ?>" 
                            placeholder="Nhập địa chỉ email" required>
                    </div>
                    <button type="button" id="btnSend" class="btn-send-code" onclick="sendOtp()">Gửi mã xác nhận</button>
                    <div style="clear: both;"></div> 
                </div>

                <div class="form-group" style="margin-top: 20px;">
                    <label for="otp_code">Nhập mã vừa nhận</label>
                    <div class="input-container">
                        <input type="text" id="otp_code" name="otp_code" placeholder="Nhập mã 6 số" autocomplete="off">
                    </div>
                </div>

                <button type="submit" class="btn-login">Xác nhận & Đổi mật khẩu</button>
                
                <div class="bottom-link">
                    <a href="/onlinecourse/index.php?controller=auth&action=login">Quay lại đăng nhập</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        const btnSend = document.getElementById('btnSend');
        const form = document.getElementById('forgotForm');
        
        function sendOtp() {
            const email = document.getElementById('email').value;
            if (!email) { alert("Vui lòng nhập Email!"); return; }
            form.action = "/onlinecourse/index.php?controller=auth&action=send_otp";
            form.submit();
        }

        function closeModal(){ 
            document.getElementById('otpModal').style.display='none'; 
        }

        // Hiển thị modal OTP nếu cần
        <?php if(isset($_SESSION['show_otp_modal'])): ?>
        document.getElementById('otpModal').style.display='flex';
        <?php unset($_SESSION['show_otp_modal']); endif; ?>
        
        // Khóa gửi mã 10s
        <?php if(isset($_SESSION['start_timer'])): ?>
        let timeLeft = 10;
        btnSend.disabled = true;
        btnSend.innerText = `Gửi lại sau (${timeLeft}s)`;
        const timer = setInterval(()=>{
            timeLeft--;
            btnSend.innerText = `Gửi lại sau (${timeLeft}s)`;
            if(timeLeft<=0){clearInterval(timer);btnSend.disabled=false;btnSend.innerText="Gửi mã xác nhận";}
        },1000);
        <?php unset($_SESSION['start_timer']); endif; ?>
    </script>

</body>
</html>