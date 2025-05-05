<?php
require_once __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/../../Core/Database.php";
require_once __DIR__ . "/../../Core/function.php";
require_once __DIR__ . "/../../actions/send-mail.php";

use Core\Database;

$config = require __DIR__ . "/../../config/config.php";

$db = new Database($config);

date_default_timezone_set("Asia/Ho_Chi_Minh");

$token = filter_input(INPUT_POST, "token", FILTER_SANITIZE_STRING);

$sql_check_token = "SELECT * FROM ecommerce.tokens WHERE token = :token";
$sql_delete_exist_token = "DELETE FROM ecommerce.tokens where id=:id";

$result = $db->query($sql_check_token, ["token" => $token]);

$existToken = $db->statement->fetch(PDO::FETCH_ASSOC);

if ($existToken) {
  if ($existToken['expires'] >= date("Y-m-d H:i:s")) {

    $verifyTime = new DateTime();
    $sql_update_account = "UPDATE ecommerce.users SET verified = :verified WHERE email=:email";

    $resultUpdate = $db->query($sql_update_account, ["verified" => $verifyTime->format("Y-m-d H:i:s"), "email" => $existToken['email']]);


    $resultDelete = $db->query($sql_delete_exist_token, ["id" => $existToken['id']]);

    echo json_encode([
      "message" => "Xác thực tài khoản thành công.",
      "code" => 200
    ], JSON_UNESCAPED_UNICODE);
//    return 0;
  } else {
    $newId = generateId();
    $newVerifyToken = generateToken();
    $newVerifyTime = date("Y-m-d H:i:s", strtotime("+5 minutes"));

    $resultDelete = $db->query($sql_delete_exist_token, ["id" => $existToken['id']]);


    $sql_new_token = "INSERT INTO ecommerce.tokens (id, email, token, expires) VALUES (:id, :email, :token, :expires)";
    $createNewToken = $db->query($sql_new_token, ["id" => $newId, "email" => $existToken['email'], "token" => $newVerifyToken, "expires" => $newVerifyTime]);

    try {
      sendMail($existToken['email']
        , 'Verify your email address', baseURL() . 'verify-email?token=' . $newVerifyToken);
    } catch (Exception $e) {
      echo json_encode([
        'message' => "Không thể gửi mail, vui lòng thử lại sau",
        'code' => 102
      ], JSON_UNESCAPED_UNICODE);
//      return;
    }

    echo json_encode([
      "message" => "Token đã hết hạn, vui lòng check lại mail",
      "code" => 101
    ], JSON_UNESCAPED_UNICODE);
    return 0;
  }
} else {
  echo json_encode([
    "message" => "Xác thực không hợp lệ",
    "code" => 100
  ], JSON_UNESCAPED_UNICODE);
  return;
}