<?php

require_once "../../vendor/autoload.php";
require_once "../../Core/Database.php";
require_once "../../Core/function.php";

use Core\Database;

$config = require "../../config/config.php";
$db = new Database($config);

$id_product = filter_input(INPUT_POST, 'id');

$query_get_product = "SELECT * FROM ecommerce.products WHERE id = :id";

try{
    $db->query($query_get_product,['id'=>$id_product]);

    $product = $db->statement->fetch(PDO::FETCH_ASSOC);
    if($product){
        echo json_encode([
            'message'=>"Thành công",
            'product'=>json_encode($product,JSON_UNESCAPED_UNICODE),
            'code'=>200
        ],JSON_UNESCAPED_UNICODE);
    }
    else{
        echo json_encode([
            'message'=>'Không có sản phẩm',
            'product'=>[],
            'code'=>202
        ],JSON_UNESCAPED_UNICODE);
    }
} catch (PDOException $e){
    echo json_encode([
        'message'=>"Lỗi xảy ra",
        'product'=>[],
        'code'=>201
    ],JSON_UNESCAPED_UNICODE);
}
