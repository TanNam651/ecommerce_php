<?php
include "layout/header.php";
?>
<section class="profile-template">
  <aside class="sidebar-profile">
    <div class="wrap-profile">
      <div class="bg-white">
        <ul>
          <li class="title-sidebar">
            <span class="logo">Profiles</span>
            <button id="toggle-btn">
              <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                   fill="#e8eaed">
                <path
                    d="m313-480 155 156q11 11 11.5 27.5T468-268q-11 11-28 11t-28-11L228-452q-6-6-8.5-13t-2.5-15q0-8 2.5-15t8.5-13l184-184q11-11 27.5-11.5T468-692q11 11 11 28t-11 28L313-480Zm264 0 155 156q11 11 11.5 27.5T732-268q-11 11-28 11t-28-11L492-452q-6-6-8.5-13t-2.5-15q0-8 2.5-15t8.5-13l184-184q11-11 27.5-11.5T732-692q11 11 11 28t-11 28L577-480Z"/>
              </svg>
            </button>
            <button id="hide-btn" class="">
              <svg height="24px" width="24px" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                   stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="m17.495 11c2.484 0 4.5 2.016 4.5 4.5s-2.016 4.5-4.5 4.5c-2.483 0-4.5-2.016-4.5-4.5s2.017-4.5 4.5-4.5zm-5.979 5c.043.522.153 1.025.321 1.5h-9.092c-.414 0-.75-.336-.75-.75s.336-.75.75-.75zm6.686-.5s.642-.642 1.061-1.061c.188-.187.188-.519 0-.707-.188-.187-.52-.187-.707 0-.419.419-1.061 1.061-1.061 1.061s-.641-.642-1.06-1.061c-.188-.187-.52-.187-.707 0-.188.188-.188.52 0 .707.418.419 1.06 1.061 1.06 1.061s-.642.642-1.06 1.061c-.188.187-.188.519 0 .707.187.187.519.187.707 0 .419-.419 1.06-1.061 1.06-1.061s.642.642 1.061 1.061c.187.187.519.187.707 0 .188-.188.188-.52 0-.707-.419-.419-1.061-1.061-1.061-1.061zm-5.579-3.5c-.329.456-.595.96-.786 1.5h-9.092c-.414 0-.75-.336-.75-.75s.336-.75.75-.75zm7.372-3.25c0-.414-.336-.75-.75-.75h-16.5c-.414 0-.75.336-.75.75s.336.75.75.75h16.5c.414 0 .75-.336.75-.75zm0-4c0-.414-.336-.75-.75-.75h-16.5c-.414 0-.75.336-.75.75s.336.75.75.75h16.5c.414 0 .75-.336.75-.75z"
                    fill-rule="nonzero"/>
              </svg>
            </button>
          </li>
          <li class="info-user-sidebar">
            <a data-nav="user-info">
              <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                   fill="#e8eaed">
                <path
                    d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-240v-32q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v32q0 33-23.5 56.5T720-160H240q-33 0-56.5-23.5T160-240Zm80 0h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z"/>
              </svg>
              <span>
                        Thông tin chung
                    </span>
            </a>
          </li>
          <li class="list-order-sidebar">
            <a data-nav="list-order">
              <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                   fill="#e8eaed">
                <path
                    d="m221-313 142-142q12-12 28-11.5t28 12.5q11 12 11 28t-11 28L250-228q-12 12-28 12t-28-12l-86-86q-11-11-11-28t11-28q11-11 28-11t28 11l57 57Zm0-320 142-142q12-12 28-11.5t28 12.5q11 12 11 28t-11 28L250-548q-12 12-28 12t-28-12l-86-86q-11-11-11-28t11-28q11-11 28-11t28 11l57 57Zm339 353q-17 0-28.5-11.5T520-320q0-17 11.5-28.5T560-360h280q17 0 28.5 11.5T880-320q0 17-11.5 28.5T840-280H560Zm0-320q-17 0-28.5-11.5T520-640q0-17 11.5-28.5T560-680h280q17 0 28.5 11.5T880-640q0 17-11.5 28.5T840-600H560Z"/>
              </svg>
              <span>
                        Đơn hàng
                    </span>
            </a>
          </li>
        </ul>
        <button id="btn-logout" class="btn">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
               stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
               class="icon icon-tabler icons-tabler-outline icon-tabler-logout">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"/>
            <path d="M9 12h12l-3 -3"/>
            <path d="M18 15l3 -3"/>
          </svg>
          <span>
          Logout
        </span>
        </button>
      </div>
    </div>
  </aside>
  <div class="profile">
    <div class="container">
      <div class="wrap-profile">
        <div class="bg-color-white">
          <div class="header-profile">
            <button id="show-btn">
              <svg width="24px" height="24px" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                   stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="m21 17.75c0-.414-.336-.75-.75-.75h-16.5c-.414 0-.75.336-.75.75s.336.75.75.75h16.5c.414 0 .75-.336.75-.75zm0-4c0-.414-.336-.75-.75-.75h-16.5c-.414 0-.75.336-.75.75s.336.75.75.75h16.5c.414 0 .75-.336.75-.75zm0-4c0-.414-.336-.75-.75-.75h-16.5c-.414 0-.75.336-.75.75s.336.75.75.75h16.5c.414 0 .75-.336.75-.75zm0-4c0-.414-.336-.75-.75-.75h-16.5c-.414 0-.75.336-.75.75s.336.75.75.75h16.5c.414 0 .75-.336.75-.75z"
                    fill-rule="nonzero"/>
              </svg>
            </button>
            <div class="title-profile">
              <h2></h2>
            </div>
          </div>
          <div class="content-profile">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="modal-detail">
  <div class="modal-content">
    <div class="modal-header">
      <h2>Chi tiết đơn hàng</h2>
    </div>
    <div class="modal-body">
      <div class="product-order">
        <div class="product-title">
          <h2>Danh sách sản phẩm</h2>
        </div>
        <div class="list-product-order">
          <table id="render-product" class="product-table">
            <thead>
            <tr>
              <th scope="col">
                <span class="visually-hidden">Hình ảnh</span>
              </th>
              <th scope="col">
                <span class="visually-hidden">Mô tả</span>
              </th>
              <th scope="col">
                <span class="visually-hidden">Số lượng</span>
              </th>
              <th scope="col">
                <span class="visually-hidden">Giá</span>
              </th>
            </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <div class="product-title">
        <h2>Chi tiết Hóa đơn</h2>
      </div>
      <div class="summary-total">
        <div class="d-flex flex-space">
          <span>Ngày đặt hàng</span>
          <span id="date"></span>
        </div>
        <div class="d-flex flex-space">
          <span>Trạng thái đơn hàng</span>
          <span id="status-order"></span>
        </div>
        <div class="d-flex flex-space">
          <span>Trạng thái thanh toán</span>
          <span id="status-payment"></span>
        </div>
        <div class="d-flex flex-space">
          <span class="price">Tổng tiền</span>
          <span id="price" class="price"></span>
        </div>
      </div>
    </div>
    <button id="close-btn">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
           stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
           class="lucide lucide-x h-4 w-4">
        <path d="M18 6 6 18"></path>
        <path d="m6 6 12 12"></path>
      </svg>
      <span class="sr-close">Close</span>
    </button>
  </div>
