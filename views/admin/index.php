<?php
require_once './config/Database.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$db = new Database();
$conn = $db->pdo;
$keyword = $_GET['keyword'] ?? '';
$roleFilter = $_GET['role'] ?? 'all';
$statusFilter = $_GET['status'] ?? 'all';
$sqlUsers = "SELECT * FROM users WHERE 1=1";
$params = [];

// Lọc theo từ khóa
if (!empty($keyword)) {
    $sqlUsers .= " AND (fullname LIKE :keyword OR email LIKE :keyword)";
    $params[':keyword'] = '%' . $keyword . '%';
}

// Lọc theo vai trò (Dựa theo SQL dump: 0=Học viên, 1=Giáo viên, 2=Admin)
if ($roleFilter !== 'all') {
    $sqlUsers .= " AND role = :role";
    $params[':role'] = $roleFilter;
}

if ($statusFilter !== 'all') {
    $sqlUsers .= " AND status = :status";
    $params[':status'] = $statusFilter;
}

$sqlUsers .= " ORDER BY created_at DESC";
$stmtUsers = $conn->prepare($sqlUsers);
foreach ($params as $key => $val) {
    $stmtUsers->bindValue($key, $val);
}
$stmtUsers->execute();
$usersList = $stmtUsers->fetchAll(PDO::FETCH_ASSOC);
function getRoleName($role) {
    return match((int)$role) {
        2 => 'Admin',
        1 => 'Giáo viên',
        0 => 'Học viên',
        default => 'Không xác định',
    };
}


require_once 'views/layouts/header_students.php'; 
?>

<link rel="stylesheet" href="/onlinecourse/assets/css/admin.css?v=<?= time() ?>">

<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="hero-title"><span class="text-title">Xin chào, </span><?= $_SESSION['fullname'] ?? 'Admin' ?></h1>    
            </div>
            <div class="col-md-6">
                <div class="hero-image-wrapper">
                    <img src="/onlinecourse/assets/image/hero/student.png" alt="Student" class="img-fluid hero-girl-img">
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container mb-5">
    
    <form action="" method="GET">
        <input type="hidden" name="controller" value="admin">
        <input type="hidden" name="action" value="users">

        <h4 class="fw-bold mb-3" style = "margin-top: 30px; font-size: 1.9rem;">Tìm kiếm</h4>
        <div class="search-container">
            <i class="fas fa-search"></i>
            <input type="text" name="keyword" class="search-input" 
                   placeholder="Nhập tên người dùng hoặc email..." 
                   value="<?= htmlspecialchars($keyword) ?>">
        </div>

        <h4 class="fw-bold mb-3" style = "font-size: 1.9rem;">Quản lý người dùng</h4>
        <div class="filter-section ps-2">
            <div class="d-flex align-items-center mb-3 flex-wrap">
                <span class="filter-label">Vai trò :</span>
                <?php 
                $roles = [1 => 'Giáo viên', 0 => 'Học viên', 2 => 'Admin', 'all' => 'Tất cả'];
                foreach ($roles as $key => $label): 
                ?>
                    <div class="form-check custom-radio">
                        <input class="form-check-input" type="radio" name="role" value="<?= $key ?>" id="role_<?= $key ?>" <?= (string)$roleFilter === (string)$key ? 'checked' : '' ?>>
                        <label class="form-check-label" for="role_<?= $key ?>"><?= $label ?></label>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="d-flex align-items-center mb-3 flex-wrap">
                <span class="filter-label">Trạng thái :</span>
                <?php 
                $statuses = [1 => 'Đang hoạt động', 0 => 'Vô hiệu hóa', 'all' => 'Tất cả'];
                foreach ($statuses as $key => $label): 
                ?>
                    <div class="form-check custom-radio">
                        <input class="form-check-input" type="radio" name="status" value="<?= $key ?>" id="status_<?= $key ?>" <?= (string)$statusFilter === (string)$key ? 'checked' : '' ?>>
                        <label class="form-check-label" for="status_<?= $key ?>"><?= $label ?></label>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="d-flex justify-content-end mb-4">
                <button type="submit" class="btn btn-purple" style = "font-size: 1.6rem;">Lọc &rarr;</button>
            </div>
        </div>
    </form>

<div class="card shadow-sm border-0" style="border-radius: 12px; overflow: hidden;">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-custom mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">TÊN NGƯỜI DÙNG</th>
                        <th>EMAIL</th>
                        <th>VAI TRÒ</th>
                        <th class="text-center">TRẠNG THÁI</th>
                        <th>NGÀY TẠO</th>
                        <th class="text-center">HOẠT ĐỘNG</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($usersList)): ?>
                        <?php foreach ($usersList as $user): ?>
                            <tr>
                                <td class="ps-4">
                                    <div class="user-name"><?= htmlspecialchars($user['fullname']) ?></div>
                                </td>
                                
                                <td>
                                    <a href="mailto:<?= htmlspecialchars($user['email']) ?>" class="email-text">
                                        <?= htmlspecialchars($user['email']) ?>
                                    </a>
                                </td>
                                
                                <td>
                                    <span class="role-text"><?= getRoleName($user['role']) ?></span>
                                </td>
                                
                                <td class="text-center">
                                    <?php 
                                        $status = $user['status'] ?? 1; 
                                        $dotClass = ($status == 1) ? 'dot-green' : 'dot-red';
                                    ?>
                                    <span class="status-dot <?= $dotClass ?>"></span>
                                </td>
                                
                                <td><?= date('d/m/Y', strtotime($user['created_at'])) ?></td>
                                
                                <td class="text-center">
                                    <a href="index.php?controller=admin&action=update_status&id=<?= $user['id'] ?>&status=1" 
                                       class="action-icon icon-active" 
                                       title="Kích hoạt"
                                       onclick="return confirm('Kích hoạt tài khoản này?')">
                                        <i class="fas fa-bolt"></i>
                                    </a>

                                    <a href="index.php?controller=admin&action=update_status&id=<?= $user['id'] ?>&status=0" 
                                       class="action-icon icon-inactive" 
                                       title="Vô hiệu hóa"
                                       onclick="return confirm('Vô hiệu hóa tài khoản này?')">
                                        <i class="fas fa-times-circle"></i>
                                    </a>
                                    
                                   
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="fas fa-inbox fa-3x mb-3 opacity-50"></i><br>
                                Không tìm thấy người dùng nào phù hợp.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
        <div class="modal fade" id="userDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content custom-modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-decoration-underline">Chi tiết thông tin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            

            <div class="modal-footer border-0 justify-content-between pt-0 pb-4 px-4">
                <a href="#" id="btnActivate" class="btn btn-action btn-purple-modal w-45">
                    <i class="fas fa-bolt me-1"></i> Kích hoạt
                </a>
                <a href="#" id="btnDeactivate" class="btn btn-action btn-gray-modal w-45">
                    <i class="fas fa-times-circle me-1"></i> Vô hiệu hóa
                </a>
            </div>
        </div>
    </div>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<?php require_once 'views/layouts/footer.php'; ?>
<?php require_once 'views/users/manage.php'; ?>
<?php require_once 'views/instructor/materials/upload_admin.php';?>