<?php
// 1. KẾT NỐI CSDL & LẤY DỮ LIỆU
require_once __DIR__ . '/../../config/Database.php'; 

$db = new Database();
$conn = $db->pdo;

// --- LOGIC XỬ LÝ XEM TẤT CẢ ---
// Kiểm tra URL có ?view=all không
$isShowAll = isset($_GET['view']) && $_GET['view'] == 'all';

// Nếu có view=all thì lấy 10 (hoặc nhiều hơn), ngược lại chỉ lấy 2
$limit = $isShowAll ? 12 : 2; 

$sql = "SELECT * FROM courses ORDER BY created_at DESC LIMIT $limit";
$stmt = $conn->prepare($sql);
$stmt->execute();
$courses = $stmt->fetchAll();

// Gọi Header
require_once 'views/layouts/header.php'; 
?>

<style>
    html { scroll-behavior: smooth; }
</style>

<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 mb-5 mb-md-0">
                <h1 class="hero-title"><span class = "text-title">Học trực tuyến</span> trở nên 
                <br> dễ dàng hơn</h1>
                <p class="hero-subtitle">EasyStudy là một nền tảng thú vị sẽ giúp bạn 
                    <br>học tốt theo nhiều phương thức khác nhau.</p>
                <div class="mt-4">
                    <a href = "/onlinecourse/index.php?controller=auth&action=login" class="btn btn-hero-pink">Đăng nhập</a>
                    
                    <a href="#discovery-section" class="btn btn-hero-watch">
                        <i class="fas fa-play-circle"></i> Xem khóa học
                    </a>
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
                        <button class="btn btn-sm btn-danger w-100 rounded-pill" style = "font-size:18px">Tham gia</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="stats-section">
    <div class="container">
        <h2 class="stats-title">Thành Tựu</h2>
        <p class="text-muted w-75 mx-auto mb-5" style = "font-size:28px">Trong hành trình xây dựng một nền tảng học tập hiện đại, chúng tôi đã 
            <br>đạt được những cột mốc quan trọng mà cộng đồng học viên luôn tự hào</p>
        <div class="row">
            <div class="col-md-3"> <div class="stat-number">50K+</div> <p style = "font-size:24px">Học viên đã tin tưởng
            <br>Những lĩnh vực đã học<br> ở các lĩnh vực khác nhau
            </p> </div>
            <div class="col-md-3"> <div class="stat-number">98%</div> <p style = "font-size:24px">Học viên và Giáo viên
                <br>hài lòng</p> </div>
            <div class="col-md-3"> <div class="stat-number">100+</div> <p style = "font-size:24px">Giảng viên chất lượng<br>lượng giảng dạy tốt</p> </div>
            <div class="col-md-3"> <div class="stat-number">200+</div> <p style = "font-size:24px">Khóa học đảm bảo<br> kết quả đầu ra</p> </div>
        </div>
    </div>
</section>

<section class="about-section">
    <div class="container">
        <div class="text-center mb-5">
            <span class="brand-text-style">EasyStudy</span> <span class="section-title-large">là gì ?</span>
            <p class="mt-3 text-muted w-75 mx-auto" style = "font-size:23px">EasyStudy là nền tảng học trực tuyến được xây dựng với mục tiêu mang đến cho 
                người học trải nghiệm giáo dục hiện đại, linh hoạt và hiệu quả.
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
                    <span class="text-pink-accent">Mọi thứ bạn có thể làm ở một lớp học,</span><br>
                    <span class="text-purple-accent">bạn cũng làm được ở</span><br>
                    <span class="brand-text-style" style="font-size: 3rem; font-style: bold;">EasyStudy</span>
                </h2>
                <p class="text-muted"style = "font-size:23px">Phần mềm EasyStudy giúp các lớp học truyền thống và trường học trực tuyến quản lý lịch học, 
                    điểm danh, thanh toán và lớp học ảo chỉ trong một hệ thống đám mây bảo mật duy nhất.</p>
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
        <div class="text-center mb-5"><h2 class="fw-bold text-dark"style = "font-size:3.5rem">Các tính năng của <span class="brand-text-style">EasyStudy</span></h2></div>
        
        <div class="row align-items-center feature-item">
            <div class="col-lg-6">
                <div class="feature-img-container"><div class="blob-deco blob-purple"></div><img src="/onlinecourse/assets/image/function/a5.png" class="feature-main-img"></div>
            </div>
            <div class="col-lg-6 ps-lg-5">
                <h3 class="feature-title text-primary">Lớp học được thiết kế giao diện thông minh</h3>
                <ul class="feature-list-check">
                    <li>Teachers don’t get lost in the grid view and have a dedicated Podium space.</li>
                    <li>Trợ giảng và người thuyết trình có thể được ưu tiên hiển thị trong giao diện lớp học.</li>
                    <li>Giáo viên có thể dễ dàng nhìn thấy học viên và dữ liệu lớp học cùng một thời điểm.</li>
                </ul>
            </div>
        </div>
        
        <div class="text-center mt-4"><button id ="btnwatchAdd" class="btn btn-discovery-purple">Xem thêm</button></div>
    </div>
