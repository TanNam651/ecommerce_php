
function sendMessage(element, message, type) {
    if (type === 'error') {
        $(element).removeClass('show-success-message')
            .addClass('show-error-message');
    } else {
        $(element).removeClass('show-error-message')
            .addClass('show-success-message');
    }
    $(element).find('#message-status').text(message);
}

function regexEmail(email) {
    let emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    return emailRegex.test(email);
}

function regexDigitalNumber(number) {
    const regex = /^\d+(\.\d+)?$/;
    return regex.test(number);
}

function checkValidPassword(password) {
    return password.length >= 6;
}

function regexPhoneNumber(phone) {
    let phoneRegex = /^(0[3|5|7|8|9])\d{8}$/;
    let phoneWithCountryRegex = /^(\+84|0)(3|5|7|8|9)\d{8}$/;

    return phoneRegex.test(phone) || phoneWithCountryRegex.test(phone);
}

function getSpecialCookie(inp) {
    let result = document.cookie.split(';');
    for (let cookie of result) {
        let [key, value] = cookie.split('=');
        if (key.trim() === inp) {
            return decodeURIComponent(value);
        }
    }
    return null;
}

function loadCartProduct() {
    let listCart = JSON.parse(localStorage.getItem('store-cart')) || [];
    let cartTable = $('#cart-view tbody');
    let total = $('#total-view-cart');
    let numberCartHeader = $('#number-cart-header');

    let totalPrice = 0;

    cartTable.empty();

    if (listCart.length === 0) {
        cartTable.append(`
    <tr>
      <td class="mini-cart-header text-center">
        <img src="../public/assets/no-cart_c1e41f3edf5c45b18eb6c64306d881c8_small.webp" alt="No cart" style="width: 60px; height: 60px;">
        <p>Hiện chưa có sản phẩm</p>
      </td>
    </tr>
    `);
    } else {
        listCart.forEach((item, index) => {
            totalPrice += convertPrintToInt(item.price) * parseInt(item.quantity);
            cartTable.append(`
        <tr class="list-item">
          <td class="img">
           <a href="products?productId=${item.id}">
            <img src="../public/products/${item.img_url}" alt="${item.name}">
          </a>
          </td>
          <td class="item">
            <a class="product-title-view" href="products?productId=${item.id}">
            ${item.name}
            </a>
            <span class="variant">
              Giá sốc
            </span>
             <div class="quantity-area-cart-mini">
              <input type="text" name="quantity-mini-cart" value="${item.quantity}" min="1" class="quantity-mini-cart">
              <span class="pro-price-view">${item.price}</span>
            </div>
            <span class="remove-cart" onclick="removeCartItem('${item.id}')">
              <i class="fa fa-times"></i>
            </span>
          </td>
        </tr>
      `);
        });
    }
    total.html(formatPrice(totalPrice))
    setNumberCartHeader();
    console.log(listCart.length);
}

function loadListProductCartPage() {
    let listCart = JSON.parse(localStorage.getItem('store-cart')) || [];

    let listProductStore = $('#list-product-cart');

    if (listCart.length === 0) {
        listProductStore.empty();

        listProductStore.append(`
        <p class="no-item-cart">
          Giỏ hàng của bạn đang trống. Mời bạn mua thêm sản phẩm <a href="/"> tại đây</a>
        </p>
        `);
    } else {
        listProductStore.empty();

        listCart.forEach((item, index) => {
            listProductStore.append(`
                <ul class="cart-wrap">
                  <li class="item-info">
                    <div class="item-img">
                      <img src="../../public/products/${item.img_url}" alt="">
                    </div>
                    <div class="item-title">
                      <a href="/products?productId=${item.id}">${item.name}</a>
                      <div class="d-flex group-item-option">
                        <span class="item-option">Giá sốc không ưu đã thêm</span>
                        <span class="item-option">
                          <span class="money">${item.price}</span>
                          <del>${item.origin_price}</del>
                        </span>
                      </div>
                    </div>
                  </li>
                  <li class="item-quantity">
                    <div class="quantity-area">
                      <input type="button" value="-" class="quantity-btn btn-left-quantity" onclick="decreaseQuantity('${item.id}')">
                      <input id="updates-${item.id}" type="text" value="${item.quantity}">
                      <input type="button" value="+" class="quantity-btn btn-right-quantity" onclick="increaseQuantity('${item.id}')">
                    </div>
                    <div class="remove-item">
                      <span class="remove-wrap">
                        <a onclick="removeItem('${item.id}')">Xóa</a>
                      </span>
                    </div>
                  </li>
                  <li class="item-price">
                    <span id="prices-${item.id}" class="amount full-price">dd</span>
                  </li>
                </ul>
            `);
        });
    }

    caculateTotalPriceAndQuantity();
}

