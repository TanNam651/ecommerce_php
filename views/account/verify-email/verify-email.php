<?php
include "layout/header.php";
?>
<div class="template-account">
  <div class="container">
    <div class="customer-max">
      <div class="bg-white">
        <div class="customer-form">
          <div class="header-page">
            <h1>Xác thực tài khoản</h1>
          </div>
          <div class="user-box">
            <div class="message">
              <p id="message-status"></p>
            </div>
            <div class="req-pass">
              <a class="come-back" href="/login">
                <i class="fa-solid fa-reply"></i>
                Quay lại đăng nhập
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
include "layout/footer.php";
?>
<script src="../../../scripts/script.js"></script>
<script>
  const urlParams = new URLSearchParams(window.location.search);
  const token = urlParams.get("token");
  console.log("TOKEN: ", token);

  $.ajax({
    type: 'POST',
    url: "actions/accounts/verify-email.php",
    dataType: "html",
    data: {
      token
    }
  }).done(function(response) {
    let result = JSON.parse(response);
    if(result.code===200){
      sendMessage(result.message, "success");

    } else if(response ===101){
      sendMessage(result.message,"error");
    } else{
      sendMessage(result.message,"error");
    }
    console.log(result.code);
    console.log(result.message);
      console.log(response);
  }).fail(function(jqXHR, textStatus) {
    sendMessage("Xác thực thất bại","error");
  });

</script>