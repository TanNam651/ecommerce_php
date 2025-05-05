<?php
require_once "../../vendor/autoload.php";
require_once "../../Core/Database.php";
require_once "../../Core/function.php";

use Core\Database;

$config = require "../../config/config.php";
$db = new Database($config);

$account_id = filter_input(INPUT_POST, 'id');

$query_delete_account = "DELETE FROM ecommerce.users WHERE id=:id";
try {
    $db->query($query_delete_account, ['id' => $account_id]);
    echo json_encode([
        'code' => 200,
        'message' => 'Xóa tài khoản thành công'
    ]);
} catch (PDOException $e) {
    echo json_encode([
        'code' => 500,
        'message' => 'Lỗi hệ thống'
    ]);
}