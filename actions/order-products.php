<?php

require_once "../vendor/autoload.php";
require_once "../Core/Database.php";
require_once "../Core/function.php";
require_once "../config/vnpay-config.php";
require_once "send-mail.php";

use Core\Database;
use Ramsey\Uuid\Uuid;

$config = require "../config/config.php";

$db = new Database($config);
//$db = Core\Database::getConnection();

date_default_timezone_set("Asia/Ho_Chi_Minh");

$full_name = filter_input(INPUT_POST, 'fullName');
$email = filter_input(INPUT_POST, 'email');
$phone = filter_input(INPUT_POST, 'phone');
$address = filter_input(INPUT_POST, 'address');
$user_id = filter_input(INPUT_POST, 'userId');
$method = filter_input(INPUT_POST, 'paymentMethod');

$products = filter_input(INPUT_POST, 'products');

$products = json_decode($products, true);

$query_user = "SELECT * FROM ecommerce.users WHERE id = :id";
$query_product = "SELECT * FROM ecommerce.products WHERE id = :id";
$query_order = "INSERT INTO ecommerce.orders (id, user_id, total_amount, order_status, address, created_at) VALUES (:id, :user_id, :total_amount, :order_status, :address, :created_at)";
$query_order_detail = "INSERT INTO ecommerce.order_details (id, order_id, product_id, quantity, total) VALUES (:id, :order_id, :product_id, :quantity, :total)";
$query_payment = "INSERT INTO ecommerce.payments (id, order_id, payment_method, payment_status, transaction_id, bank_code, paid_amount, created_at) values (:id, :order_id, :payment_method, :payment_status, :transaction_id, :bank_code, :paid_amount, :created_at)";

$db->query($query_user, [':id' => $user_id]);

$existUser = $db->statement->fetch(PDO::FETCH_ASSOC);

$totalPrice = 0;

$order_id = Uuid::uuid4()->toString();

$list_order_detail = [];


foreach ($products as $product) {
    $priceForProduct = (int)$product['quantity'] * convertPriceToInt($product['price']);
    $totalPrice += $priceForProduct;
    $list_order_detail[] = [
        'product_id' => $product['id'],
        'quantity' => $product['quantity'],
        'total' => formatToPrice($priceForProduct),
    ];
}

$db->createTransaction();

try {


//create database order

    $db->query($query_order, [
        'id' => $order_id,
        'user_id' => $user_id,
        'total_amount' => formatToPrice($totalPrice),
        'order_status' => "PENDING",
        'address' => $address,
        'created_at' => date("Y-m-d H:i:s"),
    ]);


//create database order detail
    foreach ($list_order_detail as $item) {
        $order_detail_id = Uuid::uuid4()->toString();
        $db->query($query_order_detail, [
            'id' => $order_detail_id,
            'order_id' => $order_id,
            'product_id' => $item['product_id'],
            'quantity' => $item['quantity'],
            'total' => $item['total'],
        ]);
    }

//create database payment

    if ($method == "CASH") {
        $payment_id = Uuid::uuid4()->toString();
        $db->query($query_payment, [
            'id' => $payment_id,
            'order_id' => $order_id,
            'payment_method' => $method,
            'payment_status' => 'PENDING',
            'transaction_id' => null,
            'bank_code' => null,
            'paid_amount' => formatToPrice($totalPrice),
            'created_at' => date("Y-m-d H:i:s"),
        ]);

        $db->endCommit();

        echo json_encode([
            'url' => '/transaction-return?success=true',
            'message' => "Đặt hàng thành công, chúng tôi sẽ xử lý đơn hàng của bạn.",
            'code' => 200,
        ], JSON_UNESCAPED_UNICODE);
    } else {
//    payment with vnpay
//    set time for payment
        $startTime = date("YmdHis");
        $expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));

        $vnp_TxnRef = time() . ""; //Mã giao dịch thanh toán tham chiếu của merchant
        $vnp_Amount = $totalPrice * 100; // Số tiền thanh toán
        $vnp_Locale = 'vn'; //Ngôn ngữ chuyển hướng thanh toán
        $vnp_BankCode = 'NCB'; //Mã phương thức thanh toán
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; //IP Khách hàng thanh toán
        $vnp_ExpireDate = $expire;

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => "Thanh toan GD:" . $vnp_TxnRef,
            "vnp_OrderType" => "other",
            "vnp_ReturnUrl" => $vnp_Returnurl . "?order_Id=" . $order_id,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate" => $vnp_ExpireDate
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);

        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;

        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $db->endCommit();
        echo json_encode([
            'url' => $vnp_Url,
            'message' => "Giao dịch thất bại, vui lòng thử lại sau.",
            'code' => 100
        ], JSON_UNESCAPED_UNICODE);
    }


} catch (PDOException $e) {
    $db->endRollBack();
    echo json_encode([
        'url' => '/transaction-return?success=false',
        'message' => "Giao dịch thất bại, vui lòng thử lại sau.",
        'code' => 100], JSON_UNESCAPED_UNICODE);
}
