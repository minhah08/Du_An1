<link rel="stylesheet" href="./assets/css/styles.user.pay.css">
<main class="mt-20 mb-20 mb-100">
  <h2 class="title-pay">Thanh toán</h2>
  <form action="" method="post">
    <div class="section-pay">
      <div class="box-left">
        <h3>Thông tin đặt hàng</h3>
        <div class="letf-bottom">
          <div class="row mb-20">
            Họ và tên* <br />
            <input type="text" name="fullname" value="<?= $getAccountById['fullname'] ?>" />
          </div>
          <?php
          if (isset($_SESSION['error']['fullname'])) {
            echo "<div class='text-danger row mb-20'>" . $_SESSION['error']['fullname'] . "</div>";
          } 
          ?>
          <div class="row mb-20">
            Email* <br />
            <input type="email" name="email" value="<?= $getAccountById['email'] ?>" />
          </div>
          <?php 
          if (isset($_SESSION['error']['email'])) {
            echo "<div class='text-danger row mb-20'>" . $_SESSION['error']['email'] . "</div>";
          } 
          ?>
          <div class="row mb-20">
            Số điện thoại* <br />
            <input type="text" name="tel" value="<?= $getAccountById['tel'] ?>" />
          </div>
          <?php 
          if (isset($_SESSION['error']['tel'])) {
            echo "<div class='text-danger row mb-20'>" . $_SESSION['error']['tel'] . "</div>";
          }
          ?>
          <div class="row mb-20">
            Địa chỉ* <br />
            <input type="text" name="address" value="<?= $getAccountById['address'] ?>" />
          </div>
          <?php 
          if (isset($_SESSION['error']['address'])) {
            echo "<div class='text-danger row mb-20'>" . $_SESSION['error']['address'] . "</div>";
          }
          ?>
          <div class="row mb-20">
            Ghi chú <br />
            <textarea name="notes"></textarea>
          </div>
        </div>
      </div>
      <div class="box-right">
        <h3>Xem lại đơn hàng</h3>
        <div class="right-top">
          <table>
            <tr>
              <th>Tên sản phẩm</th>
              <th>Size</th>
              <th>Số lượng</th>
              <th>Thành tiền</th>
            </tr>
            <?php
            $total_price = 0;
            $discount = $discount;
            $temp_price = 0;
            foreach ($load_card as $card) {
              extract($card);
              $temp_price = $price * $quantity;
              $total_price += $temp_price;
            ?>
              <tr>
                <td style="text-align: start;">
                  <?= $name_product ?>
                  <input type="hidden" name="id_product" value="">
                </td>
                <td class="color-price">
                  <?= $name_size ?>
                  <input type="hidden" name="id_size" value="">
                </td>
                <td>
                  <?= $quantity ?>
                  <input type="hidden" name="quantity" value="">
                </td>
                <td class="color-price">
                  <?= number_format($temp_price) ?>VND
                  <input type="hidden" name="total_amount_product" value="">
                </td>
              </tr>
            <?php }
            $total_amount = $total_price - $discount;
            ?>
          </table>
        </div>
        <div class="right-bottom">
          <div class="order-detail">
            <table>
              <tr style="height: 26px;">
                <th style="text-align: start;" scope="row">Tạm tính</th>
                <td style="text-align: end;"><?= number_format($total_price); ?>VND</td>
              </tr>
              <tr style="height: 26px;">
                <th style="text-align: start;" scope="row">Giảm giá</th>
                <td style="text-align: end;"><?= number_format($discount); ?>VND</td>
              </tr>
              <tr style="height: 26px;">
                <th style="text-align: start;" scope="row">Tổng thanh toán</th>
                <td style="text-align: end;"><?= number_format($total_amount); ?>VND</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="confirm-oder mt-20">
      <a href="?act=menu" class="letf-confirm">Tiếp tục mua hàng</a>
      <input type="hidden" name="id_code_discount" value="<?= $id_code_discount ?>">
      <input type="submit" name="submit_order" value="Xác nhận mua hàng" class="right-confirm">
    </div>
  </form> 
</main>