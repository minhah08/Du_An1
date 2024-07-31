 <div class="modal-content">
   <div class="text-center modal-header d-flex justify-content-center">
     <h5 class="text-uppercase text-center modal-title d-flex justify-content-center" id="exampleModalLabel">Chi tiết đơn hàng</h5>
   </div>
   <div class="modal-body">
     <div class="row d-flex justify-content-center pt-2 pb-4">
       <!-- Cột bên trái (2/3) -->
       <div class="col-md-8 ps-5">
         <!-- Thông tin sản phẩm  -->
         <div class="row border border-light rounded-3 ps-3 mb-3">
           <table class="table align-items-center justify-content-between mb-0">
             <thead>
               <tr>
                 <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sản phẩm</th>
                 <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Size</th>
                 <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Số lượng</th>
                 <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7">Giá</th>
               </tr>
               <?php
                $temp_price = 0;
                foreach ($order_details as $order_detail) :
                  extract($order_detail);
                  $temp_price += $quantity * $price;
                ?>
                 <tr>
                   <td class="p-1 d-flex align-items-center">
                     <img class="border rounded" src="<?= '../assets/img/products/' . $image_product ?>" alt="" height="50px">
                     <p class="text-sm font-weight-bold mb-0 ps-2"><?= $name_product ?></p>
                   </td>
                   <td class="text-center p-1">
                     <p class="text-sm font-weight-bold mb-0"><?= $name_size ?></p>
                   </td>
                   <td class="text-center p-1">
                     <p class="text-sm font-weight-bold mb-0"><?= $quantity ?></p>
                   </td>
                   <td class="text-center p-1">
                     <p class="text-sm font-weight-bold mb-0"><?= number_format($price * $quantity) ?> VND</p>
                   </td>
                 </tr>
               <?php endforeach; ?>
           </table>
         </div>
         <!-- Thông tin khách hàng  -->
         <div class="row border border-light rounded-3 px-3">
           <h6 class="text-uppercase text-center modal-title p-3" id="exampleModalLabel">Thông tin khách hàng</h6>
           <table class="table align-items-center justify-content-between mb-0">

             <tr>
               <th class="text-secondary text-xxs font-weight-bolder opacity-7">Họ và tên</th>
               <td class="p-2">
                 <p class="text-sm font-weight-bold mb-0 text-end"><?= $fullname ?></p>
               </td>
             </tr>
             <tr>
               <th class="text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
               <td class="p-2">
                 <p class="text-sm font-weight-bold mb-0 text-end"><?= $email ?></p>
               </td>
             </tr>
             <tr>
               <th class="text-secondary text-xxs font-weight-bolder opacity-7">Số điện thoại</th>
               <td class="p-2">
                 <p class="text-sm font-weight-bold mb-0 text-end"><?= $tel ?></p>
               </td>
             </tr>
             <tr>
               <th class="text-secondary text-xxs font-weight-bolder opacity-7">Địa chỉ</th>
               <td class="p-2">
                 <p class="text-sm font-weight-bold mb-0 text-end"><?= $address ?></p>
               </td>
             </tr>
             <tr>
               <th class="text-secondary text-xxs font-weight-bolder opacity-7">Ghi chú đơn hàng </th>
               <td class="p-2">
                 <p class="text-sm font-weight-bold mb-0 text-end"><?= $notes ?></p>
               </td>
             </tr>
           </table>
         </div>
       </div>
       <!-- Cột bên phải (1/3) -->
       <div class="col-md-4 px-5">
         <div class="row border border-light rounded-3 mb-3">
           <!-- User -->
           <div class="d-flex p-3">
             <div>
               <img src="<?= '../assets/img/accounts/' . $avatar ?>" class="avatar me-3">
             </div>
             <div class="d-flex flex-column justify-content-center">
               <h6 class="mb-0 text-sm"><?= $username ?></h6>
             </div>
           </div>
         </div>
         <!-- Hóa đơn -->
         <div class="row border border-light rounded-3 mb-3">
           <table class="table align-items-center justify-content-between mb-0 table-borderless">
             <tbody>
               <tr>
                 <th class="text-secondary text-xxs font-weight-bolder opacity-7">Ngày mua hàng</th>
                 <td>
                   <p class="text-sm font-weight-bold mb-0 text-end"><?= $order_date ?></p>
                 </td>
               </tr>
               <tr>
                 <th class="text-secondary text-xxs font-weight-bolder opacity-7">Tạm tính</th>
                 <td>
                   <p class="text-sm font-weight-bold mb-0 text-end"><?= number_format($temp_price); ?> VND</p>
                 </td>
               </tr>
               <tr>
                 <th class="text-secondary text-xxs font-weight-bolder opacity-7">Giảm giá</th>
                 <td>
                   <p class="text-sm font-weight-bold mb-0 text-end"><?= number_format($temp_price * ($discount_product / 100)) ?> VND</p>
                 </td>
               </tr>
             </tbody>
           </table>
         </div>
         <!-- Tổng thanh toán -->
         <div class="row border border-light rounded-3">
           <table class="table align-items-center justify-content-between mb-0">
             <tbody>
               <tr>
                 <th class="text-secondary text-xxs font-weight-bolder opacity-7">Tổng thanh toán</th>
                 <td>
                   <p class="text-sm font-weight-bold mb-0 text-end"><?= number_format($temp_price - ($temp_price * ($discount_product / 100))) ?> VND</p>
                 </td>
               </tr>
           </table>
         </div>
       </div>
     </div>
   </div>