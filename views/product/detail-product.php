<?php
require_once "Core/Database.php";
require_once "Core/function.php";

use Core\Database;

$config = require "config/config.php";

$db = new Database($config);

$idProduct = $_GET['productId'];
$product = [];

if (isset($idProduct)) {
    $sql_get_product = "SELECT * FROM ecommerce.products WHERE id=:id";
    $db->query($sql_get_product, ["id" => $idProduct]);
    $product = $db->statement->fetch(PDO::FETCH_ASSOC);
}

include("layout/header.php");
?>

<section class="template-product">
  <div class="container">
    <div class="d-flex detail-product-form">
      <div class="bg-white">
        <div class="d-flex">
          <div class="gallery-product-template">
            <div class="gallery">
              <img src="../../public/products/<?= $product['img_url'] ?>" alt="<?= $product['name'] ?>">
            </div>
            <div class="specifications">
              <ul class="configs-detail-products">
                  <?php
                  if (!empty($product['configuration']))
                      $configurations = explode(',', $product['configuration']);
                  foreach ($configurations as $config) {
                      echo $config;
                  }
                  ?>
              </ul>
            </div>
          </div>
          <div class="product-detail-content">
            <div class="product-content">
              <div class="product-detail-title">
                <h1>
                    <?= $product['name'] ?>
                </h1>
              </div>
              <div class="product-views">
                <span>
                  <span class="view-number">
                  <?= $product['views'] ?>
                </span>
                lượt xem
                </span>
                <span class="product-stored">
                  <?php
                  if((int)$product['quantity'] == 0) {
                      echo "Đã hết hàng";
                  } else{
                    echo "Còn ". $product['quantity']. " sản phẩm trong kho";
                  }
                  ?>
                </span>
              </div>
              <div class="product-info">
                <div class="product-band">
                  <span>Thương hiệu:
                    <a href="#">
                      <?= $product['brand'] ?>
                    </a>
                  </span>
                </div>
                <span class="line-info">|</span>
                <div class="product-type">
                  <span>Loại:
                    <a href="#">
                      <?= $product['category'] ?>
                    </a>
                  </span>
                </div>
              </div>
              <div class="tags-insulation">
                  <?= str_replace(",", "", $product['warranty']) ?>
              </div>
              <div class="price-container">
                <div class="price-purchase">
                  <p>Mua ngay với giá</p>
                  <div class="product-price">
                    <span class="price-now">
                      <?= $product['price'] ?>
                    </span>
                    <span class="special-price">
                      <del>
                        <?= $product['origin_price'] ?>
                      </del>
                    </span>
                  </div>
                </div>
                <div class="price-or">
                  <p>Hoặc</p>
                </div>
                <div class="price-installment">
                  <p>Trả góp</p>
                  <span class="installment-value"><strong>2,176,292đ</strong>/tháng</span>
                </div>
              </div>

                <?php
                if ($product['sale_for_student'] !== '0') {
                    ?>
                  <div class="special-deal">
                    <span class="special-price">Giá HSSV: </span>
                    <span class="special-price-now"><?= $product['sale_for_student'] ?></span>
                  </div>
                <?php } ?>

            </div>
            <form action="" class="add-card-product-form">
              <div class="">
                <div class="quantity-area">
                  <input id="btn-decrease" type="button" value="-">
                  <label for="quantity" hidden=""></label>
                  <input id="quantity" type="number" value="1">
                  <input id="btn-increase" type="button" value="+">
                </div>
              </div>
            </form>
            <div class="product-promotion">
              <!--              <div class="product-promotion-container">-->
              <!--                <div class="product-head-title">-->
              <!--                  <p>Chọn gói khuyến mãi</p>-->
              <!--                </div>-->
              <!--                <ul>-->
              <!--                  <li>-->
              <!--                    <div class="select-option">-->
              <!--                      <input id="swap-select-option1" type="radio" name="option-selected" checked class="variant-radio">-->
              <!--                      <label for="swap-select-option1">-->
              <!--                        <span>Giá sốc (không bao gồm ưu đãi thêm)</span>-->
              <!--                      </label>-->
              <!--                    </div>-->
              <!--                    <div class="select-option">-->
              <!--                      <input id="swap-select-option2" type="radio" name="option-selected" class="varian-radio">-->
              <!--                      <label for="swap-select-option2">-->
              <!--                        <span>Ưu đãi nâng cấp 32GB RAM</span>-->
              <!--                      </label>-->
              <!--                    </div>-->
              <!--                  </li>-->
              <!--                </ul>-->
              <!--              </div>-->
              <div class="promotion-tab">
                <div class="title-head">
                  <svg height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path
                        d="M152 0H154.2C186.1 0 215.7 16.91 231.9 44.45L256 85.46L280.1 44.45C296.3 16.91 325.9 0 357.8 0H360C408.6 0 448 39.4 448 88C448 102.4 444.5 115.1 438.4 128H480C497.7 128 512 142.3 512 160V224C512 241.7 497.7 256 480 256H32C14.33 256 0 241.7 0 224V160C0 142.3 14.33 128 32 128H73.6C67.46 115.1 64 102.4 64 88C64 39.4 103.4 0 152 0zM190.5 68.78C182.9 55.91 169.1 48 154.2 48H152C129.9 48 112 65.91 112 88C112 110.1 129.9 128 152 128H225.3L190.5 68.78zM360 48H357.8C342.9 48 329.1 55.91 321.5 68.78L286.7 128H360C382.1 128 400 110.1 400 88C400 65.91 382.1 48 360 48V48zM32 288H224V512H80C53.49 512 32 490.5 32 464V288zM288 512V288H480V464C480 490.5 458.5 512 432 512H288z"></path>
                  </svg>
                  Ưu đãi thêm
                </div>
                <div class="tabs-content">
                  <ul>
                      <?php
                      if (!empty($product['offer'])) {
                          $offers = explode(',', $product['offer']);
                          foreach ($offers as $offer) {
                              echo $offer;
                          }
                      }
                      ?>
                  </ul>
                  <p>
                    <b>Xin lưu ý:</b>
                    Tình trạng tồn kho của sản phẩm có thể thay đổi. Quý khách vui lòng liên hệ với nhân viên để được hỗ
                    trợ và cập nhật thông tin chi tiết một cách nhanh chóng
                  </p>
                </div>
              </div>
            </div>
            <div class="selector-action">
              <div class="wrap-cart">
                <button id="add-to-cart" class="btn-add-cart">
                  <strong>Thêm vào giỏ</strong>
                  Giao tận nơi hoặc nhận tại cửa hàng
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="detail-information-product">
      <div class="bg-white">
        <div class="title-information">
          <h1>Mô tả sản phẩm</h1>
        </div>
        <div class="description-product">
          <div class="content-entry-product">
            <div class="editable-content">
              <ul>
                <li>
                  <strong>
                    Hiệu năng:
                  </strong>
                  Bộ vi xử lý Intel Core i5 12450H mạnh mẽ.
                </li>
                <li>
                  <strong>Thiết kế:</strong>
                  Cá tính, sang trọng.
                </li>
                <li>
                  <strong>Thời lượng pin</strong>
                  Thời lượng pin trung bình 3 cell, 52.4Whrs.
                </li>
                <li>
                  <strong>Bàn phím</strong>
                  Bàn phím Blue Backlit Gaming Keyboard dễ dàng chơi game và làm việc.
                </li>
                <li>
                  <strong>Bảo mật</strong>
                  Có tính năng khóa màn hình tự động, khóa ứng dụng theo mong muốn.
                </li>
                <li>
                  <strong>Giá cả</strong>
                  16,490,000đ
                </li>
              </ul>
              <p class="">
                <strong>Laptop Gaming MSI Thin 15 B12UCX 1419VN I5 12450H</strong> là lựa chọn hàng đầu với những ai yêu
                thích sở hữu một chiếc laptop nhẹ gọn, vừa chơi game tốt, vừa xử lý tác vụ cần thiết nhẹ nhàng. Vậy sản
                phẩm có gì đặc biệt? Cùng XGear tìm hiểu “tất tần tật” thông tin hữu ích bên dưới.
              </p>
              <h2>
                Màn hình có tần số quét đỉnh cao
              </h2>
              <ul>
                <li>
                  MSI Thin A15 lấy cảm hứng từ hai tác phẩm nổi tiếng là "Blade Runner" và "Dune". Trong đó, nhân vật
                  biểu trưng cho tinh thần của Thin A15 là "C15" - hình mẫu của sự thon gọn, sức mạnh đáng nể và đậm
                  chất Gaming.&nbsp;
                </li>
                <li>
                  Nhà sản xuất bố trí thêm phần trong suốt trên bàn phím cho phép người dùng nhìn thấy các linh kiện bên
                  trong, tạo cảm giác chân thực hơn bao giờ hết.
                </li>
                <li>
                  Cùng những đường viền thanh mảnh, tạo nét đặc trưng, qua đó thể hiện phong cách cực kỳ đầy đặc sắc.
                </li>
                <li>
                  Về kích thước, máy có 359 x 254 x 21.5 mm và nặng 1.85 kg giúp người dùng có thể mang theo máy đi khắp
                  mọi nơi
                </li>
              </ul>
              <div>
                <img src="../../public/products/laptop_gaming_msi_thin__84c8ddcb8885495cabcc869e7a666ed4_master.webp"
                     alt="">
              </div>
              <h2>
                Hiệu suất vận hành mạnh mẽ
              </h2>
            </div>
          </div>
          <div class="view-all-btn">
            <button id="view-all">
              <i class="fa fa-plus-circle"></i>
              Xem thêm
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="review-product">
      <div class="bg-white">
        <div class="product-rv-head">

        </div>
        <div class="product-rv-list">
        </div>
        <div class="write-review-form">
          <h3>Viết đánh giá</h3>
          <form>
            <div class="flex">
              <fieldset>
                <div>
                  <input id="name-rv" name="your-name" type="text" placeholder="Tên của bạn">
                  <label hidden="hidden" for="name-rv">Tên của bạn</label>
                </div>
              </fieldset>
              <fieldset>
                <div>
                  <input id="email-rv" name="your-name" type="text" placeholder="example@gmail.com">
                  <label hidden="hidden" for="email-rv">Tên của bạn</label>
                </div>
              </fieldset>
            </div>
            <div class="flex">
              <fieldset>
                <div>
                  <select id="comment-status" name="status" class="">
                    <option value="Đã mua tại Xgear">Đã mua tại Xgear</option>
                    <option value="Đang sử dụng">Đang sử dụng</option>
                    <option value="Đang quan tâm">Đang quan tâm</option>
                  </select>
                  <label hidden="hidden" for="comment-status">Trạng thái</label>
                </div>
              </fieldset>
              <fieldset>
                <div>
                  <input id="phone-rv" name="your-name" type="text" placeholder="Số điện thoại">
                  <label hidden="hidden" for="phone-rv">Số điện thoại</label>
                </div>
              </fieldset>
            </div>
            <fieldset style="padding-top: 13px;">
              <div style="display: flex;">
                <label style="padding-right: 5px; font-size: 15px;">Đánh giá</label>
                <div class="star-widget">
                  <input type="radio" name="rate" id="rate-5" value="5">
                  <label for="rate-5" class="fa fa-star"></label>
                  <input type="radio" name="rate" id="rate-4" value="4">
                  <label for="rate-4" class="fa fa-star"></label>
                  <input type="radio" name="rate" id="rate-3" value="3">
                  <label for="rate-3" class="fa fa-star"></label>
                  <input type="radio" name="rate" id="rate-2" value="2">
                  <label for="rate-2" class="fa fa-star"></label>
                  <input type="radio" name="rate" id="rate-1" value="1">
                  <label for="rate-1" class="fa fa-star"></label>
                </div>
              </div>
            </fieldset>
            <fieldset>
              <div>
                <label for="description-rv" hidden="hidden">Mô tả</label>
                <textarea name="description" id="description-rv" rows="5" minlength="30" maxlength="100"
                          placeholder="Viết nội dung đánh giá ở đây"></textarea>
              </div>
            </fieldset>
          </form>
          <fieldset>
            <div style="padding-top: 13px;">
              <button id="btn-rv-product" class="btn btn-submit">Gửi đánh giá</button>
            </div>
          </fieldset>
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
    $(document).ready(function () {

        let addToCartBtn = $('#add-to-cart');
        let increaseBtn = $('#btn-increase');
        let decreaseBtn = $('#btn-decrease');

        let user = loadUserFromCookie();
        let resultReview = [];
        let reviews = [];

        if (user) {
            $('#name-rv').val(user.name);
            $('#email-rv').val(user.email);
            $('#phone-rv').val(user.phone);
        } else {
            console.log('user not found')
        }

        $('#view-all').click(function (e) {
            e.preventDefault();
            if ($('.view-all-btn').hasClass('active')) {
                $('.view-all-btn').removeClass('active');
                $('#view-all').html('<i class="fa fa-plus-circle"></i> Xem thêm');


                $('.content-entry-product').removeClass('active');
            } else {
                $('.view-all-btn').addClass('active');
                $('#view-all').html('<i class="fa fa-minus-circle"></i> Rút gọn');

                $('.content-entry-product').addClass('active');
            }
        });

        $('#btn-rv-product').click(function (e) {
            e.preventDefault();
            if (!user) {
                alert('Vui lòng đăng nhập để thực hiện đánh giá');
                return 0;
            }

            for (let i = 0; i < reviews.length; i++) {
                if (user.id === reviews[i].user_id) {
                    alert('Bạn đã đánh giá sản phẩm này rồi.');
                    return 0;
                }
            }

            let status = $('#comment-status').val();
            let rate = $('input[name="rate"]:checked').val();
            let description = $('#description-rv').val();
            let productId = getParamsURL('productId');

            if (!rate) {
                alert('Vui lòng đánh giá mức độ hài lòng của bạn.');
                return 0;
            }

            if (!description.trim()) {
                alert('Vui lòng nhập nội dung đánh giá.');
                return 0;
            }

            $.ajax({
                url: 'actions/add-review.php',
                type: 'POST',
                data: {
                    userId: user.id,
                    productId: productId,
                    status: status,
                    rate: rate,
                    description: description
                }
            }).done(function (response) {
                let result = JSON.parse(response);
                if (result.code === 200) {

                    $('#name-rv').val('');
                    $('#email-rv').val('');
                    $('#phone-rv').val('');
                    $('#description-rv').val('');
                    $('input[name="rate"]:checked').prop('checked', false);

                    let review = JSON.parse(result.review);
                    let rating = generateRatingStart(parseInt(review.rating))

                    $('.product-rv-list').prepend(generateReviewBox(review, rating));
                    alert(result.message);
                } else {
                    alert(result.message);
                }

            }).fail(function (error) {
                alert("Có lỗi xảy ra trong quá trình gửi đánh giá, vui lòng thử lại sau.");
            });
        })

        decreaseBtn.click(function (e) {
            let quantity = $('#quantity');
            e.preventDefault();
            let updateQuantity = decreaseQuantity(quantity.val());
            quantity.val(updateQuantity);
        });

        increaseBtn.click(function (e) {
            e.preventDefault();
            let quantity = $('#quantity');
            let updateQuantity = increaseQuantity(quantity.val());

            quantity.val(updateQuantity);
        });

        loadReview();

        addToCartBtn.click(function (e) {
            e.preventDefault();

            let storeProductCart = localStorage.getItem('store-cart');

            let product = <?= json_encode($product, JSON_UNESCAPED_UNICODE)?>;
            let quantity = $('#quantity');
            let quantityProductStore = quantity.val();
            let listProductFromStore = storeProductCart ? JSON.parse(storeProductCart) : [];
            if (listProductFromStore.find(item => item.id === product.id)) {
               listProductFromStore = listProductFromStore.map((item) =>
                    item.id === product.id ? {...item, quantity:String(parseInt(item.quantity) + parseInt(quantityProductStore))} : item
                );
            } else {
                let productData = {
                    id: product.id,
                    name: product.name,
                    price: product.price,
                    quantity: quantityProductStore,
                    origin_price: product.origin_price,
                    img_url: product.img_url
                }
                listProductFromStore = [...listProductFromStore, productData];
            }

            localStorage.setItem('store-cart', JSON.stringify(listProductFromStore));
            loadCartProduct();
            $('#list-item-cart').addClass('show-modal-header');
            $('.modal-backdrop').addClass('in');

        });

        function decreaseQuantity(quantity) {
            let currentQuantity = parseInt(quantity);
            return currentQuantity === 1 ? 1 : currentQuantity - 1;
        }

        function increaseQuantity(quantity) {
            let currentQuantity = parseInt(quantity);
            return currentQuantity + 1;
        }

        function loadReview() {
            let productId = getParamsURL('productId');
            $.ajax({
                url: 'actions/get-review-product.php',
                type: 'POST',
                data: {
                    productId: productId
                }
            }).done(function (response) {
                let result = JSON.parse(response);
                console.table(JSON.parse(result.review))
                if (JSON.parse(result.review).length > 0) {
                    resultReview = JSON.parse(result.review);
                    reviews = resultReview.map((item, index) => {
                        let rating = [];
                        let realRating = parseInt(item.rating);
                        rating = generateRatingStart(realRating);
                        return generateReviewBox(item, rating);
                    });

                    $('.product-rv-list').html(reviews.join(''));
                    reviews = JSON.parse(result.review);


                    $('.product-rv-head').html(`<p>
                        Có <span>${resultReview.length}</span> đánh giá trên sản phẩm "<strong>${result.product_name}</strong>"
                      </p>`);
                } else {
                    $('.product-rv-head').html(`<p>Chưa có đánh giá cho sản phẩm này</p>`);
                }
            })
        }

        function generateReviewBox(item, rating) {
            return `
                       <div class="user-review-box">
                          <div class="review-head">
                            <p class="review-product-user">
                            <span itemprop="user" class="user" style="margin: 0; vertical-align: middle;">
                              <img src="../../public/assets/no_avatar.webp" alt="User">
                              <meta itemprop="name" content="No Avatar">
                              <cite>${item.name}</cite>
                            </span>
                            </p>
                            <div class="product-review-star">
                             ${rating.join('')}
                            </div>
                            <span class="status" data-content="${item.status}">
                            ${item.status}
                          </span>
                          </div>
                          <div class="user-comment">
                            <div>
                              <p>
                                ${item.review_text}
                              </p>
                              <time>${item.created_at}</time>
                            </div>
                          </div>
                          ${item.reply &&
            `<div class="reply-comment">
                            <div class="brand">Xgear</div>
                            <p>${item.reply}</p>
                          </div>` || ``
            }
                        </div>
                      `
        }

        function generateRatingStart(rating) {
            let ratingStar = [];
            for (let i = 0; i < 5; i++) {
                if (i < rating) {
                    ratingStar.push('<i class="fa fa-star"></i>');
                } else {
                    ratingStar.push('<i class="fa fa-star-o"></i>');
                }
            }
            return ratingStar;
        }
    });
</script>