<div class="modal fade" id="uploadAvatarModal" tabindex="-1" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
    <form action="/onlinecourse/index.php?controller=student&action=upload_avatar" method="POST" enctype="multipart/form-data">
        <div class="modal-content">

            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Cập nhật ảnh đại diện</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center pt-0">
                <img id="previewImage" src="<?= $avatarDisplay ?>" 
                    class="rounded-circle mb-3" 
                    style="width: 120px; height: 120px; object-fit: cover; border: 4px solid #f0f0f0;">

                <p class="text-muted small">Tải lên ảnh mới (JPG, PNG)</p>
                <input class="form-control" type="file" name="avatar" accept="image/*" required onchange="previewFile(this)">
            </div>

            <div class="modal-footer border-0 justify-content-center pb-4">
                <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Hủy</button>
                <button type="submit" class="btn text-white px-4" style="background: #a582e6;">Lưu thay đổi</button>
            </div>

        </div>
    </form>
</div>