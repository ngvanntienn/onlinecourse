function previewFile(input) {
    const file = input.files[0];
    if (!file) return;
    document.getElementById("previewImage").src = URL.createObjectURL(file);
}

document.addEventListener('DOMContentLoaded', function () {
    var toastElSuccess = document.getElementById('successToast');
    if (toastElSuccess) {
        var toast = new bootstrap.Toast(toastElSuccess, {
            delay: 3000,    
            autohide: true  
        });
        toast.show();
    }
    var toastElError = document.getElementById('errorToast');
    if (toastElError) {
        var toast = new bootstrap.Toast(toastElError, {
            delay: 3000,
            autohide: true
        });
        toast.show();
    }
});