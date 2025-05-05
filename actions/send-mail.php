<?php

use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;

function sendMail($to, $subject, $baseURL):void
{

//    create transport mail
    $transport = Transport::fromDsn('smtp://ntnamxxx@gmail.com:nbailyktnygwgayw@smtp.gmail.com:587');

//    create mailer
    $mailer = new Mailer($transport);

//    create an email object
    $email = (new Email());

//    set from address
    $email->from('ntnamxxx@gmail.com');

//    set to address
    $email->to($to);

//    set a subject
    $email->subject($subject);

//    set explain text
    $email->text("The explain text");

//    set html body
    $email->html(
        "<h1>Vui lòng nhấn vào <a href='{$baseURL}'>liên kết</a> để xác thực tài khoản </h1>"
    );

    try {
        $mailer->send($email);

    } catch (\Symfony\Component\Mailer\Exception\TransportExceptionInterface $e) {
    }
}