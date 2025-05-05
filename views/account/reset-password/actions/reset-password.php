<?php

include '../../signup/actions/email.php';
require_once("../../../../config/config.php");
require_once("../../../../vendor/autoload.php");

date_default_timezone_set("Asia/Ho_Chi_Minh");

use Ramsey\Uuid\Uuid;
use Symfony\Component\Mailer\Exception\TransportException;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

function baseURL()
{
  $url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https://' : 'http://';
  return $url . $_SERVER['HTTP_HOST'] . '/intern-ecommerce/index.php';
}

if (isset($_POST['email'])) {
  $email = $connect->real_escape_string($_POST['email']);

  $query_check_email = "SELECT * FROM users WHERE email='$email' LIMIT 1";
  $result_email = mysqli_query($connect, $query_check_email);
  if (mysqli_num_rows($result_email) > 0) {

    $id = Uuid::uuid4();
    $reset_token = Uuid::uuid4();
    $expire_reset = date('Y-m-d H:i:s', strtotime('+1 minutes'));

    $query_create_token = "INSERT INTO verificationtokens(id, email, token, expires) VALUE('$id', '$email', '$reset_token', '$expire_reset')";

    $create_token = mysqli_query($connect, $query_create_token);

    if ($create_token) {
      try {
        sendMail($email, "Reset password", baseURL() . "?pages=reset-password&token=$reset_token");
      } catch (TransportExceptionInterface $e) {
        echo "100";
      }

      echo "101";
    }
  }
}

if (isset($_POST['token']) && isset($_POST['password'])) {

  $options = [
    'cost' => 12,
  ];

  $token = $connect->real_escape_string($_POST['token']);
  $password = $connect->real_escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT, $options));

  $query_check_token = "SELECT * FROM verificationtokens WHERE token = '$token'";
  $query_delete_token = "DELETE FROM verificationtokens WHERE token='$token'";

  $token_result = mysqli_query($connect, $query_check_token);

  if (mysqli_num_rows($token_result) > 0) {
    $row = mysqli_fetch_assoc($token_result);

    $email = $row['email'];
    $expires = new DateTime($row['expires']);
    $now = new DateTime();


    if ($now < $expires) {

      $query_change_password = "UPDATE users SET password='$password' WHERE email = '$email' LIMIT 1";
      mysqli_query($connect, $query_change_password);
      mysqli_query($connect, $query_delete_token);
      echo "102";
    } else {

      $new_id = Uuid::uuid4();
      $new_token = Uuid::uuid4();
      $new_expires = date('Y-m-d H:i:s', strtotime('+5 minutes'));

      $query_create_new_token = "INSERT INTO verificationtokens(id,email,token,expires) VALUE('" . $new_id . "','" . $email . "','" . $new_token . "','" . $new_expires . "')";

      mysqli_query($connect, $query_delete_token);
      $create_new_token = mysqli_query($connect, $query_create_new_token);

      try {
        sendMail($email, 'Verify Email', baseURL() . "?pages=reset-password&token=$new_token");
        echo "103";
      } catch (TransportExceptionInterface $e) {
        echo "104";
      }
    }
  }




  // $password = $connect->real_escape_string($_POST['password']);


  // echo $password;
  // $result_email = mysqli_query($connect, $result_email);

  // if (mysqli_num_rows($result_email) > 0) {
  //   $reset_token = Uuid::uuid4();
  //   $expire_reset = date('Y-m-d H:i:s', strtotime('+1 minutes'));
  // } else {
  //   echo "100";
  // }
}
