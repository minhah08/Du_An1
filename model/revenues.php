<?php
function getRevenues($start = "", $end = "", $categoryId = 0)
{
    try {
        $sql = "SELECT 
        p.image,
        p.id AS product_id,
        p.name AS product_name,
        SUM(od.total_amount) AS total_revenue
        FROM
            categories c
        JOIN
            products p ON c.id = p.id_category
        JOIN
            product_variants pv ON p.id = pv.id_product
        JOIN
            order_details od ON pv.id = od.id_product_variants
        JOIN
            orders o ON od.id_order = o.id
        WHERE
            o.id_status = 4";

        if ($categoryId != 0) {
            $sql .= " AND c.id = $categoryId";
        }

        if ($start != "") {
            $sql .= " AND o.order_date >= '$start'";
        }

        if ($end != "") {
            $sql .= " AND o.order_date <= '$end'";
        }

        $sql .= " GROUP BY c.name_category, p.name ORDER BY total_revenue DESC;";

        return pdo_query($sql);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function getRevenuesByMonth($year)
{
    try {
        $sql = "SELECT
            p.name AS product_name,
            MONTH(o.order_date) AS order_month,
            YEAR(o.order_date) AS order_year,
            SUM(od.total_amount) AS total_revenue
        FROM
            products p
        JOIN
            product_variants pv ON p.id = pv.id_product
        JOIN
            order_details od ON pv.id = od.id_product_variants
        JOIN
            orders o ON od.id_order = o.id
        WHERE
            o.id_status = 4 AND YEAR(o.order_date) = $year
        GROUP BY
            order_month
        ORDER BY
            order_year, order_month, total_revenue DESC;";

        return pdo_query($sql);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function getStatusOrder($id)
{
    try {
        $sql = "SELECT
            os.name AS status_name,
            COUNT(o.id) AS order_count
        FROM
            order_status os
        LEFT JOIN
            orders o ON os.id = o.id_status
            WHERE os.id = $id;";

        return pdo_query_one($sql);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