</section>

<section class="discovery-section" id="discovery-section">
    <div class="container">
        <h2 class="section-heading mb-5">
            <span class="text-highlight-red">Khám phá</span> các khóa học
        </h2>

        <?php if (count($courses) > 0): ?>
            <?php foreach ($courses as $course): ?>
                <?php 
                    // --- SỬA LỖI ẢNH ---
                    $dbImage = $course['image'];
                    // Kiểm tra nếu link trong DB là link online (bắt đầu bằng http) thì dùng luôn
                    if (strpos($dbImage, 'http') === 0) {
                        $imgSrc = $dbImage;
                    } 
                    // Nếu là tên file thì nối thêm đường dẫn thư mục
                    else {
                        $imgSrc = '/onlinecourse/assets/uploads/courses/' . $dbImage;
                    }
                    
                    // Nếu dữ liệu trống thì dùng ảnh mặc định
                    if (empty($dbImage)) {
                        $imgSrc = '/onlinecourse/assets/image/course/default.png';
                    }
                ?>
                <div class="course-item-wrapper mb-5">
                    <div class="course-header d-flex justify-content-between align-items-center mb-2">
                        <h3 class="course-title mb-0"><?php echo htmlspecialchars($course['title']); ?></h3>
                        
                        <a href="/onlinecourse/index.php?controller=course&action=detail&id=<?php echo $course['id']; ?>" class="btn-see-detail" style="font-size: 1.4rem;">
                            XEM CHI TIẾT <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                    <div class="course-banner-container">
                        <img src="<?php echo htmlspecialchars($imgSrc); ?>" class="img-fluid course-banner-img" alt="<?php echo htmlspecialchars($course['title']); ?>" style="width: 100%; object-fit: cover;">
                        <div class="banner-bottom-layer"></div>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="text-center mt-4">
                <?php if ($isShowAll): ?>
                    <a href="?#discovery-section" class="btn btn-secondary px-4 py-2 fw-bold" style="font-size: 1.2rem;">
                        <i class="fas fa-arrow-up"></i> Thu gọn
                    </a>
                <?php else: ?>
                    <a href="?view=all#discovery-section" id="btnwatchAdd2" class="btn btn-discovery-pink px-4 py-2 fw-bold">
                        Xem tất cả <i class="fas fa-arrow-down ms-1"></i>
                    </a>
                <?php endif; ?>
            </div>

        <?php else: ?>
            <div class="alert alert-info text-center" style = "font-size: 1.5rem; background-color: #f3effb; border-color: #d3cce3; color: #692e8e;">
                <i class="fas fa-info-circle me-2"></i> Hiện tại chưa có khóa học nào được đăng tải.
            </div>
        <?php endif; ?>

    </div>
</section>

<section class="testimonial-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-5">
                <h2 class="fw-bold mb-3"style = "font-size: 2.3rem; color: #0b2b76ff;">Học viên nói gì ?</h2>
                <p class="text-muted mb-4" style = "font-size: 1.7rem;">EasyStudy có hàng ngàn đánh giá từ người dùng trên khắp Việt Nam.
                    <br><br>
                    Nhiều học viên và giáo viên đã được giúp đỡ trên nên tảng EasyStudy.
                    <br><br>
                    Bạn thì sao ? Cho chúng tôi xin đánh giá nhé !
                </p>
                <div class="review-input-group">
                    <input type="text" class="review-input" placeholder="Viết đánh giá của bạn..."> 
                    <button class="btn-arrow-circle"><i class="fas fa-arrow-right"></i></button>
                </div>
            </div>
            <div class="col-md-7">
                <div class="testi-img-wrapper">
                    <img src="/onlinecourse/assets/avatars/mt.png" class="testi-main-img">
                    <div class="float-quote-card">
                        <p class="fst-italic text-muted" style = "font-size: 1.4rem;">"Cảm ơn rất nhiều vì đã hỗ trợ, tôi đã thu được nhiều kiến thức bổ ích từ các khóa học. 
                            Đây chính xác là những gì tôi tìm kiếm. Bạn sẽ không hối hận khi lựa chọn EasyStudy”"</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <strong style = "font-size: 1.4rem;">Minh Thư</strong>
                            <div class="star-rating"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src = "/onlinecourse/assets/js/script.js"></script>
<?php require_once 'views/layouts/footer.php'; ?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Tìm thẻ a chứa chữ "Khóa học" trong header
        const navLinks = document.querySelectorAll('nav a, header a');
        
        navLinks.forEach(link => {
            if (link.textContent.trim() === 'Khóa học') {
                link.addEventListener('click', function(e) {
                    e.preventDefault(); // Chặn chuyển trang
                    const section = document.getElementById('discovery-section');
                    if (section) {
                        section.scrollIntoView({ behavior: 'smooth' });
                    }
                });
            }
        });
    });
</script>