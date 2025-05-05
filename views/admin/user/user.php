<div class="wrapper">
  <div class="bg-color-white">
    <div class="box-data">
      <div class="section-admin">
        <div class="head-table-title">
          <h2 class="title">ADMIN Account</h2>
        </div>
        <div class="table-data" style="max-width: 800px;">
          <table id="table-admin" class="table table-striped table-bordered">
            <thead>
            <tr>
              <th class="sortable">Name</th>
              <th class="sortable">Email</th>
              <th>Phone</th>
              <th>Role</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
      <div class="section-user">
        <div class="head-table-title">
          <h2 class="title">USER Account</h2>
        </div>
        <div class="table-data" style="max-width: 800px;">
          <table id="table-user" class="table table-striped table-bordered">
            <thead>
            <tr>
              <th class="sortable">Name</th>
              <th class="sortable">Email</th>
              <th>Phone</th>
              <th>Role</th>
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
</div>

<script src="/scripts/script.js"></script>

<script>
  $(document).ready(function (){
      dataTable('#table-admin',['/actions/admin/get-user-admin.php'],{
          rowFunction: ({row})=>{
              return `
              <tr data-id="${row.id}">
                <td data-name="user_name" data-val="${row.user_name}">
                  <div class="row-text">
                    ${row.user_name}
                  </div>
                </td>
                <td data-name="email" data-val="${row.email}">
                  <div class="row-text">
                    ${row.email}
                  </div>
                </td>
                <td data-name="phone" data-val="${row.phone}">
                  <div class="row-text">
                      ${row.phone}
                  </div>
                </td>
                <td data-name="role" data-val="${row.role}">
                  <div class="row-text">
                      ${row.role}
                  </div>
                </td>
                <td class="text-center no-wrap">
                  <a data-id="${row.id}" onclick="updatePasswordModal('${row.id}')" class="btn btn-primary">Update Password</a>
                </td>
              </tr>`;
          }
      });
      dataTable('#table-user',['/actions/admin/get-user.php'],{
          rowFunction: ({row})=>{
              return `
              <tr data-id="${row.id}">
                <td data-name="user_name" data-val="${row.user_name}">
                  <div class="row-text">
                    ${row.user_name}
                  </div>
                </td>
                <td data-name="email" data-val="${row.email}">
                  <div class="row-text">
                    ${row.email}
                  </div>
                </td>
                <td data-name="phone" data-val="${row.phone}">
                  <div class="row-text">
                      ${row.phone}
                  </div>
                </td>
                <td data-name="role" data-val="${row.role}">
                  <div class="row-text">
                      ${row.role}
                  </div>
                </td>
                <td class="text-end no-wrap">
                  <a data-id="${row.id}" onclick="updatePasswordModal('${row.id}')" class="btn btn-primary">Update Password</a>
                  <button id="delete-acc" onclick="deleteAccount('${row.id}')" class="btn btn-primary">Delete </button>
                </td>
              </tr>`;
          }
      });
  });
  function updatePasswordModal(id){
      $('.modal-backdrop').addClass('in');

      $('.modal-edit-admin').addClass('show').css({
          'display': 'flex',
          'justify-content': 'center',
          'align-items': 'center',
      }).children().css({
          'width': '500px',
          'align-items': 'center',
      });

      $('#modal-edit-content').html(`
        <div>
          <div class="modal-header">
            <h2>UPDATE PASSWORD 🔐</h2>
          </div>
          <div class="modal-body">
            <div class="update-form">
                <form>
                  <div class="form-group" style="padding-bottom: 10px;">
                    <label for="pass">Password</label>
                    <input id="pass" class="form-group" placeholder="Password">
                  </div>
                  <div class="form-group" style="padding-bottom: 10px;">
                    <label for="new-pass">New password</label>
                    <input id="new-pass" class="form-group" placeholder="New password">
                  </div>
                  <div class="form-group" style="padding-bottom: 10px;">
                    <label for="confirm">Confirm password</label>
                    <input id="confirm" class="form-group" placeholder="Confirm password">
                  <div class="form-message">
                    <p id="message"></p>
                  </div>
                </form>
            </div>
          </div>
          <div class="modal-footer">
            <div class="button-group">
              <button id="btn-update" type="button" class="btn btn-primary">Cập nhật </button>
              <button id="btn-back" type="button" class="btn btn-secondary">Quay lại</button>
            </div>
            </div>
          </div>
        </div>
      `);

      $('#btn-back').click(function (e){
          e.preventDefault();
          $('.modal-backdrop').removeClass('in');
          $('.modal-edit-admin').removeClass('show').css({
              'display': 'none',
          }).children().css({
              // 'display': 'none',
              'width': '500px',
              'align-items': 'center',
          });
          $('#modal-edit-content').empty();
      });
      $('#modal-close-btn').click(function (e){
          e.preventDefault();
          $('.modal-backdrop').removeClass('in');
          $('.modal-edit-admin').removeClass('show').css({
              'display': 'none',
          }).children().css({
              // 'display': 'none',
              'width': '500px',
              'align-items': 'center',
          });
          $('#modal-edit-content').empty();
      });

      $('#btn-update').click(function (){
          let password = $('#pass').val().trim();
          let new_password = $('#new-pass').val().trim();
          let confirm_password = $('#confirm').val().trim();
          if(!password || !new_password || !confirm_password){
              $('.form-message').addClass('show-error');
              $('#message').text('Vui lòng nhập đầy đủ thông tin');
              return;
          }
          if(checkValidPassword(password) === false ||checkValidPassword(new_password) === false || checkValidPassword(confirm_password) === false){
              $('.form-message').addClass('show-error');
              $('#message').text('Mật khẩu phải có ít nhất 6 ký tự');
              return;
          }
          if(password===new_password){
              $('.form-message').addClass('show-error');
              $('#message').text('Mật khẩu mới không được giống mật khẩu cũ');
              return;
          }
          if(new_password !== confirm_password){
              $('.form-message').addClass('show-error');
              $('#message').text('Mật khẩu xác thực không khớp');
              return;
          }
          $.ajax({
              url: '/actions/admin/update-password.php',
              type: 'POST',
              data:{
                  account_id: id,
                  password: password,
                  new_password: new_password,
                  confirm_password: confirm_password
              }
          }).done(function (data){
              let result = JSON.parse(data);
              if(result.code === 200){
                  $('.form-message').removeClass('show-error').addClass('show-success');
                  $('#message').text('Cập nhật thành công.');
                  $('#btn-update').prop('disabled', true).css('display', 'none');
              } else {
                  $('.form-message').addClass('show-error');
                  $('#message').text('Lỗi không xác định.');
              }
          });
      });
  }

  function deleteAccount(id){
      if(confirm("Bạn có chắc chắn muốn xóa tài khoản này không?")){
          $.ajax({
              url: '/actions/admin/delete-account.php',
              type: 'POST',
              data:{
                  id: id
              }
          }).done(function (data){
              let result = JSON.parse(data);
              if(result.code === 200){
                  alert("Xóa tài khoản thành công");
                  window.location.reload();
              } else {
                  alert("Có lỗi xảy ra, vui lòng thử lại");
              }
          });
      }
  }
</script>