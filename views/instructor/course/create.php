
<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Thêm khóa học</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <form action="/onlinecourse/index.php?controller=course&action=create" method="POST"><div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Tên khóa học</label>
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mô tả</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Học phí</label>
                        <input type="number" name="price" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Thời lượng</label>
                        <input type="text" name="duration" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Trình độ</label>
                        <input type="text" name="level" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ảnh minh họa</label>
                        <input type="text" name="image" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Hủy bỏ</button>
                    <button type="submit" class="btn-modal-add">Thêm</button>
                </div>
            </form>
        </div>
    </div>
</div>