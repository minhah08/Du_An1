<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Thêm danh mục</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="row justify-content-center align-items-center h-100 mt-5">
                            <div class="col-12 col-xl-7">
                                <div class="row">
                                    <div class="col-12 mb-4 d-flex align-items-center">
                                        <div class="form-outline datepicker w-100">
                                            <label for="name_category" class="form-label">Tên danh mục</label>
                                            <input type="text" name="name_category" class="form-control form-control-sm" value="" placeholder="" id="name_category" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-4 pb-2">
                                        <div class="form-outline">
                                            <label class="form-label" for="image">Hình ảnh</label>
                                            <input class="form-control form-control-sm" id="image" name="image" type="file" />
                                        </div>
                                    </div>
                                </div>
                                <div class="button">
                                    <a href="?action=categories">
                                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Hủy</button>
                                    </a>
                                    <input type="submit" name="btn_edit" class="btn" style="background-color: #17c1e8;" value="Xác nhận">
                                </div> 
                                <?php
                                if (isset($_SESSION['nofication']['error'])) {
                                    echo "<span class='text-danger'>" . $_SESSION['nofication']['error'] . "</span>";
                                } else if (isset($_SESSION['nofication']['success'])) {
                                    echo "<span class='text-success'>" . $_SESSION['nofication']['success'] . "</span>";
                                } else {
                                    echo "";
                                }
                                ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>