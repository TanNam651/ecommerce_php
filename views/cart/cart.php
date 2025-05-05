<?php
include "layout/header.php";
?>
<section class="template-list-cart">
  <div class="container">
    <form action="" class="form-order">
      <div class="d-flex list-cart-flex">
        <div class="list-cart">
          <div class="bg-white">
            <div class="list-cart-container">
              <div class="title-cart">
                <h2 class="title">Giỏ hàng:</h2>
                <span class="cart-count">
                  <span class="count"></span>
                  <span id="cart-item-title">Sản phẩm</span>
                </span>
              </div>
              <div id="list-product-cart" class="list-item">
              </div>
            </div>
          </div>
        </div>
        <div class="information-order">
          <div class="bg-white">
            <div class="order-form">
              <div class="order-title">
                <h2>Thông tin đơn hàng</h2>
              </div>
              <div class="order-total">
                <p>Tổng tiền: <span id="total-price">57,184,000đ</span></p>
              </div>
              <div class="checkout-btn">
                <label for="note">Thông tin đơn hàng</label>
                <textarea class="form-control" name="note" id="note" rows="4"></textarea>
                <input type="text" class="form-control" placeholder="Nhập mã khuyến mãi (nếu có)">
              </div>
              <div class="order-action">
                <button id="navigate-checkout" type="button" class="btn-cart-checkout">
                  Thanh toán ngay
                </button>
                <p class="link-continue">
                  <a href="/">
                    <i class="fa fa-reply"></i>
                    Tiếp tục mua hàng
                  </a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</section>
<?php
include "layout/footer.php";
?>
<script src="../../scripts/script.js"></script>

<script>

    loadListProductCartPage();

    function removeItem(id){
        let listCart = localStorage.getItem('store-cart')? JSON.parse(localStorage.getItem('store-cart')):[];

        let updateList = listCart.filter((item)=>item.id !== id);

        localStorage.setItem('store-cart', JSON.stringify(updateList));

        loadListProductCartPage();
        loadCartProduct();
    }

    $(document).ready(function (){
        $('#navigate-checkout').click(function (e){
            e.preventDefault();
            let listCart = JSON.parse(localStorage.getItem('store-cart')) ||[];

            if(listCart.length>0){
              location.href="/checkout";
            }
            else{
              alert("Vui lòng chọn sản phẩm.");
            }
        })
    })

</script>