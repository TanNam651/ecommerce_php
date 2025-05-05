<?php
require_once "Core/function.php";
?>

<header id="header" class="site-header">
  <div id="site-header-center" class="header-top">
    <div class="container">
      <div class="header">
        <div class="logo" onclick="redirectHome()">
          <img src="../public/assets/logo-web-white-xgear.webp" class="logo-shop" alt="Xgear">
        </div>
        <div class="search-header">
          <div class="site-search search-desktop">
            <form action="" class="search-form">
              <div class="search-inner">
                <label for="search" hidden="">Search</label>
                <input type="text" id="search" name="search" class="search-input" placeholder="Tìm kiếm">
              </div>
              <button type="submit" id="btn-search" class="btn-search">
                <i class="fa fa-search" aria-hidden="true"></i>
              </button>
            </form>
            <div class="search-result-wrapper">
              <div class="search-container">
                <div class="search-title text-center">
                  <h2>Kết quả tìm kiếm</h2>
                </div>
                <div class="group-head-search d-flex">
                  <span class="title-search">Sản phẩm</span>
                  <a id="number-search-result"></a>
                </div>
                <div class="search-result">

                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="group-header">
          <div class="cart-login-address">
            <ul class="header-group-icon">
              <li id="list-item-account" class="list-item header-account">
                <div class="list-item-text">
                  <button id="login-register-header" class="group-icon-item">
                    <span class="box-icon">
                      <i class="fa-regular fa-user"></i>
                    </span>
                    <span class="box-text hidden-text" style="display: <?= isAuthenticate() ? "none" : "block" ?>;">
                      Đăng nhập
                      <span class="small-text">
                        Đăng ký
                        <i class="fa fa-angle-down"></i>
                      </span>
                    </span>
                    <span class="box-arrow">
                      <svg viewBox="0 0 20 9" role="presentation">
                        <path
                            d="M.47108938 9c.2694725-.26871321.57077721-.56867841.90388257-.89986354C3.12384116 6.36134886 5.74788116 3.76338565 9.2467995.30653888c.4145057-.4095171 1.0844277-.40860098 1.4977971.00205122L19.4935156 9H.47108938z"
                            fill="#ffffff"></path>
                      </svg>
                    </span>
                  </button>
                  <div class="header-action-dropdown"
                       style="<?= isAuthenticate() ? "width:200px; display:flex; justify-content:center; align-item:center;" : "" ?>">
                    <div class="header-logout header-dropdown-content"
                         style="width: 200px; display: <?= isAuthenticate() ? "block" : "none" ?>;">
                      <div style="margin-bottom: 5px;">
                        <button type="button" id="profile-button" class=" btn btn-submit"
                                style="background: #25b09b; border-color: #25b09b;">
                          Profile
                        </button>
                      </div>
                      <div class="">
                        <button type="button" id="logout-button" class=" btn btn-submit ">
                          Logout
                        </button>
                      </div>
                    </div>
                    <div class="header-dropdown-content" style="display: <?= isAuthenticate() ? "none" : "block" ?>;">
                      <div style="overflow:hidden; position: relative;">
                        <div id="header-login-toggle" class="site-account-modal translate-left active">
                          <div class="account-header text-center">
                            <div class="account-title heading">
                              <h1>Đăng nhập tài khoản</h1>
                            </div>
                            <p class="account-legend">Nhập email và password của bạn:</p>
                          </div>
                          <div class="site-account-container">
                            <form action="" method="POST">
                              <div class="form-control">
                                <label for="email">Email address</label>
                                <input id="email" type="email" placeholder="Email" name="email" required
                                       autocomplete="on">
                              </div>
                              <div class="form-control">
                                <label for="password-header"></label>
                                <input id="password-header" type="password" placeholder="Mật khẩu" name="password"
                                       required autocomplete="on">
                              </div>
                              <div class="form-control">
                                <button type="submit" class="btn btn-submit" id="form-submit-login">
                                  Đăng nhập
                                </button>
                              </div>
                            </form>
                          </div>
                          <div class="site-account-secondary-action">
                            <p>Khách hàng mới
                              <a href="/register" class="link"> Tạo tài khoản</a>
                            </p>
                            <p>Quên mật khẩu
                              <button id="reset-password" class="js-link link"> Khôi phục
                                mật khẩu
                              </button>
                            </p>
                          </div>
                        </div>
                        <div id="header-recovery-toggle" class="site-account-modal translate-right">
                          <div class="account-header text-center">
                            <div class="account-title heading">
                              <h1>Khôi phục mật khẩu</h1>
                            </div>
                            <p class="account-legend">Nhập email của bạn:</p>
                          </div>
                          <div class="site-account-container">
                            <form action="" method="POST">
                              <div class="form-control">
                                <label for="reset-email"></label>
                                <input id="reset-email" type="email" placeholder="Email" name="email" required
                                       autocomplete="on">
                              </div>

                              <div class="form-control">
                                <button type="submit" class="btn btn-submit" id="form-submit-login">
                                  Lấy mật khẩu
                                </button>
                              </div>
                            </form>
                          </div>
                          <div class="site-account-secondary-action">
                            <button id="back-to-login" class="js-link link">
                              <i class="fa fa-hand-o-left" aria-hidden="true"></i>
                              Trở về đăng nhập
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
              <li id="list-item-cart" class="list-item header-cart">
                <div class="list-item-text">
                  <button id="header-cart-products" class="group-icon-item">
                    <span class="box-icon">
                      <i class="fa-solid fa-cart-shopping"></i>
                      <span id="number-cart-header" class="number-cart">0</span>
                    </span>
                    <span class="box-text hidden-text">Giỏ hàng</span>
                    <span class="box-arrow">
                      <svg viewBox="0 0 20 9" role="presentation">
                        <path
                            d="M.47108938 9c.2694725-.26871321.57077721-.56867841.90388257-.89986354C3.12384116 6.36134886 5.74788116 3.76338565 9.2467995.30653888c.4145057-.4095171 1.0844277-.40860098 1.4977971.00205122L19.4935156 9H.47108938z"
                            fill="#ffffff"></path>
                      </svg>
                    </span>
                  </button>
                  <div class="header-action-dropdown">
                    <div class="header-dropdown-content">
                      <div style="overflow:hidden; position: relative;">
                        <div id="header-login-toggle" class="site-account-modal translate-left active">
                          <div class="account-header text-center">
                            <div class="account-title heading">
                              <h1>Giỏ hàng</h1>
                            </div>
                          </div>
                          <div class="cart-content">
                            <div class="cart-view">
                              <div class="cart-scroll">
                                <table id="cart-view">
                                  <tbody>
                                  </tbody>
                                </table>
                              </div>
                              <span class="line"></span>
                              <table class="table-total">
                                <tbody>
                                <tr>
                                  <td class="text-left title-total">TỔNG TIỀN:</td>
                                  <td class="text-right" id="total-view-cart"></td>
                                </tr>
                                <tr>
                                  <td>
                                    <a href="/cart" class="btn cart-url">XEM GIỎ HÀNG</a>
                                  </td>
                                  <td>
                                    <a href="/checkout" class="btn checkout-url">THANH TOÁN</a>
                                  </td>
                                </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="header-bottom"></div>
