<?php require_once 'views/layouts/header_students.php'; 
require_once 'models/Course.php';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <link rel="stylesheet" href="/onlinecourse/assets/css/student.css">
    <link rel="stylesheet" href="/onlinecourse/assets/css/style.css">
    <link rel="stylesheet" href="/onlinecourse/assets/css/course.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title><?= htmlspecialchars($course['title']) ?></title>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
        }
        .card {
            background: white;
            border-radius: 18px;
            padding: 28px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }
    </style>
</head>

<body class="pb-10">

<!-- Banner ngay dưới header -->
<div class="mt-20">
    <img src="assets/image/course/web.png"
         class="w-full h-[420px] object-cover rounded-xl shadow-md">
</div>

<!-- MAIN CONTENT -->
<div class="max-w-6xl mx-auto px-4 mt-10 grid grid-cols-1 lg:grid-cols-3 gap-10">

    <!-- LEFT CONTENT -->
    <div class="lg:col-span-2 space-y-10">

        <!-- Course Title Card -->
        <div class="card">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">
                <?= htmlspecialchars($course['title']) ?>
            </h1>

            <h2 class="text-xl font-semibold text-gray-800 mt-6 mb-3">
                Tổng quan khóa học
            </h2>

            <p class="text-gray-700 text-lg mb-6 leading-relaxed">
                <?= nl2br(htmlspecialchars($course['overview'] ?? $course['description'])) ?>
            </p>


            <!-- Duration Badge -->
            <div class="inline-flex items-center gap-2 bg-purple-100 px-4 py-2 rounded-full text-purple-700 font-semibold">
                ⏳ Thời lượng:
                <?= htmlspecialchars($course['dur']) ?>
            </div>

            <div class="mt-7 space-y-4">
                <a href="#" class="block w-full bg-purple-500 text-white py-4 font-bold rounded-xl text-center text-lg hover:bg-purple-600">
                    ĐĂNG KÝ NGAY
                </a>
                <a href="#" class="block w-full border border-purple-500 text-purple-600 py-4 font-bold rounded-xl text-center text-lg hover:bg-purple-50">
                    Xem thử (Bài học miễn phí)
                </a>
            </div>
        </div>

        <!-- Teacher Card -->
        <div class="card">
            <h2 class="text-xl font-bold text-gray-900 mb-6">👩‍🏫 Giảng viên</h2>

            <div class="flex gap-6 items-start">
                <div class="w-24 h-24 rounded-full bg-purple-200 flex items-center justify-center">
                    <span class="text-3xl font-bold text-purple-700">
                        <?= htmlspecialchars($teacher['initials']) ?>
                    </span>
                </div>

                <div>
                    <h3 class="font-bold text-xl text-gray-900">
                        <?= htmlspecialchars($teacher['name']) ?>
                    </h3>
                    <p class="text-gray-600 mt-1">
                        <?= htmlspecialchars($teacher['degree']) ?>
                    </p>
                    <p class="text-gray-600 mt-1">
                        <?= htmlspecialchars($teacher['experience']) ?>
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mt-6">
                <div class="bg-gray-50 p-4 rounded-lg text-center">
                    <div class="text-sm text-gray-600">Chuyên môn</div>
                    <div class="font-semibold text-gray-900">
                        <?= htmlspecialchars($teacher['specialization']) ?>
                    </div>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg text-center">
                    <div class="text-sm text-gray-600">Học viên đào tạo</div>
                    <div class="font-semibold text-gray-900">
                        <?= htmlspecialchars($teacher['students_trained']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- RIGHT SIDEBAR -->
    <div>
        <div class="card space-y-5 sticky top-10">

            <h3 class="text-lg font-bold text-gray-900 text-center">Quyền lợi học viên</h3>

            <p class="text-center text-3xl text-purple-600 font-extrabold">
                <?= htmlspecialchars($course['price_discount']) ?>
            </p>

            <ul class="space-y-4 pt-4 border-t">
                <?php foreach ($benefits as $b): ?>
                    <li class="flex items-start gap-3">
                        <div class="w-6 h-6 rounded-full bg-purple-100 flex items-center justify-center">
                            ✔
                        </div>
                        <span class="text-gray-700"><?= htmlspecialchars($b) ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>

        </div>
    </div>

</div>
<!-- Khám phá khóa học -->
<section class="pt-5" id="discovery-section">

    <h2 class="section-title border-top pt-4">
        <span class="text-purple">Khám phá</span> khóa học
    </h2>

    <div class="search-input-wrapper">
        <i class="fas fa-search icon-search"></i>
        <input type="text" class="search-input" placeholder="Tìm khóa học mới">
        <i class="fas fa-filter icon-filter" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#filterModal"></i>
    </div>

    <?php if (!empty($discoveryCourses) && count($discoveryCourses) > 0): ?>
        <?php foreach ($discoveryCourses as $item): ?>
            <?php 
                $imgSrc = !empty($item['image']) 
                    ? (strpos($item['image'], 'http') === 0 ? $item['image'] : '/onlinecourse/assets/uploads/courses/' . $item['image'])
                    : '/onlinecourse/assets/image/course/default.png';
            ?>
            <div class="mb-5">
                <div class="course-header">
                    <h3 class="course-cat-name"><?= htmlspecialchars($item['title']) ?></h3>
                    <a href="/onlinecourse/index.php?controller=course&action=detail&id=<?= $item['id'] ?>" class="link-detail">
                        XEM CHI TIẾT <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>

                <div style="height: 250px; overflow: hidden; border-radius: 0;">
                    <img src="<?= htmlspecialchars($imgSrc) ?>" class="course-banner-img w-100 h-100" style="object-fit: cover;">
                </div>

                <a href="/onlinecourse/index.php?controller=enrollment&action=create&course_id=<?= $item['id'] ?>" 
                   class="btn btn-register-pink mt-2 d-block text-center text-decoration-none">
                    Đăng ký ngay
                </a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-muted mt-3">Hiện chưa có khóa học nào.</p>
    <?php endif; ?>

</section>

        <div class="text-center mt-4">
            <?php if ($isShowAll): ?>
                <a href="/onlinecourse/index.php?controller=student&action=dashboard#discovery-section" 
                class="fw-bold mb-0 text-decoration-none text-dark" style="font-size: 1.8rem;">
                    Thu gọn <br> <i class="fas fa-arrow-up"></i>
                </a>
            <?php else: ?>
                <a href="/onlinecourse/index.php?controller=student&action=dashboard&view=all#discovery-section" 
                class="fw-bold mb-0 text-decoration-none text-dark" style="font-size: 1.8rem;">
                    Xem thêm <br> <i class="fas fa-arrow-down"></i>
                </a>
            <?php endif; ?>
        </div>        
    </div> 
</div> 
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
  <?php if(isset($_SESSION['success'])): ?>
    <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body" style = "font-size: 1.5rem;">
          <?= $_SESSION['success']; unset($_SESSION['success']); ?>
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
<?php endif; ?>

  <?php if(isset($_SESSION['error'])): ?>
    <div id="errorToast" class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body" "font-size: 1.5rem;">
          <?= $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  <?php endif; ?>
</div>
<?php require_once 'views/layouts/footer.php'; ?>
</body>
</html>
