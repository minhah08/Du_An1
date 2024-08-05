<?php

function getAllOrders()
{
    try {
        $sql = "SELECT * FROM orders;";
        return pdo_query($sql);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
function getAll_order()
{
    $sql = "SELECT 
        o.id as id, 
        p.name,
        a.username,
        o.order_date,
        os.id as id_status,
        os.name as name_status
    FROM orders o 
    JOIN order_details od ON o.id = od.id_order
    JOIN product_variants pv ON od.id_product_variants = pv.id
    JOIN products p ON p.id = pv.id_product
    JOIN accounts a ON a.id = o.id_account
    JOIN order_status os ON o.id_status = os.id
    GROUP BY id
    ORDER BY o.id DESC;";
    $listorder = pdo_query($sql);
    return $listorder;
}
function getOrder()
{
    try {
        $sql = "SELECT * FROM orders;";
        return pdo_query($sql);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}


function loadone_order_details($id)
{
    $sql = "SELECT 
    p.image AS image_product,
	p.name AS name_product,
   	s.name AS name_size,
    od.quantity,
    od.total_amount,
    a.avatar,
    a.username,
    o.fullname,
    o.email,
    o.tel,
    o.order_date,
    o.address,
    o.notes,
    pv.price,
    od.discount
    
    FROM orders o 
    JOIN order_details od ON o.id = od.id_order
    JOIN product_variants pv ON od.id_product_variants = pv.id
    JOIN products p ON p.id = pv.id_product
    JOIN accounts a ON a.id = o.id_account
    JOIN order_status os ON o.id_status = os.id 
    JOIN sizes s ON s.id = pv.id_size 
    where o.id = '$id'";
    $order_details = pdo_query($sql);
    return $order_details;
}
function loadone_order($id)
{
    $sql = "SELECT * FROM orders WHERE id = '$id'"; 
    $order = pdo_query_one($sql);
    return $order;
}
function loadall_order()
{
    $sql = "select * from orders order by id desc";
    $listor = pdo_query($sql);
    return $listor;
}
function loadall_order_variants($id_order)
{
    $sql = "select * from order_variants where id_order=" . $id_order;
    $listvar = pdo_query($sql);
    return $listvar;
}
function order_update($id_order, $id_status)
{
    $sql = "UPDATE orders SET id_status = '$id_status' WHERE id = '$id_order'";  
    pdo_execute($sql);
}

function fitterOrder($status = null)
{
    try {
        $sql = "SELECT 
        o.id as id, 
        p.name,
        a.username,
        o.order_date,
        os.id as id_status,
        os.name as name_status
    FROM orders o 
    JOIN order_details od ON o.id = od.id_order
    JOIN product_variants pv ON od.id_product_variants = pv.id
    JOIN products p ON p.id = pv.id_product
    JOIN accounts a ON a.id = o.id_account
    JOIN order_status os ON o.id_status = os.id";
        if ($status != null) {
            $sql .= " WHERE os.id = $status";
        }
        $sql .= " GROUP BY id ORDER BY o.id DESC;";
        return pdo_query($sql);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function getOrdersByAccount($id_account, $id_status)
{
    try {
        $sql = "SELECT 
        o.id AS id_order 
    FROM orders o  
        WHERE o.id_account = $id_account";
        if ($id_status != null) {
            $sql .= " AND o.id_status = $id_status";
        }
        $sql .= " ORDER BY o.id DESC;";
        return pdo_query($sql);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function getOrderDetailByAccount($id_order)
{
    try {
        $sql = "SELECT  
        o.id AS id_order,
        p.image AS image_product,
        p.name AS name_product,
        s.name AS name_size,
        od.quantity AS quantity, 
        pv.price AS price,
        od.total_amount AS total_amount, 
        od.discount AS discount,
        os.name AS name_status,
        os.id AS id_status
    FROM orders o 
    JOIN order_details od ON o.id = od.id_order
    JOIN product_variants pv ON od.id_product_variants = pv.id
    JOIN products p ON p.id = pv.id_product
    JOIN categories c ON c.id = p.id_category
    JOIN sizes s ON s.id = pv.id_size
    JOIN accounts a ON a.id = o.id_account
    JOIN order_status os ON o.id_status = os.id
    -- JOIN discount_codes dc ON dc.id = od.discount
    WHERE o.id = $id_order 
    ORDER BY o.id ASC;";
        return pdo_query($sql);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}


function getAllStatusOrder()
{
    try {
        $sql = "SELECT * FROM order_status;";

        return pdo_query($sql);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function cancelOrder($id_order)
{
    try {
        $sql = "SELECT * FROM order_details WHERE id_order = $id_order;";
        foreach (pdo_query($sql) as $orderDetail) {
            $id_product_variants = $orderDetail['id_product_variants'];
            $quantity = $orderDetail['quantity'];
            updateQuantityProductVariants($id_product_variants, ($quantity * -1));
        }
        $sql2 = "UPDATE orders SET id_status = 5 WHERE id = $id_order;";
        return pdo_execute($sql2);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function addOrder($order_date, $id_status, $id_account, $notes, $fullname, $email, $tel, $address)
{
    try {
        $sql = "INSERT INTO orders(order_date, id_status, id_account, notes, fullname, email, tel, address) VALUES ('$order_date', $id_status, $id_account, '$notes', '$fullname', '$email', '$tel', '$address');";
        return pdo_execute($sql);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function getLastIdOrder()
{
    try {
        $sql = "SELECT MAX(id) AS id FROM orders;";
        return pdo_query_one($sql);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function addOrderDetail($id_order, $id_product_variants, $quantity, $total_amount, $discount)
{
    try {
        if ($discount == null) {
            $sql = "INSERT INTO order_details(id_order, id_product_variants, quantity, total_amount) VALUES ($id_order, $id_product_variants, $quantity, $total_amount);";
        } else {
            $sql = "INSERT INTO order_details(id_order, id_product_variants, quantity, total_amount, discount) VALUES ($id_order, $id_product_variants, $quantity, $total_amount, $discount);";
        }
        return pdo_execute($sql);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
