<?php

require_once __DIR__."/../../vendor/autoload.php";
require "../../Core/App.php";
require "../../Core/Database.php";
require "../../actions/send-mail.php";
require "../../Core/function.php";

use Core\App;
use Core\Database;

use Ramsey\Uuid\Uuid;

$config = require "../../config/config.php";

date_default_timezone_set("Asia/Ho_Chi_Minh");


$db = new Database($config);

$option = ['cost'=>12];

$id = Uuid::uuid4()->toString();
$firstname = filter_input(INPUT_POST,'firstname',FILTER_SANITIZE_STRING);
$lastname = filter_input(INPUT_POST, 'lastname',FILTER_SANITIZE_STRING);
$phone = filter_input(INPUT_POST, 'phone',FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = password_hash(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING), PASSWORD_BCRYPT, $option);

$sql_check_mail = "SELECT * FROM ecommerce.users WHERE email= :email LIMIT 1";

$result = $db->query($sql_check_mail,["email"=>$email]);
$existEmail = $result->statement->fetch(PDO::FETCH_ASSOC);


if($existEmail){
    $message = [
        'message'=>"Email already exist",
        'code'=>100
    ];
   echo json_encode($message);
}
else{
    $sql_create_account = "INSERT INTO ecommerce.users(id, firstname, lastname, email, password, role, accesstoken, refreshtoken, phone) VALUES(:id, :firstname, :lastname, :email, :password, :role, :accesstoken, :refreshtoken, :phone)";

    $result = $db->query($sql_create_account, [
        "id"=>$id,
        "firstname"=>$firstname,
        "lastname"=>$lastname,
        "email"=>$email,
        "password"=>$password,
        "role"=>"user",
        "accesstoken"=>'',
        "refreshtoken"=>'',
        "phone"=>$phone

    ]);

    if($result){
        $idVerifyToken = generateId();
        $verifyToken = generateToken();
        $expire = date('Y-m-d H:i:s', strtotime('+5 minutes'));

        $sql_save_token = "INSERT INTO ecommerce.tokens(id, email, token, expires) VALUES (:id, :email, :token, :expires)";

        $saveTokenResult = $db->query($sql_save_token,[
           'id'=>$idVerifyToken,
           'email'=>$email,
           'token'=>$verifyToken,
           'expires'=>$expire
        ]);

        if($saveTokenResult){
            try {
                sendMail($email,'Verify your email address',baseUrl('verify-email?token='.$verifyToken));
            } catch (Exception $e) {
                echo json_encode([
                    'message'=>"Không thể gửi mail, vui lòng thử lại",
                    'code'=>101
                ],JSON_UNESCAPED_UNICODE);
                return;
            }

            echo json_encode([
                'message'=>"Vui lòng kiểm tra mail để xác thực tài khoản.",
                'code'=>200
            ],JSON_UNESCAPED_UNICODE);
        }


    }
}


//$db->query("INSERT INTO ecommerce.users (id, firstname, lastname, email, password, phone, role, accesstoken, refreshtoken) VALUES(:id, :firstname, :lastname, :email, :password, :phone, :role, :accesstoken, :refreshtoken)",[
//    'id'=>$id,
//    'firstname' => $firstname,
//    'lastname' => $lastname,
//    'email' => $email,
//    'password' => $password,
//    'phone' => $phone,
//    'role' => 'USER',
//    'accesstoken' => '',
//    'refreshtoken' => '',
//]);

