<?php
include '../actions/email.php';
require_once("../../../../config/config.php");
require_once("../../../../vendor/autoload.php");
require_once('../actions/email.php');

date_default_timezone_set("Asia/Ho_Chi_Minh");


use Ramsey\Uuid\Uuid;
use Symfony\Component\Mailer\Exception\TransportException;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

function baseURL()
{
  $url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https://' : 'http://';
  return $url . $_SERVER['HTTP_HOST'] . '/intern-ecommerce/index.php';
}

session_start();


// status: 100: email exists, 200: success 404: error

$status = "";
$firstname = $connect->real_escape_string($_POST['firstname']);
$lastname = $connect->real_escape_string($_POST['lastname']);
$phone_number = $connect->real_escape_string($_POST['phone_number']);
$email = $connect->real_escape_string($_POST['email']);
$options = [
  'cost' => 12,
];

$password = $connect->real_escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT, $options));

$id = Uuid::uuid4();
$verify_id = Uuid::uuid4();
$token = Uuid::uuid4();

$expire = date('Y-m-d H:i:s', strtotime('+1 minutes'));
$check_verify = "";
$accesstoken = "";
$refreshtoken = "";

$query_email = "SELECT * FROM users WHERE email = '$email' LIMIT 1";

$verify_email = mysqli_query($connect, $query_email);

if (mysqli_num_rows($verify_email) > 0) {
  echo "100";
} else {
  // create account
  try {
    $register_account = mysqli_query($connect, "INSERT INTO users(id,firstname,lastname,phonenumber,email,password,refreshtoken, accesstoken,verify_email) VALUE('" . $id . "','" . $firstname . "','" . $lastname . "','" . $phone_number . "','" . $email . "','" . $password . "','" . $refreshtoken . "','" . $accesstoken . "','" . $check_verify . "')");

    $verify_token = mysqli_query($connect, "INSERT INTO verificationtokens(id,email,token,expires) VALUE('".$verify_id. "','".$email. "','".$token. "','".$expire."')");

    if($register_account&&$verify_email){
      try {
        sendMail($email, 'Verify Email', baseURL() . "?pages=verify&token=$token");
      } catch (TransportExceptionInterface $e) {
        echo $status="101";
      }
    }
  } catch (Exception $e) {
    echo $status = "102";
  }

  echo $status="103";
}
