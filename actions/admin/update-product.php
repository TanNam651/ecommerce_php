<?php

require_once "../../vendor/autoload.php";
require_once "../../Core/Database.php";
require_once "../../Core/function.php";

use Core\Database;

$config = require "../../config/config.php";
$db = new Database($config);

$id = filter_input(INPUT_POST, 'id');
$img_url = filter_input(INPUT_POST, 'img');
$price = filter_input(INPUT_POST, 'price');
$status = filter_input(INPUT_POST, 'status');
$price_student = filter_input(INPUT_POST, 'price_student');

$field = [];
$params = [];

$params['id'] = $id;

if (!empty($img_url)) {
    $field[] = "img_url = :img_url";
    $params['img_url'] = $img_url;
}

if (!empty($price)) {
    $field[] = "price = :price";
    $params['price'] = $price;
}

if (!empty($status)) {
    $field[] = "status = :status";
    $params['status'] = $status;
}

if (!empty($price_student)) {
    $field[] = "sale_for_student = :price_student";
    $params['price_student'] = $price_student;
}

$query_update = "UPDATE ecommerce.products SET " . implode(", ", $field) . " WHERE id = :id";

$query_get_product = "SELECT * FROM ecommerce.products where id = :id";

try {
    $db->query($query_update, [
        'price' => $price,
        'price_student' => $price_student,
        'status' => $status,
        'img_url' => $img_url,
        'id' => $id
    ]);

    $db->query($query_get_product, ['id' => $id]);
    $product = $db->statement->fetch(PDO::FETCH_ASSOC);

    echo json_encode([
        'message' => "Thành công",
        'product' => json_encode($product, JSON_UNESCAPED_UNICODE),
        'code' => 200
    ], JSON_UNESCAPED_UNICODE);
} catch (PDOException $e) {
    echo json_encode([
        'message' => "Lỗi",
        'code' => 201
    ], JSON_UNESCAPED_UNICODE);
}
