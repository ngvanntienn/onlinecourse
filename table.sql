CREATE DATABASE IF NOT EXISTS onlinecourse;
USE onlinecourse;

-- 1. Bảng users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) UNIQUE NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    fullname VARCHAR(255) NOT NULL,
    role TINYINT NOT NULL COMMENT '0: học viên, 1: giảng viên, 2: quản trị viên',
    avatar VARCHAR(255) DEFAULT NULL,

    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- 2. Bảng categories
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- 3. Bảng courses
CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    instructor_id INT,
    category_id INT,
    price DECIMAL(10,2) DEFAULT 0.00,
    duration_weeks INT DEFAULT 0,
    level ENUM('Beginner', 'Intermediate', 'Advanced') NOT NULL,
    image VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_course_instructor FOREIGN KEY (instructor_id) REFERENCES users(id) ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT fk_course_category FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB;

-- 4. Bảng enrollments
CREATE TABLE enrollments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT NOT NULL,
    student_id INT NOT NULL,
    enrolled_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    status ENUM('active', 'completed', 'dropped') DEFAULT 'active',
    progress INT DEFAULT 0,
    CONSTRAINT fk_enroll_course FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_enroll_student FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- 5. Bảng lessons
CREATE TABLE lessons (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    content LONGTEXT,
    video_url VARCHAR(255),
    `order` INT DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_lesson_course FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- 6. Bảng materials
CREATE TABLE materials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    lesson_id INT NOT NULL,
    filename VARCHAR(255) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    file_type VARCHAR(50) NOT NULL,
    uploaded_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_material_lesson FOREIGN KEY (lesson_id) REFERENCES lessons(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;


/* chèn dữ liệu cho bảng khóa học*/
INSERT INTO `users` (`id`, `username`, `email`, `password`, `fullname`, `role`, `created_at`) VALUES
(1, 'ngvanntienn', 'ngvanntienn05@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Nguyễn Văn Tiến', 1, NOW()),
(2, 'pt0403', 'pt0403@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Hoàng Phương Thảo', 1, NOW()),
(3, 'ttmt97k5', 'ttmt97k5@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Trần Thị Minh Thư', 1, NOW()),
(4, 'van2503', 'van2503@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Trịnh Thị Vân', 1, NOW());


INSERT INTO `categories` (`id`, `name`, `description`, `created_at`) VALUES
(1, 'Lập trình Web', 'Các khóa học về Front-end, Back-end, Fullstack', NOW()),
(2, 'Thiết kế Đồ họa', 'UI/UX, Photoshop, Illustrator', NOW()),
(3, 'Khoa học Dữ liệu', 'Python, Machine Learning, AI', NOW()),
(4, 'Ngoại ngữ', 'Tiếng Anh giao tiếp, TOEIC, IELTS', NOW()),
(5, 'Marketing', 'Digital Marketing, Content SEO, Ads', NOW());



INSERT INTO `courses` 
(`id`, `title`, `description`, `instructor_id`, `category_id`, `price`, `duration_weeks`, `level`, `image`, `created_at`, `updated_at`) 
VALUES
(
    1,
    'Lập trình Web (HTML, CSS, JS)',
    'Khóa học dành cho người mới bắt đầu muốn tự tay xây dựng giao diện website hoàn chỉnh từ con số 0.',
    1,
    1,
    599000.00,
    8,
    'Beginner',
    'https://blog.xprofile.vn/wp-content/uploads/2023/03/Lo-trinh-web-developer-tu-co-ban-den-nang-cao-la-gi-e1679546066297.jpeg',
    NOW(),
    NOW()
),
(
    2,
    'Lập trình PHP & MySQL Nâng cao',
    'Làm chủ Backend với mô hình MVC, OOP và bảo mật ứng dụng web thực tế.',
    1,
    1,
    899000.00,
    12,
    'Intermediate',
    'https://key.com.vn/upload/article/contents/lap-trinh-web-voi-php-mysql-1.png',
    NOW(),
    NOW()
),
(
    3,
    'Thiết kế UI/UX với Figma từ A-Z',
    'Học tư duy thiết kế và sử dụng thành thạo Figma để tạo ra các giao diện ứng dụng đẹp mắt.',
    2,
    2,
    450000.00,
    6,
    'Beginner',
    'https://img.freepik.com/free-vector/gradient-style-ui-ux-background_52683-69621.jpg?semt=ais_hybrid&w=740&q=80',
    NOW(),
    NOW()
),
(
    4,
    'Python cho Phân tích Dữ liệu (Data Science)',
    'Khám phá sức mạnh của dữ liệu với thư viện Pandas, NumPy và Matplotlib trong Python.',
    2,
    3,
    1200000.00,
    10,
    'Intermediate',
    'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f8/Python_logo_and_wordmark.svg/2560px-Python_logo_and_wordmark.svg.png',
    NOW(),
    NOW()
),
(
    5,
    'Thành thạo Photoshop trong 7 ngày',
    'Khóa học cấp tốc giúp bạn chỉnh sửa ảnh, blend màu và thiết kế banner quảng cáo chuyên nghiệp.',
    2,
    2,
    299000.00,
    1,
    'Beginner',
    'https://static1.makeuseofimages.com/wordpress/wp-content/uploads/2016/10/photoshop-cc-guide.jpg',
    NOW(),
    NOW()
),
(
    6,
    'Lập trình ứng dụng di động với Flutter',
    'Xây dựng ứng dụng đa nền tảng (iOS & Android) mượt mà chỉ với một codebase duy nhất.',
    1,
    1,
    1500000.00,
    16,
    'Advanced',
    'https://upload.wikimedia.org/wikipedia/commons/1/17/Google-flutter-logo.png',
    NOW(),
    NOW()
),
(
    7,
    'Tiếng Anh giao tiếp cho người đi làm',
    'Tự tin giao tiếp trong môi trường công sở, viết email và thuyết trình bằng tiếng Anh.',
    3,
    4,
    650000.00,
    8,
    'Beginner',
    'https://aten.edu.vn/wp-content/uploads/2022/05/hinh-anh-tieng-anh-giao-tiep-la-gi-so-1.jpg',
    NOW(),
    NOW()
),
(
    8,
    'Digital Marketing thực chiến',
    'Chiến lược SEO, chạy quảng cáo Facebook/Google Ads và xây dựng thương hiệu cá nhân.',
    3,
    5,
    799000.00,
    8,
    'Intermediate',
    'https://mir-s3-cdn-cf.behance.net/project_modules/hd/1a3c0c18546659.562cb438b98a8.png',
    NOW(),
    NOW()
),
(
    9,
    'Machine Learning & AI cơ bản',
    'Bước đầu tiếp cận trí tuệ nhân tạo, xây dựng các mô hình dự đoán đơn giản.',
    1,
    3,
    2000000.00,
    14,
    'Advanced',
    'https://www.smartdatacollective.com/wp-content/uploads/2018/11/Machine-learning-scaled.jpg',
    NOW(),
    NOW()
),
(
    10,
    'Quản trị mạng và Bảo mật hệ thống',
    'Kiến thức nền tảng về mạng máy tính, cấu hình server và các kỹ thuật phòng chống tấn công mạng.',
    2,
    1,
    950000.00,
    10,
    'Intermediate',
    'https://thumbs.dreamstime.com/b/cyber-security-shield-logo-design-information-network-protection-vector-internet-safety-logotype-121786777.jpg',
    NOW(),
    NOW()
);
