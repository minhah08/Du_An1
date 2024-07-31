<div class="container-fluid py-4">
  <a class="btn btn-sm btn-info mb-2" href="?action=add_account">Thêm tài khoản</a>
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>Người dùng</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tên tài khoản</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Họ và tên</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Địa chỉ</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Số điện thoại</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Vai trò</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 1;
                foreach ($getAccounts as $account) :
                  extract($account);
                ?>
                  <tr>
                    <td class="text-center" style="width: 15px;">
                      <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                    </td>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex align-items-center justify-content-center">
                          <img src="<?= $pathImg . $avatar ?>" class="avatar avatar-sm me-3" alt="user1">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm"><?= $username ?></h6>
                          <p class="text-xs text-secondary mb-0"><?= $email ?></p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $fullname ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0 px-3 text-truncate" style="width: 400px;"><?= $address ?></p>
                    </td>
                    <td class="align-middle">
                      <span class="text-secondary text-xs font-weight-bold  px-3"><?= $tel ?></span>
                    </td>
                    <td class="align-middle text-sm">
                      <span class="badge badge-sm bg-<?= $id_role == 0 ? "danger" : "warning" ?> px-3"><?= $id_role == 0 ? "Admin" : "Client" ?></span>
                    </td>
                    <td class="align-middle d-flex py-4">
                      <!-- Sửa -->
                      <a name="edit_btn" class="btn bg-secondary btn-sm m-0 mx-1" style="display: flex; align-items: center; justify-content: center;" href="?action=edit_account&acc_id=<?= $id ?>">
                        <i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i>
                      </a>
                      <!-- Xóa -->
                      <a name="dlt_btn" class="btn btn-danger btn-sm m-0 mx-1" style=" display: flex; align-items: center; justify-content: center;" onclick="return confirm('Bạn có xác nhận xóa ?');" href="?action=delete_account&acc_id=<?= $id ?>">
                        <i class="fa fa-trash"></i>
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div> 
      </div>
    </div>
  </div>