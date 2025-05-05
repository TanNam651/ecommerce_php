<?php
$product = null;
?>

<div class="wrapper">
  <div class="bg-color-white">
    <div class="box-data">
      <div class="head-table-title">
        <h2 class="title">Order</h2>
      </div>
      <div class="table-data">
        <table id="table-order" class="table table-striped table-bordered">
          <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <!--            <th>Details</th>-->
            <th>Status</th>
            <th>Payment</th>
            <th></th>
          </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script src="/scripts/script.js"></script>
<script>
    $(document).ready(function () {

        dataTable('#table-order', ['/actions/admin/get-order.php', '/actions/admin/get-count-order.php'], {
            rowFunction: ({row}) => {
                return `
                <tr data-id="${row.id}">
                  <td data-name="user_name" data-val="${row.name}">
                    <div class="row-text">
                      ${row.name}
                    </div>
                  </td>
                  <td data-name="email" data-val="${row.email}">
                    <div class="row-text">
                      ${row.email}
                    </div>
                  </td>
                  <td data-name="user_address" data-val="${row.address}">
                    <div class="row-text">
                      ${row.address}
                    </div>
                  </td>
                  <td data-name="order_status" data-val="${row.order_status}">
                    <div class="row-text">
                      <span class="status ${row.order_status === 'COMPLETE' ? 'message-success' : 'message-error'}">
                        ${row.order_status}
                      </span>
                    </div>
                  </td>
                  <td data-name="payment_status" data-val="${row.payment_status}">
                    <div class="row-text">
                      <span class="status ${row.payment_status === 'COMPLETED' ? 'message-success' : 'message-error'}">
                        ${row.payment_status}
                      </span>
                    </div>
                  </td>
                  <td class="text-center">
                      <a data-id="${row.id}" onclick="editOrderModal('${row.id}')" class="btn btn-primary">Show</a>
                  </td>
                </tr>
                `;
            }
        });
    });

    function editOrderModal(id) {
        $.ajax({
            url: '/actions/admin/get-order-details.php',
            type: 'POST',
            data: {
                id: id
            },
        }).done(function (data) {
            let result = JSON.parse(data);
            let products = JSON.parse(result.list_product);
            let payment = JSON.parse(result.payment);
            let status_order = JSON.parse(result.status_order);
            let status_payment = JSON.parse(result.status_payment);
            renderOrderContent(products, payment, status_order, status_payment);
        });
    }

    function renderOrderContent(products, payment, status_order, status_payment) {
        $('.modal-backdrop').addClass('in');

        $('.modal-edit-admin').addClass('show');

        $('#modal-edit-content').html(`
            <div>
              <div class="modal-header">
                <h2>Chi tiết đơn hàng</h2>
              </div>
              <div class="modal-body">
                <div class="product-order">
                  <div class="product-title">
                    <h2>Danh sách sản phẩm</h2>
                  </div>
                  <div class="list-product-order">
                    <table id="render-product-order" class="product-table">
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
                      <span>Địa chỉ</span>
                    <span id="address"></span>
                  </div>
                  <div class="d-flex flex-space">
                    <span>Trạng thái đơn hàng</span>
                    <select id="status-order" class="form-control">
                    </select>

                  </div>
                  <div class="d-flex flex-space">
                    <span>Trạng thái thanh toán</span>
                    <select id="status-payment" class="form-control">
                    </select>
                  </div>
                  <div class="d-flex flex-space">
                    <span class="price">Tổng tiền</span>
                    <span id="price" class="price"></span>
                  </div>
                  <div class="button-group">
                    <button id="btn-update" type="button" class="btn btn-primary">Cập nhật </button>
                    <button id="btn-back" type="button" class="btn btn-secondary">Quay lại</button>
                  </div>
                </div>
              </div>
            </div>
        `);

        let listProduct = $('#render-product-order tbody');
        listProduct.html('');

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
        $('#address').text(payment.address);

        let optionsStatusOrder = [];
        let optionsStatusPayment = [];

        status_order.forEach((item, index) => {
            optionsStatusOrder.push(`
                <option value="${item}" ${item === payment.order_status ? 'selected' : ''}>${item}</option>
            `);
        });

        status_payment.forEach((item, index) => {
            optionsStatusPayment.push(`
                <option value="${item}" ${item === payment.payment_status ? 'selected' : ''}>${item}</option>
            `);
        });
        $('#status-order').html(optionsStatusOrder.join(' '));
        $('#status-payment').html(optionsStatusPayment.join(' '));
        if (payment.payment_status === 'COMPLETED') {
            $('#status-payment').attr('disabled', true);
        }
        if (payment.order_status === 'COMPLETE') {
            $('#status-order').attr('disabled', true);
        }

        if (payment.payment_status === 'COMPLETED' && payment.order_status === 'COMPLETE') {
            $('#btn-update').attr('disabled', true);
        }

        if (payment.order_status === 'COMPLETE' && payment.payment_status === 'COMPLETED') {
            $('#btn-update').css('display', 'none');
        }

        $('#price').text(payment.total_amount);

        $('#btn-back').click(function (e) {
            e.preventDefault();
            $('.modal-backdrop').removeClass('in');
            $('.modal-edit-admin').removeClass('show');
            $('#modal-edit-content').empty();
        });

        $('#btn-update').click(function (e) {
            e.preventDefault();
            let statusOrder = $('#status-order option:selected').val();
            let statusPayment = $('#status-payment option:selected').val();

            if (statusOrder === 'COMPLETE') {
                let updateProduct = products.map((item, index) => {
                    return {
                        id: item.product_id,
                        quantity: item.quantity,
                    }
                });

                $.ajax({
                    url: '/actions/admin/order-success.php',
                    type: 'POST',
                    data: {
                        orderId: payment.id,
                        products: JSON.stringify(updateProduct),
                    },
                }).done(function (data){
                    let result = JSON.parse(data);
                    console.log(result);
                    $('tr[data-id="' + payment.id + '"]').find('td[data-name="order_status"]').html(`
                   <div class="row-text">
                      <span class="status message-success">
                        COMPLETE
                      </span>
                    </div>`);

                    $('tr[data-id="' + payment.id + '"]').find('td[data-name="payment_status"]').html(`
                   <div class="row-text">
                      <span class="status message-success">
                        COMPLETED
                      </span>
                    </div>`)

                    $('.modal-backdrop').removeClass('in');
                    $('.modal-edit-admin').removeClass('show');
                    $('#modal-edit-content').empty();
                }).fail(function (data) {
                    let result = JSON.parse(data);
                    console.log(result);
                });
            } else if(statusOrder === 'CANCELLED') {
                $.ajax({
                    url: '/actions/admin/order-cancel.php',
                    type: 'POST',
                    data: {
                        orderId: payment.id,

                    },
                }).done(function (data) {
                    let result = JSON.parse(data);
                    console.log(result);
                    $('tr[data-id="' + payment.id + '"]').find('td[data-name="order_status"]').html(`
                   <div class="row-text">
                      <span class="status message-error">
                        CANCELLED
                      </span>
                    </div>`);

                    $('tr[data-id="' + payment.id + '"]').find('td[data-name="payment_status"]').html(`
                   <div class="row-text">
                      <span class="status message-error">
                        CANCEL
                      </span>
                    </div>`)

                    $('.modal-backdrop').removeClass('in');
                    $('.modal-edit-admin').removeClass('show');
                    $('#modal-edit-content').empty();
                });
            }
            else {
                $.ajax({
                    url: '/actions/admin/update-status-order.php',
                    type: 'POST',
                    data: {
                        orderId: payment.id,
                        orderStatus: statusOrder,
                        paymentStatus: statusPayment
                    },
                }).done(function (data) {
                    let result = JSON.parse(data);
                    console.log(result);
                    $('tr[data-id="' + payment.id + '"]').find('td[data-name="order_status"]').html(`
                   <div class="row-text">
                      <span class="status ${statusOrder === 'COMPLETE' ? 'message-success' : 'message-error'}">
                        ${statusOrder}
                      </span>
                    </div>`);

                    $('tr[data-id="' + payment.id + '"]').find('td[data-name="payment_status"]').html(`
                   <div class="row-text">
                      <span class="status ${statusPayment === 'COMPLETED' ? 'message-success' : 'message-error'}">
                        ${statusPayment}
                      </span>
                    </div>`)

                    $('.modal-backdrop').removeClass('in');
                    $('.modal-edit-admin').removeClass('show');
                    $('#modal-edit-content').empty();

                });
            }

        });
    }
</script>
