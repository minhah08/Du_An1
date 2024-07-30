<link rel="stylesheet" href="./assets/css/styles.user.product_detail.css">
<section>
    <main class="main">
        <div class="product-detail">
            <form action="?act=add_to_card" method="post" enctype="multipart/form-data">
                <div class="product">
                    <div class="file-img">
                        <img src="<?php echo 'assets/img/products/' . $one_product[0]['image'] ?>" alt="" class="image">
                    </div>
                    <div class="content">
                        <div class="file-content">
                            <h4><?php echo $one_product[0]['name'] ?></h4>
                            <input type="hidden" name="id_product" value="<?= $one_product[0]['id_product'] ?>">
                            <p class="price"><?php echo number_format($one_product[0]['price']) . ' VND  '; ?></p>
                            <p class="conect"><?php echo $one_product[0]['description'] ?></p>
                        </div>
                        <div class="table-size">
                            <div class="size-name">
                                <p class="name-size">Size</p>
                            </div>
                            <input type="radio" value="1" name="exp[]" id="<?php echo $one_product[0]['id_size'] ?>">
                            <label for="1"><?php echo $one_product[0]['size'] ?></label>
                            <input type="radio" value="2" name="exp[]" id="<?php echo $one_product[1]['id_size'] ?>">
                            <label for="2"><?php echo $one_product[1]['size'] ?></label>
                            <input type="radio" value="3" name="exp[]" id="<?php echo $one_product[2]['id_size'] ?>">
                            <label for="3"><?php echo $one_product[2]['size'] ?></label>
                        </div>
                        <div class="ntf-quantity" style="margin: 25px 0 5px 0; color: #646464;">
                            <span class="quantity_product"></span>
                        </div>
                        <div class="qty">
                            <div class="q-inner" style="width: 100px;">
                                <button class="btn-minute" type="button" disabled>-</button>
                                <span name="number" class="number" style="display: flex; align-items: center; justify-content: center">1</span>
                                <input type="hidden" name="quantity" id="quantityPro">
                                <button class="btn-plus" type="button">+</button>
                            </div> 
                            <div class="add">
                                <input type="submit" name="addtocart" value="Thêm vào giỏ hàng" class="add-pro"></a>
                            </div>
                        </div>
                        <div class="error mt-3 text-danger">
                            <?php
                            if (isset($_SESSION['error']['size'])) {
                                echo '<p class="text-danger">' . $_SESSION['error']['size'] . '</p>';
                                unset($_SESSION['error']['size']);
                            } else if (isset($_SESSION['error']['quantity'])) {
                                echo '<p class="text-danger">' . $_SESSION['error']['quantity'] . '</p>';
                                unset($_SESSION['error']['quantity']);
                            } else {
                                echo "";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </form>

            <?php
            ?>
            <div class="comment">
                <h4>Bình luận</h4>
                <hr>
                <div class="user-comment">
                    <?php
                    foreach ($list_comments as $comment) {
                        extract($comment);
                    ?>
                        <div class="img-user">
                            <img src="<?php echo 'assets/img/accounts/' . $avatar ?>" alt="" class="img">
                            <span class="text-comment">
                                <div style="display: flex;">
                                    <p style="font-weight: bold;"><?php echo $user ?></p>
                                    <p style="padding: 0 5px;"> - </p>
                                    <p><?php echo $comments_date ?></p>
                                </div>
                                <p><?php echo $content ?></p>
                            </span>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="add-comment">
                        <?php
                        if (isset($_SESSION['user'])) {
                        ?>
                            <form action="?act=comment_user" method="POST">
                                <input type="hidden" name="id_product" value="<?php echo $one_product[0]['id_product'] ?>">
                                <input type="text" name="content" id="" placeholder="Viết bình luận..." class="text-1">
                                <input type="submit" name="send" id="" value="Đăng bình luận" class="sb-comment">
                            </form>
                            <?php
                            if (isset($_SESSION['error']['content'])) {
                                echo '<p class="text-danger">' . $_SESSION['error']['content'] . '</p>';
                            } else {
                                echo "";
                            }
                            ?>
                        <?php
                        } else {
                            echo '<h4>Vui lòng đăng nhập để bình luận</h4>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!-- COMMENT -->
            <div class="related-products">
                <h4 class="pro-cx">Sản phẩm liên quan</h4>
                <div class="sum-relad">
                    <?php
                    foreach ($similar_product as $row) {
                        extract($row);
                    ?>
                        <div class="item-product">
                            <div class="info">
                                <a href="?act=product_detail&id=<?php echo $id_product ?>"><img src="<?php echo 'assets/img/products/' . $image_product ?>" alt="" /></a>
                                <a href="?act=product_detail&id=<?php echo $id_product ?>">
                                    <p class="mb-10 content"><?php echo $name_product ?></p>
                                </a>
                                <p class="mb-10 sub-content"><?php echo $description ?></p>
                            </div>
                            <div class="price">
                                <p class="price-box"><?php echo number_format($price) ?> VND</p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </main>
    <?php include 'scroll.php'; ?>
</section>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get relevant elements
        var minusButton = document.querySelector('.btn-minute');
        var plusButton = document.querySelector('.btn-plus');
        var quantityElement = document.querySelector('.number');
        var quantityPro = document.querySelector('#quantityPro');

        // Initial quantity value
        var quantity = 1;
        var quantityE;
        var maxQuantity = 0;
        // PRICE PRODUCT
        var priceS = '<?= number_format($one_product[0]['price']) ?>';
        var priceM = '<?= number_format($one_product[1]['price']) ?>';
        var priceL = '<?= number_format($one_product[2]['price']) ?>';
        var quantityS = '<?= $one_product[0]['quantity'] ?>';
        var quantityM = '<?= $one_product[1]['quantity'] ?>';
        var quantityL = '<?= $one_product[2]['quantity'] ?>';

        var price = document.querySelector('.price');
        var quantity_product = document.querySelector('.quantity_product');
        var radioS = document.getElementById('1');
        var radioM = document.getElementById('2');
        var radioL = document.getElementById('3');
        radioS.onclick = function() {
            price.textContent = priceS + ' VND';
            quantity_product.textContent = quantityS + ' sản phẩm có sẵn';
            maxQuantity = quantityS;
            if (quantityElement.textContent > quantityS) {
                quantityElement.textContent = quantityS;
                quantityPro.value = quantityS;
            }
        }

        radioM.onclick = function() {
            price.textContent = priceM + ' VND';
            quantity_product.textContent = quantityM + ' sản phẩm có sẵn';
            maxQuantity = quantityM;
            if (quantityElement.textContent > quantityM) {
                quantityElement.textContent = quantityM;
                quantityPro.value = quantityM;
            }
        }

        radioL.onclick = function() {
            price.textContent = priceL + ' VND';
            quantity_product.textContent = quantityL + ' sản phẩm có sẵn';
            maxQuantity = quantityL;
            if (quantityElement.textContent > quantityL) {
                quantityElement.textContent = quantityL;
                quantityPro.value = quantityL;
            }
        } 
        // Function to update the quantity and enable/disable buttons
        function updateQuantity() {
            quantityElement.textContent = quantity;
            quantityPro.value = quantity;
            minusButton.disabled = (quantity === 1);
            plusButton.disabled = quantityE // Enable the plus button, you might want to add conditions here
        }

        // Event listener for the minus button
        minusButton.addEventListener('click', function() {
            if (quantity > 1) {
                quantity--;
                updateQuantity();
            }
        });

        // Event listener for the plus button
        plusButton.addEventListener('click', function() {
            if (quantity < maxQuantity) {  
                quantity++;
                updateQuantity();
            }
        });

        // Initial update
        updateQuantity();
    });
</script>