<?php

require_once "../../vendor/autoload.php";
require_once "../../Core/Database.php";
require_once "../../Core/function.php";

use Core\Database;

$config = require "../../config/config.php";
$db = new Database($config);

$img_url = filter_input(INPUT_POST, 'img_url');
$product_name = filter_input(INPUT_POST, 'name');
$category_id = filter_input(INPUT_POST, 'category_id');
$category = filter_input(INPUT_POST, 'category');
$brand = filter_input(INPUT_POST, 'brand');
$status = filter_input(INPUT_POST, 'status');
$price = filter_input(INPUT_POST, 'price');
$origin_price = filter_input(INPUT_POST, 'origin_price');
$student_price = filter_input(INPUT_POST, 'student_price');
$configuration = filter_input(INPUT_POST, 'configuration');
$offer = filter_input(INPUT_POST, 'offer');
$warranty = filter_input(INPUT_POST, 'warranty');
$description = filter_input(INPUT_POST, 'description');


if (empty($product_name) || empty($category_id) || empty($brand) || empty($status) || empty($price) || empty($origin_price) || empty($student_price) || empty($configuration) || empty($offer) || empty($warranty) || empty($description)) {
    echo json_encode(['status' => 'error', 'message' => 'Vui lòng điền đầy đủ thông tin','code' => 400]);
    exit();
}

$query_update_product = "INSERT INTO ecommerce.products(id, name, description, price, origin_price, sale_for_student, configuration, offer, views, warranty, quantity, brand, status, img_url, category_id, category) VALUES(:id, :name, :description, :price, :origin_price, :sale_for_student, :configuration, :offer, :views, :warranty, :quantity, :brand, :status, :img_url, :category_id, :category)";

$idProduct = generateId();

try{
    $db->query($query_update_product, ['id'=>$idProduct, 'name'=>$product_name, 'description'=>$description, 'price'=>$price, 'origin_price'=>$origin_price, 'sale_for_student'=>$student_price, 'configuration'=>$configuration, 'offer'=>$offer, 'views'=>0, 'warranty'=>$warranty, 'quantity'=>0, 'brand'=>$brand, 'status'=>$status, 'img_url'=>$img_url, 'category_id'=>$category_id, 'category'=>$category]);

    echo json_encode(['status' => 'success', 'message' => 'Thêm sản phẩm thành công','code' => 200]);
} catch (PDOException $e){
    echo json_encode(['status' => 'error', 'message' => 'Lỗi không xác định','code' => 500]);
    exit();
}