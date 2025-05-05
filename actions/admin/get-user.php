<?php

require_once "../../vendor/autoload.php";
require_once "../../Core/Database.php";
require_once "../../Core/function.php";

use Core\Database;

$config = require "../../config/config.php";
$db = new Database($config);


$query_user_account = "SELECT * FROM ecommerce.users WHERE  role='user'";

try {
    $db->query($query_user_account);
    $account = $db->statement->fetchAll(PDO::FETCH_ASSOC);

    if ($account) {
        foreach ($account as $key => $value) {
            $account[$key]['user_name'] = $value['firstname'] . ' ' . $value['lastname'];
        }
    }

    echo json_encode($account, JSON_UNESCAPED_UNICODE);
} catch (PDOException $e) {
    echo json_encode([
    ], JSON_UNESCAPED_UNICODE);
}

