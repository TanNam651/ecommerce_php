<?php
require_once "../../vendor/autoload.php";
require_once "../../Core/Database.php";
require_once "../../Core/function.php";

use Core\Database;

$config = require "../../config/config.php";
$db = new Database($config);

$order_id = filter_input(INPUT_POST, 'id');

$query_product_from_order_details = "SELECT od.product_id, p.img_url, p.name, p.category, od.quantity, od.total FROM ecommerce.order_details as od INNER JOIN ecommerce.products as p ON od.product_id = p.id WHERE order_id = :id";

$query_user = "SELECT firstname, lastname, email FROM ecommerce.users WHERE id = :id";

$query_payment = "SELECT o.id as id, p.id as pid, o.total_amount, o.order_status, o.address, o.user_id, o.created_at, p.payment_status FROM ecommerce.orders o INNER JOIN ecommerce.payments p ON o.id = p.order_id WHERE o.id = :id";

$query_status_order = "SHOW COLUMNS FROM ecommerce.orders LIKE 'order_status'";
$query_status_payment = "SHOW COLUMNS FROM ecommerce.payments LIKE 'payment_status'";

if(!empty($order_id)){
    $db->query($query_product_from_order_details,array("id"=>$order_id));
    $product = $db->statement->fetchAll(PDO::FETCH_ASSOC);

    $db->query($query_payment,array("id"=>$order_id));
    $payment = $db->statement->fetch(PDO::FETCH_ASSOC);

    $db->query($query_user,array("id"=>$payment['user_id']));
    $user = $db->statement->fetch(PDO::FETCH_ASSOC);

    $payment['name'] = $user['firstname'] . ' ' . $user['lastname'];
    $payment['email'] = $user['email'];

    $db->query($query_status_order);
    $status_order = $db->statement->fetch(PDO::FETCH_ASSOC);

    $db->query($query_status_payment);
    $status_payment = $db->statement->fetch(PDO::FETCH_ASSOC);

    $status_order = $status_order['Type'];
    $status_payment = $status_payment['Type'];

    $enum_order_status = [];
    $enum_payment_status = [];

    preg_match("/^enum\((.*)\)$/", $status_order, $matchesOrder);

    if(isset($matchesOrder[1])){
        $valsOrder = explode(',', $matchesOrder[1]);
        foreach ($valsOrder as $valOrder) {
            $valOrder = trim($valOrder, "'");
            $enum_order_status[] = $valOrder;
        }
    }

    preg_match("/^enum\((.*)\)$/", $status_payment, $matchesPayment);

    if(isset($matchesPayment)){
        $valsPayment = explode(',', $matchesPayment[1]);
        foreach ($valsPayment as $valPayment) {
            $valPayment = trim($valPayment, "'");
            $enum_payment_status[] = $valPayment;
        }
    }

    echo json_encode(array(
        "list_product"=> json_encode($product, JSON_UNESCAPED_UNICODE),
        "payment"=>json_encode($payment, JSON_UNESCAPED_UNICODE),
        "status_order"=>json_encode($enum_order_status, JSON_UNESCAPED_UNICODE),
        "status_payment"=>json_encode($enum_payment_status, JSON_UNESCAPED_UNICODE),
    ), JSON_UNESCAPED_UNICODE);
}