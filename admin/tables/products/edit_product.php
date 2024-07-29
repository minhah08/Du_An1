<?php
    if(is_array($load_one_product)){
        extract($load_one_product);
        // $img_path = './assets/img/products/'.$image;
        // $id_category = $id_category;
        // echo '<pre>';
        // print_r($load_one_product);
        // echo '</pre>';
    }
?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Cập nhật sản phẩm</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <form action="?action=update_products" method="POST" enctype="multipart/form-data">
                        <div class="row justify-content-center align-items-center h-100 mt-5">
                            <div class="col-12 col-xl-7">
                                <div class="row">
                                    <div class="col-12 mb-4 d-flex align-items-center">
                                        <div class="form-outline w-100">
                                            <label for="name" class="form-label">Tên sản phẩm</label>
                                            <input type="text" name="name" class="form-control form-control-sm" value="<?php echo $load_one_product[0]['name'] ?>" placeholder="" id="name" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <label class="form-label" for="image">Hình ảnh</label> <br>
                                            <input class="form-control form-control-sm" id="image" name="image" value="<?php echo $load_one_product[0]['image'] ?>"  type="file" />

                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4 d-flex align-items-center">
                                        <div class="form-outline datepicker w-100">
                                            <label class="form-label select-label">Loại sản phẩm</label>
                                            <select name="id_category" class="select form-control form-control-sm">
                                                <option value="0" >--Tất cả</option>
                                                <?php
                                                    foreach ($list_categories as $row){
                                                        extract($row);
                                                        if($load_one_product[0]['id_category'] == $id){
                                                            echo "<option value='$id' selected>$name_category</option>";
                                                        }else{
                                                            echo "<option value='$id'>$name_category</option>";
                                                        }
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
                                            <textarea name="description" cols="30" rows="3" class="form-control form-control-sm" id="description"><?php echo $load_one_product[0]['description'] ?></textarea>
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
                                            <input type="number" id="quantityS" name="quantityS" value="<?php echo $load_one_product[0]['quantity'] ?>" placeholder="" class="form-control form-control-sm" />
                                        </div>
                                    </div>

                                    <div class="col-md-5 mb-4 d-flex align-items-center">
                                        <div class="form-outline w-100">
                                            <label class="form-label" for="priceS">Giá</label>
                                            <input type="number" id="priceS" name="priceS" value="<?php echo $load_one_product[0]['price'] ?>" placeholder="" class="form-control form-control-sm" />
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
                                            <input type="number" id="quantityM" name="quantityM" value="<?php echo $load_one_product[1]['quantity'] ?>" placeholder="" class="form-control form-control-sm" />
                                        </div>
                                    </div>

                                    <div class="col-md-5 mb-4 d-flex align-items-center">
                                        <div class="form-outline w-100">
                                            <label class="form-label" for="priceM">Giá</label>
                                            <input type="number" id="priceM" name="priceM" value="<?php echo $load_one_product[1]['price'] ?>" placeholder="" class="form-control form-control-sm" />
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
                                            <input type="number" id="quantityL" name="quantityL" value="<?php echo $load_one_product[2]['quantity'] ?>" placeholder="" class="form-control form-control-sm" />
                                        </div>
                                    </div>

                                    <div class="col-md-5 mb-4 d-flex align-items-center">
                                        <div class="form-outline w-100">
                                            <label class="form-label" for="priceL">Giá</label>
                                            <input type="number" id="priceL" name="priceL" value="<?php echo $load_one_product[2]['price'] ?>" placeholder="" class="form-control form-control-sm" />
                                        </div>
                                    </div>
                                </div>                            
                                <div class="button">
                                    <a href="?action=products">
                                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Hủy</button>
                                    </a>
                                    <input type="hidden" name="id"  value="<?php echo $load_one_product[0]['id_product'] ?>">
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