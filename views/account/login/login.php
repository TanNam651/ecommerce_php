<?php
include "layout/header.php";
?>
<div class="template-account">
    <div class="container">
        <div class="customer-max">
            <div class="bg-white">
                <div class="customer-form">
                    <div class="header-page">
                        <h1>Đăng nhập</h1>
                    </div>
                    <div class="user-box">
                        <form action="/login" class="form-account">
                            <ul>
                                <li class="form-email">
                                    <label for="email-login"></label>
                                    <input type="email" name="email" id="email-login" placeholder="Email">
                                </li>
                                <li class="form-password">
                                    <label for="password"></label>
                                    <input type="password" name="password" id="password" placeholder="Mật khẩu">
                                </li>
                                <li class="message">
                                    <p id="message-status"></p>
                                </li>
                                <li class="customer-action-account">
                                    <div class="action-bottom button">
                                        <button id="btn-login" class="btn" type="submit">Đăng nhập</button>
                                    </div>
                                </li>
                            </ul>
                        </form>
                        <div class="action-account-customer">
                            <div class="req-pass">
                                <a class="" href="/reset-password">
                                    Quên mật khẩu?
                                </a>
                                <br>
                                hoặc
                                <a href="/register">
                                    Đăng ký
                                </a>
                            </div>
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
    console.log(getSpecialCookie('auth_user'))
    $(document).ready(function () {
        $('#btn-login').click(function (e) {
            e.preventDefault();
            let email = $('#email-login').val();
            let password = $('#password').val();

            if (!email || !password) {
                sendMessage('.message',"Vui lòng nhập đầy đủ thông tin", 'error');
            } else if(!regexEmail(email)|| !checkValidPassword(password)){
                sendMessage('.message',"Email hoặc password không hợp lệ", 'error');
            }
            else {
                $.ajax({
                    url: "actions/accounts/login.php",
                    type: 'POST',
                    data: {
                        email: email,
                        password: password
                    },
                }).done(function (response) {

                    let result = JSON.parse(response);

                    if (result.code === 101 || result.code === 102 || result.code === 103) {
                        sendMessage('.message',result.message, 'error');
                    } else {
                        let params = new URLSearchParams(window.location.search);
                        let search = params.get('callback');
                        sendMessage('.message',result.message, 'success');
                        getSpecialCookie('auth_user')
                        window.location.href = search? '/'+search+'':'/';
                    }
                });
            }
        });
    });
</script>


