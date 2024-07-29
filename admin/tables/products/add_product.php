<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Thêm sản phẩm</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="row justify-content-center align-items-center h-100 mt-5">
                            <div class="col-12 col-xl-7">
                                <div class="row">
                                    <div class="col-12 mb-4 d-flex align-items-center">
                                        <div class="form-outline w-100">
                                            <label for="name" class="form-label">Tên sản phẩm</label>
                                            <input type="text" name="name" class="form-control form-control-sm" value="" placeholder="" id="name" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <label class="form-label" for="image">Hình ảnh</label>
                                            <input class="form-control form-control-sm" id="image" name="image" type="file" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4 d-flex align-items-center">
                                        <div class="form-outline datepicker w-100">
                                            <label class="form-label select-label">Loại sản phẩm</label>
                                            <select name="id_category" class="select form-control form-control-sm">
                                                <?php
                                                    foreach ($list_categories as $row){
                                                        extract($row);
                                                        echo "<option value='$id'>$name_category</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mb-4 d-flex align-items-center">
                                        <div class="form-outline datepicker w-100">
                                            <label for="description" class="form-label">Mô tả sản phẩm</label>
                                            <textarea name="description" cols="30" rows="3" class="form-control form-control-sm" id="description"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2 d-flex align-items-center">
                                            <label class="form-label" for="">Size S</label>
                                    </div>

                                    <div class="col-md-5 mb-4 d-flex align-items-center">
                                        <div class="form-outline w-100">
                                            <label class="form-label" for="quantityS">Số lượng</label>
                                            <input type="number" id="quantity" name="quantityS" value="0"  placeholder="" class="form-control form-control-sm" />
                                        </div>
                                    </div>

                                    <div class="col-md-5 mb-4 d-flex align-items-center">
                                        <div class="form-outline w-100">
                                            <label class="form-label" for="priceS">Giá</label>
                                            <input type="number" id="priceS" name="priceS" value="0" placeholder="" class="form-control form-control-sm" />
                                        </div>
                                    </div>
                                </div>  
                                <div class="row">
                                    <div class="col-md-2 d-flex align-items-center">
                                            <label class="form-label" for="">Size M</label>
                                    </div>

                                    <div class="col-md-5 mb-4 d-flex align-items-center">
                                        <div class="form-outline w-100">
                                            <label class="form-label" for="quantityM">Số lượng</label>
                                            <input type="number" id="quantity" name="quantityM" value="0" placeholder="" class="form-control form-control-sm" />
                                        </div>
                                    </div>

                                    <div class="col-md-5 mb-4 d-flex align-items-center">
                                        <div class="form-outline w-100">
                                            <label class="form-label" for="priceM">Giá</label>
                                            <input type="number" id="priceM" name="priceM" value="0" placeholder="" class="form-control form-control-sm" />
                                        </div>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-md-2 d-flex align-items-center">
                                            <label class="form-label" for="">Size L</label>
                                    </div>

                                    <div class="col-md-5 mb-4 d-flex align-items-center">
                                        <div class="form-outline w-100">
                                            <label class="form-label" for="quantityL">Số lượng</label>
                                            <input type="number" id="quantity" name="quantityL" value="0" placeholder="" class="form-control form-control-sm" />
                                        </div>
                                    </div>

                                    <div class="col-md-5 mb-4 d-flex align-items-center">
                                        <div class="form-outline w-100">
                                            <label class="form-label" for="priceL">Giá</label>
                                            <input type="number" id="priceL" name="priceL" value="0" placeholder="" class="form-control form-control-sm" />
                                        </div>
                                    </div>
                                </div> 
                                <div class="button">
                                    <a href="?action=products">
                                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Hủy</button>
                                    </a>
                                    <input type="submit" name="btn_edit" class="btn" style="background-color: #17c1e8;" value="Xác nhận">
                                </div>
                                <?php
                                    if(isset($notificationERROR) && ($notificationERROR != '')){
                                        echo $notificationERROR;
                                    }
                                    if(isset($notification) && ($notification != '')){
                                        echo $notification;
                                    }
                                ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        var quantity_product = document.querySelector('#quantity');
        quantity_product.addEventListener('change', function(){
            if(quantity_product.value < 0) quantity_product.value = 0;
        });
    </script>