<?php require_once 'views/layouts/header_students.php'; ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title><?= htmlspecialchars($course['title'] ?? "Khóa học") ?></title>
    <div style="margin-top: 80px;"></div>
<div class="mt-20"> 
    <img src="assets/image/course/web.png" class="w-full h-96 object-cover rounded-xl shadow-md">
</div>
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

<div class="max-w-6xl mx-auto px-4 mt-10 grid grid-cols-1 lg:grid-cols-3 gap-10">

    <!-- LEFT CONTENT -->
    <div class="lg:col-span-2 space-y-10">

        <!-- Course Title Card -->
        <div class="card">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">
                <?= htmlspecialchars($course['title']) ?>
            </h1>

            <p class="text-gray-700 text-lg mb-6">
                <?= htmlspecialchars($course['description']) ?>
            </p>

            <!-- Duration Badge -->
            <div class="inline-flex items-center gap-2 bg-purple-100 px-4 py-2 rounded-full text-purple-700 font-semibold">
                ⏳ Thời lượng:
                <?= htmlspecialchars($course['duration'] ?? "Đang cập nhật") ?>
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
                        <?= htmlspecialchars($teacher['initials'] ?? "GV") ?>
                    </span>
                </div>

                <div>
                    <h3 class="font-bold text-xl text-gray-900">
                        <?= htmlspecialchars($teacher['name'] ?? "Đang cập nhật") ?>
                    </h3>
                    <p class="text-gray-600 mt-1">
                        <?= htmlspecialchars($teacher['degree'] ?? "Chưa cập nhật bằng cấp") ?>
                    </p>
                    <p class="text-gray-600 mt-1">
                        <?= htmlspecialchars($teacher['experience'] ?? "Chưa có thông tin kinh nghiệm") ?>
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mt-6">
                <div class="bg-gray-50 p-4 rounded-lg text-center">
                    <div class="text-sm text-gray-600">Chuyên môn</div>
                    <div class="font-semibold text-gray-900">
                        <?= htmlspecialchars($teacher['specialization'] ?? "Đang cập nhật") ?>
                    </div>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg text-center">
                    <div class="text-sm text-gray-600">Học viên đào tạo</div>
                    <div class="font-semibold text-gray-900">
                        <?= htmlspecialchars($teacher['students_trained'] ?? "0") ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- RIGHT SIDEBAR -->
    <div>
        <div class="card space-y-5 sticky top-10">

            <h3 class="text-lg font-bold text-gray-900 text-center">Quyền lợi học viên</h3>

            <!-- Price -->
            <?php if (!empty($course['price_discount'])): ?>
            <p class="text-center text-3xl text-purple-600 font-extrabold">
                <?= htmlspecialchars($course['price_discount']) ?>
            </p>
            <?php endif; ?>

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

</body>
</html>

<?php require_once 'views/layouts/footer.php'; ?>
