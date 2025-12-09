<div class="modal fade" id="filterModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Bộ lọc tìm kiếm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-2">
                <form action="" method="GET">
                    <div class="mb-3">
                        <label class="fw-bold mb-2">Danh mục</label>
                        <div class="d-flex flex-wrap gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="cat_it">
                                <label class="form-check-label" for="cat_it">IT</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="cat_eng">
                                <label class="form-check-label" for="cat_eng">Tiếng Anh</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="cat_math">
                                <label class="form-check-label" for="cat_math">Toán</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="cat_lit">
                                <label class="form-check-label" for="cat_lit">Văn</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="cat_other">
                                <label class="form-check-label" for="cat_other">Khác</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold mb-2">Cấp độ</label>
                        <div class="d-flex flex-wrap gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="lvl_basic">
                                <label class="form-check-label" for="lvl_basic">Cơ bản</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="lvl_inter">
                                <label class="form-check-label" for="lvl_inter">Trung cấp</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="lvl_adv">
                                <label class="form-check-label" for="lvl_adv">Nâng cao</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="lvl_all">
                                <label class="form-check-label" for="lvl_all">Mọi cấp độ</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold mb-2">Giá cả</label>
                        <div class="d-flex flex-wrap gap-5">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="price_free">
                                <label class="form-check-label" for="price_free">Miễn phí</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="price_paid">
                                <label class="form-check-label" for="price_paid">Có phí</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="price_all">
                                <label class="form-check-label" for="price_all">Tất cả</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold mb-2">Đánh giá</label>
                        <div class="d-flex flex-column gap-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="star_5">
                                <label class="form-check-label" for="star_5">5 sao</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="star_4">
                                <label class="form-check-label" for="star_4">4 sao trở lên</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="star_3">
                                <label class="form-check-label" for="star_3">3 sao trở lên</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="star_2">
                                <label class="form-check-label" for="star_2">2 sao trở lên</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="star_1">
                                <label class="form-check-label" for="star_1">1 sao trở lên</label>
                            </div>
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-apply-filter">Áp dụng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
