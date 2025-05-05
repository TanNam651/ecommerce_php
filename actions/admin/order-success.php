<?php
require_once "../../vendor/autoload.php";
require_once "../../Core/Database.php";
require_once "../../Core/function.php";

use Core\Database;

$config = require "../../config/config.php";
$db = new Database($config);

$update_quantity = "UPDATE ecommerce.products SET quantity = quantity - :qty WHERE id = :id";
$query_update_status_order = "UPDATE ecommerce.orders  SET order_status='COMPLETE' WHERE id=:id";
$query_update_status_payment = "UPDATE ecommerce.payments  SET payment_status= 'COMPLETED' WHERE order_id=:id";

$order_id = filter_input(INPUT_POST, 'orderId');

$products = filter_input(INPUT_POST, 'products');
$products = json_decode($products, true);

$db->createTransaction();

if (empty($order_id) || empty($products)) {
    echo json_encode([
        "code" => 400,
        'id' => $order_id,
        "products" => $products,
        "message" => "Thiếu thông tin"
    ], JSON_UNESCAPED_UNICODE);
    exit();
} else{
    try{
        foreach ($products as $product) {
            $db->query($update_quantity, ['qty' => (int)$product['quantity'], 'id' => $product['id']]);
        }
        $db->query($query_update_status_order, ['id' => $order_id]);
        $db->query($query_update_status_payment, ['id' => $order_id]);
        $db->endCommit();
        echo json_encode([
            "code" => 200,
            'id' => $order_id,
            "products" => $products,
            "message" => "Thanh cong"
        ], JSON_UNESCAPED_UNICODE);
    } catch (PDOException $e) {
        $db->endRollBack();
        echo json_encode([
            "code" => 400,
            "message" => "Lỗi cập nhật trạng thái đơn hàng."
        ], JSON_UNESCAPED_UNICODE);
        exit();
    }
}