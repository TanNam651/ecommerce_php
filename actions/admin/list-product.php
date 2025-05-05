<?php

require_once  "../../vendor/autoload.php";
require_once  "../../Core/Database.php";
require_once  "../../Core/function.php";

use Core\Database;

$config = require_once "../../config/config.php";

$db = new Database($config);

$page = filter_input(INPUT_POST,'page');

$limit = 8;
$offset = ($page - 1) * $limit;

$query = "SELECT id, name, price, origin_price, brand, category, quantity FROM ecommerce.products LIMIT $limit OFFSET $offset";

$db->query($query);
$products = $db->statement->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($products, JSON_UNESCAPED_UNICODE);

