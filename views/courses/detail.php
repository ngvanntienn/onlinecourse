<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khóa học Fullstack Developer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }
        .center-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .full-width-btn {
            width: 100%;
            padding: 1rem;
            font-size: 1.125rem;
            font-weight: bold;
            border-radius: 12px;
            transition: all 0.3s;
        }
        .btn-register {
            background: linear-gradient(90deg, #C3A7FF 0%, #9270FF 100%);
            color: white;
        }
        .btn-register:hover {
            background: linear-gradient(90deg, #b395f0 0%, #8365e0 100%);
            box-shadow: 0 4px 12px rgba(146, 112, 255, 0.3);
        }
        .btn-trial {
            border: 2px solid #C3A7FF;
            color: #4b2bbf;
        }
        .btn-trial:hover {
            background-color: #f5f3ff;
        }
        .course-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e5e7eb;
        }
    </style>
</head>
<body>
    <div class="center-container py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- LEFT COLUMN -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Course Header Card -->
                <div class="course-card p-8">
                    <!-- Title Section -->
                    <div class="text-center lg:text-left mb-8">
                        <h1 class="text-3xl font-bold text-gray-900 mb-4">Khóa Học Fullstack Developer</h1>
                        <p class="text-gray-600 text-lg">Từ Zero đến Hero - Làm chủ Frontend, Backend và DevOps</p>
                    </div>
                    
                    <!-- Duration Badge -->
                    <div class="flex justify-center lg:justify-start mb-8">
                        <div class="px-5 py-3 bg-purple-50 text-purple-700 font-semibold rounded-full inline-flex items-center gap-2">
                            <span>⏱️</span>
                            <span>Thời lượng: 30 giờ / 10 chương</span>
                        </div>
                    </div>
                    
                    <!-- Two Full Width Buttons -->
                    <div class="space-y-4">
                        <button class="full-width-btn btn-register">
                            ĐĂNG KÝ NGAY
                        </button>
                        <button class="full-width-btn btn-trial">
                            Xem thử (Bài học miễn phí)
                        </button>
                    </div>
                </div>
                
                <!-- Teacher Card -->
                <div class="course-card p-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">👩‍🏫 Giảng viên</h2>
                    
                    <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6 p-6 bg-purple-50 rounded-xl">
                        <div class="w-20 h-20 rounded-full bg-gradient-to-br from-purple-200 to-pink-100 flex items-center justify-center">
                            <span class="text-2xl font-bold text-purple-600">TV</span>
                        </div>
                        <div class="text-center sm:text-left">
                            <h3 class="font-bold text-lg text-gray-900 uppercase mb-2">TRỊNH THỊ VÂN</h3>
                            <p class="text-gray-700 mb-2">Thạc sĩ Khoa học máy tính - École Nationale Supérieure des Mines de Saint-Étienne, Pháp</p>
                            <p class="text-gray-700">5 năm kinh nghiệm giảng dạy và phát triển phần mềm</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- RIGHT COLUMN -->
            <div class="lg:col-span-1">
                <div class="sticky top-8 course-card p-6 space-y-6">
                    <!-- Title -->
                    <h3 class="text-lg font-bold text-gray-900">Quyền lợi học viên</h3>
                    
                    <!-- Two Full Width Buttons -->
                    <div class="space-y-4">
                        <button class="full-width-btn btn-register">
                            ĐĂNG KÝ NGAY
                        </button>
                        <button class="full-width-btn btn-trial">
                            Xem thử (Miễn phí)
                        </button>
                    </div>
                    
                    <!-- Benefits List -->
                    <div class="space-y-4 pt-4 border-t border-gray-200">
                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full bg-purple-100 flex items-center justify-center mt-0.5">
                                <span class="text-purple-600 text-sm">✓</span>
                            </div>
                            <span>Học mọi lúc, mọi nơi trên mọi thiết bị</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full bg-purple-100 flex items-center justify-center mt-0.5">
                                <span class="text-purple-600 text-sm">✓</span>
                            </div>
                            <span>Hỗ trợ 1-1 trực tiếp với mentor</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full bg-purple-100 flex items-center justify-center mt-0.5">
                                <span class="text-purple-600 text-sm">✓</span>
                            </div>
                            <span>Bài tập thực hành & Project thực tế</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full bg-purple-100 flex items-center justify-center mt-0.5">
                                <span class="text-purple-600 text-sm">✓</span>
                            </div>
                            <span>Truy cập trọn đời tài liệu khóa học</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full bg-purple-100 flex items-center justify-center mt-0.5">
                                <span class="text-purple-600 text-sm">✓</span>
                            </div>
                            <span>Chứng chỉ hoàn thành có giá trị</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>