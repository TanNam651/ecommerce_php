<?php

require_once "../vendor/autoload.php";
require_once "../Core/Database.php";
require_once "../Core/function.php";

use Core\Database;

$config = require "../config/config.php";

$db = new Database($config);

$productId = filter_input(INPUT_POST, "productId");

$query_review = "SELECT user_id, rating, review_text, reply, status, created_at FROM ecommerce.reviews WHERE product_id = :productId order by created_at desc";

$query_user = "SELECT firstname, lastname FROM ecommerce.users WHERE id = :userId";

$query_product_name = "SELECT name FROM ecommerce.products WHERE id = :productId";

$db->query($query_review, ['productId' => $productId]);

$reviewResult = $db->statement->fetchAll(PDO::FETCH_ASSOC);

if ($reviewResult) {

    $review = [];
    foreach ($reviewResult as $item) {
        $userId = $item['user_id'];
        $db->query($query_user, ['userId' => $userId]);
        $user = $db->statement->fetch(PDO::FETCH_ASSOC);
        $item['name'] = $user['firstname'] . ' ' . $user['lastname'];
        $review[] = $item;
    }

    $db->query($query_product_name, ['productId' => $productId]);

    $productName = $db->statement->fetch(PDO::FETCH_ASSOC);
    $result = [
        'review' => json_encode($review,JSON_UNESCAPED_UNICODE),
        'review_count' => count($review),
        'product_name' => $productName['name'],
    ];

    echo json_encode($result,JSON_UNESCAPED_UNICODE);
} else echo json_encode([
    'review' => json_encode([]),
    'review_count' => 0,
    'product_name' => '',
],JSON_UNESCAPED_UNICODE);
