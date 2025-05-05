<?php

require_once "../../vendor/autoload.php";
require_once "../../Core/Database.php";
require_once "../../Core/function.php";

use Core\Database;

$config = require "../../config/config.php";

$db = new Database($config);

$query_total = "SELECT COUNT(*) as total FROM ecommerce.products";

$db->query($query_total);

$total = $db->statement->fetch(PDO::FETCH_ASSOC);

echo $total['total'];