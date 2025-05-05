<?php
require_once "Core/Database.php";
require_once "Core/function.php";

use Core\Database;

$config = require "config/config.php";
$db = new Database($config);

$query_category = "SELECT * FROM ecommerce.category";


?>
<section class="add-product-container">
  <div class="wrapper">
    <div class="bg-color-white">
      <div class="head-table-title">
        <h2>Thêm sản phẩm</h2>
      </div>
      <div class="content-add-product">
        <form>
          <div class="form-group">
            <div class="img-product">
              <label for="product-img" class="img-wrap" id="drop-area">
                <input type="file" id="product-img" accept="image/*" hidden="hidden">
                <img id="preview" src="/public/assets/white-image.png" alt="Preview Image">
              </label>
            </div>
          </div>
          <div class="form-group">
            <label for="name">Tên sản phẩm</label>
            <input type="text" class="form-control" id="name" placeholder="Tên sản phẩm">
          </div>
          <div class="flex">
            <div class="form-group">
              <label for="category">Danh mục</label>
              <select id="category" class="form-control">
                  <?php
                  $db->query($query_category);
                  $categories = $db->statement->fetchAll(PDO::FETCH_ASSOC);
                  foreach ($categories as $category) {
                      echo "<option value='{$category['id']}'>{$category['name']}</option>";
                  }
                  ?>
              </select>
            </div>
            <div class="form-group">
              <label for="brand">Thương hiệu</label>
              <input id="brand" type="text" class="form-control" placeholder="Thương hiệu">
            </div>
            <div class="form-group">
              <label for="status">Trạng thái sản phẩm</label>
              <input id="status" type="text" class="form-control" placeholder="Trạng thái">
            </div>
          </div>
          <div class="flex">
            <div class="form-group">
              <label for="price">Giá sản phẩm</label>
              <input type="text" class="form-control" id="price" placeholder="Giá sản phẩm">
            </div>
            <div class="form-group">
              <label for="origin-price">Giá gốc</label>
              <input type="text" class="form-control" id="origin-price" placeholder="Giá gốc">
            </div>
            <div class="form-group">
              <label for="student-price">Giá ưu đãi cho sinh viên</label>
              <input type="text" class="form-control" id="student-price" placeholder="Giá ưu đãi">
            </div>
          </div>
          <div class="form-group">
            <label for="configuration">Cấu hình sản phẩm</label>
            <textarea class="form-control" id="configuration" rows="10" placeholder="Cấu hình"></textarea>
          </div>
          <div class="form-group">
            <label for="offer">Ưu đãi sản phẩm</label>
            <textarea class="form-control" id="offer" rows="10" placeholder="Ưu đãi sản phẩm"></textarea>
          </div>
          <div class="form-group">
            <label for="warranty">Chính sách bảo hành</label>
            <textarea id="warranty" class="form-group" rows="10" placeholder="Chính sách bảo hành"></textarea>
          </div>
          <div class="form-group">
            <label for="description">Chi tiết sản phẩm</label>
            <textarea id="description" class="form-group" rows="10" placeholder="Chi tiết sản phẩm"></textarea>
          </div>
          <div class="form-message">
            <p id="message"></p>
          </div>

          <button id="btn-add" type="button" class="btn btn-primary">Thêm sản phẩm</button>
          <button id="back-btn" type="button" class="btn btn-secondary">Quay lại</button>
        </form>
      </div>
    </div>
  </div>
</section>

<script src="/scripts/script.js"></script>

<script>
    $(document).ready(function () {
        let img_url_product = "";

        $('#configuration').on('keydown', function (e) {
            if (e.key === 'Tab') {
                e.preventDefault();
                let textarea = this
                addTab(textarea);
            }
        });

        $('#offer').on('keydown', function (e) {
            if (e.key === 'Tab') {
                e.preventDefault();
                let textarea = this
                addTab(textarea);
            }
        });

        $('#warranty').on('keydown', function (e) {
            if (e.key === 'Tab') {
                e.preventDefault();
                let textarea = this
                addTab(textarea);
            }
        });

        $('#description').on('keydown', function (e) {
            if (e.key === 'Tab') {
                e.preventDefault();
                let textarea = this
                addTab(textarea);
            }
        });

        $('#product-img').change(function () {
            const file = this.files[0];
            if (file) {
                img_url_product = updateImg('#preview', file);
            }
        });

        $('#drop-area').on('dragover', function (e) {
            e.preventDefault();
            $('.img-product').css('box-shadow', '0 0 8px rgba(0,0,0,0.2');
        });

        $('#drop-area').on('dragleave', function (e) {
            e.preventDefault();
            $('.img-product').css('box-shadow', 'none');
        });

        $('#drop-area').on('drop', function (e) {
            e.preventDefault();
            $('.img-product').css('box-shadow', 'none');
            const file = e.originalEvent.dataTransfer.files[0];
            if (file) {
                img_url_product = updateImg('#preview', file);
            }
        });

        $('#btn-add').click(function (e){
            e.preventDefault();

            let productName = $('#name').val();
            let categoryId = $('#category option:selected').val();
            let category = $('#category option:selected').text();
            let brand = $('#brand').val();
            let status = $('#status').val();
            let price = $('#price').val();
            let originPrice = $('#origin-price').val();
            let studentPrice = $('#student-price').val();
            let configuration = $('#configuration').val();
            let offer = $('#offer').val();
            let warranty = $('#warranty').val();
            let description = $('#description').val();

            if(!regexDigitalNumber(price)){
                $('.form-message').addClass('show-error')
                $('#message').text("Giá sản phẩm không hợp lệ");
                return 0;
            }

            if(!regexDigitalNumber(originPrice)){
                $('.form-message').addClass('show-error')
                $('#message').text("Giá gốc sản phẩm không hợp lệ");
                return 0;
            }

            if(!regexDigitalNumber(studentPrice)){
                $('.form-message').addClass('show-error')
                $('#message').text("Giá ưu ãi cho sinh viên không hợp lệ");
                return 0;
            }

            if(!img_url_product || !productName || !categoryId || !category || !brand || !status || !price || !originPrice || !studentPrice || !configuration || !offer || !warranty || !description){
                $('.form-message').addClass('show-error')
                $('#message').text("Vui lòng điền đầy đủ thông tin");
                return 0;
            }

            $.ajax({
                url: '/actions/admin/add-product.php',
                type: 'POST',
                data: {
                    img_url: img_url_product,
                    name: productName,
                    category_id: categoryId,
                    category: category,
                    brand: brand,
                    status: status,
                    price: formatPrice(price),
                    origin_price: formatPrice(originPrice),
                    student_price: formatPrice(studentPrice),
                    configuration: configuration,
                    offer: offer,
                    warranty: warranty,
                    description: description
                }
            }).done(function (data) {
                let result = JSON.parse(data);
                if (result.code === 200) {
                    alert("Thêm sản phẩm thành công");
                    window.location.href = "/admin/product";
                } else {
                    $('.form-message').addClass('show-error')
                    $('#message').text("Có lỗi xảy ra, vui lòng thử lại");
                }
            })
        });



        function addTab(textarea) {
            let start = textarea.selectionStart;
            let end = textarea.selectionEnd;

            textarea.value = textarea.value.substring(0, start) + "\t" + textarea.value.substring(end);
            textarea.selectionStart = textarea.selectionEnd = start + 4;
        }

    });
</script>