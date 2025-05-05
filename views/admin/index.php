<?php
$title = $attributes['title'] ?? '';
?>
<div class="template-admin">
  <aside class="admin-sidebar">
    <div class="wrap-sidebar">
      <div class="bg-white">
        <ul>
          <li class="dashboard-sidebar <?= $title == 'dashboard' ? 'active' : '' ?>">
            <a href="/admin">
              <svg width="24px" height="24px" fill="#000000" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                   id="dashboard" class="icon glyph">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                  <rect x="2" y="2" width="9" height="11" rx="2"></rect>
                  <rect x="13" y="2" width="9" height="7" rx="2"></rect>
                  <rect x="2" y="15" width="9" height="7" rx="2"></rect>
                  <rect x="13" y="11" width="9" height="11" rx="2"></rect>
                </g>
              </svg>
              <span>Dashboard</span>
            </a>
          </li>
          <li class="product-sidebar <?= $title == 'product' ? 'active' : '' ?>">
            <a href="/admin/product">
              <svg width="24px" height="24px" viewBox="0 0 512 512" version="1.1" xmlns="http://www.w3.org/2000/svg"
                   xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier"><title>product-management</title>
                  <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="icon" fill="#000000" transform="translate(42.666667, 34.346667)">
                      <path
                          d="M426.247658,366.986259 C426.477599,368.072636 426.613335,369.17172 426.653805,370.281095 L426.666667,370.986667 L426.666667,392.32 C426.666667,415.884149 383.686003,434.986667 330.666667,434.986667 C278.177524,434.986667 235.527284,416.264289 234.679528,393.025571 L234.666667,392.32 L234.666667,370.986667 L234.679528,370.281095 C234.719905,369.174279 234.855108,368.077708 235.081684,366.992917 C240.961696,371.41162 248.119437,375.487081 256.413327,378.976167 C275.772109,387.120048 301.875889,392.32 330.666667,392.32 C360.599038,392.32 387.623237,386.691188 407.213205,377.984536 C414.535528,374.73017 420.909655,371.002541 426.247658,366.986259 Z M192,7.10542736e-15 L384,106.666667 L384.001134,185.388691 C368.274441,181.351277 350.081492,178.986667 330.666667,178.986667 C301.427978,178.986667 274.9627,184.361969 255.43909,193.039129 C228.705759,204.92061 215.096345,223.091357 213.375754,241.480019 L213.327253,242.037312 L213.449,414.75 L192,426.666667 L-2.13162821e-14,320 L-2.13162821e-14,106.666667 L192,7.10542736e-15 Z M426.247658,302.986259 C426.477599,304.072636 426.613335,305.17172 426.653805,306.281095 L426.666667,306.986667 L426.666667,328.32 C426.666667,351.884149 383.686003,370.986667 330.666667,370.986667 C278.177524,370.986667 235.527284,352.264289 234.679528,329.025571 L234.666667,328.32 L234.666667,306.986667 L234.679528,306.281095 C234.719905,305.174279 234.855108,304.077708 235.081684,302.992917 C240.961696,307.41162 248.119437,311.487081 256.413327,314.976167 C275.772109,323.120048 301.875889,328.32 330.666667,328.32 C360.599038,328.32 387.623237,322.691188 407.213205,313.984536 C414.535528,310.73017 420.909655,307.002541 426.247658,302.986259 Z M127.999,199.108 L128,343.706 L170.666667,367.410315 L170.666667,222.811016 L127.999,199.108 Z M42.6666667,151.701991 L42.6666667,296.296296 L85.333,320.001 L85.333,175.405 L42.6666667,151.701991 Z M330.666667,200.32 C383.155809,200.32 425.80605,219.042377 426.653805,242.281095 L426.666667,242.986667 L426.666667,264.32 C426.666667,287.884149 383.686003,306.986667 330.666667,306.986667 C278.177524,306.986667 235.527284,288.264289 234.679528,265.025571 L234.666667,264.32 L234.666667,242.986667 L234.808715,240.645666 C237.543198,218.170241 279.414642,200.32 330.666667,200.32 Z M275.991,94.069 L150.412,164.155 L192,187.259259 L317.866667,117.333333 L275.991,94.069 Z M192,47.4074074 L66.1333333,117.333333 L107.795,140.479 L233.373,70.393 L192,47.4074074 Z"
                          id="Combined-Shape"></path>
                    </g>
                  </g>
                </g>
              </svg>
              <span>Products</span>
            </a>
          </li>
          <li class="order-sidebar <?= $title == 'order' ? 'active' : '' ?>">
            <a href="/admin/order">
              <svg width="24px" height="24px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="#000000">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                  <path fill="#000000"
                        d="M2,11 L4,11 C4.51283143,11 4.93550653,11.386027 4.9932722,11.8833761 L5,12 L5,14 C5,14.51285 4.61395571,14.9355092 4.11662025,14.9932725 L4,15 L2,15 C1.48716857,15 1.06449347,14.613973 1.0067278,14.1166239 L1,14 L1,12 C1,11.48715 1.38604429,11.0644908 1.88337975,11.0067275 L2,11 L4,11 L2,11 Z M14,12 C14.5523,12 15,12.4477 15,13 C15,13.5523 14.5523,14 14,14 L8,14 C7.44772,14 7,13.5523 7,13 C7,12.4477 7.44772,12 8,12 L14,12 Z M4,12 L2,12 L2,14 L4,14 L4,12 Z M4,6 C4.55228,6 5,6.44772 5,7 L5,9 C5,9.55228 4.55228,10 4,10 L2,10 C1.44772,10 1,9.55228 1,9 L1,7 C1,6.44772 1.44772,6 2,6 L4,6 Z M14,7 C14.5523,7 15,7.44772 15,8 C15,8.51283143 14.613973,8.93550653 14.1166239,8.9932722 L14,9 L8,9 C7.44772,9 7,8.55228 7,8 C7,7.48716857 7.38604429,7.06449347 7.88337975,7.0067278 L8,7 L14,7 Z M4,7 L2,7 L2,9 L4,9 L4,7 Z M4.77466,1.22614 C5.04092364,1.49240364 5.06512942,1.90907223 4.84727736,2.20268222 L4.77466,2.2868 L2.28033,4.78113 C2.13968,4.92179 1.94891,5.0008 1.75,5.0008 C1.590872,5.0008 1.4369536,4.9502336 1.30973856,4.85798912 L1.21967,4.78113 L0.21967,3.78113 C-0.0732233,3.48824 -0.0732233,3.01337 0.21967,2.72047 C0.485936364,2.45420636 0.902600248,2.43000058 1.19621162,2.64785264 L1.28033,2.72047 L1.75,3.19014 L3.714,1.22614 C4.00689,0.933247 4.48176,0.933246 4.77466,1.22614 Z M14,2 C14.5523,2 15,2.44772 15,3 C15,3.51283143 14.613973,3.93550653 14.1166239,3.9932722 L14,4 L8,4 C7.44772,4 7,3.55228 7,3 C7,2.48716857 7.38604429,2.06449347 7.88337975,2.0067278 L8,2 L14,2 Z"></path>
                </g>
              </svg>
              <span>Orders</span>
            </a>
          </li>
          <li class="user-sidebar <?= $title == 'user' ? 'active' : '' ?>">
            <a href="/admin/user">
              <svg width="24px" height="24px" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                  <path
                      d="M8 7C9.65685 7 11 5.65685 11 4C11 2.34315 9.65685 1 8 1C6.34315 1 5 2.34315 5 4C5 5.65685 6.34315 7 8 7Z"
                      fill="#000000"></path>
                  <path d="M14 12C14 10.3431 12.6569 9 11 9H5C3.34315 9 2 10.3431 2 12V15H14V12Z" fill="#000000"></path>
                </g>
              </svg>
              <span>User</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </aside>
  <div class="admin-content">
    <div class="admin-head">
      <div class="bg-white">
        <div class="head-wrap">
          <button id="show-btn-admin">
            <svg width="24px" height="24px" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                 stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path
                  d="m21 17.75c0-.414-.336-.75-.75-.75h-16.5c-.414 0-.75.336-.75.75s.336.75.75.75h16.5c.414 0 .75-.336.75-.75zm0-4c0-.414-.336-.75-.75-.75h-16.5c-.414 0-.75.336-.75.75s.336.75.75.75h16.5c.414 0 .75-.336.75-.75zm0-4c0-.414-.336-.75-.75-.75h-16.5c-.414 0-.75.336-.75.75s.336.75.75.75h16.5c.414 0 .75-.336.75-.75zm0-4c0-.414-.336-.75-.75-.75h-16.5c-.414 0-.75.336-.75.75s.336.75.75.75h16.5c.414 0 .75-.336.75-.75z"
                  fill-rule="nonzero"/>
            </svg>
          </button>
          <div class="admin-account">
            <button id="btn-account">
              <span class="box-icon">
                <i class="fa fa-user"></i>
              </span>
              <span class="box-text">
                admin
              </span>
              <span class="box-arrow">
                <svg viewBox="0 0 20 9" role="presentation">
                        <path
                            d="M.47108938 9c.2694725-.26871321.57077721-.56867841.90388257-.89986354C3.12384116 6.36134886 5.74788116 3.76338565 9.2467995.30653888c.4145057-.4095171 1.0844277-.40860098 1.4977971.00205122L19.4935156 9H.47108938z"
                            fill="#ffffff"></path>
                      </svg>
              </span>
            </button>
            <div class="admin-dropdown-container">
              <div class="dropdown-content">
                <button id="admin-btn-logout" class="admin-button-logout">
                  <svg fill="#000000" height="24px" width="24px" version="1.1" id="Layer_1"
                       xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                       viewBox="0 0 512 512" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                      <g>
                        <g>
                          <path
                              d="M372.513,202.174H190.268l10.841-71.555c0.801-5.285-1.683-10.53-6.281-13.258c-4.598-2.725-10.39-2.395-14.646,0.841 L12.729,245.55c-3.264,2.484-5.18,6.349-5.18,10.45s1.917,7.966,5.18,10.45l167.453,127.348c2.337,1.776,5.137,2.678,7.949,2.678 c2.299,0,4.607-0.603,6.673-1.823c4.595-2.712,7.091-7.936,6.315-13.215L190.201,307.2h182.311 c7.249,0,12.472-5.879,12.472-13.128v-78.769C384.985,208.053,379.762,202.174,372.513,202.174z M358.728,280.944H175.002 c-3.815,0-7.441,1.661-9.935,4.548c-2.494,2.887-3.609,6.716-3.054,10.491l8.447,57.433L42.365,256l127.933-97.293l-8.276,54.629 c-0.574,3.782,0.53,7.626,3.026,10.526c2.493,2.901,6.128,4.569,9.954,4.569h183.727V280.944z"></path>
                        </g>
                      </g>
                      <g>
                        <g>
                          <path
                              d="M465.135,0H121.764c-7.249,0-13.785,5.879-13.785,13.128v52.513c0,7.249,6.535,13.128,13.785,13.128h303.918v354.462 H121.764c-7.249,0-13.785,5.879-13.785,13.128v52.513c0,7.249,6.535,13.128,13.785,13.128h343.371 c22.041,0,39.316-17.668,39.316-39.385V39.385C504.451,17.668,487.176,0,465.135,0z M478.195,472.615 c0,7.117-5.625,13.128-13.06,13.128H134.236v-26.256h305.231c7.249,0,12.472-5.879,12.472-13.128V65.641 c0-7.249-5.222-13.128-12.472-13.128H134.236V26.256h330.899c7.435,0,13.06,6.011,13.06,13.128V472.615z"></path>
                        </g>
                      </g>
                    </g></svg>
                  <span>Logout</span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="admin-container">
      <div class="container">
          <?php
          if (isset($children)) {
              require_once "views/admin/{$children}";
          }
          ?>
      </div>
    </div>
  </div>
