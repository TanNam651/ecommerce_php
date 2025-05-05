<?php
require_once "vendor/autoload.php";
require_once "Core/Database.php";
require_once "Core/function.php";

use Core\Database;

$config = require "config/config.php";
$db = new Database($config);

$select_order_overview = "SELECT COUNT(*) as total FROM ecommerce.orders WHERE order_status IN ('PENDING', 'PROCESSING')";

$select_user_overview = "SELECT COUNT(*) as count FROM ecommerce.users WHERE role='user'";

$query_revenue_overview = "SELECT SUM(CAST(REPLACE(REPLACE(paid_amount, '.',''),'₫','') AS UNSIGNED )) as revenue from ecommerce.payments WHERE payment_status='COMPLETED' and MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE())";

$db->query($select_order_overview);
$orders = $db->statement->fetch(PDO::FETCH_ASSOC);

$db->query($select_user_overview);
$users = $db->statement->fetch(PDO::FETCH_ASSOC);

$db->query($query_revenue_overview);
$revenue = $db->statement->fetch(PDO::FETCH_ASSOC);

?>

<section class="dashboard">
  <div class="wrapper">
    <div class="overview">
      <div class="overview-header">
        <h2 class="title">Overview</h2>
      </div>
      <div class="overview-body row-left-list">
        <div class="overview-card">
          <div class="card-block">
            <div class="card-body">
              <div class="icon-item">
                <div class="text-center">
                  <i class="fa-solid fa-cart-shopping"></i>
                </div>
              </div>
              <div class="detail">
                <div>
                  <p class="sub-title">PENDING ORDERS</p>
                  <span class="number">
                    <?php
                    echo $orders['total'];
                    ?>
                  </span>
                </div>
              </div>
            </div>
            <div class="cart-footer">
              <hr/>
              <div class="stats">
                <i class="fa-solid fa-calendar"></i> All
              </div>
            </div>
          </div>
        </div>
        <div class="overview-card">
          <div class="card-block">
            <div class="card-body">
              <div class="icon-item">
                <div class="text-center">
                  <i class="fa-solid fa-building-columns"></i>
                </div>
              </div>
              <div class="detail">
                <div>
                  <p class="sub-title">REVENUE</p>
                  <span class="number">
                      <?php
                      echo number_format($revenue['revenue'], 0, ',', '.') . '₫';
                      ?>
                  </span>
                </div>
              </div>
            </div>
            <div class="cart-footer">
              <hr/>
              <div class="stats">
                <i class="fa-solid fa-calendar"></i> For Month
              </div>
            </div>
          </div>
        </div>
        <div class="overview-card">
          <div class="card-block loop-border">
            <div class="card-body">
              <div class="icon-item">
                <div class="text-center">
                  <i class="fa-solid fa-people-roof"></i>
                </div>
              </div>
              <div class="detail">
                <div>
                  <p class="sub-title">USERS</p>
                  <span class="number">
                    <?php
                    echo $users['count'];
                    ?>
                  </span>
                </div>
              </div>
            </div>
            <div class="cart-footer">
              <hr/>
              <div class="stats">
                <i class="fa-solid fa-calendar"></i> All
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="statistical">
      <div class="overview-header">
        <h2 class="title">Statistical</h2>
      </div>
      <div class="chart row-left-list">
        <div class="order-chart">
          <div class="block-chart">
            <div class="title-statistical">
              <h3>Orders overview</h3>
            </div>
            <canvas id="chart-order"></canvas>
          </div>
        </div>
        <div class="revenue-chart">
          <div class="block-chart">
            <div class="title-statistical">
              <h3>Revenue overview</h3>
            </div>
            <canvas id="chart-revenue"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="/scripts/script.js"></script>

<script>
    $(document).ready(function () {
        const ctxOrder = $('#chart-order')[0].getContext('2d');
        const ctxRevenue = $('#chart-revenue')[0].getContext('2d');

        $.ajax({
            url: '/actions/admin/statistical.php',
            type: 'POST',
        }).done(function (data) {
            let result = JSON.parse(data);
            let order = JSON.parse(result.orders);
            let revenue = JSON.parse(result.revenue);
            console.log(order);

            new Chart(ctxOrder, {
                type: 'bar',
                data: {
                    labels: order.map(row => row.month),
                    datasets: [
                        {
                            label: 'Order by month',
                            data: order.map(row => row.total)
                        }
                    ]
                },
                options: {
                    animations: {
                        tension: {
                            duration: 1000,
                            easing: 'linear',
                            from: 1,
                            to: 0,
                            loop: true
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Orders in this year',
                            fullSize: true,
                            position: 'top',
                        },
                        subtitle: {
                            display: true,
                            text: 'Number of orders',
                            fullSize: true,
                            position: 'left',
                        }
                    }
                }
            });

            new Chart(ctxRevenue, {
                type: 'line',
                data: {
                    labels: revenue.map(row => row.month),
                    datasets: [
                        {
                            label: 'Revenue by month',
                            data: revenue.map(row => row.total)
                        }
                    ]
                },
                options: {
                    animations: {
                        tension: {
                            duration: 1000,
                            easing: 'linear',
                            from: 1,
                            to: 0,
                            loop: true
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Revenue in this year',
                            fullSize: true,
                            position: 'top',
                        },
                        subtitle: {
                            display: true,
                            text: 'Revenue',
                            fullSize: true,
                            position: 'left',
                        }
                    }
                }
            });
        })
    });

</script>

