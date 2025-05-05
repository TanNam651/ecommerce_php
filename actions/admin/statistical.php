<?php
require_once "../../vendor/autoload.php";
require_once "../../Core/Database.php";
require_once "../../Core/function.php";

use Core\Database;

$config = require "../../config/config.php";
$db = new Database($config);

$select_order_this_year = "SELECT MONTH(created_at) as month, YEAR(created_at) as year, COUNT(*) as total FROM ecommerce.orders WHERE YEAR(created_at) = YEAR(CURRENT_DATE) GROUP BY MONTH(created_at), YEAR(created_at)";

$select_revenue_this_year = "SELECT MONTH(p.created_at) as month, YEAR(p.created_at) as year, SUM(CAST(REPLACE(REPLACE(p.paid_amount, '.',''),'₫','') AS UNSIGNED )) AS total FROM ecommerce.payments p INNER JOIN ecommerce.orders o on p.order_id = o.id WHERE YEAR(p.created_at) = YEAR(CURRENT_DATE) AND p.payment_status = 'COMPLETED' GROUP BY MONTH(p.created_at), YEAR(p.created_at)";

$db->query($select_order_this_year);
$orders = $db->statement->fetchAll(PDO::FETCH_ASSOC);

$db->query($select_revenue_this_year);
$revenue = $db->statement->fetchAll(PDO::FETCH_ASSOC);

$result_order = [];
$result_revenue = [];

for ($i = 0; $i < 12; $i++) {
    $result_order[$i] = [
        'month' => $i + 1,
        'total' => 0
    ];
    $result_revenue[$i] = [
        'month' => $i + 1,
        'total' => 0
    ];
}

if($orders){
    foreach ($orders as $order) {
        $result_order[$order['month'] - 1]['total'] = $order['total'];
    }
}

if($revenue){
    foreach ($revenue as $rev) {
        $result_revenue[$rev['month'] - 1]['total'] = (int) $rev['total'];
    }
}
echo json_encode([
    'orders' => json_encode($result_order, JSON_UNESCAPED_UNICODE),
    'revenue' => json_encode($result_revenue, JSON_UNESCAPED_UNICODE)
], JSON_UNESCAPED_UNICODE);

