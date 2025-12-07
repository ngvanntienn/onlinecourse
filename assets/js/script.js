document.addEventListener("DOMContentLoaded", function() {

    const modal = document.getElementById('loginModal');
    const closeBtn = document.getElementById('closeLoginModal');
    const loginBtn = document.getElementById('goLoginModal');

    // ẩn modal mặc định khi load trang
    if(modal) modal.style.display = 'none';

    // Các selector cần đăng nhập
    const loginRequiredSelectors = [
        '.btn-role-outline',     
        '.btn-role-purple',      
        '.btn-see-detail',        
        '.btn.btn-sm.btn-danger',
        '.btn-discovery-purple'
    ];

    // gắn sự kiện click để mở modal
    loginRequiredSelectors.forEach(selector => {
        document.querySelectorAll(selector).forEach(el => {
            el.addEventListener('click', function(e) {
                e.preventDefault();
                modal.style.display = 'flex';
            });
        });
    });

    // Đóng modal khi nhấn nút đóng
    closeBtn.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    // điều hướng tới trang đăng nhập
    loginBtn.addEventListener('click', function() {
        modal.style.display = 'none'; // Ẩn modal trước khi redirect
        window.location.href = "/onlinecourse/index.php?controller=auth&action=login";
    });

    // Đóng khi click ra ngoài modal
    window.addEventListener('click', function(e) {
        if(e.target === modal){
            modal.style.display = 'none';
        }
    });

    // Đảm bảo modal luôn ẩn khi quay lại
    window.addEventListener('pageshow', function(event) {
        // pageshow sẽ chạy khi load từ cache (back/forward)
        if(event.persisted){
            modal.style.display = 'none';
        }
    });

    // scroll khi ấn vào xem khóa học
    document.querySelectorAll('nav a, header a').forEach(link => {
        if (link.textContent.includes('Khóa học')) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.getElementById('discovery-section');
                if(target){
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        }
    });

});

// xử lý ký tự password 
const newPassword = document.getElementById('new_password');
const lengthReq = document.getElementById('length');
const upperReq = document.getElementById('uppercase');
const numberReq = document.getElementById('number');
const specialReq = document.getElementById('special');

newPassword.addEventListener('input', function() {
    const val = newPassword.value;
    lengthReq.classList.toggle('valid', val.length >= 8);
    lengthReq.classList.toggle('invalid', val.length < 8);

    upperReq.classList.toggle('valid', /[A-Z]/.test(val));
    upperReq.classList.toggle('invalid', !/[A-Z]/.test(val));

    numberReq.classList.toggle('valid', /[0-9]/.test(val));
    numberReq.classList.toggle('invalid', !/[0-9]/.test(val));

    specialReq.classList.toggle('valid', /[@#._%$!]/.test(val));
    specialReq.classList.toggle('invalid', !/[@#._%$!]/.test(val));
});