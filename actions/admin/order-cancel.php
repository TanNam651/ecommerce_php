<?php
require_once "../../vendor/autoload.php";
require_once "../../Core/Database.php";
require_once "../../Core/function.php";

use Core\Database;

$config = require "../../config/config.php";
$db = new Database($config);

$order_id = filter_input(INPUT_POST, 'orderId');

$update_order_status = "UPDATE ecommerce.orders SET order_status='CANCELLED' WHERE id=:id";
$update_payment_status = "UPDATE ecommerce.payments SET payment_status='CANCEL' WHERE order_id=:id";

$db->createTransaction();

if (empty($order_id)) {
    echo json_encode([
        "code" => 400,
        'id' => $order_id,
        "message" => "Thiếu thông tin"
    ], JSON_UNESCAPED_UNICODE);
    exit();
} else {
    try {
        $db->query($update_order_status, ['id' => $order_id]);
        $db->query($update_payment_status, ['id' => $order_id]);

        $db->endCommit();
        echo json_encode([
            "code" => 200,
            'id' => $order_id,
            "message" => "Đơn hàng đã được hủy thành công"
        ], JSON_UNESCAPED_UNICODE);
    } catch (PDOException $e) {
        echo json_encode([
            "code" => 400,
            "message" => "Lỗi cập nhật trạng thái đơn hàng."
        ], JSON_UNESCAPED_UNICODE);
        $db->endRollBack();
        exit();

    }
}