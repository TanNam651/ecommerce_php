<?php
//

use Ramsey\Uuid\Uuid;
use Core\Database;

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}



function basePath($path):string
{
    return BASE_PATH.$path;
}

function view($uri, $attributes = []): void
{
extract($attributes);

require basePath('views/'.$uri);
}

function abort($code = 404)
{
    http_response_code($code);
    require basePath("views/{$code}.php");
}

function redirect($path):void
{
    header("Location: {$path}");
    exit();
}

function generateId():string
{
    return Uuid::uuid4()->toString();
}

function generateToken():string
{
    return Uuid::uuid4()->toString();
}

function baseUrl($url):string
{
    $URL = isset($_SERVER['HTTPS'])&& $_SERVER['HTTPS']!=='off'?'https://':'http://';

    return $URL.$_SERVER['HTTP_HOST'].'/'.$url;
}

function isAuthenticate():bool
{
    require_once "Core/Database.php";
    $config = require "config/config.php";
    $db = new Database($config);

    if(isset( $_COOKIE['auth_user'])){
        $userAuth = json_decode($_COOKIE['auth_user'],true);
        $refreshToken = $userAuth['refreshtoken'];
        $accessToken = $userAuth['access_token'];

        $sql_get_access_token = "SELECT * FROM ecommerce.auth_token WHERE token=:token";
        $db->query($sql_get_access_token,[':token'=>$accessToken]);

        $checkAccess = $db->statement->fetch(PDO::FETCH_ASSOC);

        if($checkAccess && $checkAccess['expires']>=date("Y-m-d H:i:s")){
            return true;
        }
    }
    setcookie('auth_user','',time()-3600,'/');
    return false;
}

function getProductDetails($id)
{
    require_once "Core/Database.php";
    $config = require "config/config.php";
    $db = new Database($config);

    $sql_get_product = "SELECT name FROM ecommerce.products WHERE id=:id";
    $db->query($sql_get_product,[':id'=>$id]);

    return $db->statement->fetch(PDO::FETCH_ASSOC);
}

function getOrderDetails($id)
{
    require_once "Core/Database.php";
    $config = require "config/config.php";
    $db = new Database($config);

    $sql_get_order = "SELECT quantity, total FROM ecommerce.order_details WHERE id=:id";
    $db->query($sql_get_order,[':id'=>$id]);

    return $db->statement->fetch(PDO::FETCH_ASSOC);
}

function convertPriceToInt($price):int
{
    return (int)str_replace(['.', '₫', ','], '', $price);
}

function formatToPrice($price):string
{
    return number_format($price, 0, ',', '.') . '₫';
}
