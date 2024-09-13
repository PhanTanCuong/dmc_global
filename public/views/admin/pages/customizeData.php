<div class="modal fade" id="addDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addDataModalLabel">Data Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="addData" method="POST" enctype="multipart/form-data">

        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" name="selected_radio_option" id="selected_radio_option" value="">
            <label> Title </label>
            <textarea name="data_title" id="data_title" class="form-control" placeholder="Enter Title"
              rows="2"></textarea>
          </div>
          <div class="form-group">
            <label>Description</label>
            <textarea name="data_description" id="data_description" class="form-control" placeholder="Enter Description"
              rows="4"></textarea>
          </div>
          <div class="form-group">
            <label>Upload Image </label>
            <input type="file" name="data_image" id="data_image" class="form-contfooterrol" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="addDataBtn" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>
<div class="modal fade" id="editData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="customizeData" id="customizeData" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" name="edit_id" id="edit_id">
            <label> Title </label>
            <textarea name="edit_title" id="edit_title" class="form-control" placeholder="Enter Title"
              rows="2"></textarea>
          </div>
          <div class="form-group">
            <label>Description</label>
            <textarea name="edit_description" id="edit_description" class="form-control" placeholder="Enter Description"
              rows="4"></textarea>
          </div>
          <div class="form-group">
            <label>Current Image</label><br>
            <img <?php
            $selected_option = isset($_GET['radio_option']) ? $_GET['radio_option'] : '3';
            if ($selected_option == 6) {
              echo 'class="icon"';
            }
            ?> id="current_image" src="/dmc_global/public/images/"
              alt="Img"><br>
            <span id="current_file">Current file: </span>
          </div>
          <div class="form-group">
            <label>Upload Image </label>
            <input type="file" name="data_image" id="data_image" class="form-contfooterrol">
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
  <div class="row">
    <!-- Sidebar -->
    <div class="col-md-2">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Menu</h6>
        </div>
        <?php
        if (mysqli_num_rows($data["product_categories"]) > 0) {
          while ($row = mysqli_fetch_array($data["product_categories"])) {
            ?>
            <form action="Data" method="GET">
              <input type="hidden" name="product_category_id" value="<?= $row['id']; ?>">
              <button type="submit" class="list-group-item list-group-item-action">
                <?= $row['name']; ?>
              </button>
            </form>
            <?php
          }
        }
        ?>
      </div>
    </div>

    <!-- Main Content -->
    <div class="col-md-10">
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">List of data</h6>
          <div class="controll-btn">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addDataModal">
              <i class="fas fa-plus"> Add data</i>
            </button>
            <form action="Data" method="GET">
              <div class="form-group" style="display: flex; gap: 10px; align-items: center;">
                <input type="radio" name="radio_option" value="3" <?= ($data['radio_button'] == '3') ? 'checked' : ''; ?>
                  onclick="this.form.submit();"> About2
                <input type="radio" name="radio_option" value="4" <?= ($data['radio_button'] == '4') ? 'checked' : ''; ?>
                  onclick="this.form.submit();"> About3
                <input type="radio" name="radio_option" value="5" <?= ($data['radio_button'] == '5') ? 'checked' : ''; ?>
                  onclick="this.form.submit();"> Product1
                <input type="radio" name="radio_option" value="6" <?= ($data['radio_button'] == '6') ? 'checked' : ''; ?>
                  onclick="this.form.submit();"> Stat
              </div>
            </form>
          </div>
        </div>

        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="50%" cellspacing="0">
              <thead>
                <tr>
                  <th> No. </th>
                  <th> Title</th>
                  <th> Description </th>
                  <th> Background</th>
                  <th> Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (mysqli_num_rows($data["item"]) > 0) {
                  $counter = 1;
                  while ($row = mysqli_fetch_array($data["item"])) {
                    ?>
                    <tr>
                      <td><?= $counter++; ?></td>
                      <td><?= $row['title'] ?></td>
                      <td><?= substr($row['description'], 0, 200) . '...' ?></td>
                      <td><?php
                      $selected_option = isset($_GET['radio_option']) ? $_GET['radio_option'] : 3;
                      if ($selected_option == 6) {
                        echo '<img class="icon" src="/dmc_global/public/images/' . $row['image'] . '" alt="Img">';
                      }
                      echo '<img src="/dmc_global/public/images/' . $row['image'] . '" alt="Img">';
                      ?></td>
                      <td>
                        <div class="action_column">
                          <form action="getDataById" method="POST">
                            <input type="hidden" name="edit_id" class="edit_id" value="<?= $row['id']; ?>">
                            <button href="#" type="button" name="edit_btn" class="btn btn-warning edit_btn"
                              data-toggle="modal" data-target="#editData"> <i class="fas fa-edit"></i> </i></button>
                          </form>
                          <form action="deleteData" method="POST">
                            <input type="hidden" name="delete_id" value="<?= $row['id']; ?>">
                            <button type="submit" name="delete_btn" class="btn btn-danger"> <i
                                class="fas fa-trash"></i></button>
                          </form>
                        </div>
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
    </div>
  </div>
</div>


<script src="/dmc_global/public/js/admin/checkImageFiles.js">
  setupFormValidation('customizeData', ['data_image']);
</script>
<script>
  $(document).ready(function () {
    $('.edit_btn').click(function (e) {
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
        success: function (response) {
          // console.log(response);
          $.each(response, function (key, value) {
            $('#edit_id').val(value['id']);
            $('#edit_title').val(value['title']);
            $('#edit_description').val(value['description']);
            $('#current_image').attr('src', '/dmc_global/public/images/' + value['image']);
            $('#current_file').text('Current file:' + value['image']);
          });
          $('#editData').modal('show');
        }
      });
    });

  });
</script>
<script>
  $(document).ready(function () {
    $('#addDataModal').on('show.bs.modal', function (e) {
      // Set the selected radio option in the hidden input
      var selectedOption = $('input[name="radio_option"]:checked').val();
      $('#selected_radio_option').val(selectedOption);
    });
  });
</script>