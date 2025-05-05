<?php
include "layout/header.php";
?>
<div class="template-account">
    <div class="container">
        <div class="customer-max">
            <div class="bg-white">
                <div class="customer-form">
                    <div class="header-page">
                        <h1>Tạo tài khoản</h1>
                    </div>
                    <div class="user-box">
                        <form action="" class="form-account">
                            <ul>
                                <li class="form-firstname">
                                    <label for="firstname" hidden="hidden">Firstname</label>
                                    <input type="text" id="firstname" name="firstname" placeholder="Họ">
                                </li>
                                <li class="form-lastname">
                                    <label for="lastname" hidden="hidden">Firstname</label>
                                    <input type="text" id="lastname" name="lastname" placeholder="Tên">
                                </li>
                                <li class="form-phone-number">
                                    <label for="phone-number" hidden="hidden">Firstname</label>
                                    <input type="tel" id="phone-number" name="phone-number" placeholder="Số điện thoại">
                                </li>
                                <li class="form-email">
                                    <label for="email-register" hidden="hidden">Firstname</label>
                                    <input type="email" id="email-register" name="email" placeholder="Email">
                                </li>
                                <li class="form-password">
                                    <label for="password" hidden="hidden">Firstname</label>
                                    <input type="password" id="password" name="password" placeholder="Mật khẩu">
                                </li>
                                <li class="message">
                                    <p id="message-status"></p>
                                </li>
                                <li class="customer-action-account">
                                    <div class="action-bottom button">
                                        <button class="btn" id="btn-signup" type="submit"
                                                style="display: flex; justify-content: center; align-items: center;">
                                            Đăng ký
                                        </button>
                                    </div>
                                </li>
                                <li class="req-pass">
                                    <a class="come-back" href="/login">
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

<?php
include "layout/footer.php";
?>
<script src="../../../scripts/script.js"></script>
<script>
    $(document).ready(function () {
        $('#btn-signup').click(function (e) {
            e.preventDefault();
            $(this).attr('disable', true);
            let firstname = $('#firstname').val();
            let lastname = $('#lastname').val();
            let phoneNumber = $('#phone-number').val();
            let email = $('#email-register').val();
            let password = $('#password').val();

            // remove message notification
            $('.message').removeClass('show-error-message').removeClass('show-success-message');

            if (!firstname || !lastname || !phoneNumber || !email || !password) {
                sendMessage('.message' ,"Vui lòng điền đầy đủ thông tin", 'error');
                return;
            }

            // check input email
            if(!regexEmail(email)){
                sendMessage('.message',"Vui lòng nhập đúng email!", 'error');
                // $('#email-register').val('');
                email.val('');
                return;
            }

            if(!regexPhoneNumber(phoneNumber)){
                sendMessage('.message',"Vui lòng nhập đúng SDT", 'error');
                phoneNumber.val('');
                return;
            }

            // check input password
            if (!checkValidPassword(password)) {
                sendMessage('.message',"Mật khẩu phải có ít nhất 6 ký tự", 'error');
                password.val('');
            }

            $.ajax({
                type: 'POST',
                url: "actions/accounts/register.php",
                dataType: "html",
                data: {
                    firstname: firstname,
                    lastname: lastname,
                    phone: phoneNumber,
                    email: email,
                    password: password,
                }
            }).done(function (response) {
                let result =JSON.parse(response);
                if(result.code===200){
                    sendMessage('.message',result.message, "success");
                }
                else if(result.code===100){
                    sendMessage('.message',result.message, "error");
                } else if (result.code===101){
                    sendMessage('.message',result.message, "error");
                }

            }).fail(function (jqXHR, textStatus) {
                console.log(textStatus);
                sendMessage('.message',"Có lỗi, vui lòng thử lại sau", 'error');
            });
            $(this).removeAttr('disable');
            // $("#loader-register").removeClass('active');
        });
    });
</script>