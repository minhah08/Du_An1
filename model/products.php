<?php
function getAllProducts()
{
    try {
        $sql = "SELECT * FROM products;";
        return pdo_query($sql);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function insert_products($name, $description, $id_category, $image)
{
    $sql = "INSERT INTO products(name,image,description,id_category) VALUES('$name','$image','$description','$id_category')";
    pdo_execute($sql);
}

function getLatestProductsId()
{
    try {
        $sql = "SELECT id FROM products ORDER BY id DESC LIMIT 1;";
        return pdo_query_one($sql);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function insert_product_variant($getLatestProductsIdData, $id_size, $price, $quantity)
{
    $sql = "INSERT INTO product_variants(id_product,id_size,price,quantity)
            VALUES('$getLatestProductsIdData','$id_size','$price','$quantity')";
    pdo_execute($sql);
}

function load_all_product_category_variant()
{
    $sql = "SELECT p.id AS id ,p.image AS image ,p.name AS name_product, c.name_category
        FROM products p
        INNER JOIN categories c ON p.id_category = c.id
        ORDER BY p.id DESC";
    $list_all_product = pdo_query($sql);
    return $list_all_product;
}


function quantity($id_pro)
{
    $sql = "SELECT * FROM product_variants 
        INNER JOIN products ON product_variants.id_product = products.id
        INNER JOIN sizes ON product_variants.id_size = sizes.id
        WHERE id_product = $id_pro";
    $quantity = pdo_query($sql);
    return $quantity;
}

function load_one_product($id)
{
    $sql = "SELECT 
            p.id AS id_product, 
            p.id_category AS id_category, 
            p.name AS name, 
            p.image AS image, 
            p.description AS description, 
            pv.quantity AS quantity, 
            pv.price, 
            sizes.id AS id_size, 
            sizes.name AS size 
        FROM products p
        INNER JOIN product_variants pv ON pv.id_product = p.id 
        INNER JOIN sizes ON sizes.id = pv.id_size 
        WHERE p.id = $id
        ORDER BY sizes.id ASC";
        
    $load_one_product = pdo_query($sql);
    return $load_one_product;
}

function update_product($id, $name, $id_category, $description, $image)
{
    if ($image !=  '') {
        $sql = "UPDATE products SET name='$name', image='$image', description='$description', id_category='$id_category' WHERE id=" . $id;
    } else {
        $sql = "UPDATE products SET name='$name', description='$description', id_category='$id_category' WHERE id=" . $id;
    }
    pdo_execute($sql);
}

function update_product_variants($id, $id_size, $price, $quantity)
{
    $sql = "UPDATE product_variants SET quantity='$quantity', price='$price' WHERE id_product=$id AND id_size=" . $id_size;
    pdo_execute($sql);
}

function delete_product($id)
{
    $sql = "DELETE FROM products WHERE id=" . $id;
    pdo_execute($sql);
}

function delete_product_variants($id, $id_size)
{
    $sql = "DELETE FROM product_variants WHERE id=$id AND id_size=" . $id_size;
    pdo_execute($sql);
}

// USER
function list_products($id_category)
{
    $sql = "SELECT 
    p.id AS id_product, 
    p.name AS name_product,
    p.image AS image_product, 
    pv.price, 
    p.description 
    FROM products p 
    INNER JOIN product_variants pv ON pv.id_product = p.id
    WHERE id_size = 1 AND p.id_category = $id_category";
    $list_products = pdo_query($sql);
    return $list_products;
}

function similar_product($id_category)
{
    $sql = "SELECT 
    p.id AS id_product, 
    p.name AS name_product,
    p.image AS image_product, 
    pv.price, 
    p.description 
    FROM products p 
    INNER JOIN product_variants pv ON pv.id_product = p.id
    WHERE  p.id_category = $id_category AND pv.id_size = 1  ORDER BY p.id DESC";
    $top4_product_similar = pdo_query($sql);
    return $top4_product_similar;
}


function list_search_products($keyw)
{
    $sql = 'SELECT 
    p.id AS id_product, 
    p.name AS name_product,
    p.image AS image_product, 
    pv.price, 
    p.description 
    FROM products p 
    INNER JOIN product_variants pv ON pv.id_product = p.id
    WHERE p.name LIKE "%' . $keyw . '%" AND pv.id_size = 1 ORDER BY p.id DESC ';
    $list_search_products = pdo_query($sql);
    return $list_search_products;
}

function updateQuantityProductVariants($id_product_variants, $quantity)
{
    try {
        $sql = "SELECT quantity FROM product_variants WHERE id = $id_product_variants";
        $quantity_old = pdo_query_one($sql)['quantity'];
        $quantity_new = $quantity_old - $quantity;
        $sql = "UPDATE product_variants SET quantity = $quantity_new WHERE id = $id_product_variants";
        pdo_execute($sql);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function getProductVariants ($id_product_variants) {
    try {
        $sql = "SELECT * FROM product_variants WHERE id = $id_product_variants";
        return pdo_query_one($sql);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}