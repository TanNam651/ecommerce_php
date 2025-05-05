<?php
require_once "../../vendor/autoload.php";
require_once "../../Core/Database.php";
require_once "../../Core/function.php";

use Core\Database;
$config = require "../../config/config.php";
$db = new Database($config);

$option = ['cost'=>12];

$account_id = filter_input(INPUT_POST, 'account_id');
$password = filter_input(INPUT_POST, 'password');
$new_password = filter_input(INPUT_POST, 'new_password');
$confirm_password = filter_input(INPUT_POST, 'confirm_password');

$query_account = "SELECT * FROM ecommerce.users WHERE id=:id";

try{
    $db->query($query_account,['id'=>$account_id]);
    $user = $db->statement->fetch(PDO::FETCH_ASSOC);
    if($user && !password_verify($password, $user['password'])){
        echo json_encode([
            'code' => 400,
            'message' => 'Mật khẩu không chính xác'
        ]);
        exit();
    }
    if($new_password !== $confirm_password){
        echo json_encode([
            'code' => 400,
            'message' => 'Mật khẩu không khớp'
        ]);
        exit();
    }
    $query_update = "UPDATE ecommerce.users SET password=:password WHERE id=:id";

    $hash_password = password_hash($new_password, PASSWORD_BCRYPT, $option);

    $db->query($query_update, [
        'password' => $hash_password,
        'id' => $account_id
    ]);

    echo json_encode([
        'code' => 200,
        'message' => 'Cập nhật mật khẩu thành công'
    ]);

} catch (PDOException $e){
    echo json_encode([
        'code' => 500,
        'message' => 'Lỗi hệ thống'
    ]);
}

