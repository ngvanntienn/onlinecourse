function previewFile(input) {
    const file = input.files[0];
    if (!file) return;
    document.getElementById("previewImage").src = URL.createObjectURL(file);
}