</div>
<div class="modal-edit-admin">
  <div class="modal-container">
    <div class="bg-white" style="position: relative;">
      <div id="modal-edit-content">

      </div>
      <span class="modal-close-btn" id="modal-close-btn">
      <i class="fa fa-times" aria-hidden="true"></i>
    </span>
    </div>

  </div>
</div>

<script src="/scripts/script.js"></script>
<script>
    $(document).ready(function () {
        $('#btn-account').click(function (e) {
            e.preventDefault();
            if ($(this).parent().hasClass('active')) {
                $(this).parent().removeClass('active');
            } else {
                $(this).parent().addClass('active');
            }
        });

        $('#show-btn-admin').click(function (e) {
            e.preventDefault();
            if ($('.template-admin .admin-sidebar').hasClass('close')) {
                $('.template-admin .admin-sidebar').removeClass('close');
            } else {
                $('.template-admin .admin-sidebar').addClass('close');
            }
        });

        $('#admin-btn-logout').click(function (e) {
            e.preventDefault();
            $.ajax({
                url: "/actions/accounts/logout.php",
                type: "POST",
            }).done(function (response) {
                let result = JSON.parse(response);
                if (result.code === 200) {
                    location.href = '/';
                }
            });
        });

        $('#modal-close-btn').click(function (e){
            e.preventDefault();

            $('.modal-backdrop').removeClass('in');

            $('.modal-edit-admin').removeClass('show');

            $('#modal-edit-content').empty();
        });

    });
</script>