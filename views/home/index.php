<?php require_once 'views/layouts/header.php'; ?>

<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 mb-5 mb-md-0">
                <h1 class="hero-title"><span class = "text-title">Học trực tuyến</span> trở nên <br> dễ dàng hơn</h1>
                <p class="hero-subtitle">EasyStudy là một nền tảng thú vị sẽ giúp bạn học tốt theo nhiều phương thức khác nhau.</p>
                <div class="mt-4">
                    <a href = "/onlinecourse/views/auth/login.php" class="btn btn-hero-pink">Đăng nhập</a>
                    <button class="btn btn-hero-watch"><i class="fas fa-play-circle"></i> Xem khóa học</button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="hero-image-wrapper">
                    <img src="/onlinecourse/assets/image/hero/student.png" alt="Student" class="img-fluid hero-girl-img">
                    <div class="floating-card card-1">
                        <div class="bg-primary text-white p-2 rounded me-2"><i class="fas fa-calendar-alt"></i></div>
                        <div><strong>250k</strong><br><small>Học viên đã tham gia</small></div>
                    </div>
                    <div class="floating-card card-2 bg-danger text-white"><i class="fas fa-chart-bar"></i></div>
                    <div class="floating-card card-3">
                        <div class="bg-warning text-white p-2 rounded me-2"><i class="fas fa-envelope"></i></div>
                        <div><strong>Chúc mừng</strong><br><small>Khóa học đã hoàn thành</small></div>
                    </div>
                    <div class="floating-card card-4">
                        <div class="d-flex align-items-center mb-2">
                            <img src="/onlinecourse/assets/image/hero/npt.png" class="rounded-circle me-2" width="30">
                            <div class="text-start"><strong>Lớp học trải nghiệm Toán 12</strong><br><small class="text-muted">12:00 Hôm nay</small></div>
                        </div>
                        <button class="btn btn-sm btn-danger w-100 rounded-pill">Tham gia</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="stats-section">
    <div class="container">
        <h2 class="stats-title">Thành Tựu</h2>
        <p class="text-muted w-75 mx-auto mb-5">Những cột mốc quan trọng mà cộng đồng học viên luôn tự hào.</p>
        <div class="row">
            <div class="col-md-3"> <div class="stat-number">50K+</div> <p>Học viên đã tin tưởng
            <br>Những lĩnh vực đã học<br> ở các lĩnh vực khác nhau
            </p> </div>
            <div class="col-md-3"> <div class="stat-number">98%</div> <p>Học viên và Giáo viên<br>hài lòng</p> </div>
            <div class="col-md-3"> <div class="stat-number">100+</div> <p>Giảng viên chất lượng<br>lượng giảng dạy tốt</p> </div>
            <div class="col-md-3"> <div class="stat-number">200+</div> <p>Khóa học đảm bảo<br> kết quả đầu ra</p> </div>
        </div>
    </div>
</section>

