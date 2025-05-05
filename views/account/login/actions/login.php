<?php

include('../../signup/actions/email.php');
require_once("../../../../config/config.php");

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

$status = "";
$email = $connect->real_escape_string($_POST['email']);
$password = $connect->real_escape_string($_POST['password']);

$query_email = "SELECT * FROM users WHERE email = '$email' LIMIT 1";

$get_email = mysqli_query($connect, $query_email);

if (mysqli_num_rows($get_email)) {
  while ($row = mysqli_fetch_array($get_email)) {

    if ($row['verify_email']=='0000-00-00 00:00:00.000000') {
      $new_verify_id = Uuid::uuid4();
      $verify_token_again = Uuid::uuid4();
      $new_expires = date('Y-m-d H:i:s', strtotime('+1 minutes'));

      $query_verify_again = "INSERT INTO verificationtokens(id,email,token,expires) VALUE('$new_verify_id', '$email', '$verify_token_again','$new_expires')";
      mysqli_query($connect, $query_verify_again);

      try {
        sendMail($email, 'Verify Email', baseURL() . "?pages=verify&token=$verify_token_again");
      } catch (TransportException $e) {
        echo "100";
      }

      echo "101";
      return;
    } else {
      $hash_password = $row['password'];
      if (password_verify($password, $hash_password)) {
        $id_access = Uuid::uuid4();
        $access_token = Uuid::uuid4();
        $expire_access = date('Y-m-d H:i:s', strtotime('+1 day'));

        $query_access_token = "INSERT INTO verificationtokens(id,email,token,expires) VALUE('$id_access', '$email', '$access_token', '$expire_access')";

        mysqli_query($connect, $query_access_token);

        $id_refresh = Uuid::uuid4();
        $refresh_token=Uuid::uuid4();
        $expire_refresh = date('Y-m-d H:i:s', strtotime('+15 minutes'));

        $query_refresh_token = "INSERT INTO verificationtokens(id,email,token,expires) VALUE('$id_refresh', '$email', '$refresh_token', '$expire_refresh')";

        mysqli_query($connect, $query_refresh_token);
        

        $update_user = "UPDATE users SET refreshtoken='$refresh_token', accesstoken='$access_token' WHERE email='$email'";
        mysqli_query($connect, $update_user);
        echo "102"  ;
      } else {
        echo "404";
        return;
      }
    }
  }
}
