CREATE DATABASE IF NOT EXISTS onlinecourse 
    CHARACTER SET utf8mb4 
    COLLATE utf8mb4_unicode_ci;

USE onlinecourse;

-- bảng users
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) UNIQUE,
    email VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    fullname VARCHAR(255),
    role INT,
    created_at DATETIME
) ENGINE=InnoDB;

-- bảng categories
CREATE TABLE categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    description TEXT,
    created_at DATETIME
) ENGINE=InnoDB;

-- bảng courses
CREATE TABLE courses (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255),
    description TEXT,
    instructor_id INT,
    category_id INT,
    price DECIMAL(10,2),
    duration_weeks INT,
    level VARCHAR(50),
    image VARCHAR(255),
    created_at DATETIME,
    updated_at DATETIME
) ENGINE=InnoDB;

-- Bảng enrollments
CREATE TABLE enrollments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    course_id INT,
    student_id INT,
    enrolled_date DATETIME,
    status VARCHAR(50),
    progress INT
) ENGINE=InnoDB;

-- Bảng lessons
CREATE TABLE lessons (
    id INT PRIMARY KEY AUTO_INCREMENT,
    course_id INT,
    title VARCHAR(255),
    content LONGTEXT,
    video_url VARCHAR(255),
    `order` INT,
    created_at DATETIME
) ENGINE=InnoDB;

-- Bảng materials
CREATE TABLE materials (
    id INT PRIMARY KEY AUTO_INCREMENT,
    lesson_id INT,
    filename VARCHAR(255),
    file_path VARCHAR(255),
    file_type VARCHAR(50),
    uploaded_at DATETIME
) ENGINE=InnoDB;

-- courses
ALTER TABLE courses 
ADD CONSTRAINT fk_courses_instructor 
    FOREIGN KEY (instructor_id) REFERENCES users(id)
    ON DELETE SET NULL ON UPDATE CASCADE,
ADD CONSTRAINT fk_courses_category 
    FOREIGN KEY (category_id) REFERENCES categories(id)
    ON DELETE SET NULL ON UPDATE CASCADE;

-- enrollments
ALTER TABLE enrollments
ADD CONSTRAINT fk_enrollments_course
    FOREIGN KEY (course_id) REFERENCES courses(id)
    ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT fk_enrollments_student
    FOREIGN KEY (student_id) REFERENCES users(id)
    ON DELETE CASCADE ON UPDATE CASCADE;

-- lessions
ALTER TABLE lessons
ADD CONSTRAINT fk_lessons_course
    FOREIGN KEY (course_id) REFERENCES courses(id)
    ON DELETE CASCADE ON UPDATE CASCADE;

-- materials
ALTER TABLE materials
ADD CONSTRAINT fk_materials_lesson
    FOREIGN KEY (lesson_id) REFERENCES lessons(id)
    ON DELETE CASCADE ON UPDATE CASCADE;
