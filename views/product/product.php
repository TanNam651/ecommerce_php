<?php
require_once "Core/Database.php";
require_once "Core/function.php";

use Core\Database;

$config = require "config/config.php";

$db = new Database($config);

$products = array();

$sql_get_products = "SELECT * FROM ecommerce.products WHERE category=:category LIMIT 10";
$db->query($sql_get_products,[
      'category' => "Laptop"
]);

$resultLaptops = $db->statement->fetchAll(PDO::FETCH_ASSOC);

$db->query($sql_get_products, [
        'category' => "Monitor"
]);

$resultMonitors = $db->statement->fetchAll(PDO::FETCH_ASSOC);


include "layout/header.php";

?>

<div class="container">
  <section class="session-collection-group pd-top-30">
    <div class="bg-color-white">
      <div class="wd-top-title d-flex d-flex-center js-between">
        <h2 class="title-section">Laptop</h2>
        <ul class="menu-col scoll-x-tablet">
          <li>
            <a href="/">Thương hiệu</a>
          </li>
          <li>
            <a href="/">Giá bán</a>
          </li>
          <li>
            <a href="/">Card đồ họa</a>
          </li>
          <li>
            <a href="/">CPU INTEL-AMD</a>
          </li>
          <li>
            <a href="/">MSI Gaming</a>
          </li>
          <li>
            <a href="/">Asus | ROG</a>
          </li>
          <li>
            <a href="/">ACER | PREDATOR</a>
          </li>
        </ul>
      </div>
      <div class="list-product-flex row-left-list">
          <?php
          foreach ($resultLaptops as $product) { ?>

          <div class="product-card">
              <div class="product-block item loop-border">
                  <div class="product-img">
                      <a href="/products?productId=<?= $product['id']?>">
                          <img src="../../public/products/<?= $product['img_url']?>" alt="<?= $product['name']?>">
                      </a>
                  </div>
                  <div class="product-detail">
                      <strong class="product-name">
                          <a href="/products?productId=<?= $product['id']?>">
                              <?php echo $product['name']?>
                          </a>
                      </strong>
                      <div class="js-between">
                          <ul class="list-variants d-flex d-flex-wrap"></ul>
                      </div>
                      <div class="box-product-prices">
                          <p class="pro-price">
                              <span>
                                  <?php echo $product['price']?>
                              </span>
                              <del class="compare-price">
                                  <?php echo $product['origin_price']?>
                              </del>
                          </p>
                          <?php if($product['sale_for_student']!=='0'){?>
                          <div class="deal-tag-value">
                              <p>Giá HSSV: <?php echo $product['sale_for_student']?></p>
                          </div>
                          <?php  }
                          if(!empty($product['configuration'])){
                              $configuration = explode(",",$product['configuration']); ?>
                          <ul class="config-tags">
                              <div class="field-1">
                                 <?php
                                 echo $configuration[0];
                                 echo $configuration[1];
                                 ?>
                              </div>
                              <div class="field-2">
                                  <?php
                                  echo $configuration[3];
                                  echo $configuration[4];
                                  ?>
                              </div>
                          </ul>
                         <?php }
                          ?>

                      </div>
                  </div>
              </div>
          </div>
         <?php  } ?>
      </div>
      <div class="text-center btn-view-all-tab">
        <a href="#" class="btn btn-all-tab">Xem tất cả</a>
      </div>
    </div>
  </section>

  <!-- monitor -->
  <section class="session-collection-group pd-top-30">
    <div class="bg-color-white">
      <div class="wd-top-title d-flex d-flex-center js-between">
        <h2 class="title-section">Màn hình</h2>
        <ul class="menu-col scoll-x-tablet">
          <li>
            <a href="/">Màn hình theo hãng</a>
          </li>
          <li>
            <a href="/">Kích thước</a>
          </li>
          <li>
            <a href="/">Tần số quét</a>
          </li>
          <li>
            <a href="/">Độ phân giải</a>
          </li>
          <li>
            <a href="/">Màn hình theo nhu cầu</a>
          </li>
          <li>
            <a href="/">Phụ kiện màn hình</a>
          </li>
          <li>
            <a href="/">Màn hình di động</a>
          </li>
        </ul>
      </div>
      <div class="list-product-flex row-left-list">
          <?php
          foreach ($resultMonitors as $product) { ?>
          <div class="product-card">
              <div class="product-block item loop-border">
                  <div class="product-img">
                      <a href="/products?productId=<?= $product['id']?>">
                          <img src="../../public/products/<?= $product['img_url']?>" alt="<?= $product['name']?>">
                      </a>
                  </div>
                  <div class="product-detail">
                      <strong class="product-name">
                          <a href="/products?productId=<?= $product['id']?>">
                              <?php echo $product['name'] ?>
                          </a>
                      </strong>
                      <div class="js-between">
                          <ul class="list-variants d-flex d-flex-wrap"></ul>
                      </div>
                      <div class="box-product-prices">
                          <p class="pro-price">
                              <span>
                                  <?php echo $product['price']?>
                              </span>
                              <del class="compare-price">
                                  <?php echo $product['origin_price'] ?>
                              </del>
                          </p>
                          <?php
                          if($product['sale_for_student']!=='0'){?>
                          <div class="deal-tag-value">
                              <p>Giá HSSV: <?php echo $product['sale_for_student']?></p>
                          </div>
                          <?php  }
                          if(!empty($product['configuration'])){
                              $configuration = explode(",",$product['configuration']); ?>
                          <ul class="config-tags">
                              <div class="field-1">
                                 <?php
                                 echo $configuration[0];
                                 echo $configuration[1];
                                 ?>
                              </div>
                              <div class="field-2">
                                  <?php
                                  echo $configuration[3];
                                  echo $configuration[4];
                                  ?>
                              </div>
                          </ul>
                         <?php }
                          ?>
                      </div>
                  </div>
              </div>
          </div>
          <?php }
          ?>
      </div>
      <div class="text-center btn-view-all-tab">
        <a href="#" class="btn btn-all-tab">Xem tất cả</a>
      </div>
    </div>
  </section>
</div>

<?php
include "layout/footer.php";
?>