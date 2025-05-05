<div class="template-account">
  <div class="container">
    <div class="customer-max">
      <div class="bg-white">
        <div class="customer-form">
          <div class="header-page">
            <h1>Nhập mật khẩu mới</h1>
          </div>
          <div class="user-box">
            <form action="" class="form-account">
              <ul>
                <li class="form-email">
                  <input type="email" id="email" name="email" placeholder="Email">
                </li>
                <li class="form-email">
                  <input type="password" id="password" name="password" placeholder="Password">
                </li>
                <div class="message">
                  <p id="message-status"></p>
                </div>
                <div class="customer-action-account">
                  <div class="action-bottom button">
                    <button class="btn" id="btn-reset" type="submit" style="display: flex; justify-content: center; align-items: center;">
                      <div id="loader-register" class="loader"></div>
                      Gửi yêu cầu
                    </button>
                  </div>
                </div>
                <li class="req-pass">
                  <a class="come-back" href="index.php?pages=login">
                    <i class="fa-solid fa-reply"></i>
                    Quay lại đăng nhập
                  </a>
                </li>
              </ul>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {

    const urlParams = new URLSearchParams(window.location.search);
    const token = urlParams.get('token');

    const emailRegex = /^(?!.*\.\.)[a-zA-Z0-9][a-zA-Z0-9._%+-]*@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    function isValidEmail(email) {
      return emailRegex.test(email);
    }

    // Example usage:
    console.log(isValidEmail("test@example.com")); // true

    const email = $('#email');
    const password = $('#password');
    const btn_reset = $('#btn-reset');

    if (token) {
      email.css({
        "display": "none"
      });
      password.css({
        "display": "block"
      });
      btn_reset.text("Xác nhận")

    } else {
      email.css({
        "display": "block"
      });
      password.css({
        "display": "none"
      });
    }
    $('#btn-reset').click(function(e) {
      e.preventDefault();
      if (!token) {
        const emailVal = $('#email').val();
        if (emailRegex.test(emailVal)) {
          $.ajax({
            method: "POST",
            url: "./pages/account/reset-password/actions/reset-password.php",
            dataType: "html",
            data: {
              email: emailVal
            }
          }).done(function(response) {
            sendMessage("Vui lòng kiểm tra mail để lấy lại mật khẩu.","success");
          }).fail(function(jqXHR, textStatus) {
            console.log(textStatus);
          });
        } else {
          // console.log("a");
          console.log($('#email').val());
        }
      } else {
        const passwordVal = $('#password').val();
        $.ajax({
          method: "POST",
          url: "./pages/account/reset-password/actions/reset-password.php",
          dataType: "html",
          data: {
            password: passwordVal,
            token: token
          }
        }).done(function(response) {
          if(response.trim()==="101"){
            sendMessage("Vui lòng kiểm tra mail để đổi mật khẩu.", "success");
          } else if(response.trim()==="102"){
            sendMessage("Đổi mật khẩu thành công.", "success");
          } else if(response.trim()==="103"){
            sendMessage("Token quá hạn. Vui lòng kiểm tra lại mail", "success");
          } else{
            sendMessage("Có lỗi, vui lòng thử lại sau.", "error");
          }

        }).fail(function(jqXHR, textStatus) {
          sendMessage("Có lỗi, vui lòng thử lại sau.", "error");
        })
      }
    })
  });

  
</script>