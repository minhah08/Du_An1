<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>Đơn hàng</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="">
            <form action="" method="post">
              <div class="row my-3 px-2 d-flex">
                <div class="col-md-4 mb-3">
                  <label for="status" class="form-label">Trạng thái</label>
                  <select name="status" class="form-select" name="id_category">
                    <option value="">Tất cả</option>
                    <?php foreach ($getAllStatusOrder as $status) : extract($status); ?>
                      <option value="<?= $id ?>"><?= $name ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-md-4 mb-3 d-flex align-items-end">
                  <button name="filter" type="submit" class="btn mx-1 my-0 px-5" style="background-color: #17c1e8;">Lọc</button>
                  <a href="?action=orders"><button class="btn mx-1 my-0 btn-secondary px-4">Mặc định</button></a>
                </div>
              </div>
            </form>
          </div>
          <div class="table-responsive p-0">
            <table class="table align-items-center justify-content-between mb-0">

              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mã đơn hàng</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">account</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7">date</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7">Status</th>
                <th></th>
              </tr>
              <?php
              foreach ($listorder as $orders) {
                extract($orders);
              ?>
                <tr>
                  <td class="text-center p-2" style="width: 25px;">
                    <span><?= $id ?></span>
                  </td>
                  <td class="text-center p-4">
                    <p class="text-sm font-weight-bold mb-0"><?= $username ?></p>
                  </td>
                  <td class="text-center p-2">
                    <p class="text-sm font-weight-bold mb-0"><?= $order_date ?></p>
                  </td>
                  <td class="text-center p-2" style="width: 300px;">
                    <span class="badge badge-sm 
                      <?php
                      if ($id_status == 0) {
                        echo "bg-warning";
                      } elseif ($id_status == 1) {
                        echo "bg-secondary";
                      } elseif ($id_status == 2) {
                        echo "bg-info";
                      } elseif ($id_status == 3) {
                        echo "bg-dark";
                      } elseif ($id_status == 4) {
                        echo "bg-success";
                      } elseif ($id_status == 5) {
                        echo "bg-danger";
                      }
                      ?> 
                      px-3"><?= $name_status ?></span>
                  </td>
                  <td class="align-middle" style="width: 250px;">
                    <div class="d-flex py-3 float-end">
                      <!-- Xem chi tiết -->
                      <a name="edit_btn" class="btn bg-secondary btn-sm m-0 mx-1" style="display: flex; align-items: center; justify-content: center;" href="index.php?action=order_variants&id=<?php echo $id ?> ">
                        <i class="fa-solid fa-circle-info" style="color: #ffffff;"></i>
                      </a>
                      <!-- Sửa -->
                      <a name="edit_btn" class="btn bg-secondary btn-sm m-0 mx-1" style="display: flex; align-items: center; justify-content: center;" href="index.php?action=update_order&id=<?php echo $id ?> ">
                        <i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i>
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