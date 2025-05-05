<div class="wrapper">
  <div class="bg-color-white">
    <div class="box-data">
      <div class="head-table-title">
        <h2 class="title">Products</h2>
        <a id="btn-add-product" class="btn btn-primary">
          <i class="fa-solid fa-plus"></i>
          Add product
        </a>
      </div>
      <!--      <div class="search-table">-->
      <!--        <form action="" method="get">-->
      <!--          <div class="input-group">-->
      <!--            <input id="search" type="text" class="form-control" placeholder="Search" name="search" value="">-->
      <!--            <label style="display: none;" for="search"></label>-->
      <!--          </div>-->
      <!--        </form>-->
      <!--      </div>-->
      <div class="table-data">
        <table id="table-product" class="table table-striped table-bordered">
          <thead>
          <tr>
            <th class="sortable">Name</th>
            <th class="sortable">Price</th>
            <th>Origin price</th>
            <th>Brand</th>
            <th>Category</th>
            <th>Quantity</th>
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

        $('#btn-add-product').click(function (e){
            e.preventDefault();
            history.pushState(null, '', '/admin/product/create');
            window.location.reload();
        })

        dataTable('#table-product', ['/actions/admin/list-product.php','/actions/admin/get-total-data.php'], {
            rowFunction: ({row}) => {
                return `
                <tr data-id="${row.id}">
                  <td data-name="user_name" data-val="${row.name}">
                    <div class="row-text">
                      ${row.name}
                    </div>
                  </td>
                  <td data-name="price" data-val="${row.price}">
                    <div class="row-text">
                      ${row.price}
                    </div>
                  </td>
                  <td data-name="origin_price" data-val="${row.origin_price}">
                    <div class="row-text">
                      ${row.origin_price}
                    </div>
                  </td>
                  <td data-name="brand" data-val="${row.brand}">
                    <div class="row-text">
                        ${row.brand}
                    </div>
                  </td>
                  <td data-name="category" data-val="${row.category}">
                    <div class="row-text">
                        ${row.category}
                    </div>
                  </td>
                  <td data-name="quantity" data-val="${row.quantity}">
                    <div class="row-text">
                        ${row.quantity}
                    </div>
                  </td>
                  <td class="text-center">
                      <a data-id="${row.id}" onclick="editProductModal('${row.id}')" class="btn btn-primary">Edit</a>
                  </td>
                </tr>
          `;
            }
        });
    });

    function editProductModal(id) {
        $.ajax({
            url: '/actions/admin/get-product.php',
            type: 'POST',
            data: {
                id: id
            }
        }).done(function (data) {
            let result = JSON.parse(data);


            if (result.code === 200) {
                let product = JSON.parse(result.product);
                let img_url = product.img_url;
                let productId = id
                renderEditContent(product);

                $('#input-file').change(function () {
                    const file = this.files[0];
                    if (file) {
                        img_url = updateImg('#show-img-url',file);
                    }
                });

                $('#drop-area').on('dragover', function (e){
                    e.preventDefault();
                    $('.modal-edit-admin .img-product').css('box-shadow', '0 0 8px rgba(0,0,0,0.2');
                });

                $('#drop-area').on('dragleave', function (e){
                    e.preventDefault();
                    $('.modal-edit-admin .img-product').css('box-shadow', 'none');
                });

                $('#drop-area').on('drop', function (e){
                    e.preventDefault();
                    $('.modal-edit-admin .img-product').css('box-shadow', 'none');

                    const file = e.originalEvent.dataTransfer.files[0];
                    img_url = updateImg('#show-img-url',file);
                });

                $('#btn-update').click(function (e){
                    e.preventDefault();

                    let status = $('#product-status').val().trim();
                    console.log("STATUS: ",status)
                    let price = $('#product-price').val().trim();
                    let price_student = $('#product-student').val().trim();
                    $.ajax({
                        url: '/actions/admin/update-product.php',
                        type: 'POST',
                        data:{
                            id: productId,
                            img: img_url,
                            status: status,
                            price: price,
                            price_student: price_student,
                        }
                    }).done(function (data){
                        let result = JSON.parse(data);
                       if(result.code === 200){
                           let updateProduct = JSON.parse(result.product);
                           $('.modal-backdrop').removeClass('in');

                           $('.modal-edit-admin').removeClass('show');

                           $('#modal-edit-content').empty();

                           let updateRow = $(`#table-product tbody tr[data-id="${productId}"]`);

                           if(price){
                               updateRow.find(`td[data-name="price"]`).text(updateProduct.price);
                           }
                       } else {
                           alert("Không có thông tin cần cập nhật")
                       }
                    });

                });
            }
        });

    }


    function renderEditContent(product) {

        $('.modal-backdrop').addClass('in');

        $('.modal-edit-admin').addClass('show');

        $('#modal-edit-content').html(`
        <div>
          <div class="modal-header">
            <h2>Thông tin sản phẩm</h2>
          </div>
          <div class="modal-body">
            <div class="product">
              <div class="img-product">
                <label for="input-file" id="drop-area" class="img-wrap">
                  <input type="file" name="input-image" id="input-file" class="input-file" multiple hidden="hidden">
                  <img id="show-img-url"
                      src="../../../public/products/${product.img_url}"
                      alt="aa">
                </label>
              </div>
              <div class="product-info">
                <h2>
                  ${product.name}
                </h2>
              </div>
            </div>
            <div class="information-product">
              <h2>Chi tiết</h2>
              <div class="container-des">
                <fieldset>
                  <div>
                    <label for="product-name">Tên sản phẩm</label>
                    <input type="text" id="product-name" value="${product.name}" disabled>
                  </div>
                </fieldset>
                <div class="flex">
                  <fieldset>
                    <div>
                      <label for="product-name">Thương hiệu</label>
                      <input type="text" id="product-name" value="${product.brand}" disabled>
                    </div>
                  </fieldset>
                  <fieldset>
                    <div>
                      <label for="product-name">Phân loại</label>
                      <input type="text" id="product-name" value="${product.category}" disabled>
                    </div>
                  </fieldset>
                  <fieldset>
                    <div>
                      <label for="product-name">Giá gốc</label>
                      <input type="text" id="product-name" value="${product.origin_price}" disabled>
                    </div>
                  </fieldset>

                </div>
                <div class="flex">
                  <fieldset>
                    <div>
                      <label for="product-name">Trạng thái</label>
                      <input type="text" id="product-status" value="${product.status}">
                    </div>
                  </fieldset>
                  <fieldset>
                    <div>
                      <label for="product-name">Giá bán</label>
                      <input type="text" id="product-price" value="${product.price}">
                    </div>
                  </fieldset>
                  <fieldset>
                    <div>
                      <label for="product-name">Giá ưu đãi cho sinh viên</label>
                      <input type="text" id="product-student" value="${product.sale_for_student}">
                    </div>
                  </fieldset>
                </div>
              </div>
            </div>
            <div>
              <button id="btn-update" class="btn btn-primary">Cập nhật</button>
            </div>
          </div>
        </div>
`)
    }
</script>
