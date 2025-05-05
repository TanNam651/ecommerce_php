<?php

require_once '../vendor/autoload.php';
require_once '../Core\Database.php';
require_once '../Core/function.php';

use Core\Database;

$config = require '../config/config.php';
$db = new Database($config);

$search = filter_input(INPUT_POST, 'search');

if(!empty($search)){
    $query_search_product = "SELECT id, name, price, origin_price, img_url FROM ecommerce.products WHERE MATCH(name, category, brand) AGAINST(:search IN BOOLEAN MODE) LIMIT 6";

    $query_total_list_product = "SELECT count(*) FROM ecommerce.products WHERE MATCH(name, category, brand) AGAINST(:search IN BOOLEAN MODE)";

    $searchParams = '+'.str_replace(' ', ' +', $search) . '*';

    $db->query($query_search_product,array('search' => $searchParams));

    $searchResult = $db->statement->fetchAll(PDO::FETCH_ASSOC);

    $db->query($query_total_list_product, array('search'=>$searchParams));

    $count = $db->statement->fetchColumn();

    echo json_encode(array(
        'product'=>json_encode($searchResult,JSON_UNESCAPED_UNICODE),
        'count'=> $count
    ),JSON_UNESCAPED_UNICODE);

}