</div>
<?php
include "layout/footer.php";
?>
<script src="../../scripts/script.js"></script>
<script>
    $(document).ready(function () {

        let user = loadUserFromCookie();
        let idUser = user.id;
        let partName = user.name.split(' ', 2);
        let firstname = partName[0];
        let lastname = user.name.substring(firstname.length + 1);
        let phone = user.phone;

        loadProfile();

        $('#toggle-btn').click(function (e) {
            e.preventDefault();
            $('.sidebar-profile').toggleClass('close');
            $('#toggle-btn').toggleClass('rotate');
        });

        $('#show-btn').click(function (e) {
            e.preventDefault();
            $('.sidebar-profile').removeClass('close').addClass('show');
            $('.modal-backdrop').addClass('in');
            $('body').addClass('hidden');
        });

        $('#hide-btn').click(function (e) {
            e.preventDefault();
            $('.sidebar-profile').removeClass('show');
            $('.modal-backdrop').removeClass('in');
        })

        $('.sidebar-profile ul li a').click(function (e) {
            e.preventDefault();
            $('.sidebar-profile ul li').removeClass('active');
            $(this).parent().addClass('active');
            renderContent($(this).attr('data-nav'));
        });

        $('#btn-logout').click(function (e) {
            e.preventDefault();
            $.ajax({
                url: 'actions/accounts/logout.php',
                type: 'POST',
            }).done(function (response) {
                let result = JSON.parse(response);
                if (result.code === 200) {
                    location.href = '/'
                }
            });
        });

        $('#btn-change').click(function (e) {
            e.preventDefault();

            firstname = $('#first-name').val();
            lastname = $('#last-name').val();
            let password = $('#password').val();

            if (!regexPhoneNumber(phone)) {
                alert("Vui lòng nhập đúng số điện thoại");
            } else if (!checkValidPassword(password)) {
                alert("Mật khẩu phải trên 6 ký tự");
            } else {
                $.ajax({
                    url: 'actions/accounts/update-user.php',
                    type: 'POST',
                    data: {
                        'id': idUser,
                        'firstname': firstname,
                        'lastname': lastname,
                        'password': password,
                        'phone': phone
                    }
                }).done(function (response) {
                    let result = JSON.parse(response);
                    alert(result.message);
                }).fail(function (jqXHR, textStatus) {

                });
            }
        });

        $('#close-btn').click(function (e) {
            e.preventDefault();
            closeModal();
        });

        $('.modal-backdrop').click(function (e) {
            e.preventDefault();
            closeModal();
        })

        function loadProfile() {
            $('.info-user-sidebar').addClass('active');
            renderContent($('.info-user-sidebar a').attr('data-nav'));
        }

        function renderContent(dataAttr) {
            if (dataAttr === 'user-info') {
                $('.title-profile h2').text("Thông tin người dùng");
                let userInfor = $('.profile .content-profile');
                console.log(dataAttr);
                userInfor.html(`
            <div class="form-profile">
              <div class="fieldset">
                <div class="field-wrap">
                  <label for="first-name">Họ</label>
                  <input id="first-name" type="text" placeholder="Họ" value="${firstname}">
                </div>
                <div class="field-wrap">
                  <label for="last-name">Tên</label>
                  <input id="last-name" type="text" placeholder="Tên" value="${lastname}">
                </div>
                  <div class="field-wrap">
                  <label for="phone">Số điện thoại</label>
                  <input id="phone" type="text" placeholder="Số điện thoại" value="${phone}">
                </div>
                <div class="field-wrap">
                  <label for="email">Email</label>
                  <input id="email" type="text" placeholder="Email" value="${user.email}" disabled>
                </div>
                <div class="field-wrap">
                  <label for="password">Mật khẩu</label>
                  <input id="password" type="text" placeholder="Mật khẩu">
                </div>
              </div>
              <div class="change-info">
                <button id="btn-change" class="btn btn-change">Cập nhật</button>
              </div>
            </div>
            `)
            } else {
                let listOrder = $('.profile .content-profile');
                let orderData = [];
                $('.title-profile h2').text("Lịch sử đơn hàng");
                $.ajax({
                    url: 'actions/get-orders.php',
                    type: 'POST',
                    data: {
                        userId: user.id,
                    }

                }).done(function (response) {
                    let result = JSON.parse(response);
                    if (result.length > 0) {
                        orderData = result.map((item) => `
                          <tr>
                            <td>${item.created_at}</td>
                            <td>
                              ${item.order_status === "PENDING"|| "PROCESSING" ? "<span class='status-danger'>Đang xử lý</span>" : "<span class='status-success'>Hoàn thành</span>"}
                            </td>
                            <td>${item.total_amount}</td>
                            <td>
                              <a onclick="showModalDetail('${item.id}')">Xem chi tiết</a>
                            </td>
                          </tr>
                          `);

                        listOrder.html(`
                          <div class="table-order">
                            <table>
                              <thead>
                              <tr>
                                <th>
                                  Ngày đặt hàng
                                </th>
                                <th>
                                  Trạng thái
                                </th>
                                <th>
                                  Tổng tiền
                                </th>
                                <th>Chi tiết</th>
                              </tr>
                              </thead>
                              <tbody>
                                ${orderData.join("")}
                              </tbody>
                            </table>
                          </div>
                        `);
                    } else {
                        listOrder.html(`
                          <h2 class="no-order">Bạn chưa có đơn hàng nào</h2>
                        `)
                    }
                });

            }
        }


    });

    function showModalDetail(orderId) {
        let listProduct = $('#render-product tbody');
        listProduct.empty();

        $.ajax({
            url: 'actions/get-list-products.php',
            type: 'POST',
            data: {
                orderId: orderId,
            }
        }).done(function (response) {
            console.log(response);
            let result = JSON.parse(response);
            let products = JSON.parse(result.list_product);
            let payment = JSON.parse(result.payment);

            console.log(payment);

            showModal();

            products.forEach((item, index) => {
                listProduct.append(`
                <tr class="product">
                <td class="product-img">
                  <div class="img-wrap">
                    <div class="img-product">
                      <img
                          src="../../public/products/${item.img_url}"
                          alt="product">
                    </div>
                    <span class="product-quantity">${item.quantity}</span>
                  </div>
                </td>
                <td class="product-description">
                <span class="product-description-name order-summary-emphasis">
                  ${item.name}
                </span>
                  <span class="product-description-variant order-summary-small-text">
                  ${item.category}
                </span>
                </td>
                <td class="product-quantity visually-hidden">${item.quantity}</td>
                <td class="product-price">
                  <span class="order-summary-emphasis ">${item.total}</span>
                </td>
              </tr>
              `);
            });

            $('#date').text(payment.created_at);

            if (payment.order_status === 'COMPLETE') {
                $('#status-order').text('Hoàn thành').addClass('status-success').removeClass('status-danger');
            } else if (payment.order_status === 'PROCESSING') {
                $('#status-order').text('Đang xử lý').addClass('status-danger').removeClass('status-success');
            } else if (payment.order_status === 'PENDING') {
                $('#status-order').text('Chờ kiểm duyệt').addClass('status-danger').removeClass('status-success');
            } else if (payment.order_status === 'CANCELLED') {
                $('#status-order').text('Đã hủy').addClass('status-danger').removeClass('status-success');
            }

            if (payment.payment_status === 'PENDING') {
                $('#status-payment').text('Chưa thanh toán').addClass('status-danger').removeClass('status-success');
            } else if (payment.payment_status === 'COMPLETED') {
                $('#status-payment').text('Đã thanh toán').addClass('status-success').removeClass('status-danger');
            }

            $('#price').text(payment.total_amount);
        });


    }

    function showModal() {
        $('.modal-backdrop').addClass('in');
        $('.modal-detail').addClass('show');
    }

    function closeModal() {
        $('.modal-backdrop').removeClass('in');
        $('.modal-detail').removeClass('show');
        $('.sidebar-profile').removeClass('show')
        $('body').removeClass('hidden');
    }
</script>
