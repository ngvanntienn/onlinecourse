console.log("Detail page JS loaded.");

let allCourses = [];
let initialCourse = null;
let expanded = false;

document.addEventListener("DOMContentLoaded", () => {
    const courseList = document.getElementById("course-list");
    const btn = document.getElementById("load-more");
    allCourses = Object.values(window.otherCourses).filter(c => c.id !== window.currentCourseId);
    initialCourse = allCourses.length > 0 ? allCourses[0] : null;

    function renderInitial() {
        if (!initialCourse) return;
        courseList.innerHTML = courseCard(initialCourse);
    }

    function courseCard(c) {
        return `
            <div class="course-item mb-5">
                <div class="course-header d-flex justify-content-between align-items-baseline mb-2">
                    <h5 class="course-cat-name fw-bold text-dark">${c.title}</h5>
                    <a href="/onlinecourse/views/courses/detail.php?id=${c.id}"
                    class="text-dark fw-bold small" style="font-size: 1.3rem;">
                        XEM CHI TIẾT <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="course-img-wrapper mb-3">
                    <img src="${c.banner_img}" class="img-fluid w-100 shadow-sm" alt="${c.title}">
                </div>
                <button class="btn btn-register-pink w-100" style="font-size: 1.6rem;">Đăng ký ngay</button>
            </div>
        `;
    }

    function renderAll() {
        courseList.innerHTML = allCourses.map(c => courseCard(c)).join("");
    }

    // initial load
    renderInitial();

    btn.addEventListener("click", () => {
        if (!expanded) {
            renderAll();
            btn.innerText = "Thu gọn";
            expanded = true;
        } else {
            renderInitial();
            btn.innerText = "Xem thêm";
            expanded = false;
        }
    });
});
