<?php
require_once "Core/Database.php";
require_once "Core/function.php";

use Core\Database;
use Ramsey\Uuid\Uuid;

$config = require "config/config.php";

$db = new Database($config);

date_default_timezone_set("Asia/Ho_Chi_Minh");

if (isset($_COOKIE['auth_user'])) {
    $userAuth = json_decode($_COOKIE['auth_user'],true);
    $refreshToken = htmlspecialchars($userAuth['refresh_token']);
    $accessToken = htmlspecialchars($userAuth['access_token']);

    $sql_get_access_token = "SELECT * FROM ecommerce.auth_token WHERE token=:token";
     $db->query($sql_get_access_token,["token"=>$accessToken]);

     $checkAccess = $db->statement->fetch(PDO::FETCH_ASSOC);

     if($checkAccess && $checkAccess['expires']>=date("Y-m-d H:i:s")){
         header("Location: /");
     } else{
         $db->query($sql_get_access_token,["token"=>$refreshToken]);

         $checkRefresh = $db->statement->fetch(PDO::FETCH_ASSOC);

         if($checkRefresh && $checkRefresh['expires']>=date("Y-m-d H:i:s")){
             $sql_delete_token = "DELETE FROM ecommerce.auth_token WHERE token=:token";
             $db->query($sql_delete_token,["token"=>$accessToken]);

             $newId = Uuid::uuid4()->toString();
             $newAccessToken = Uuid::uuid4()->toString();
             $newExpiresAccess = date("Y-m-d H:i:s", strtotime("+30 minutes"));
             $newExpiresRefresh = date("Y-m-d H:i:s", strtotime("+1 day"));

             $sql_create_access = "INSERT INTO ecommerce.auth_token(id, user_id, token, expires) VALUES (:id, :user_id, :token, :expires)";
             $sql_update_refresh = "UPDATE ecommerce.auth_token SET expires=:new_expires WHERE token=:token";
             $sql_update_user ="UPDATE ecommerce.users SET accesstoken=:access_token WHERE id=:user_id";

             $db->query($sql_update_refresh,['new_expires'=>$newExpiresRefresh,'token'=>$checkRefresh['token']]);
             $db->query($sql_create_access,['id'=>$newId,'user_id'=>$checkRefresh['user_id'],'token'=>$newAccessToken,'expires'=>$newExpiresAccess]);

             $db->query($sql_update_user,['access_token'=>$newAccessToken,'user_id'=>$checkRefresh['user_id']]);

             $user = array(
                 'id' => $userAuth['id'],
                 'email' => $userAuth['email'],
                 'role'=>$userAuth['role'],
                 'access_token' => $newAccessToken,
                 'refresh_token' => $userAuth['refresh_token'],
             );
             $_SESSION['user_login'] = $user;
             setcookie("auth_user", json_encode($user,JSON_UNESCAPED_UNICODE), time() + (86400 * 30), "/");
            header("Location: /");
         } else{

             $sql_update_user = "UPDATE ecommerce.users SET accesstoken=NULL, refreshtoken=NULL WHERE id=:user_id";
             $db->query($sql_update_user,['user_id'=>$userAuth['id']]);

             unset($_COOKIE['auth_user']);
             view("account/login/login.php", [
                 'heading' => "Login Page",
             ]);
         }
     }



} else {
    view("account/login/login.php", [
        'heading' => "Login Page",
    ]);
}

ob_end_flush();
