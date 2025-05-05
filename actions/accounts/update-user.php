<?php

require_once "../../vendor/autoload.php";
require_once "../../Core/Database.php";
require_once "../../Core/function.php";

use Core\Database;

$config = require_once "../../config/config.php";

$option = ['cost'=>12];

$db = new Database($config);

$id = filter_input(INPUT_POST, "id");
$firstname = filter_input(INPUT_POST,'firstname');
$lastname = filter_input(INPUT_POST,'lastname');
$phone = filter_input(INPUT_POST,'phone');
$password = password_hash(filter_input(INPUT_POST,'password'), PASSWORD_BCRYPT, $option);

$query_update = "UPDATE ecommerce.users SET firstname=:firstname, lastname=:lastname, phone=:phone, password=:password WHERE id=:id";

try {
    $db->query($query_update,[
        'id'=>$id,
        'firstname'=>$firstname,
        'lastname'=>$lastname,
        'phone'=>$phone,
        'password'=>$password
    ]);

    $query_user = 'SELECT * FROM ecommerce.users WHERE id=:id';

    $db->query($query_user,['id'=>$id]);

    $getUser =  $db->statement->fetch(PDO::FETCH_ASSOC);

    $user = array(
        'id' => $getUser['id'],
        'email' => $getUser['email'],
        'name' => $getUser['firstname'] . " " . $getUser['lastname'],
        'phone' => $getUser['phone'],
        'role' => $getUser['role'],
        'access_token' => $getUser['accesstoken'],
        'refresh_token' => $getUser['refreshtoken'],
    );
    setcookie("auth_user", json_encode($user, JSON_UNESCAPED_UNICODE), time() + (86400 * 30), "/");

    echo json_encode([
        'message'=>"Cập nhật thông tin thành công.",
        'code'=>200
    ]);
} catch (PDOException $e) {
    echo json_encode([
        'message'=>$e->getMessage(),
        'code'=>100
    ], JSON_UNESCAPED_UNICODE);
}