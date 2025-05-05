<?php
require_once "../../vendor/autoload.php";
require_once "../../Core/Database.php";
require_once "../../Core/function.php";

use Core\Database;

$config = require "../../config/config.php";
$db = new Database($config);

$page = filter_input(INPUT_POST, 'page');
$limit = 8;
$offset = ($page - 1) * $limit;

$query_order = "SELECT id,user_id, total_amount, order_status, address FROM ecommerce.orders  ORDER BY CASE order_status WHEN 'PENDING' THEN 1 WHEN 'PROCESSING' THEN 2 WHEN 'COMPLETE' THEN 3 ELSE 4 END ASC, created_at DESC LIMIT $limit OFFSET $offset";
$query_user = "SELECT firstname, lastname, email FROM ecommerce.users WHERE id = :id";
$query_payment_status = "SELECT payment_status FROM ecommerce.payments WHERE order_id = :id";
//$query_detail_product="SELECT name FROM ecommerce.products WHERE id = :id";
//$query_order_details = "SELECT quantity, total FROM ecommerce.order_details WHERE id = :id";


try {
    $db->query($query_order);
    $orders = $db->statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($orders as $key => $order) {
        $db->query($query_payment_status, [':id' => $order['id']]);
        $payment_status = $db->statement->fetch(PDO::FETCH_ASSOC);
        $orders[$key]['payment_status'] = $payment_status['payment_status'];

        $db->query($query_user, [':id' => $order['user_id']]);
        $user = $db->statement->fetch(PDO::FETCH_ASSOC);
        $orders[$key]['name']= $user['firstname'] . ' ' . $user['lastname'];
        $orders[$key]['email'] = $user['email'];
    }
    echo json_encode($orders, JSON_UNESCAPED_UNICODE);
} catch (PDOException $e) {
    echo json_encode([]);
}