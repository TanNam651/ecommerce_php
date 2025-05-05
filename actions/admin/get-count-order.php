<?php
require_once "../../vendor/autoload.php";
require_once "../../Core/Database.php";
require_once "../../Core/function.php";

use Core\Database;

$config = require "../../config/config.php";
$db = new Database($config);

$query_count = "SELECT COUNT(*) as total FROM ecommerce.orders";

try{
    $db->query($query_count);
    $result = $db->statement->fetch(PDO::FETCH_ASSOC);
    echo json_encode(['total'=>$result['total']]);
} catch (PDOException $e){
    echo json_encode(['total' => 0]);
    exit;
}