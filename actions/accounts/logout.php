<?php

require_once __DIR__."/../../vendor/autoload.php";
require_once __DIR__."/../../Core/Database.php";
//require_once __DIR__."/../../Core/function.php";
//
use Core\Database;
//
session_start();

$config = require "../../config/config.php";

$db = new Database($config);

$userAuth = json_decode($_COOKIE['auth_user'],true);

$userId = $userAuth['id'];
//
$sql_update_user = "UPDATE ecommerce.users SET refreshtoken='', accesstoken='' WHERE id=:user_id";
$sql_delete_token = "DELETE FROM ecommerce.auth_token WHERE user_id=:user_id";

$db->query($sql_update_user,[
    'user_id' => $userId,
]);

$db->query($sql_delete_token,[
    'user_id' => $userId,
]);

setcookie('auth_user',"", time() - 3600,"/");
unset($_COOKIE['auth_user']);

echo json_encode([
    "message" => "Logged out successfully.",
    "code" => 200
], JSON_UNESCAPED_UNICODE);

