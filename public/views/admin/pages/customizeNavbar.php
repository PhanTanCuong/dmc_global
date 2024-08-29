  <!-- Add new icons form -->
  <div class="modal fade" id="addNavbarItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Navbar Item Information</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <!-- enctype="multipart/form-data": Thuộc tính phải có để uplaod hoặc fetch dữ liệu dạng file(Ảnh) -->
              <form action="addNavBar" method="POST" enctype="multipart/form-data">

                  <div class="modal-body">
                      <div class="form-group">
                          <label>Item</label>
                          <input type="text" name="navbar_name" id="navbar_name" class="form-control" required>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" name="addNavbarItemBtn" class="btn btn-primary">Save</button>
                  </div>
              </form>

          </div>
      </div>
  </div>

  <!-- Edit new icons form -->
  <div class="modal fade" id="editNavbarItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">NavbarItem Information </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <!-- enctype="multipart/form-data": Thuộc tính phải có để uplaod hoặc fetch dữ liệu dạng file(Ảnh) -->
              <form action="customizeNavBar" method="POST" enctype="multipart/form-data">

                  <div class="modal-body">
                      <input type="hidden" name="edit_id" id="edit_id">
                      <div class="form-group">
                          <label>Item</label>
                          <input type="text" name="edit_navbar_name" id="edit_navbar" class="form-control">
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" name="navbar_updatebtn" class="btn btn-primary">Save</button>
                  </div>
              </form>

          </div>
      </div>
  </div>


  <div class="container-fluid">

      <!-- DataTales Example -->
      <div class="card shadow mb-4">
          <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">List of NavBar Items</h6>
              <div class="controll-btn">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNavbarItem">
                      <i class="fas fa-plus"></i>
                  </button>
              </div>
          </div>

          <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>11
                          <tr>
                              <th>No.</th>
                              <th>Item</th>
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
                                      <td><?php echo $row['name']?></td>
                                      <td>
                                          <form action="getNavbarItemById" method="POST">
                                              <input type="hidden" name="edit_id" class="edit_id" value="<?php echo $row['id']; ?>">
                                              <button href="#" type="button" name="edit_btn" class="btn btn-warning edit_btn" data-toggle="modal" data-target="#editNavbarItem"> <i class="fas fa-edit"></i> </i></i></button>
                                          </form>
                                      </td>
                                      <td>
                                          <form action="deleteNavBar" method="POST">
                                              <input type="hidden" name="delete_navbar_id" value="<?php echo $row['id']; ?>">
                                              <button type="submit" name="delete_navbar_btn" class="btn btn-danger"> <i class="fas fa-trash"></i></button>
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

                  var navbar_id = $(this).closest('tr').find('.edit_id').val();

                  // console.log(navbar_id);

                  $.ajax({
                      type: "POST",
                      url: 'NavBar/getNavBarById/' + navbar_id,
                      data: {
                          'checking_edit_btn': true,
                          'navbar_id': navbar_id,
                      },
                      success: function(response) {
                          console.log(response);
                          $.each(response, function(key, value) {
                              $('#edit_id').val(value['id']);
                              $('#edit_navbar').val(value['name']);
                          });
                          $('#editNavbarItem').modal('show');
                      }
                  });
              });

          });
      </script>