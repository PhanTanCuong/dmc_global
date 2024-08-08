  <!-- Add new icons form -->
  <div class="modal fade" id="addChildNav" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Customize ChildNavInfors </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <!-- enctype="multipart/form-data": Thuộc tính phải có để uplaod hoặc fetch dữ liệu dạng file(Ảnh) -->
              <form action="addChildNavBar" method="POST" enctype="multipart/form-data">

                  <div class="modal-body">
                      <div class="form-group">
                          <label>Item</label>
                          <input type="text" name="child_nav_name" id="child_nav_name" class="form-control" required>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" name="addChildNavInforBtn" class="btn btn-primary">Save</button>
                  </div>
              </form>

          </div>
      </div>
  </div>

  <!-- Edit new icons form -->
  <div class="modal fade" id="editChildNav" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">ChildNavInfor Information </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <!-- enctype="multipart/form-data": Thuộc tính phải có để uplaod hoặc fetch dữ liệu dạng file(Ảnh) -->
              <form action="customizeChildNavInfor" method="POST" enctype="multipart/form-data">

                  <div class="modal-body">
                      <input type="hidden" name="edit_id" id="edit_id">
                      <div class="form-group">
                          <label>Item</label>
                          <input type="text" name="child_nav_name" id="edit_name" class="form-control">
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" name="child_nav_updatebtn" class="btn btn-primary">Save</button>
                  </div>
              </form>

          </div>
      </div>
  </div>


  <div class="container-fluid">

      <!-- DataTales Example -->
      <div class="card shadow mb-4">
          <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">List of Navbar Children</h6>
              <div class="controll-btn">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addChildNav">
                      <i class="fas fa-plus"></i>
                  </button>
              </div>

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
                              <th>No.</th>
                              <th>Location</th>
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
                                      <td></td>
                                      <td><?php echo $row['name']?></td>
                                      <td>
                                          <form action="getChildNavInforById" method="POST">
                                              <input type="hidden" name="edit_id" class="edit_id" value="<?php echo $row['id']; ?>">
                                              <button href="#" type="button" name="edit_btn" class="btn btn-warning edit_btn" data-toggle="modal" data-target="#editChildNav"> <i class="fas fa-edit"></i> </i></i></button>
                                          </form>
                                      </td>
                                      <td>
                                          <form action="deleteChildNavInfor" method="POST">
                                              <input type="hidden" name="delete_child_nav_id" value="<?php echo $row['id']; ?>">
                                              <button type="submit" name="delete_child_nav_btn" class="btn btn-danger"> <i class="fas fa-trash"></i></button>
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

                  var child_nav_id = $(this).closest('tr').find('.edit_id').val();

                  // console.log(child_nav_id);

                  $.ajax({
                      type: "POST",
                      url: 'ChildNavInfor/getChildNavInforById/' + child_nav_id,
                      data: {
                          'checking_edit_btn': true,
                          'child_nav_id': child_nav_id,
                      },
                      success: function(response) {
                          console.log(response);
                          $.each(response, function(key, value) {
                              $('#edit_id').val(value['id']);
                              $('#edit_name').val(value['name']);
                            
                          });
                          $('#editChildNav').modal('show');
                      }
                  });
              });

          });
      </script>