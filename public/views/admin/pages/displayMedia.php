<div class="modal fade" id="editnewsprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Product Information </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- enctype="multipart/form-data": Thuộc tính phải có để uplaod hoặc fetch dữ liệu dạng file(Ảnh) -->
      <form action="editNews" method="POST" enctype="multipart/form-data">

        <div class="modal-body">
          <input type="hidden" name="edit_news_id" id="edit_id">
          <div class="form-group">
            <label> Title </label>
            <input type="text" name="news_title" id="edit_title" class="form-control" placeholder="Enter Title"
              required>
          </div>
          <div class="form-group">
            <label>Description</label>
            <input type="text" name="news_description" id="edit_description" class="form-control"
              placeholder="Enter Description" required>
          </div>
          <div class="form-group">
            <label>Current Image</label><br>
            <img id="news_current_image" src="/dmc_global/public/images/" width="50%" height="auto"
              alt="Product Img"><br>
            <span id="current_file">Current file: </span>
          </div>
          <div class="form-group">
            <label>Image </label>
            <input type="file" name="news_image" id="edit_img" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="news_updatebtn" class="btn btn-primary">Save</button>
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
          <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addnewsinfor">
            <i class="fas fa-plus"></i>
          </button> -->
          <a href="News/Add" class="btn btn-primary"><i class="fas fa-plus"></i></a>
          <form action="multipleDeleteNews" method="POST">
            <button type="submit" name="delete-multiple-data" class="btn btn-danger"><i
                class="fas fa-trash"></i></button>
          </form>
        </div>
      </h6>

    </div>

    <div class="card-body">
      <div class="table-responsive">
        <?php
        ?>
        <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <!-- <th>Check</th> -->
              <th>ID</th>
              <th>Title</th>
              <th>Description</th>
              <th>Image</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (mysqli_num_rows($data["news"]) > 0):
              $counter = 1;
              while ($row = mysqli_fetch_array($data["news"])):
                ?>
                <tr>
                  <!-- <td>
                    <input type="checkbox" onclick="toggleCheckbox(this,'../Admin/toggleCheckboxDelete/')" value="<?= $row['id'] ?>
                    <?= $row['visible'] === 1 ? "checked" : "" ?>"> -->
                  </td>
                  <td><?= $counter++; ?></td>
                  <td><?= $row['title']; ?></td>
                  <td><?= $row['description']; ?></td>
                  <td>
                    <?= '<img src="/dmc_global/public/images/' . $row['image'] . '"alt="Product Img">' ?>
                  </td>
                  <td>
                    <div class="action_column">
                      <form action="getNewsById" method="POST">
                        <input type="hidden" name="edit_id" class="edit_id" value="<?= $row['id']; ?>">
                        <a href="News/Update" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                      </form>
                      <form action="deleteNews" method="POST">
                        <input type="hidden" name="delete_news_id" value="<?= $row['id']; ?>">
                        <button type="submit" name="delete_news_btn" class="btn btn-danger"> <i
                            class="fas fa-trash"></i></button>
                      </form>
                    </div>

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

  <script src="../public/js/admin/checkbox.js"></script>
  <script>
    $(document).ready(function () {
      $('.edit_btn').click(function (e) {
        e.preventDefault();

        var news_id = $(this).closest('tr').find('.edit_id').val();

        // console.log(news_id);

        $.ajax({
          type: "POST",
          url: 'News/getNewsById/' + news_id,
          data: {
            'checking_edit_btn': true,
            'news_id': news_id,
          },
          success: function (response) {
            console.log(response);
            $.each(response, function (key, value) {
              $('#edit_id').val(value['id']);
              $('#edit_title').val(value['title']);
              $('#edit_description').val(value['description']);
              $('#edit_link').val(value['link']);
              $('#news_current_image').attr('src', '/dmc_global/public/images/' + value['image']);
              $('#current_file').text('Current file:' + value['image']);
            });
            $('#editproductprofile').modal('show');
          }
        });
      });

    });
  </script>