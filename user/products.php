<link rel="stylesheet" href="./assets/css/styles.user.products.css">
<section class="mt-20">
  <!-- LIST CATEGORY -->
  <div class="list-category">
    <?php
    foreach ($list_category_home as $category) {
      extract($category);
    ?>
      <div class="category-item">
        <a href="#<?php echo $name_category ?>"><img src="<?php echo 'assets/img/categories/' . $image ?>" alt="" /></a>
        <a href="#<?php echo $name_category ?>">
          <h6><?php echo $name_category ?></h6>
        </a>
      </div>
    <?php
    }
    ?>
  </div>

  <!-- LIST PRODUCTS -->
  <div class="section-product">
    <?php
    foreach ($list_category_home as $category) {
    ?>
      <div class="wrap-list-products" id="<?php echo $category['name_category'] ?>">

        <div class="title-category">
          <h3><?php echo $category['name_category'] ?></h3>
        </div>
        <div class="list-products">
          <?php
          $list = list_products($category['id']);
          foreach ($list as $product) {
            extract($product);
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
    <?php
    }
    ?>
  </div>
  <?php include 'scroll.php'; ?>
</section>
