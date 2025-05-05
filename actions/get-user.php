<?php
require_once "../vendor/autoload.php";
require_once "../Core/Database.php";
require_once "../Core/function.php";

use Core\Database;

$config = require "../config/config.php";

$db = new Database($config);

$query_get_user = "SELECT id, lastname, email, phone FROM ecommerce.users WHERE id = :id";

$userId = filter_input(INPUT_POST, "userId");

$db->query($query_get_user, ['id' => $userId]);
$user = $db->statement->fetch(PDO::FETCH_ASSOC);

if($user){
    echo json_encode($user);
}
else{
    echo json_encode([]);
}