</header>
<script src="../scripts/script.js"></script>
<script>
    $(document).ready(function () {

        let accountDropdownItem = $('#list-item-account');
        let cartDropdownItem = $('#list-item-cart');

        let debounceTimer;

        setNumberCartHeader();

        $('#search').on('input', function () {
            let query = $(this).val().trim();

            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(function () {
                if (query.trim().length === 0) {
                    $('.search-container .search-result').empty();
                    $('#number-search-result').text('');
                    closeAllDropdown();
                    return;
                }

                query = query.replace(/[`\~!@#\$%\^&\*\(\)\-=_\+\[\]\{\}\\|;':",\.\/<>\?]/g, ' ').replace(/\s+/g, ' ').trim();

                $.ajax({
                    url: 'actions/search-product.php',
                    type: 'POST',
                    data: {
                        search: query,
                    }
                }).done(function (response) {
                    let result = JSON.parse(response);
                    let listProduct = JSON.parse(result.product);
                    let searchContent = $('.search-container .search-result');
                    let content = [];

                    openSearchDropdown();

                    if (listProduct.length) {
                        content = listProduct.map((item, index) => `
                      <div class="item-product">
                        <div class="thumb">
                          <a href="/product-detail">
                            <img src="../public/products/${item.img_url}" alt="${item.name}">
                          </a>
                        </div>
                        <div class="title-product">
                          <a href="/products?productId=${item.id}">
                            ${item.name}
                          </a>
                          <p class="initial-price">${item.price}<del class="origin-price">${item.origin_price}</del></p>
                        </div>
                      </div>
                      `);
                        searchContent.empty();
                        searchContent.html(content.join(''));

                        $('#number-search-result').text(`Xem tất cả ${result.count} sản phẩm`).attr('href', `?search=${query}`);
                    } else {
                        searchContent.html(`
                        <p class="text-center no-result">Không tìm thấy kết quả</p>`)
                    }

                });

            }, 300);
        });

        $('#logout-button').click(function (e) {
            e.preventDefault();
            $.ajax({
                url: "actions/accounts/logout.php",
                type: "POST",
            }).done(function (response) {
                let result = JSON.parse(response);
                if (result.code === 200) {
                    closeAllDropdown();
                    location.reload();
                }
            });
        });

        $('#profile-button').click(function (e) {
            e.preventDefault();

            location.href = '/profile';
        })

        $('#login-register-header').click(function (e) {
            e.preventDefault();
            let dropdownAccount = $('#list-item-account');
            if (dropdownAccount.hasClass('show-modal-header')) {
                closeAllDropdown();
            } else {
                if (cartDropdownItem.hasClass('show-modal-header')) {
                    cartDropdownItem.removeClass('show-modal-header');
                }
                dropdownAccount.addClass('show-modal-header');
                $('.modal-backdrop').addClass('in');
            }
        });

        $('#header-cart-products').click(function (e) {
            e.preventDefault();
            let dropdownCart = $('#list-item-cart');
            if (dropdownCart.hasClass('show-modal-header')) {
                closeAllDropdown();
            } else {
                if (accountDropdownItem.hasClass('show-modal-header')) {
                    accountDropdownItem.removeClass('show-modal-header');
                }
                dropdownCart.addClass('show-modal-header');
                loadCartProduct();
                $('.modal-backdrop').addClass('in');
            }
        });

        $('#reset-password').click(function (e) {
            e.preventDefault();
            $('#header-login-toggle').removeClass('active');
            $('#header-recovery-toggle').addClass('active');
        });

        $('#back-to-login').click(function (e) {
            e.preventDefault();
            $('#header-login-toggle').addClass('active');
            $('#header-recovery-toggle').removeClass('active');
        });

        $('#form-submit-login').click(function (e) {
            e.preventDefault();
            let email = $('#email').val();
            let password = $('#password-header').val();

            if (!email || !password) {
                alert("Vui lòng điền đầy đủ thông tin");
            } else {
                $.ajax({
                    url: 'actions/accounts/login.php',
                    type: "POST",
                    dataType: 'html',
                    data: {
                        email: email,
                        password: password
                    }
                }).done(function (response) {
                    let result = JSON.parse(response);
                    if (result.code === 101 || result.code === 102 || result.code === 103) {
                        alert(result.message)
                    } else {
                        let user = JSON.parse(result.user);
                        if(user.role === 'admin'){
                            location.href = '/admin';
                        } else {
                            closeAllDropdown();
                            location.reload();
                        }
                    }
                });
            }
        });


        $('.modal-backdrop').click(function (e) {
            e.preventDefault();
            closeAllDropdown();
        });
    });

    function closeAllDropdown() {
        $('.modal-backdrop').removeClass('in');
        $('#list-item-account').removeClass('show-modal-header');
        $('#list-item-cart').removeClass('show-modal-header');
        $('.site-search .search-result-wrapper').removeClass('show');
        $('body').removeClass('hidden');
    }

    function openSearchDropdown() {
        $('.modal-backdrop').addClass('in');
        $('.site-search .search-result-wrapper').addClass('show');
        $('body').addClass('hidden');
    }

    function redirectHome() {
        window.location.href = '/';
    }
</script>