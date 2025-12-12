<?php

require_once __DIR__ . '/../../layouts/header_teacher.php';

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Học viên - EasyStudy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-bg: #f3effb;
            --header-bg: #fff;
            --purple-text: #5e2d87;
        }

        body {
            background-color: var(--primary-bg);
            /* Nếu header fixed thì cần padding-top, tùy chỉnh theo header của bạn */
            padding-top: 20px; 
        }

        /* toolbar container */
        .toolbar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            font-size: 1.2rem;
        }

        /* search box */
        .search-box {
            position: relative;
            background: white;
            border-radius: 8px;
            padding: 8px 15px;
            width: 400px;
            display: flex;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.02);
        }
        .search-box input {
            border: none;
            outline: none;
            width: 100%;
            padding-left: 10px;
            color: #666;
        }
        .search-box i.fa-search { color: #aaa; }

        /* Table container */
        .table-container {
            background: white;
            border-radius: 12px;
            padding: 0;
            overflow-x: auto; 
            box-shadow: 0 4px 20px rgba(0,0,0,0.05); 
        }
                
        .table {
            margin-bottom: 0;
            width: 100%;
        }
        .table thead th {
            background-color: #f8f9fa;
            color: #444;
            font-weight: 700;
            font-size: 1.1rem;
            border-bottom: 2px solid #dee2e6;
            padding: 20px 15px; 
            text-align: left;
            white-space: nowrap; 
            vertical-align: middle;
        }
        .table tbody td {
            vertical-align: middle;
            padding: 20px 15px; 
            font-size: 1rem;
            color: #333;
            border-bottom: 1px solid #f0f0f0;
        }

        .col-id { 
            width: 60px; 
            font-weight: bold;
            color: #888;
        }

        .col-img img { 
            width: 50px; 
            height: 50px; 
            object-fit: cover; 
            border-radius: 50%; /* Avatar tròn */
            border: 2px solid #f3effb;
        }
        
        .col-action { 
            text-align: center; 
            width: 100px; 
        }

        /* Nút hành động (Xóa) */
        .action-btn {
            border: 1px solid #ddd;
            background: white;
            width: 35px;
            height: 35px;
            border-radius: 4px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #dc3545; /* Màu đỏ cho nút xóa */
            margin: 0 2px;
            transition: all 0.2s;
            font-size: 1.1rem;
            text-decoration: none;
        }
        .action-btn:hover { 
            background: #dc3545; 
            color: white;
            border-color: #dc3545;
        }
        
        .badge-course {
            background-color: #e6e6fa;
            color: #5e2d87;
            padding: 5px 10px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="container" style="margin-top: 100px; padding-bottom: 50px;">
        
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1111">
          <?php if(isset($_SESSION['success'])): ?>
            <div id="successToast" class="toast align-items-center text-bg-success border-0 show" role="alert">
              <div class="d-flex">
                <div class="toast-body" style="font-size: 1.1rem;">
                  <?= $_SESSION['success']; unset($_SESSION['success']); ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
              </div>
            </div>
          <?php endif; ?>

          <?php if(isset($_SESSION['error'])): ?>
            <div id="errorToast" class="toast align-items-center text-bg-danger border-0 show" role="alert">
              <div class="d-flex">
                <div class="toast-body" style="font-size: 1.1rem;">
                  <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
              </div>
            </div>
          <?php endif; ?>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold m-0" style="font-size: 2rem; color: var(--purple-text);">Quản lý Học viên</h4>
        </div>

        <div class="toolbar-container">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" placeholder="Tìm kiếm học viên hoặc khóa học...">
            </div>
            <div class="text-muted fst-italic" style="font-size: 1rem;">
                Tổng số: <?= count($students ?? []) ?> lượt đăng ký

             </div>
        </div>

        <div class="table-container">
            <table class="table table-hover" id="studentsTable">
                <thead>
                    <tr>
                        <th class="col-id">#</th>
                        <th class="text-center">Avatar</th>
                        <th style="text-align: left;">Họ và Tên</th>
                        <th style="text-align: left;">Email</th>
                        <th style="text-align: left;">Khóa học đã đăng ký</th>
                        <th>Ngày đăng ký</th>
                        <th class="text-center">Hủy đăng ký</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($students)): ?>
                        <?php foreach ($students as $index => $stu): ?>
                        <tr>
                            <td class="col-id" style="font-size: 1.1rem;"><?= $index + 1 ?></td>
                            
                            <td class="col-img text-center">
                                <?php 
                                    $avatar = !empty($stu['avatar']) ? '/onlinecourse/assets/avatars/' . $stu['avatar'] : 'https://t4.ftcdn.net/jpg/05/49/98/39/360_F_549983970_bRCkYfk0P6PP5fveM072efagRg8JuC8e.jpg';
                                ?>
                                <img src="<?= $avatar ?>" alt="Avatar">
                            </td>

                            <td class="fw-bold" style="font-size: 1.1rem;"><?= htmlspecialchars($stu['fullname']) ?></td>
                            
                            <td style="font-size: 1.1rem; color: #666;"><?= htmlspecialchars($stu['email']) ?></td>
                            
                            <td>
                                <span class="badge-course">
                                    <i class="fas fa-book-open me-1"></i> <?= htmlspecialchars($stu['course_name']) ?>
                                </span>
                            </td>
                            
                            <td style="font-size: 1.1rem;">
                                <?= date('d/m/Y H:i', strtotime($stu['enrolled_date'])) ?>
                            </td>
                            
                            <td class="col-action">
                                <a href="/onlinecourse/index.php?controller=teacher&action=remove_student&id=<?= $stu['enrollment_id'] ?>" 
                                   class="action-btn" 
                                   title="Hủy đăng ký môn học của học viên này"
                                   onclick="return confirm('Bạn có chắc chắn muốn hủy đăng ký khóa học: <?= htmlspecialchars($stu['course_name']) ?> của học viên <?= htmlspecialchars($stu['fullname']) ?> không? Hành động này không thể hoàn tác.')">
                                    <i class="fas fa-user-times"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="7" class="text-center py-5">Chưa có học viên nào đăng ký khóa học của bạn.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Script tìm kiếm đơn giản trên client
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let searchValue = this.value.toLowerCase();
        let tableRows = document.querySelectorAll('#studentsTable tbody tr');

        tableRows.forEach(row => {
            let text = row.innerText.toLowerCase();
            if(text.includes(searchValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    // Tự động ẩn Toast sau 3s
    setTimeout(() => {
        const toasts = document.querySelectorAll('.toast');
        toasts.forEach(t => {
            const bsToast = new bootstrap.Toast(t);
            bsToast.hide();
        });
    }, 3000);
</script>
</body>
</html>
