<div class="container-fluid py-4">
  <a class="btn btn-sm btn-info mb-2" href="?action=add_discount_code">Thêm mã giảm giá</a>
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>Mã giảm giá</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center justify-content-between mb-0">
              
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">STT</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">code</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">giảm giá</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">số lượng</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ngày hết hạn</th>
                  <th></th>
                </tr>

                  <?php
                  foreach ($listcode as $discounts_code) {
                    
                  ?>
                  <tr>
                    <td class="text-center p-2" style="width: 25px;">
                      <span><?php echo $discounts_code['id'] ?></span>
                    </td>
                    <td class="text-center px-4">
                      <p class="text-sm font-weight-bold mb-0"><?php echo $discounts_code['code'] ?></p>
                    </td>
                    <td class="text-center px-4">
                      <p class="text-sm font-weight-bold mb-0"><?php echo $discounts_code['discount'] ?></p>
                    </td>
                    <td class="text-center px-4">
                      <p class="text-sm font-weight-bold mb-0"><?php echo $discounts_code['quantity'] ?></p>
                    </td>
                    <td class="text-center p-2">
                      <p class="text-sm font-weight-bold mb-0"><?php echo $discounts_code['expiration_date'] ?></p>
                    </td>
                    <td class="align-middle" style="width: 250px;">
                      <div class="d-flex py-3 float-end"> 
                        <!-- Sửa -->
                        <a name="edit_btn" class="btn bg-secondary btn-sm m-0 mx-1" style="display: flex; align-items: center; justify-content: center;" href="index.php?action=update_discount_code&id=<?php echo $discounts_code['id'] ?> ">
                          <i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i>
                        </a>
                        <!-- Xóa -->
                        <a name="dlt_btn" class="btn btn-danger btn-sm m-0 mx-1" style=" display: flex; align-items: center; justify-content: center;" onclick="return confirm('Bạn có xác nhận xóa ?');" href="index.php?action=delete_discount_code&id=<?php echo $discounts_code['id'] ?> ">
                          <i class="fa fa-trash"></i>
                        </a>
                      </div>
                    </td>
                  </tr>
                  <?php
                }
                  ?>
                
             
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>