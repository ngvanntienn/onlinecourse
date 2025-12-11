
// js hiển thị dữ liệu khóa học 
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn-edit').forEach(btn => {
        btn.addEventListener('click', () => {
            // hiển thị dữ liệu
            const id = btn.dataset.id;
            const title = btn.dataset.title;
            const desc = btn.dataset.desc;
            const price = btn.dataset.price;
            const duration = btn.dataset.duration;
            const level = btn.dataset.level;
            const image = btn.dataset.image;

            // gán dữ liệu
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-title').value = title;
            document.getElementById('edit-desc').value = desc;
            document.getElementById('edit-price').value = price;
            
            if(document.getElementById('edit-duration')) 
                document.getElementById('edit-duration').value = duration;
            
            if(document.getElementById('edit-level')) 
                document.getElementById('edit-level').value = level;
            
            if(document.getElementById('edit-image')) 
                document.getElementById('edit-image').value = image;
        });
    });
});