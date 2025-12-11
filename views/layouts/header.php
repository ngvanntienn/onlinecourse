<?php
// Bắt đầu session để kiểm tra trạng thái đăng nhập
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Logic kiểm tra trang hiện tại để tô màu menu (Active State)
$current_controller = isset($_GET['controller']) ? $_GET['controller'] : 'home';
$current_action = isset($_GET['action']) ? $_GET['action'] : 'index';
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyStudy - Nền tảng học trực tuyến</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="/onlinecourse/assets/css/style.css">
    <style>
        .navbar-custom {
            background-color: #fff;
            height: 90px; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            padding: 0 20px;
            z-index: 1000;
        }

        .logo-text {
            font-weight: 900;
            color: #692e8e;
            font-size: 2rem; 
            text-decoration: none;
            display: flex;
            align-items: center;
            margin-right: 40px;
        }
        .nav-box-link {
            display: inline-block;
            background-color: #fff;
            color: #555;
            font-weight: 600;
            text-decoration: none;
            padding: 10px 25px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            box-shadow: 0 3px 6px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            font-size: 1.3rem;
            white-space: nowrap;
            min-width: 110px; 
            text-align: center;
        }
        
        .nav-item {
            margin: 0 5px;
        }

        /* Hiệu ứng Hover */
        .nav-box-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
            color: #692e8e;
            border-color: #d3cce3;
        }

        /* Trạng thái Active */
        .nav-box-link.active {
            background-color: #f3effb;
            border-color: #692e8e;
            color: #692e8e;
            box-shadow: 0 4px 8px rgba(105, 46, 142, 0.2);
        }

        .btn-custom-login {
            background: #eeeeeef1;
            color: #333;
            font-weight: 600;
            border-radius: 14px;
            padding: 10px 25px;
            text-decoration: none;
            font-size: 1.3rem;
            border: none;
            transition: 0.3s;
            white-space: nowrap;
        }
        
        .btn-custom-register {
            background: #d39ce6;
            color: #fff;
            font-weight: 600;
            border-radius: 14px;
            padding: 10px 25px;
            text-decoration: none;
            font-size: 1.3rem;
            border: none;
            transition: 0.3s;
            white-space: nowrap;
        }

        .btn-custom-login:hover { 
            background: #e2e2e2; 
            transform: translateY(-2px); 
        }
        .btn-custom-register:hover { 
            background: #c085d6; 
            color: white; 
            transform: translateY(-2px); 
        }

    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg fixed-top navbar-custom">
  <div class="container h-100">
    <a class="navbar-brand logo-text" href="/onlinecourse/index.php">
        <i class="fas fa-graduation-cap me-2"></i>EasyStudy
    </a>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      
      <ul class="navbar-nav align-items-center me-4">
        <li class="nav-item">
            <a class="nav-box-link <?= ($current_controller == 'home') ? 'active' : '' ?>" href="/onlinecourse/index.php">Trang chủ</a>
        </li>
        <li class="nav-item">
            <a class="nav-box-link <?= ($current_controller == 'course') ? 'active' : '' ?>" href="/onlinecourse/index.php?controller=course&action=index">Khóa học</a>
        </li>
        <li class="nav-item">
            <a class="nav-box-link" href="#">Tính năng</a>
        </li>
        <li class="nav-item">
            <a class="nav-box-link" href="#">Về chúng tôi</a>
        </li>
      </ul> 
      
      <div class="d-flex gap-2 auth-buttons align-items-center">
         <?php if (isset($_SESSION['user_id'])): ?>
            <a href="/onlinecourse/index.php?controller=student&action=dashboard" class="btn-custom-register">
                <i class="fas fa-columns me-2"></i>Dashboard
            </a>
            <a href="/onlinecourse/index.php?controller=auth&action=logout" class="btn btn-outline-danger" style="border-radius: 14px; padding: 8px 12px;" title="Đăng xuất">
                <i class="fas fa-sign-out-alt"></i>
            </a>
         <?php else: ?>
            <a href="/onlinecourse/views/auth/login.php" class="btn-custom-login">Đăng nhập</a>
            <a href="/onlinecourse/views/auth/register.php" class="btn-custom-register">Đăng ký</a>
         <?php endif; ?>
      </div>

    </div>
  </div>
</nav>

</body>
</html>