<section class="about-section">
    <div class="container">
        <div class="text-center mb-5">
            <span class="brand-text-style">EasyStudy</span> <span class="section-title-large">là gì ?</span>
            <p class="mt-3 text-muted w-75 mx-auto">EasyStudy là nền tảng học trực tuyến được xây dựng với mục tiêu mang đến cho 
                người học trải nghiệm giáo dục hiện đại, linh hoạt và hiệu quả. Chúng tôi tập trung phát triển các khóa học chất lượng cao, bám sát 
                nhu cầu thực tế, giúp học viên dễ dàng tiếp cận kiến thức mới và nâng cao kỹ năng trong thời gian ngắn nhất.
                Với hệ thống bài giảng được thiết kế bởi đội ngũ giảng viên uy tín, giao diện thân thiện và lộ trình học rõ ràng, EasyStudy 
                tạo điều kiện để mỗi người có thể học tập theo nhịp độ của riêng mình, mọi lúc, mọi nơi. Không chỉ dừng lại ở việc truyền tải kiến thức, 
                nền tảng còn cung cấp các bài tập thực hành, tài liệu bổ trợ và chứng chỉ hoàn thành nhằm giúp học viên tự tin áp dụng vào công việc và cuộc sống.
                EasyStudy hướng đến một cộng đồng học tập năng động, nơi mọi người có thể phát triển bản thân, theo đuổi đam mê và chinh 
                phục những mục tiêu nghề nghiệp trong tương lai.
            </p>
        </div>
        <div class="row g-4 justify-content-center mb-5">
            <div class="col-md-5">
                <div class="role-card-wrapper">
                    <img src="/onlinecourse/assets/image/easystudy/gv.png" class="role-bg-img">
                    <div class="role-overlay">
                        <h3 class="role-title">Cho Giáo Viên</h3>
                        <a href="#" class="btn btn-role-outline">Bắt đầu một lớp học</a>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="role-card-wrapper">
                    <img src="/onlinecourse/assets/image/easystudy/hs.png" class="role-bg-img">
                    <div class="role-overlay">
                        <h3 class="role-title">Cho Học Viên</h3>
                        <a href="#" class="btn btn-role-purple">Truy cập lớp học</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="feature-wrapper row align-items-center">
            <div class="col-lg-5">
                <div class="dot-pink-large"></div>
                <h2 class="feature-heading mb-4">
                    <span class="text-pink-accent">Mọi thứ bạn làm ở lớp học,</span><br>
                    <span class="text-purple-accent">bạn cũng làm được ở</span><br>
                    <span class="brand-text-style" style="font-size: 3rem;">EasyStudy</span>
                </h2>
                <p class="text-muted">Phần mềm EasyStudy giúp các lớp học truyền thống và trường học trực tuyến quản lý lịch học, 
                    điểm danh, thanh toán và lớp học ảo chỉ trong một hệ 
                    thống đám mây bảo mật duy nhất.</p>
            </div>
            <div class="col-lg-7">
                <div class="image-deco-container">
                    <div class="shape-pink-top"></div>
                    <div class="shape-purple-bottom"></div>
                    <img src="/onlinecourse/assets/image/easystudy/1.png" class="feature-main-img">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="features-list-section">
    <div class="container">
        <div class="text-center mb-5"><h2 class="fw-bold text-dark">Các tính năng của <span class="brand-text-style">EasyStudy</span></h2></div>
        
        <div class="row align-items-center feature-item">
            <div class="col-lg-6">
                <div class="feature-img-container"><div class="blob-deco blob-purple"></div><img src="/onlinecourse/assets/image/function/a1.png" class="feature-main-img"></div>
            </div>
            <div class="col-lg-6 ps-lg-5">
                <h3 class="feature-title text-primary">Lớp học được thiết kế giao diện thông minh</h3>
                <ul class="feature-list-check">
                    <li>Teachers don’t get lost in the grid view and have a dedicated Podium space.</li>
                    <li>Trợ giảng và người thuyết trình có thể được ưu tiên hiển thị trong giao diện lớp học.</li>
                    <li>Giáo viên có thể dễ dàng nhìn thấy học viên và dữ liệu lớp học cùng một thời điểm</li>
                </ul>
            </div>
        </div>

        <div class="row align-items-center feature-item">
            <div class="col-lg-6 order-lg-2">
                <div class="feature-img-container"><div class="blob-deco blob-pink"></div><img src="/onlinecourse/assets/image/function/a2.png" class="feature-main-img"></div>
            </div>
            <div class="col-lg-6 order-lg-1 pe-lg-5">
                <h3 class="feature-title text-danger">Các công cụ cho giáo viên và học viên</h3>
                <p class="text-muted">Lớp học có một bộ công cụ giảng dạy năng động được tích hợp sẵn để triển 
                    khai và sử dụng trong 
                    suốt buổi học.Giáo viên có thể giao bài tập ngay lập tức để học viên hoàn thành và nộp bài.</p>
            </div>
        </div>

        <div class="row align-items-center feature-item">
            <div class="col-lg-6">
                <div class="feature-img-container"><div class="blob-deco blob-purple"></div><img src="/onlinecourse/assets/image/function/a3.png" class="feature-main-img"></div>
            </div>
            <div class="col-lg-6 ps-lg-5">
                <h3 class="feature-title text-purple-accent">Đánh giá, Bài tập ngắn (Quiz),
                    <br> Bài kiểm tra</h3>
                <p class="text-muted">Dễ dàng khởi chạy các bài tập, bài tập ngắn và bài kiểm tra trực tiếp (live). 
                    Kết quả của học viên được tự động nhập vào sổ điểm trực tuyến.</p>
            </div>
        </div>

        <div class="row align-items-center feature-item">
            <div class="col-lg-6 order-lg-2">
                <div class="feature-img-container"><div class="blob-deco blob-pink"></div><img src="/onlinecourse/assets/image/function/a4.png" class="feature-main-img"></div>
            </div>
            <div class="col-lg-6 order-lg-1 pe-lg-5">
                <h3 class="feature-title text-danger">Công cụ quản lý lớp học cho giáo viên</h3>
                <p class="text-muted">Lớp học cung cấp các công cụ giúp điều hành và quản lý lớp như Danh sách Lớp, Chuyên cần, và nhiều hơn nữa.Với 
                    sổ điểm, giáo viên có thể xem lại và chấm điểm các bài kiểm tra và bài tập ngắn ngay lập tức (trong thời gian thực)..</p>
            </div>
        </div>

        <div class="row align-items-center feature-item">
            <div class="col-lg-6">
                <div class="feature-img-container"><div class="blob-deco blob-purple"></div><img src="/onlinecourse/assets/image/function/a5.png" class="feature-main-img"></div>
            </div>
            <div class="col-lg-6 ps-lg-5">
                <h3 class="feature-title text-purple-accent">Thảo luận 1-1</h3>
                <p class="text-muted">Giáo viên và trợ giảng có thể nói chuyện riêng với học sinh.</p>
            </div>
        </div>
        
        <div class="text-center mt-4"><button class="btn btn-discovery-pink">Xem thêm</button></div>
    </div>
