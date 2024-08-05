<?php
function insert_code($code_name, $discount, $quantity, $expiration_date)
{
    $sql = "insert into discount_codes(code, discount, quantity,expiration_date) values('$code_name', '$discount', '$quantity', '$expiration_date')";
    pdo_execute($sql);
}
function loadall_code()
{
    $sql = "select * from discount_codes order by id desc";
    $listcode = pdo_query($sql);
    return $listcode;
}
function delete_code($id)
{
    $sql = "delete from discount_codes where id=" . $id;
    pdo_execute($sql);
}
function update_code($id, $code_name, $discount, $quantity, $expiration_date)
{
    $sql = "update discount_codes set code='$code_name', discount='$discount', quantity='$quantity', expiration_date='$expiration_date' where id= $id";
    pdo_execute($sql);
}
function loadone_code($id)
{
    $sql = "select * from discount_codes where id=" . $id;
    $code = pdo_query_one($sql);
    return $code;
}

function checkCodeDiscount($code)
{
    $sql = "select * from discount_codes where code='$code'";
    $code = pdo_query_one($sql);
    return $code;
}

function checkDiscountCode($id)
{
    try {
        $sql = "SELECT * FROM discount_codes WHERE id = $id;";
        return pdo_query_one($sql);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}