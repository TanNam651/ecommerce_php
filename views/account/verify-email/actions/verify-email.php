<?php

include('../../signup/actions/email.php');
require_once('../../../../config/config.php');

date_default_timezone_set("Asia/Ho_Chi_Minh");

use Ramsey\Uuid\Uuid;
use Symfony\Component\Mailer\Exception\TransportException;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

session_start();

$verify_token = $connect->real_escape_string($_POST['token']);


$query = "SELECT * FROM verificationtokens WHERE token = '$verify_token' LIMIT 1";

$results = mysqli_query($connect, $query);

if (mysqli_num_rows($results) > 0) {
  $row = mysqli_fetch_assoc($results);
  $token = $row['token'];
  $expires = new DateTime($row['expires']);
  $email = $row['email'];

  $now = new DateTime();

  if ($now < $expires) {
    $verify_date = date('Y-m-d H:i:s');
    $update_account = "UPDATE users SET verify_email='$verify_date' WHERE email='$email'";
    if (mysqli_query($connect, $update_account)) {
      $delete_query = "DELETE FROM verificationtokens WHERE token='$token'";
      mysqli_query($connect, $delete_query);
      echo "101";
    }
  } else {
    $delete_query = "DELETE FROM verificationtokens WHERE token='$token'";
    mysqli_query($connect, $delete_query);
    $new_id = Uuid::uuid4();
    $new_token = Uuid::uuid4();
    $new_expires = date('Y-m-d H:i:s', strtotime('+5 minutes'));
    $new_verify_token = "INSERT INTO verificationtokens(id,email,token,expires) VALUE('".$new_id. "','".$email. "','".$new_token. "','".$new_expires."')";
    mysqli_query($connect, $new_verify_token);

    try {
      sendMail($email, 'Verify Email', baseURL() . "?pages=verify&token=$new_token");
      echo "100";
    } catch (TransportExceptionInterface $e) {
      echo "102";
    }
  }
  // echo $now->format('Y-m-d H:i:s');
} else {
  echo "103";
}
