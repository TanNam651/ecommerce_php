<section class="template-checkout">
  <div class="container">
    <div class="content">
      <div class="wrap">
        <div class="sidebar-checkout">
          <div class="sidebar-content">
            <div class="order-summary">
              <div class="order-summary-sections">
                <div class="order-summary-section order-summary-section-product-list">
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
                    <!-- render-product -->
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="order-summary-section order-summary-total">
                <table class="total-table">
                  <thead>
                  <tr>
                    <th scope="col">
                      <span class="visually-hidden">Mô tả</span>
                    </th>
                    <th scope="col">
                      <span class="visually-hidden">Giá</span>
                    </th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr class="total-line">
                    <td>
                      <span class="payment-dual-label">Tổng cộng</span>
                    </td>
                    <td>
                      <span id="total-price" class="payment-dual-price"></span>
                    </td>
                  </tr>
                  </tbody>
                </table>
              </div>
              <div id="why-us" style="position: relative; padding: 10px 0; color: #666;">
                <div class="wyustit" style=" text-align: center; position: relative; z-index: 1;">
                  <span style="padding: 4px 10px; background: #e6e6e6;">
                    Lý do bạn chon Xgear
                  </span>
                  <span
                      style="position: absolute; width: 100%;  height: 1px; background: #e6e6e6; top: 50%; left: 0; z-index: -1;"></span>
                </div>
                <div class="wyuscs" style="overflow: auto; margin-top: 16px;">
                  <div class="wyuscs1" style="float: left; width: 20%;">
                    <img src="../../public/assets/mail-truck-64e12_05e20103f8814bcfb554c07e67ba839f.webp"
                         style="max-width: 64px; height: auto;" alt="Signature mail">
                  </div>
                  <div class="wyuscs2" style="float: right; width: 80%;">
                    <strong style="font-weight: bolder; color: #000; font-size: 1.1em">
                      Hơn 30.000 đơn hàng được Xgear vận chuyển đến tay khách hàng thành công.
                    </strong>
                    <p>Xgear luôn làm đảm bảo khách hàng hài lòng khi nhận sản phẩm. Tất cả sản phẩm Xgear phân phối
                      100% là hàng chính hãng.</p>
                  </div>
                </div>
                <div class="wyuscs" style="overflow: auto; margin-top: 16px;">
                  <div class="wyuscs1" style="float: left; width: 20%;">
                    <img src="../../public/assets/reload_44f0185e8a834a108fb386db12182dd3.webp"
                         style="max-width: 64px; height: auto;" alt="Signature mail">
                  </div>
                  <div class="wyuscs2" style="float: right; width: 80%;">
                    <strong style="font-weight: bolder; color: #000; font-size: 1.1em">
                      An tâm đặt hàng online với chính sách đổi trả
                    </strong>
                    <p>Xgear bảo hành, chính sách đổi trả theo điều kiện của từng hãng.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="main-checkout">
          <div class="checkout-header">
            <h2 class="checkout-title">Thông tin giao hàng</h2>
          </div>
          <div class="section-content section-information">
            <p class="section-content-text">

            </p>
            <div class="fieldset">
              <div class="field">
                <div class="field-wrap">
                  <label for="full-name-field"></label>
                  <input id="full-name-field" type="text" placeholder="Họ và tên">
                </div>
                <div class="field-wrap">
                  <label for="email-field"></label>
                  <input id="email-field" type="text" placeholder="Email">
                </div>
                <div class="field-wrap">
                  <label for="phone-number-field"></label>
                  <input id="phone-number-field" type="tel" placeholder="Số điện thoại">
                </div>
                <div class="field-wrap">
                  <label for="address-field"></label>
                  <input id="address-field" type="tel" placeholder="Địa chỉ">
                </div>
                <div class="field-wrap">
                  <div class="message">
                    <p id="message-status"></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="section-checkout-method">
            <div class="checkout-header">
              <h2 class="checkout-title">
                Phương thức thanh toán
              </h2>
            </div>
            <div class="checkout-method">
              <div class="content-box">
                <div class="radio-wrapper content-box-row">
                  <label class="radio-label">
                    <input type="radio" name="payment-method" class="input-radio-payment" checked
                           id="payment-method-cod" value="CASH">
                    <div class="radio-content-input">
                      <p>
                        Thanh toán khi nhận hàng (Duới 2 triệu, nhận hàng sau 3-5 ngày)
                      </p>
                    </div>
                  </label>
                </div>
                <div class="radio-wrapper content-box-row">
                  <label class="radio-label">
                    <input type="radio" name="payment-method" class="input-radio-payment" id="payment-method-bank"
                           value="VNPAY">
                    <div class="radio-content-input">
                      <p>Chuyển khoản qua ngân hàng</p>
                    </div>
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="submit-checkout">
            <a href="/cart">Giỏ hàng</a>
            <button id="btn-confirm-order" class="confirm-order btn">
              Hoàn tất đơn hàng
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="../../scripts/script.js"></script>

