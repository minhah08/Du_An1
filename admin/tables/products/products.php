<div class="container-fluid py-4">
  <a class="btn btn-sm btn-info mb-2" href="?action=add_product">Thêm sản phẩm</a>

  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>Sản phẩm</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center justify-content-between mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">STT</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hình ảnh</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tên</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7">Phân loại</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7">Size S</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7">Size M</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7">Size L</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($list_all_product as $row) {
                  extract($row);
                  $img_path = '../assets/img/products/';
                ?>
                  <tr>
                    <td class="text-center p-2" style="width: 25px;">
                      <span><?php echo $id ?></span>
                    </td>
                    <td class="text-center p-2" style="width: 300px;">
                      <img src="<?php echo $img_path . $image ?>" class="me-3" alt="user1" width="100px">
                    </td>
                    <td class=" p-2">
                      <p class="text-sm font-weight-bold mb-0"><?php echo $name_product ?></p>
                    </td>
                    <td class=" p-2">
                      <p class="text-center text-sm font-weight-bold mb-0"><?php echo $name_category ?></p>
                    </td>
                    <?php

                    $id_pro = $row['id'];
                    $list_quantity =  quantity($id_pro);
                    foreach ($list_quantity as $value) {
                    ?>
                      <td class=" p-2">
                        <p class="text-center text-sm font-weight-bold mb-0"><?= $value['quantity'] ?></p>
                      </td>
                    <?php
                    }
                    ?>
                    <td class="align-middle">
                      <div class="d-flex py-5 float-end">
                        <!-- Sửa -->
                        <a name="edit_btn" class="btn bg-secondary btn-sm m-0 mx-1" style="display: flex; align-items: center; justify-content: center;" href="?action=fix_product&id=<?php echo $id ?>">
                          <i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i>
                        </a>
                        <!-- Xóa -->
                        <a name="dlt_btn" class="btn btn-danger btn-sm m-0 mx-1" style=" display: flex; align-items: center; justify-content: center;" onclick="return confirm('Bạn có xác nhận xóa ?');" href="?action=dlt_product&id=<?php echo $id ?>">
                          <i class="fa fa-trash"></i>
                        </a>
                      </div>
                    </td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>