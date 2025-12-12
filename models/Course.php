<?php
class Course {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->pdo;
    }    public function getDefaultCourses() {
    return [
         'lap-trinh-web' => [
                'id' => '1',
                'title' => 'Lập trình Web (HTML, CSS, JS)',
                'sub_title' => 'Học nền tảng Web',
                'teacher_name' => 'Trịnh Thị Vân',
                'teacher_avatar' => 'https://media.vov.vn/sites/default/files/styles/large/public/2023-09/4_47.jpg',
                'teacher_bio' => [
                    'Giảng viên CNTT',
                    'Chuyên về Web Development'
                ],
                'banner_img' => 'https://blog.xprofile.vn/wp-content/uploads/2023/03/Lo-trinh-web-developer-tu-co-ban-den-nang-cao-la-gi-e1679546066297.jpeg',
                'bg_color' => 'linear-gradient(135deg, #0f204b 0%, #2c1a66 100%)',
                'duration' => '8 tuần',
                'chapters' => '12 chương',
                'description' => 'Khóa học dành cho người mới bắt đầu muốn tự tay xây dựng giao diện website hoàn chỉnh từ con số 0.',
                'learn_goals' => [
                    'Hiểu HTML, CSS, JavaScript',
                    'Xây dựng layout chuẩn responsive',
                    'Hiểu tư duy UI cơ bản',
                ],
                'outcomes' => [
                    'Tự tạo website cơ bản',
                    'Biết triển khai giao diện chuyên nghiệp',
                    'Nắm vững nền tảng Web'
                ]
            ],

                'php-mysql-nang-cao' => [
                'id' => '2',
                'title' => 'Lập trình PHP & MySQL Nâng cao',
                'sub_title' => 'Làm chủ Backend',
                'teacher_name' => 'Nguyễn Văn Tiến',
                'teacher_avatar' => 'https://img.tripi.vn/cdn-cgi/image/width=700,height=700/https://cdn-media.sforum.vn/storage/app/media/thanhhuyen/%E1%BA%A3nh%20s%C6%A1n%20t%C3%B9ng%20mtp/1/anh-son-tung-mtp-1.jpg',
                'teacher_bio' => ['Chuyên gia Backend', '10 năm kinh nghiệm'],
                'banner_img' => 'https://key.com.vn/upload/article/contents/lap-trinh-web-voi-php-mysql-1.png',
                'bg_color' => 'linear-gradient(135deg, #1a237e 0%, #2c1a66 100%)',
                'duration' => '12 tuần',
                'chapters' => '14 chương',
                'description' => 'Làm chủ Backend với mô hình MVC, OOP và bảo mật ứng dụng web thực tế.',
                'learn_goals' => [
                    'Hiểu OOP trong PHP',
                    'Xây dựng hệ thống MVC',
                    'Thiết kế CSDL MySQL chuẩn'
                ],
                'outcomes' => [
                    'Tự xây dựng Website có Backend',
                    'Biết bảo mật cơ bản',
                    'Làm chủ MySQL nâng cao'
                ]
            ],

            'ui-ux-figma' => [
                'id' => '3',
                'title' => 'Thiết kế UI/UX với Figma từ A-Z',
                'sub_title' => 'Làm chủ Figma',
                'teacher_name' => 'Hoàng Phương Thảo',
                'teacher_avatar' => 'https://cdn.tienphong.vn/images/5e2829db240faf9d8eff1c5640e7a6743316af63a1c947ae548e0e11672c2eebf0ca7ea95604f1801b5908427e7f00fe/l21.jpg',
                'teacher_bio' => ['UI/UX Designer', '5 năm kinh nghiệm'],
                'banner_img' => 'https://img.freepik.com/free-vector/gradient-style-ui-ux-background_52683-69621.jpg',
                'bg_color' => 'linear-gradient(135deg, #673ab7 0%, #512da8 100%)',
                'duration' => '6 tuần',
                'chapters' => '8 chương',
                'description' => 'Học tư duy thiết kế và sử dụng thành thạo Figma để tạo ra các giao diện ứng dụng đẹp mắt.',
                'learn_goals' => [
                    'Tư duy UI/UX',
                    'Hiểu layout, typography',
                    'Thiết kế prototype'
                ],
                'outcomes' => [
                    'Biết dùng Figma chuyên nghiệp',
                    'Thiết kế giao diện App/Web',
                    'Tạo Portfolio cá nhân'
                ]
            ],

            'python-data-science' => [
                'id' => '4',
                'title' => 'Python cho Phân tích Dữ liệu (Data Science)',
                'sub_title' => 'Làm chủ Python',
                'teacher_name' => 'Trần Thị Minh Thư',
                'teacher_avatar' => 'https://media.vov.vn/sites/default/files/styles/large/public/2021-01/bts_jungkook_pics.jpg',
                'teacher_bio' => ['Data Analyst', '5 năm kinh nghiệm'],
                'banner_img' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f8/Python_logo_and_wordmark.svg/2560px-Python_logo_and_wordmark.svg.png',
                'bg_color' => 'linear-gradient(135deg, #1565c0 0%, #283593 100%)',
                'duration' => '10 tuần',
                'chapters' => '12 chương',
                'description' => 'Khám phá sức mạnh của dữ liệu với Pandas, NumPy và Matplotlib.',
                'learn_goals' => [
                    'Xử lý dữ liệu bằng Pandas',
                    'Tối ưu code Python',
                    'Vẽ biểu đồ với Matplotlib'
                ],
                'outcomes' => [
                    'Phân tích dữ liệu thực tế',
                    'Hiểu Data Pipeline',
                    'Tạo báo cáo trực quan'
                ]
            ],

            'photoshop-co-ban' => [
                'id' => '5',
                'title' => 'Thành thạo Photoshop trong 7 ngày',
                'sub_title' => 'Làm chủ thiết kế',
                'teacher_name' => 'Chưa đề cập',
                'teacher_avatar' => 'https://t4.ftcdn.net/jpg/05/49/98/39/360_F_549983970_bRCkYfk0P6PP5fveM072efagRg8JuC8e.jpg',
                'teacher_bio' => ['Graphic Designer', '8 năm kinh nghiệm'],
                'banner_img' => 'https://static1.makeuseofimages.com/wordpress/wp-content/uploads/2016/10/photoshop-cc-guide.jpg',
                'bg_color' => 'linear-gradient(135deg, #1a237e 0%, #0d47a1 100%)',
                'duration' => '1 tuần',
                'chapters' => '7 chương',
                'description' => 'Khóa học cấp tốc giúp bạn chỉnh sửa ảnh, blend màu và thiết kế banner chuyên nghiệp.',
                'learn_goals' => [
                    'Hiểu công cụ Photoshop',
                    'Cắt ghép ảnh chuyên nghiệp',
                    'Blend màu chuẩn'
                ],
                'outcomes' => [
                    'Thiết kế banner',
                    'Retouch ảnh',
                    'Làm chủ Photoshop cơ bản'
                ]
            ],

            'flutter-mobile' => [
                'id' => '6',
                'title' => 'Lập trình ứng dụng di động với Flutter',
                'sub_title' => 'Làm chủ Mobile App',
                'teacher_name' => 'Chưa đề cập',
                'teacher_avatar' => 'https://t4.ftcdn.net/jpg/05/49/98/39/360_F_549983970_bRCkYfk0P6PP5fveM072efagRg8JuC8e.jpg',
                'teacher_bio' => ['Mobile Developer', '6 năm kinh nghiệm'],
                'banner_img' => 'https://upload.wikimedia.org/wikipedia/commons/1/17/Google-flutter-logo.png',
                'bg_color' => 'linear-gradient(135deg, #1a237e 0%, #0d47a1 100%)',
                'duration' => '16 tuần',
                'chapters' => '18 chương',
                'description' => 'Xây dựng ứng dụng đa nền tảng cho iOS & Android chỉ với 1 codebase.',
                'learn_goals' => [
                    'Hiểu cấu trúc Flutter',
                    'Quản lý state (Provider/BLoC)',
                    'Kết nối API Restful'
                ],
                'outcomes' => [
                    'Tạo ứng dụng hoàn chỉnh',
                    'Triển khai lên CH Play/AppStore',
                    'Làm chủ Flutter'
                ]
            ],
            'tieng-anh-giao-tiep' => [
                'id' => '7',
                'title' => 'Tiếng Anh giao tiếp cho người đi làm',
                'sub_title' => 'Tự tin nói tiếng Anh',
                'teacher_name' => 'Chưa đề cập',
                'teacher_avatar' => 'https://t4.ftcdn.net/jpg/05/49/98/39/360_F_549983970_bRCkYfk0P6PP5fveM072efagRg8JuC8e.jpg',
                'teacher_bio' => ['Giảng viên tiếng Anh doanh nghiệp', '6 năm kinh nghiệm'],
                'banner_img' => 'https://aten.edu.vn/wp-content/uploads/2022/05/hinh-anh-tieng-anh-giao-tiep-la-gi-so-1.jpg',
                'bg_color' => 'linear-gradient(135deg, #0d47a1 0%, #1a237e 100%)',
                'duration' => '8 tuần',
                'chapters' => '12 chương',
                'description' => 'Tự tin giao tiếp trong môi trường công sở, viết email và thuyết trình bằng tiếng Anh.',
                'learn_goals' => [
                    'Giao tiếp công sở',
                    'Thuyết trình tiếng Anh',
                    'Viết email chuẩn'
                ],
                'outcomes' => [
                    'Tự tin nói chuyện',
                    'Giao tiếp trôi chảy',
                    'Ứng dụng vào công việc'
                ]
            ],

            'digital-marketing' => [
                'id' => '8',
                'title' => 'Digital Marketing thực chiến',
                'sub_title' => 'Làm chủ Marketing',
                'teacher_name' => 'Chưa đề cập',
                'teacher_avatar' => 'https://t4.ftcdn.net/jpg/05/49/98/39/360_F_549983970_bRCkYfk0P6PP5fveM072efagRg8JuC8e.jpg',
                'teacher_bio' => ['Marketer', '7 năm kinh nghiệm'],
                'banner_img' => 'https://mir-s3-cdn-cf.behance.net/project_modules/hd/1a3c0c18546659.562cb438b98a8.png',
                'bg_color' => 'linear-gradient(135deg, #4a148c 0%, #6a1b9a 100%)',
                'duration' => '8 tuần',
                'chapters' => '10 chương',
                'description' => 'Chiến lược SEO, quảng cáo Facebook/Google Ads và xây dựng thương hiệu cá nhân.',
                'learn_goals' => [
                    'Nắm SEO cơ bản',
                    'Chạy quảng cáo FB/Google',
                    'Xây dựng thương hiệu'
                ],
                'outcomes' => [
                    'Tự chạy quảng cáo',
                    'Biết phân tích chiến dịch',
                    'Áp dụng thực tế'
                ]
            ],

            'machine-learning-ai' => [
                'id' => '9',
                'title' => 'Machine Learning & AI cơ bản',
                'sub_title' => 'Học AI từ con số 0',
                'teacher_name' => 'Chưa đề cập',
                'teacher_avatar' => 'https://t4.ftcdn.net/jpg/05/49/98/39/360_F_549983970_bRCkYfk0P6PP5fveM072efagRg8JuC8e.jpg',
                'teacher_bio' => ['AI Engineer', '6 năm kinh nghiệm'],
                'banner_img' => 'https://www.smartdatacollective.com/wp-content/uploads/2018/11/Machine-learning-scaled.jpg',
                'bg_color' => 'linear-gradient(135deg, #004d40 0%, #00695c 100%)',
                'duration' => '14 tuần',
                'chapters' => '16 chương',
                'description' => 'Bước đầu tiếp cận trí tuệ nhân tạo, xây dựng các mô hình dự đoán đơn giản.',
                'learn_goals' => [
                    'Hiểu thuật toán ML',
                    'Xử lý dữ liệu',
                    'Training mô hình'
                ],
                'outcomes' => [
                    'Xây dựng mô hình dự đoán',
                    'Hiểu AI cơ bản',
                    'Áp dụng ML vào thực tế'
                ]
            ],

            'quan-tri-mang' => [
                'id' => '10',
                'title' => 'Quản trị mạng và Bảo mật hệ thống',
                'sub_title' => 'Làm chủ mạng máy tính',
                'teacher_name' => 'Chưa đề cập',
                'teacher_avatar' => 'https://t4.ftcdn.net/jpg/05/49/98/39/360_F_549983970_bRCkYfk0P6PP5fveM072efagRg8JuC8e.jpg',
                'teacher_bio' => ['System Admin', '10 năm kinh nghiệm'],
                'banner_img' => 'https://thumbs.dreamstime.com/b/cyber-security-shield-logo-design-information-network-protection-vector-internet-safety-logotype-121786777.jpg',
                'bg_color' => 'linear-gradient(135deg, #1b5e20 0%, #2e7d32 100%)',
                'duration' => '10 tuần',
                'chapters' => '14 chương',
                'description' => 'Kiến thức nền tảng về mạng máy tính, cấu hình server và phòng chống tấn công mạng.',
                'learn_goals' => [
                    'Cấu hình server',
                    'Quản trị hệ thống',
                    'Bảo mật mạng'
                ],
                'outcomes' => [
                    'Triển khai Server cơ bản',
                    'Hiểu cơ chế bảo mật',
                    'Xử lý tấn công cơ bản'
                ]
            ]

        ];

    }
    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM courses ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Lấy khóa học theo ID
    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM courses WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    // Thêm khóa học mới
    public function create($data) {
        $sql = "INSERT INTO courses (title, description, price, duration_weeks, level, image, created_at) 
                VALUES (:title, :description, :price, :duration_weeks, :level, :image, NOW())";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':title' => $data['title'],
            ':description' => $data['description'],
            ':price' => $data['price'],
            ':duration_weeks' => $data['duration'],
            ':level' => $data['level'],
            ':image' => $data['image']
        ]);
    }

    // Cập nhật khóa học theo ID
    public function update($id, $data) {
        $sql = "UPDATE courses SET 
                    title=:title, description=:description, price=:price, 
                    duration_weeks=:duration_weeks, level=:level, image=:image,
                    updated_at=NOW()
                WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':title' => $data['title'],
            ':description' => $data['description'],
            ':price' => $data['price'],
            ':duration_weeks' => $data['duration'],
            ':level' => $data['level'],
            ':image' => $data['image']
        ]);
    }

    // Xóa khóa học theo ID
    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM courses WHERE id=:id");
        return $stmt->execute([':id' => $id]);
    }

    // Lấy danh sách khóa học đã đăng ký của học viên
    public function getEnrolledCoursesWithProgress($studentId) {
        $sql = "SELECT 
                    c.id as course_id,
                    c.title,
                    c.image,
                    u.fullname as instructor_name,
                    e.progress as current_lesson,
                    e.status,
                    (SELECT COUNT(*) FROM lessons WHERE course_id = c.id) as total_lessons
                FROM enrollments e
                JOIN courses c ON e.course_id = c.id
                LEFT JOIN users u ON c.instructor_id = u.id
                WHERE e.student_id = :student_id
                ORDER BY e.enrolled_date DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':student_id' => $studentId]);
        $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $totalRegistered = count($courses);
        $completedCount = 0;
        $processedCourses = [];

        foreach ($courses as $course) {
            if ($course['status'] === 'completed') $completedCount++;

            $totalLessons = $course['total_lessons'] > 0 ? $course['total_lessons'] : 1;
            $current = $course['current_lesson'] > 0 ? $course['current_lesson'] : 0;

            if ($course['status'] === 'completed') {
                $percent = 100;
                $current = $totalLessons;
            } else {
                $percent = round(($current / $totalLessons) * 100);
            }

            $img = !empty($course['image']) ? $course['image'] : '/onlinecourse/assets/image/course/default.png';

            $processedCourses[] = [
                'course_id' => $course['course_id'],
                'title' => $course['title'],
                'instructor_name' => $course['instructor_name'] ?? 'EasyStudy Teacher',
                'image' => $img,
                'current_chapter' => $current,
                'total_chapters' => $totalLessons,
                'progress_percent' => $percent,
                'status' => $course['status']
            ];
        }

        $overallPercent = $totalRegistered > 0 ? round(($completedCount / $totalRegistered) * 100) : 0;

        return [
            'total_registered' => $totalRegistered,
            'completed_count' => $completedCount,
            'overall_progress_percent' => $overallPercent,
            'courses' => $processedCourses
        ];
    }

    // Lấy khóa học theo ID từ DB (1 bản ghi)
    public function getCourseById($id) {
        $sql = "SELECT * FROM courses WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Lấy khóa học từ danh sách mặc định (mock data) theo ID
    public function getMockCourseData($id) {
        $courses = $this->getDefaultCourses();
        foreach ($courses as $slug => $course) {
            if ($course['id'] == $id) return $course;
        }
        return null; // Không tìm thấy
    }

   public static function getCoursesByFilter($filters) {
        $dbInstance = new Database();
        $conn = $dbInstance->pdo; 
        
        $sql = "SELECT * FROM courses WHERE 1=1";
        $params = [];

        if (!empty($filters['keyword'])) {
            $sql .= " AND title LIKE ?";
            $params[] = '%' . $filters['keyword'] . '%';
        }

        // 2. Lọc theo Danh mục
        if (!empty($filters['category'])) {
            $catIds = array_map('intval', $filters['category']);
            $idsString = implode(',', $catIds);
            $sql .= " AND category_id IN ($idsString)";
        }

        // 3. Lọc theo Cấp độ
        if (!empty($filters['level']) && !in_array('all', $filters['level'])) {
            $placeholders = implode(',', array_fill(0, count($filters['level']), '?'));
            $sql .= " AND level IN ($placeholders)";
            foreach ($filters['level'] as $lvl) {
                $params[] = $lvl;
            }
        }

        // 4. Lọc theo Giá
        if (!empty($filters['price']) && !in_array('all', $filters['price'])) {
            $priceConditions = [];
            if (in_array('free', $filters['price'])) $priceConditions[] = "price = 0";
            if (in_array('paid', $filters['price'])) $priceConditions[] = "price > 0";
            
            if (!empty($priceConditions)) {
                $sql .= " AND (" . implode(' OR ', $priceConditions) . ")";
            }
        }

        $sql .= " ORDER BY created_at DESC";

        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>