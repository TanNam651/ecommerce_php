<?php
require_once "../../vendor/autoload.php";
require_once "../../Core/Database.php";
require_once "../../Core/function.php";

use Core\Database;

$config = require "../../config/config.php";
$db = new Database($config);

$order_id = filter_input(INPUT_POST, 'orderId');
$orderStatus = filter_input(INPUT_POST, 'orderStatus');
$paymentStatus = filter_input(INPUT_POST, 'paymentStatus');

if (empty($order_id) || empty($orderStatus) || empty($paymentStatus)) {
    echo json_encode([
        "code" => 400,
        'id' => $order_id,
        "orderStatus" => $orderStatus,
        "paymentStatus" => $paymentStatus,
        "message" => "Thiếu thông tin"
    ], JSON_UNESCAPED_UNICODE);
    exit();
}
$query_update_status_order = "UPDATE ecommerce.orders  SET order_status=:orderStatus WHERE id=:id";
$query_update_status_payment = "UPDATE ecommerce.payments  SET payment_status=:paymentStatus WHERE order_id=:id";

//$query_order = "SELECT * FROM ecommerce.orders WHERE id = :i";
$query_order = "SELECT * FROM ecommerce.orders WHERE id = 'ec1e1829-095d-46ad-bc1a-6345ce57946b'";

//try {
    $db->query($query_update_status_order, ['orderStatus' => $orderStatus, 'id' => $order_id]);

    $db->query($query_update_status_payment, ['paymentStatus' => $paymentStatus, 'id' => $order_id]);

    $db->query($query_order);
    $order = $db->statement->fetch(PDO::FETCH_ASSOC);

    echo json_encode([
        "code" => 200,
        "message" => "Cập nhật trạng thái đơn hàng thành công",
        "id"=> $order_id,
        "orderStatus" => $orderStatus,
        "paymentStatus" => $paymentStatus,
        "order" => $order,
    ], JSON_UNESCAPED_UNICODE);
//} catch (PDOException $e) {
//    echo json_encode([
//        "code" => 400,
//        "message" => "Lỗi cập nhật trạng thái đơn hàng."
//    ], JSON_UNESCAPED_UNICODE);
//}