<script>

    $(document).ready(function () {
        loadListProductCheckout();
        loadUserToForm();

        $('#btn-confirm-order').click(function (e) {
            e.preventDefault();
            order();
        })
    });

    function loadUserToForm() {

        let user = loadUserFromCookie();

        if (user !== null) {
            $('#full-name-field').val(user['name']);
            $('#email-field').val(user['email']);
            $('#phone-number-field').val(user['phone']);
            $('.section-content-text').html();
        } else {
            $('#full-name-field').val('');
            $('#email-field').val('');
            $('#phone-number-field').val('');
            $('.section-content-text').html('Bạn đã có tài khoản? <a href="/login?callback=checkout">Đăng nhập</a>');
        }
    }

    function order() {
        let user = loadUserFromCookie();
        let name = $('#full-name-field').val().trim();
        let email = $('#email-field').val().trim();
        let phone = $('#phone-number-field').val().trim();
        let address = $('#address-field').val().trim();
        let paymentMethod = $('input[name="payment-method"]:checked').val();

        let listProduct = JSON.parse(localStorage.getItem('store-cart')) || [];


        let message = $('.message');

        if (!name || !email || !phone || !address) {
            sendMessage(message, "Vui lòng nhập đầy đủ thông tin", 'error');
        } else {
            message.removeClass('show-error-message');

            $.ajax({
                url:"actions/order-products.php",
                type:"POST",
                dataType:"html",
                data:{
                    fullName:name,
                    email:email,
                    phone:phone,
                    address:address,
                    paymentMethod:paymentMethod,
                    userId:user['id'],
                    products:JSON.stringify(listProduct)
                }
            }).done(function (response){
                let result = JSON.parse(response);
                window.location.href = result['url'];
            }).fail(function (jqXHR, textStatus){

            });
        }
    }

    function loadListProductCheckout() {
        let listProduct = JSON.parse(localStorage.getItem('store-cart')) || [];

        let totalOrderPrice = 0;

        let renderProduct = $('#render-product tbody');

        if (listProduct.length > 0) {
            listProduct.forEach((item, index) => {
                let quantity = parseInt(item.quantity);
                let price = convertPrintToInt(item.price);
                totalOrderPrice += quantity * price;
                let totalProductPrice = formatPrice(quantity * price);
                renderProduct.append(`
                    <tr class="product">
                      <td class="product-img">
                        <div class="img-wrap">
                          <div class="img-product">
                            <img
                                src="../../public/products/${item['img_url']}"
                                alt="product">
                          </div>
                          <span class="product-quantity">${item['quantity']}</span>
                        </div>
                      </td>
                      <td class="product-description">
                        <span class="product-description-name order-summary-emphasis">
                          ${item['name']}
                        </span>
                        <span class="product-description-variant order-summary--small-text">
                          Giá nâng cấp RAM 32GB
                        </span>
                      </td>
                      <td class="product-quantity visually-hidden">${item['quantity']}</td>
                      <td class="product-price">
                        <span class="order-summary-emphasis ">${totalProductPrice}</span>
                      </td>
                    </tr>
            `)
            });
        }

        $('#total-price').text(formatPrice(totalOrderPrice));
    }
</script>