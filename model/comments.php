<?php
function load_all_comment()
{
    $sql = "SELECT  products.id AS id ,products.name AS name, COUNT(comments.id) AS quantity_comments,
        MAX(comments.comment_date) AS latest_date, MIN(comments.comment_date) AS oldest_day
        FROM comments
        INNER JOIN products ON products.id = comments.id_product
		GROUP BY products.id, products.name
        ORDER BY products.id DESC";
    $load_all_comments = pdo_query($sql);
    return $load_all_comments;
}

function delete_comments($id)
{
    $sql = "DELETE FROM `comments` WHERE id_product = $id";
    pdo_execute($sql);
}

function load_all_comment_detail($id)
{
    $sql = "SELECT comments.id AS id, accounts.fullname, 
        comments.content, comments.comment_date, comments.id AS id_comment
        FROM comments 
        INNER JOIN accounts ON accounts.id = comments.id_account 
        WHERE id_product =$id
        ORDER BY comments.id DESC";
    $load_all_comment_detail = pdo_query($sql);
    return $load_all_comment_detail;
}

function delete_comment_detail($id)
{
    $sql = "DELETE  FROM comments WHERE id=$id";
    pdo_execute($sql);
}


//USER 
function load_all_comment_product($id)
{
    $sql = "SELECT accounts.avatar AS avatar, accounts.username AS user,
    comments.comment_date AS comments_date, comments.content AS content
    FROM comments
    INNER JOIN accounts ON accounts.id = comments.id_account
    INNER JOIN products ON products.id = comments.id_product
    WHERE products.id = $id ORDER BY products.id DESC";
    $list_comments =  pdo_query($sql);
    return $list_comments;
}

function insert_comment($content, $id_account, $id_product, $comment_date)
{
    $sql = "INSERT INTO comments (content, id_account, id_product, comment_date)
    VALUES ('$content','$id_account','$id_product','$comment_date')";
    pdo_execute($sql);
}

function count_comments($id)
{
    $sql = "SELECT COUNT(content) AS count FROM comments WHERE id_product = $id";
    $count_comments =  pdo_query($sql);
    return $count_comments;
}
