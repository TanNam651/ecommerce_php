<?php
//require_once '../../../../vendor/autoload.php';
//
//use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
//use Symfony\Component\Mailer\Transport;
//use Symfony\Component\Mailer\Mailer;
//use Symfony\Component\Mime\Email;
//
//function sendMail($toEmail,$subject ,$baseURL){
//// create a Transport object
//$transport = Transport::fromDsn('smtp://ntnamxxx@gmail.com:nbailyktnygwgayw@smtp.gmail.com:587');
//
//// create mailer object
//$mailer = new Mailer($transport);
//
//// create an email object
//$email = (new Email());
//
//// set the from address
//$email->from('ntnamxxx@gmail.com');
//
//// set the to address
//$email->to(
//  $toEmail
//);
//
//// set a subject
//$email->subject($subject);
//
//// set the plain-text Body
//$email->text('The plain text');
//
//// set html body
//$email->html('
//<h1">
//Vui lòng nhấn vào <a href="'.$baseURL.'">liên kết</a> này để xác thực tài khoản.
//</h1>');
//
//// send email
//$mailer->send($email);
//}