<?php
include "layout/header.php";
?>
<section class="template-return">
    <div class="container">
        <div class="cart-wrap">
            <div class="wrapper-return">
                <div class="cart-return">
                    <div class="cart-header">
                        <img src="../../public/assets/chu_ki_mail_b62c6cf5ff4e47e39589493faf37dbc4_grande.webp" alt="">
                    </div>
                    <div class="cart-content">
                        <h2>Đặt hàng thành công</h2>
                        <p>Chúng tôi đã nhận được đơn đặt hàng của bạn và đang xử lý đơn hàng của bạn.</p>
                        <button class="btn btn-redirect">Quay lại trang chủ</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include "layout/footer.php";
?>

<script src="../../scripts/script.js"></script>

<script>
  $(document).ready(function() {
    $('.btn-redirect').click(function() {
        window.location.href = '/';
    });

    let params = Object.fromEntries(new URLSearchParams(window.location.search));
    console.log(params);

    if(!params){
        console.log(params);
    } else {
        let orderId = params.order_Id;
        let vnpAmount = params.vnp_Amount;
        let vnpBankCode = params.vnp_BankCode;
        let transactionId = params.vnp_TransactionNo;
        let status = params.vnp_TransactionStatus;
        let responseCode = params.vnp_ResponseCode;
        console.log(orderId);
          $.ajax({
              url: 'actions/transaction-success.php',
              type: 'GET',
              dataType: 'html',
              data: {
                  orderId: orderId,
                  vnpAmount: vnpAmount,
                  vnpBankCode: vnpBankCode,
                  transactionId: transactionId,
                  status: status,
                  responseCode: responseCode
              }
          }).done(function (response){
              localStorage.removeItem('store-cart');
              $('#number-cart-header').text('0');
          }).fail(function (jqXHR, textStatus){

          });
    }
  });
</script>