<link rel="stylesheet" href="./assets/css/styles.user.products.css">
<section class="mt-20">
    <div class="section-product">
        <div class="wrap-list-products" id="">
            <div class="title-category">
                <h2>SẢN PHẨM BẠN CẦN TÌM ?</h2>
            </div>
            <div class="list-products">
                <?php
                foreach ($list_search_products as $products) {
                    extract($products);
                ?>
                    <div class="item-product">
                        <div class="info mt-15">
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
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>
<?php include 'scroll.php'; ?>