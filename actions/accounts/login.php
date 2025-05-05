<?php

require_once __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/../../Core/Database.php";
require_once __DIR__ . "/../../Core/function.php";
require_once __DIR__ . "/../../actions/send-mail.php";

use Core\Database;
use Ramsey\Uuid\Uuid;

session_start();

$config = require "../../config/config.php";
date_default_timezone_set("Asia/Ho_Chi_Minh");

$db = new Database($config);


$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = filter_input(INPUT_POST, 'password');
$callback = $_GET['callback'];

$sql_get_email = "SELECT * FROM ecommerce.users WHERE email=:email LIMIT 1";

$db->query($sql_get_email, ["email" => $email]);

$existEmail = $db->statement->fetch(PDO::FETCH_ASSOC);
if ($existEmail && $existEmail['verified'] == null) {
    try {
        $id = generateId();
        $verifyToken = generateToken();
        $expires = date('Y-m-d H:i:s', strtotime('+5 minutes'));

        $sql_verify_token = "INSERT INTO ecommerce.tokens(id, email, token, expires) VALUES (:id, :email, :token, :expires)";

        $db->query($sql_verify_token, [
            'id' => $id,
            'email' => $existEmail['email'],
            'token' => $verifyToken,
            'expires' => $expires,
        ]);

        sendMail($existEmail['email'], "Verify your email address", baseURL() . 'verify-email?token=' . $verifyToken);

        echo json_encode([
            "message" => "Vui lòng kiểm tra mail để xác thực tài khoản.",
            "code" => 101
        ], JSON_UNESCAPED_UNICODE);

        return;

    } catch (Exception $e) {
        echo json_encode([
            "message" => "Có lỗi, vui lòng kiểm tra lại.",
            "code" => 102
        ], JSON_UNESCAPED_UNICODE);
    }
}


if ($existEmail && password_verify($password, $existEmail['password']) && $existEmail['verified'] !== null) {

    if ($existEmail['accesstoken'] && $existEmail['refreshtoken']) {
        $sql_delete_token = "DELETE FROM ecommerce.auth_token WHERE user_id = :user_id";
        $db->query($sql_delete_token, ["user_id" => $existEmail['id']]);
    }

    $idAccess = generateId();
    $accessToken = generateToken();
    $expiresAccess = date("Y-m-d H:i:s", strtotime('+30 minutes'));

    $sql_create_access = "INSERT INTO ecommerce.auth_token(id, user_id, token, expires) VALUES(:id, :user_id, :token, :expires)";
    $db->query($sql_create_access, [
        'id' => $idAccess,
        'user_id' => $existEmail['id'],
        'token' => $accessToken,
        'expires' => $expiresAccess,
    ]);

    $idRefresh = generateId();
    $refreshToken = generateToken();
    $expiresRefresh = date("Y-m-d H:i:s", strtotime('+1 day'));

    $sql_create_refresh = "INSERT INTO ecommerce.auth_token(id, user_id, token, expires) VALUES(:id, :user_id, :token, :expires)";
    $db->query($sql_create_refresh, [
        'id' => $idRefresh,
        'user_id' => $existEmail['id'],
        'token' => $refreshToken,
        'expires' => $expiresRefresh,
    ]);

    $sql_update_user = "UPDATE ecommerce.users SET accesstoken = :access, refreshtoken = :refresh WHERE id = :id";
    $db->query($sql_update_user, [
        'id' => $existEmail['id'],
        'access' => $accessToken,
        'refresh' => $refreshToken,
    ]);

    $user = array(
        'id' => $existEmail['id'],
        'email' => $existEmail['email'],
        'name' => $existEmail['firstname'] . " " . $existEmail['lastname'],
        'phone' => $existEmail['phone'],
        'role' => $existEmail['role'],
        'access_token' => $accessToken,
        'refresh_token' => $refreshToken,
    );
    $_SESSION['user_login'] = $user;
    setcookie("auth_user", json_encode($user, JSON_UNESCAPED_UNICODE), time() + (86400 * 30), "/");

    echo json_encode([
        "message" => "Đăng nhập thành công",
        'user'=>json_encode($user, JSON_UNESCAPED_UNICODE),
        "code" => $callback
    ], JSON_UNESCAPED_UNICODE);

} else {
    echo json_encode([
        "message" => "Mật khẩu không đúng",
        "code" => 103
    ], JSON_UNESCAPED_UNICODE);
}