function removeCartItem(id) {
    let listCart = JSON.parse(localStorage.getItem('store-cart')) || [];
    listCart = listCart.filter((item) => item.id !== id);
    localStorage.setItem('store-cart', JSON.stringify(listCart));
    loadCartProduct();
}

function decreaseQuantity(id) {
    let listCart = JSON.parse(localStorage.getItem('store-cart')) || [];
    listCart.forEach((item) => {
        if (item.id === id && parseInt(item.quantity) > 1) {
            item.quantity = parseInt(item.quantity) - 1;
            $('#updates-'+id).val(item.quantity);
        }
    });
    localStorage.setItem('store-cart', JSON.stringify(listCart));
    loadCartProduct();
}

function increaseQuantity(id) {
    let listCart = JSON.parse(localStorage.getItem('store-cart')) || [];
    listCart.forEach((item) => {
            if(item.id===id){
                item.quantity = parseInt(item.quantity) + 1;
                $('#updates-'+id).val(item.quantity);
            }
    });
    localStorage.setItem('store-cart', JSON.stringify(listCart));
    loadCartProduct();
}

function convertPrintToInt(price) {
    return parseInt(price.replace(/[.₫,]/g, ''), 10);
}

function formatPrice(price) {
    price = parseInt(price);
    return price.toLocaleString("vi-VN") + "₫";
}

function setNumberCartHeader() {
    let listCart = JSON.parse(localStorage.getItem('store-cart')) || [];
    let numberCartHeader = $('#number-cart-header');
    let count = 0;
    listCart.forEach((item)=>{
        count += parseInt(item.quantity);
    })
    numberCartHeader.html(count);
}

function caculateTotalPriceAndQuantity(){
    let listCart = JSON.parse(localStorage.getItem('store-cart')) || [];
    let totalPrice = 0;
    let totalQuantity = 0;
    listCart.forEach((item) => {
        let convertQuantity = parseInt(item.quantity);
        let priceItem = convertPrintToInt(item.price) * convertQuantity;
        totalPrice += priceItem;
        totalQuantity += convertQuantity;
        $('#prices-'+item.id).html(formatPrice(priceItem));

    });

    $('.cart-count .count').html(totalQuantity);
    $('#total-price').html(formatPrice(totalPrice));
}

function loadUserFromCookie(){
    let cookies = document.cookie.split('; ');
    for(let cookie of cookies){
        let [key, value] = cookie.split('=');

        if(key === 'auth_user'){
            return JSON.parse(decodeURIComponent(value));
        }
    }
    return null;
}

function getParamsURL(param){
    let params = new URLSearchParams(window.location.search);

    return params.get(param);
}

