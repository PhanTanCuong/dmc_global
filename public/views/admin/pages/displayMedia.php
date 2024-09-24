<div class="container-fluid">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">List of blogs
        <div class="controll-btn">
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
            <?php if (mysqli_num_rows($data["news"]) > 0): ?>
              <?php $counter = 1;?>
              <?php while ($row = mysqli_fetch_array($data["news"])):?>
                <tr>
                  <!-- <td>
                    <input type="checkbox" onclick="toggleCheckbox(this,'../Admin/toggleCheckboxDelete/')" value="<?= $row['id'] ?>
                      = 1 ? "checked" : "" ?>"> -->
                  </td>
                  <td><?= $counter++; ?></td>
                  <td><?= $row['title']; ?></td>
                  <td><?= $row['description']; ?></td>
                  <td>
                    <?= '<img src="/dmc_global/public/images/' . $row['image'] . '"alt="Product Img">' ?>
                  </td>
                  <td>
                    <div class="action_column">
                      <form action="News/Update" method="POST">
                        <input type="hidden" name="news_id" value="<?= $row['id']; ?>">
                        <button type="submit" name="checking_edit_btn" id="checking_edit_btn" class="btn btn-warning"> <i
                        class="fas fa-edit"></i></button>
                      </form>
                      <form action="deleteNews" method="POST">
                        <input type="hidden" name="delete_news_id" value="<?= $row['id']; ?>">
                        <button type="submit" name="delete_news_btn" class="btn btn-danger"> <i
                            class="fas fa-trash"></i></button>
                      </form>
                    </div>
                  </td>
                </tr>
                <?php endwhile;?>
            <?php endif; ?>
          </tbody>
        </table>

      </div>
    </div>
  </div>

  <!-- <script src="../public/js/admin/checkbox.js"></script> -->