<style>
    .site-footer {
        background-color: #2c282bed;
        color: #e0e0e0;
        padding: 20px 0 25px;
    }

    .footer-logo-wrapper {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 15px;
    }

    .logo-circle {
        font-weight: 800;
        color: #692e8e;
        font-size: 1.8rem;
        display: flex;
        align-items: center;
    }

    .footer-logo-text { 
        font-size: 3rem;
        font-weight: 800;
        color: white;
        letter-spacing: 1px;
    }

    .site-footer p {
        font-size: 1.1rem;
        color: #b0b0b0;
        line-height: 1.6;
        max-width: 300px;
    }

    .footer-column h3 {
        font-size: 1.5rem;
        margin-bottom: 35px;
        color: #fff;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        position: relative;
    }

    /* các thanh cho about course */
    .footer-column h3::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 40px;
        height: 3px;
        background-color: #be93fd;
        border-radius: 2px;
    }

    .footer-column ul {
        list-style: none;
        padding: 0;

    }

    .footer-column ul li {
        margin-bottom: 18px;
    }

    .footer-column ul li::before {
        content: none; 
    }

    .footer-column ul li a {
        color: #b0b0b0;
        text-decoration: none;
        font-size: 1.4rem;
        transition: all 0.3s ease;
        display: inline-block;

    }

    .footer-column ul li a:hover {
        color: #fff;
        transform: translateX(8px);
        text-shadow: 0 0 10px rgba(190, 147, 253, 0.5);
    }

    .footer-bottom {
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        margin-top: 60px;
        padding-top: 30px;
        text-align: center;
        color: #888;
        font-size: 1.3rem;
    }

    .footer-bottom a {
        color: #aaa;
        text-decoration: none;
        margin: 0 20px;
        font-weight: 500;
        transition: color 0.3s;
        font-size: 1.4rem;
    }

    .footer-bottom a:hover {
        color: #be93fd;
    }

</style>
<footer class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="footer-logo-wrapper">
                    <div class="logo-circle"><i class="fas fa-graduation-cap"></i></div>
                    <span style="font-size: 2.2rem; font-weight: bold; color: #692e8e;">EasyStudy</span>
                </div>
                <p style = "font-size: 26px;">Nền tảng học tập trực tuyến hàng đầu Việt Nam.</p>
            </div>

            <div class="col-md-4 mb-4">
                <div class="footer-column">
                    <h3>About Us</h3>
                    <ul>

                        <li><a href="#">Đội ngũ</a></li>
                        <li><a href="#">Tuyển dụng</a></li>
                        <li><a href="#">Thông tin liên hệ & Hóa đơn</a></li>
                        <li><a href="#">Điều khoản dịch vụ</a></li>
                        <li><a href="#">Chính sách bảo mật</a></li>
                        <li><a href="#">Hợp tác với EasyStudy</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="footer-column">
                    <h3>Các khóa học</h3>
                    <ul>
                        <li><a href="#">Toán học (theo lớp)</a></li>
                        <li><a href="#">Toán học (theo chuyên đề)</a></li>
                        <li><a href="#">Kỹ năng đời sống</a></li>
                        <li><a href="#">Khoa học máy tính và lập trình</a></li>
                        <li><a href="#">Dành cho giáo viên & Quản lý</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <a href="#">Chính sách và quyền riêng tư</a> |
            <a href="#">Cookies</a> |
            <a href="#">Điều khoản sử dụng</a>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>