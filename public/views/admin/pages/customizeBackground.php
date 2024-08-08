  <!-- Add new background form -->
  <div class="modal fade" id="addbackgroundprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Customize Backgrounds </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- enctype="multipart/form-data": Thuộc tính phải có để uplaod hoặc fetch dữ liệu dạng file(Ảnh) -->
        <form action="addBackground" method="POST" enctype="multipart/form-data">

          <div class="modal-body">
            <div class="form-group">
              <label>Image </label>
              <input type="file" name="background_image" id="background_image" class="form-control" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="addBackgroundBtn" class="btn btn-primary">Save</button>
          </div>
        </form>

      </div>
    </div>
  </div>

  <!-- Edit new background form -->
  <div class="modal fade" id="editbackgroundprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Background Information </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- enctype="multipart/form-data": Thuộc tính phải có để uplaod hoặc fetch dữ liệu dạng file(Ảnh) -->
        <form action="customizeBackground" method="POST" enctype="multipart/form-data">

          <div class="modal-body">
            <input type="hidden" name="edit_id" id="edit_id">
            <div class="form-group">
              <label>Current Image</label><br>
              <img id="background_current_image" src="/dmc_global/mvc/uploads/" width="50%" height="auto" alt="Background Img"><br>
              <span id="current_file">Current file: </span>
            </div>
            <div class="form-group">
              <label>Image </label>
              <input type="file" name="background_image" id="edit_img" class="form-control">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="background_updatebtn" class="btn btn-primary">Save</button>
          </div>
        </form>

      </div>
    </div>
  </div>


  <div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">List of backgrounds
          <div class="controll-btn">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addbackgroundprofile">
              <i class="fas fa-plus"></i>
            </button>
            <form action="multipleDeleteBackground" method="POST">
              <button type="submit" name="delete-multiple-data" class="btn btn-danger"><i class="fas fa-trash"></i></button>
            </form>
          </div>
        </h6>

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
        <div class="table-responsive">
          <?php
          ?>
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Image</th>
                <th>EDIT</th>
                <th>DELETE </th>
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
                    <td></td>
                    <td class="image-title" style="text-align:right;"><?php echo '<img src="/dmc_global/mvc/uploads/' . $row['image'] . '" width="50%" height="auto" alt="Background Img">' ?></td>
                    <td>
                      <form action="getBackgroundById" method="POST">
                        <input type="hidden" name="edit_id" class="edit_id" value="<?php echo $row['id']; ?>">
                        <button href="#" type="button" name="edit_btn" class="btn btn-warning edit_btn" data-toggle="modal" data-target="#editbackgroundprofile"> <i class="fas fa-edit"></i> </i></i></button>
                      </form>
                    </td>
                    <td>
                      <form action="deleteBackground" method="POST">
                        <input type="hidden" name="delete_background_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="delete_background_btn" class="btn btn-danger"> <i class="fas fa-trash"></i></button>
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

          var background_id = $(this).closest('tr').find('.edit_id').val();

          // console.log(background_id);

          $.ajax({
            type: "POST",
            url: 'Background/getBackgroundById/' + background_id,
            data: {
              'checking_edit_btn': true,
              'background_id': background_id,
            },
            success: function(response) {
              console.log(response);
              $.each(response, function(key, value) {
                $('#edit_id').val(value['id']);
                $('#background_current_image').attr('src', '/dmc_global/mvc/uploads/' + value['image']);
                $('#current_file').text('Current file:' + value['image']);
              });
              $('#editbackgroundprofile').modal('show');
            }
          });
        });

      });
    </script>