<?php

require_once "../vendor/autoload.php";
require_once "../Core/Database.php";
require_once "../Core/function.php";
require_once "../config/vnpay-config.php";


use Core\Database;
use Ramsey\Uuid\Uuid;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
$config = require "../config/config.php";

$db = new Database($config);

date_default_timezone_set("Asia/Ho_Chi_Minh");

$orderId = $_GET['orderId'];
$bankCode = $_GET['vnpBankCode'];
$transactionId = $_GET['transactionId'];
$status = $_GET['status'];
$responseCode = $_GET['responseCode'];
$amount = (int) $_GET['vnpAmount'];

$query_update_payment = "INSERT INTO ecommerce.payments (id, order_id, payment_method, payment_status, transaction_id, bank_code, paid_amount, created_at) values (:id, :order_id, :payment_method, :payment_status, :transaction_id, :bank_code, :paid_amount, :created_at)";

$db->createTransaction();
try{
    $paymentStatus = "PENDING";
    if($status == "00"){
        $paymentStatus = "COMPLETED";
    }
    $db->query($query_update_payment, [
        'id' => $transactionId,
        'order_id' => $orderId,
        'payment_method' => 'VNPAY',
        'payment_status' => $paymentStatus,
        'transaction_id' => $transactionId,
        'bank_code' => $bankCode,
        'paid_amount' => formatToPrice($amount/100),
        'created_at' => date('Y-m-d H:i:s'),
    ]);
    $db->endCommit();

} catch (PDOException $e){
    $db->endRollBack();
}

//http://localhost:8888/transaction-return?order_Id=d3b265da-2fa7-4bf6-a991-342339192e77&vnp_Amount=10100000000&vnp_BankCode=NCB&vnp_BankTranNo=VNP14884195&vnp_CardType=ATM&vnp_OrderInfo=Thanh+toan+GD%3A1743490879&vnp_PayDate=20250401140156&vnp_ResponseCode=00&vnp_TmnCode=70BXJBO0&vnp_TransactionNo=14884195&vnp_TransactionStatus=00&vnp_TxnRef=1743490879&vnp_SecureHash=1ac3745f874210e0d00198c3b2d35283c8e501b1f0754e81fd05302903c4410e458447df4526e38a3f54672a0d1ac105028a9ba0dccb6ae5779f16ce9f3b0ed0