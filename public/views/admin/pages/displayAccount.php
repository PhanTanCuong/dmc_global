<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Admin Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="addAccount" method="POST">

        <div class="modal-body">

          <div class="form-group">
            <label> Username </label>
            <input type="text" name="username" class="form-control" placeholder="Enter Username">
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" placeholder="Enter Email">
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Enter Password">
          </div>
          <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password">
          </div>
          <div class="form-group">
            <label>Role</label>
            <select name="role">
              <option value="admin">Admin</option>
              <option value="user">User</option>
            </select>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="addAccountBtn" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>

<div class="modal fade" id="editadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Admin Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="editAccount" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" name="edit_id" id="edit_id">
            <label> Username </label>
            <input type="text" name="edit_username" id="edit_username" class="form-control" placeholder="Enter Username">
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="edit_email" id="edit_email" class="form-control" placeholder="Enter Email">
          </div>
          <div class="form-group">
            <label>Role</label>
            <select name="edit_role" id="edit_role">
              <option value="admin">Admin</option>
              <option value="user">User</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="editAccountBtn" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Admin Profile</h6>
      <div class="controll-btn">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
          <i class="fas fa-user-plus"></i>
        </button>
      </div>

    </div>

    <div class="card-body">
      <div class="table-responsive">
        <?php
        ?>
        <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th> ID </th>
              <th> Username </th>
              <th>Email </th>
              <th>Password</th>
              <th>Role</th>
              <th>EDIT </th>
              <th>DELETE </th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (mysqli_num_rows($data["user"]) > 0) {
              $counter = 1; 
              while ($row = mysqli_fetch_array($data["user"])) {
            ?>
                <tr>
                  <td><?php echo $counter++; ?></td>
                  <td><?php echo $row['username']; ?></td>
                  <td><?php echo $row['email']; ?></td>
                  <td><?php echo substr($row['password'], 0, 10); ?></td>
                  <td><?php echo $row['role']; ?></td>
                  <td>
                    <form action="getAccountById" method="POST">
                      <input type="hidden" name="edit_id" class="edit_id" value="<?php echo $row['id']; ?>">
                      <button href="#" type="button" name="edit_btn" class="btn btn-warning edit_btn" data-toggle="modal" data-target="#editadminprofile"> <i class="fas fa-edit"></i> </i></i></button>
                    </form>
                  </td>
                  <td>
                    <form action="deleteAccount" method="POST">
                      <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                      <button type="submit" name="delete_btn" class="btn btn-danger"> <i class="fas fa-trash"></i></button>
                    </form>
                  </td>
                </tr>
            <?php
              }
            }
            ?>
          </tbody>
        </table>

      </div>
    </div>
  </div>

  <script>
    $(document).ready(function() {
      $('.edit_btn').click(function(e) {
        e.preventDefault();

        var account_id = $(this).closest('tr').find('.edit_id').val();

        // console.log(account_id);

        $.ajax({
          type: "POST",
          url: 'Account/getAccountById/' + account_id,
          data: {
            'checking_edit_btn': true,
            'account_id': account_id,
          },
          success: function(response) {
            // console.log(response);
            $.each(response, function(key, value) {
              $('#edit_id').val(value['id']);
              $('#edit_username').val(value['username']);
              $('#edit_email').val(value['email']);
              $('#edit_role').val(value['role']);
            });
            $('#editadminprofile').modal('show');
          }
        });
      });

    });
  </script>