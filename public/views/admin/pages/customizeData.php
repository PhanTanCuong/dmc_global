<div class="modal fade" id="editData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="customizeData" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" name="edit_id" id="edit_id">
            <label> Title </label>
            <input type="text" name="edit_title" id="edit_title" class="form-control" placeholder="Enter Title">
          </div>
          <div class="form-group">
            <label>Description</label>
            <input type="text" name="edit_description" id="edit_description" class="form-control" placeholder="Enter Description">
          </div>
          <div class="form-group">
            <label>Current Image</label><br>
            <img id="current_image" src="/dmc_global/mvc/uploads/" width="50%" height="auto" alt="Img"><br>
            <span id="current_file">Current file: </span>
          </div>
          <div class="form-group">
            <label>Upload Image </label>
            <input type="file" name="data_image"  class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="editDataBtn" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">List of data</h6>
    </div>

    <div class="card-body">
      <?php

      if (isset($_SESSION['success']) && $_SESSION['success'] != "") {
        echo '<h2 class="bg-primary text-white">' . $_SESSION['success'] . '</h2>';
        unset($_SESSION['success']);
      }
      if (isset($_SESSION['status']) && $_SESSION['status'] != "") {
        echo '<h2 class="bg-danger text-white">' . $_SESSION['status'] . '</h2>';
        unset($_SESSION['status']);
      }
      ?>

      <form action="Data" method="POST">
        <div class="form-group" style="display: flex;gap: 10px;align-items: center;">
          <input type="radio" name="radio_option" value="3" onclick="this.form.submit();"> About2
          <input type="radio" name="radio_option" value="4" onclick="this.form.submit();"> About3
          <input type="radio" name="radio_option" value="5" onclick="this.form.submit();"> Product1
          <input type="radio" name="radio_option" value="6" onclick="this.form.submit();"> Stat
        </div>
      </form>

      <div class="table-responsive">
        <?php
        ?>
        <table class="table table-bordered" id="dataTable" width="50%" cellspacing="0">
          <thead>
            <tr>
              <th> No. </th>
              <th> Title</th>
              <th> Description </th>
              <th> Background</th>
              <th> EDIT </th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (mysqli_num_rows($data["item"]) > 0) {
              $counter = 1; // Initialize the counter for the sequential ID
              while ($row = mysqli_fetch_array($data["item"])) {
            ?>
                <tr>
                  <td><?php echo $counter++; ?></td>
                  <td><?php echo $row['title'] ?></td>
                  <td><?php echo $row['description'] ?></td>
                  <td><?php echo '<img src="/dmc_global/mvc/uploads/' . $row['image'] . '" width="100%" height="auto" alt="Img">' ?></td>
                  <td>
                    <form action="getDataById" method="POST">
                      <input type="hidden" name="edit_id" class="edit_id" value="<?php echo $row['id']; ?>">
                      <button href="#" type="button" name="edit_btn" class="btn btn-warning edit_btn" data-toggle="modal" data-target="#editData"> <i class="fas fa-edit"></i> </i></i></button>
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
          url: 'Data/getDataById/' + account_id,
          data: {
            'checking_edit_btn': true,
            'data_id': account_id,
          },
          success: function(response) {
            // console.log(response);
            $.each(response, function(key, value) {
              $('#edit_id').val(value['id']);
              $('#edit_title').val(value['title']);
              $('#edit_description').val(value['description']);
              $('#current_image').attr('src', '/dmc_global/mvc/uploads/' + value['image']);
              $('#current_file').text('Current file:' + value['image']);
            });
            $('#editData').modal('show');
          }
        });
      });

    });
  </script>