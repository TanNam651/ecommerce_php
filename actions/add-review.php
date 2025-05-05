<?php

require_once "../vendor/autoload.php";
require_once "../Core/Database.php";
require_once "../Core/function.php";

date_default_timezone_set("Asia/Ho_Chi_Minh");

use Core\Database;

$config = require "../config/config.php";

$db = new Database($config);

$userId = filter_input(INPUT_POST, "userId");
$productId = filter_input(INPUT_POST, "productId");
$status = filter_input(INPUT_POST, "status");
$rating = filter_input(INPUT_POST, "rate");
$review = filter_input(INPUT_POST, "description");
$createdAt = date("Y-m-d H:i:s");

$query_review = "INSERT INTO ecommerce.reviews(id, user_id, product_id, rating, review_text, created_at, status) VALUES(:id, :user_id, :product_id, :rating, :review_text, :created_at, :status)";

$reviewId = generateId();

$reviewParams = [
    "id" => $reviewId,
    "user_id" => $userId,
    "product_id" => $productId,
    "rating" => $rating,
    "review_text" => $review,
    "created_at" => $createdAt,
    "status" => $status
];

try {
    $review = $db->query($query_review, $reviewParams);

    $query_get_review = "SELECT user_id, rating, review_text, reply, status, created_at FROM ecommerce.reviews WHERE id = :id";

    $query_get_user = "SELECT firstname, lastname FROM ecommerce.users WHERE id = :userId";

    $db->query($query_get_review, ['id' => $reviewId]);
    $result_review = $db->statement->fetch(PDO::FETCH_ASSOC);

    $db->query($query_get_user, ['userId' => $result_review['user_id']]);
    $userName = $db->statement->fetch(PDO::FETCH_ASSOC);
    $result_review["name"] = $userName['firstname'] . ' ' . $userName['lastname'];


    echo json_encode([
        'message' => "Cảm ơn bạn đã góp ý với shop.",
        'code' => 200,
        'review' => json_encode($result_review, JSON_UNESCAPED_UNICODE),
    ], JSON_UNESCAPED_UNICODE);
} catch (PDOException $e) {
    echo json_encode([
        'message' => "Có lỗi, vui lòng thử lại sau.",
        'code' => 201,
        'review' => json_encode([]),
    ], JSON_UNESCAPED_UNICODE);
}

