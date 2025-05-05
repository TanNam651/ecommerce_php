<?php

require_once "../vendor/autoload.php";
require_once "../Core/Database.php";
require_once "../Core/function.php";

use Core\Database;

$config = require "../config/config.php";

$db = new Database($config);

$orderId = filter_input(INPUT_POST,'orderId');

$query_product_from_order_details = "SELECT od.product_id, p.img_url, p.name, p.category, od.quantity, od.total  FROM ecommerce.order_details as od inner join ecommerce.products as p on od.product_id = p.id WHERE order_id = :order_id";

$query_payment = "SELECT o.id, o.total_amount, p.id as payment_id, o.created_at, o.order_status, p.payment_status FROM ecommerce.orders as o inner join ecommerce.payments as p on o.id = p.order_id WHERE order_id = :order_id";

if(!empty($orderId)){
    $db->query($query_product_from_order_details,array("order_id"=>$orderId));
    $product_detail = $db->statement->fetchAll();

    $db->query($query_payment,array("order_id"=>$orderId));
    $payment_detail= $db->statement->fetch();

    echo json_encode(array(
        "list_product"=> json_encode($product_detail, JSON_UNESCAPED_UNICODE),
        "payment"=>json_encode($payment_detail, JSON_UNESCAPED_UNICODE)
    ), JSON_UNESCAPED_UNICODE);
}