<!-- Add new icons form -->
<div class="modal fade" id="addiconsprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Customize Iconss </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- enctype="multipart/form-data": Thuộc tính phải có để uplaod hoặc fetch dữ liệu dạng file(Ảnh) -->
      <form action="addIcons" method="POST" enctype="multipart/form-data">

        <div class="modal-body">
          <div class="form-group">
            <label>Image </label>
            <input type="file" name="icons_image" id="icons_image" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="addIconsBtn" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- Edit new icons form -->
<div class="modal fade" id="editiconsprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Icons Information </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="customizeIcons" method="POST" enctype="multipart/form-data">

        <div class="modal-body">
          <input type="hidden" name="edit_footer_id" id="edit_footer_id">
          <div class="form-group">
            <label>Current Image</label><br>
            <img id="icons_current_image" src="/dmc_global/public/images/" alt="Icons Img"><br>
            <span id="current_file">Current file: </span>
          </div>
          <div class="form-group">
            <label>Image </label>
            <input type="file" name="icons_image" id="edit_img" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="icons_updatebtn" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">
  <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel" style="color:#4a6fdc;text-transform: uppercase;font-weight: 600;">
      Footer Icons
    </h5>
  </div>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">List of icons
        <div class="controll-btn">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addiconsprofile">
            <i class="fas fa-plus"></i>
          </button>
        </div>
      </h6>

    </div>

    <div class="card-body">
      <div class="table-responsive">
        <?php
        ?>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Image</th>
              <th>EDIT</th>
              <th>DELETE </th>
            </tr>
          </thead>
          <tbody class="sortable>
            <?php
            if (mysqli_num_rows($data["footer_icons"]) > 0) :
              $counter = 1;
              while ($row = mysqli_fetch_array($data["footer_icons"])) :
                ?>
                <tr>
                  <td><?php echo $counter++; ?></td>
                  <td>
                    <?php echo '<img class="footer-icon" src="/dmc_global/public/images/' . $row['image'] . '"  alt="Icons Img">' ?>
                  </td>
                  <td>
                    <form action="getIconsById" method="POST">
                      <input type="hidden" name="edit_footer_id" class="edit_footer_id" value="<?php echo $row['id']; ?>">
                      <button href="#" type="button" name="edit_btn" class="btn btn-warning edit_btn" data-toggle="modal"
                        data-target="#editiconsprofile"> <i class="fas fa-edit"></i> </i></i></button>
                    </form>
                  </td>
                  <td>
                    <form action="deleteIcons" method="POST">
                      <input type="hidden" name="delete_icons_id" value="<?php echo $row['id']; ?>">
                      <button type="submit" name="delete_icons_btn" class="btn btn-danger"> <i
                          class="fas fa-trash"></i></button>
                    </form>
                  </td>
                </tr>
                <?php
              endwhile;
            endif;
            ?>
          </tbody>
        </table>

      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function () {
    $('.edit_btn').click(function (e) {
      e.preventDefault();

      var icons_id = $(this).closest('tr').find('.edit_footer_id').val();

      // console.log(icons_id);

      $.ajax({
        type: "POST",
        url: 'Icons/getIconsById/' + icons_id,
        data: {
          'checking_edit_footer_icon_btn': true,
          'icons_id': icons_id,
        },
        success: function (response) {
          console.log(response);
          $.each(response, function (key, value) {
            $('#edit_footer_id').val(value['id']);
            $('#icons_current_image').attr('src', '/dmc_global/public/images/' + value['image']);
            $('#current_file').text('Current file:' + value['image']);
          });
          $('#editiconsprofile').modal('show');
        }
      });
    });

  });
</script>