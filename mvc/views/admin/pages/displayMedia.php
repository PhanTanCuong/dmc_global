<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">List of blogs</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="addNews" method="POST" enctype="multipart/form-data">

        <div class="modal-body">

          <div class="form-group">
            <label> Title </label>
            <input type="text" name="news_title" class="form-control" placeholder="Enter Title" required>
          </div>
          <div class="form-group">
            <label>Description</label>
            <input type="text" name="news_description" class="form-control" placeholder="Enter Description" required>
          </div>
          <div class="form-group">
            <label>Link</label>
            <input type="text" name="news_link" class="form-control" placeholder="Enter Link" required>
          </div>
          <div class="form-group">
            <label>Image </label>
            <input type="file" name="news_image" id="news_image" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="addNewsBtn" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">List of blogs
        <div class="controll-btn">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
            Add new blog
          </button>
          <form action="multipleDeleteNews" method="POST">
            <button type="submit" name="delete-multiple-data" class="btn btn-danger">Delete</button>
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
              <th>Check</th>
              <th>ID</th>
              <th>Title</th>
              <th>Description</th>
              <th>Link</th>
              <th>Image</th>
              <th>EDIT</th>
              <th>DELETE </th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (mysqli_num_rows($data["news"]) > 0) {
              $counter = 1; // Initialize the counter for the sequential ID
              while ($row = mysqli_fetch_array($data["news"])) {
            ?>
                <tr>
                  <td>
                    <input type="checkbox" onclick="toggleCheckbox(this)" value="<?php echo $row['id'] ?>
                    <?php echo $row['visible'] === 1 ? "checked" : "" ?>">
                  </td>
                  <td><?php echo $counter++; ?></td>
                  <td><?php echo $row['title']; ?></td>
                  <td><?php echo $row['description']; ?></td>
                  <td><?php echo $row['link']; ?></td>
                  <td><?php echo '<img src="/dmc_global/mvc/uploads/' . $row['image'] . '" width="200px" height="200px" alt="Product Img">' ?></td>
                  <td>
                    <form action="displayDetailNews" method="POST">
                      <input type="hidden" name="edit_news_id" value="<?php echo $row['id']; ?>">
                      <button type="submit" name="display_news_infor_btn" class="btn btn-success"> EDIT</button>
                    </form>
                  </td>
                  <td>
                    <form action="deleteNews" method="POST">
                      <input type="hidden" name="delete_news_id" value="<?php echo $row['id']; ?>">
                      <button type="submit" name="delete_news_btn" class="btn btn-danger"> DELETE</button>
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
    function toggleCheckbox(box) {
      var id = $(box).attr("value");

      if ($(box).prop("checked") === true) {
        var visible = 1;
      } else {
        var visible = 0;
      }

      var data = {
        "search_data": 1,
        "id": id,
        "visible": visible
      };

      $.ajax({
        type: "post", //method
        url: "../Media/toggleCheckboxDelete", //URL to your controller
        data: data,
        success: function(response) {
          // alert("Data Checked");
        }
      });
    }
  </script>