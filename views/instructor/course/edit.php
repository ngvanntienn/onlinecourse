
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Cập nhật khóa học</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/onlinecourse/index.php?controller=course&action=update" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit-id">

                    <div class="mb-3">
                        <label class="form-label">Tên khóa học</label>
                        <input type="text" name="title" id="edit-title" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mô tả</label>
                        <textarea name="description" id="edit-desc" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Học phí</label>
                        <input type="number" name="price" id="edit-price" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Thời lượng</label>
                        <input type="text" name="duration" id="edit-duration" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Trình độ</label>
                        <input type="text" name="level" id="edit-level" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ảnh minh họa</label>
                        <input type="text" name="image" id="edit-image" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn-modal-save">
                        <i class="fas fa-save"></i> Lưu dữ liệu
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>