function dataTable(idTable, url, options = {}) {
    let total = 0;
    let currentPage = 1;
    // create new data table container
    const dataContainer = $('<div>', {
        class: 'data-table'
    });
    const tableContainer = $('<div>', {
        class: 'data-table-container',
    });

    const paginationContainer = $('<div>', {
        class: 'pagination'
    });

    let oldTable = $(idTable);
    let newTable = $('<table></table>');
    let thead = $('<thead></thead>');
    let tr = $('<tr></tr>');
    let tbody = $('<tbody></tbody>');
    let oldTheads = $(idTable + ' th');

    //     Create list th
    for (let i = 0; i < oldTheads.length; i++) {
        let oldThead = $(oldTheads[i]).clone(true);

        tr.append(oldThead);
    }
    thead.append(tr);
    newTable.append(thead)
    newTable.append(tbody);
    tableContainer.append(newTable);
    dataContainer.append(tableContainer);

    oldTable.replaceWith(dataContainer);

    //     get data and add to tbody

    newTable.attr('id', idTable.replace('#', ''));

    const paginationDiv = $('<div></div>');

    paginationContainer.append(paginationDiv);
    dataContainer.append(paginationContainer);


    renderDataTable(1)
    renderPagination();

    function renderDataTable(page = 1) {
        $.ajax({
            url: url[0],
            type: 'POST',
            data: {
                page: page,
            }
        }).done(function (data) {

            let result = JSON.parse(data);
            console.log(result);

            let renderData = [];

            renderData = result.map((item, index) => {
                // let keys = Object.keys(item);
                // let values = Object.values(item);
                // let row = [];
                // for (let i = 1; i < keys.length; i++) {
                //     row.push(`
                //             <td data-name="${keys[i]}" data-val="${values[i]}">
                //               <div class="row-text">
                //                 ${values[i]}
                //               </div>
                //             </td>
                //             `);
                // }

                // row.push(options.rowFunction({row: item}))

                // return `<tr data-id="${item.id}">
                //           ${row.join('')}
                //         </tr>`;
                return options.rowFunction({row: item})
            });

            tbody.html(renderData.join(''));
        });
    }

    function renderPagination() {
        paginationDiv.html('');
        $.ajax({
            url: url[1],
            type: "POST",
        }).done(function (data) {
            total = parseInt(data);

            const totalPage = Math.ceil(total / 8);


            const prevButton = $('<button>', {
                class: 'prev',
                id: 'btn-prev',
                text: 'Prev',
            });

            const nextButton = $('<button>', {
                class: 'next',
                id: 'btn-next',
                text: 'Next',
            });
            paginationDiv.append(prevButton);
            // show list pagination list
            let startIndex = Math.floor((currentPage - 1) / 8) * 8 + 1;
            let endIndex = Math.min((startIndex + 4), totalPage);

            for (let i = startIndex; i <= endIndex; i++) {
                let pageBtn = $('<button>', {
                    class: 'page',
                    text: i,
                }).attr('data-page', i);

                if (currentPage === i) {
                    pageBtn.addClass('active');
                }

                paginationDiv.append(pageBtn);
            }

            paginationDiv.append(nextButton);

            if(!totalPage){
                $('.prev').hide();
                $('.next').hide();
            }

            setStatePagination();

            function setStatePagination() {

                $('.page').on('click', function (e) {
                    e.preventDefault();
                    $('.page').removeClass('active');
                    $(this).addClass('active');
                    currentPage = $(this).data('page');
                    renderDataTable(currentPage);
                });

                $('#btn-prev').click(function (e) {
                    e.preventDefault();
                    if (currentPage > startIndex) {
                        currentPage--;
                    }
                    $('.page').removeClass('active');
                    $(`.page[data-page="${currentPage}"]`).addClass('active');
                    renderDataTable(currentPage);
                });

                $('#btn-next').click(function (e) {
                    e.preventDefault();
                    if (currentPage < endIndex) {
                        currentPage++;
                    }
                    $('.page').removeClass('active');
                    $(`.page[data-page="${currentPage}"]`).addClass('active');
                    renderDataTable(currentPage);
                })

            }

        });
    }
}


function updateImg(idImg, file){
    const fileRender = new FileReader();

    fileRender.onload = function (e){
        $(idImg).attr('src', e.target.result).show();
    }

    fileRender.readAsDataURL(file);

    return file.name;
}