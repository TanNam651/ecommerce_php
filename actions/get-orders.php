<?php
require_once "../vendor/autoload.php";
require_once "../Core/Database.php";
require_once "../Core/function.php";

use Core\Database;

$config = require_once "../config/config.php";

$db = new Database($config);

$userId = filter_input(INPUT_POST, 'userId');

$orders = array();
$order_details = array();
$payments = array();

$query_orders ="SELECT * FROM ecommerce.orders  WHERE user_id = :user_id";

$db->query($query_orders,array("user_id"=>$userId));

$orders = $db->statement->fetchAll();
echo json_encode($orders,JSON_UNESCAPED_UNICODE);