</section>

<section class="discovery-section">
    <div class="container">
        <h2 class="mb-4 fw-bold text-dark"><span class="text-highlight-red">Khám phá</span> các khóa học</h2>
        <div class="course-banner-card bg-web-dev">
            <img src="/onlinecourse/assets/image/course/web.png" class="course-main-img" alt="Web Dev">
            <div class="course-inner-layout">
                <div class="course-text-col">
                    <div class="course-heading-small">Lập trình Web</div>
                    <div class="course-heading-large">Hiểu về<br>Lập Trình<br>Web</div>
                </div>
                <a href="#" class="btn-detail-link">Xem chi tiết <i class="fas fa-arrow-right ms-2"></i></a>
            </div>
        </div>
        <div class="course-banner-card bg-photoshop">
            <img src="/onlinecourse/assets/image/course/pts.png" class="course-main-img" alt="Photoshop">
            <div class="course-inner-layout">
                <div class="course-text-col">
                    <div class="course-heading-small">Thiết kế đồ họa</div>
                    <div class="course-heading-large">Photoshop và<br>thiết kế cơ bản</div>
                </div>
                <a href="#" class="btn-detail-link">Xem chi tiết <i class="fas fa-arrow-right ms-2"></i></a>
            </div>
        </div>
        <div class="text-center"><button class="btn btn-discovery-pink">Xem thêm</button></div>
    </div>
</section>

<section class="testimonial-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-5">
                <h2 class="fw-bold mb-3">Học viên nói gì ?</h2>
                <p class="text-muted mb-4">EasyStudy có hàng ngàn đánh giá từ người dùng trên khắp Việt Nam.
                    <br>
                    <br>
                    Nhiều học viên và giáo viên đã được giúp đỡ trên nên tảng EasyStudy.
                    <br>
                    <br>
                    Bạn thì sao ? Cho chúng tôi xin đánh giá nhé !
                </p>
                <div class="review-input-group">
                    <input type="text" class="review-input" placeholder="Viết đánh giá...">
                    <button class="btn-arrow-circle"><i class="fas fa-arrow-right"></i></button>
                </div>
            </div>
            <div class="col-md-7">
                <div class="testi-img-wrapper">
                    <img src="/onlinecourse/assets/avatars/mt.png" class="testi-main-img">
                    <div class="float-quote-card">
                        <p class="fst-italic text-muted">"Cảm ơn rất nhiều vì đã hỗ trợ, tôi đã thu được nhiều kiến thức bổ ích từ các khóa học. 
                            Đây chính xác là những gì tôi tìm kiếm. Bạn sẽ không hối hận khi lựa chọn EasyStudy”"</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <strong>Minh Thư</strong>
                            <div class="star-rating"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once 'views/layouts/footer.php'; ?>