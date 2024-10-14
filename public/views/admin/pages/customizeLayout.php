<style>
  .col-md-3 :is(.form-group) {
    padding: 10px 20px 0;
  }
</style>
<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <div class="col-md-3">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Layout</h6>
        </div>
        <form id="layout-form" action="layout" method="GET">
          <div class="form-group">
            <label for="page">Page</label>
            <select name="page" id="page-selector" class="form-control">
              <?php foreach ($data["selected_page"] as $page): ?>
                <option value="<?= $page["id"] ?>" <?= (isset($_GET['page']) && $_GET['page'] == $page["id"]) ? 'selected' : '' ?>>
                  <?= str_repeat('|---', $page["level"]) . $page["name"] ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div id="layout-container" class="form-group">
            <label for="layout">Layout</label>
            <select name="layout" id="layout-selector" class="form-control">
              <?php if (mysqli_num_rows($data["layout"]) > 0): ?>
                <?php while ($row = mysqli_fetch_array($data["layout"])): ?>
                  <option value="<?= $row["block_id"] ?>" <?= (isset($_GET['layout']) && $_GET['layout'] == $row["block_id"]) ? 'selected' : '' ?>><?= $row["name"] ?></option>
                <?php endwhile; ?>
              <?php endif; ?>
            </select>
          </div>
          <!-- Submit Button -->
          <button type="submit" class="btn btn-primary" style="margin: 0 20px 10px;">Submit</button>
        </form>

        <div id="response-container"></div>

        <!-- <button class="btn btn-add btn-primary"><i class="fas fa-plus"></i></button> -->
      </div>
    </div>

    <!-- Main Content -->
    <div class="col-md-9">
      <!-- Basic continer -->
      <form action="addContent" method="POST" enctype="multipart/form-data">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary">
              Content
            </h3>
          </div>
          <div class="card-body">
            <!-- Title Field -->
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
            </div>

            <!-- Description Field -->
            <div class="form-group">
              <label for="description">Description</label>
              <textarea class="form-control" id="description" name="description" rows="3"
                placeholder="Enter description"></textarea>
            </div>

            <!-- Image Field -->
            <div class="form-group">
              <label for="image">Image</label>
              <input type="file" class="form-control-file" id="image" name="image">
            </div>
            <!-- Submit Button -->
            <button name="addContentBtn" type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </form>

      <!-- Button container -->
      <form action="addContent" method="POST" enctype="multipart/form-data">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary">Button Container</h3>
          </div>
          <div class="card-body">
            <!-- Button Name Field -->
            <div class="form-group">
              <label for="button_name">Button Name</label>
              <input type="text" class="form-control" id="button_name" name="button" placeholder="Enter button name">
            </div>

            <!-- Button Link Field -->
            <div class="form-group">
              <label for="button_link">Button Link</label>
              <input type="url" class="form-control" id="button_link" name="link" placeholder="Enter button link">
            </div>

            <!-- Submit Button -->
            <button name="addContentBtn" type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </form>

      <!-- Icon Container -->
      <form action="addContent" method="POST" enctype="multipart/form-data">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary">Icon Container</h3>
          </div>
          <div class="card-body">
            <!-- Title Field -->
            <div class="form-group">
              <label for="image_title">Title</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
            </div>

            <!-- Subtitle Field -->
            <div class="form-group">
              <label for="image_subtitle">Subtitle</label>
              <input type="text" class="form-control" id="subtitle" name="subtitle" placeholder="Enter subtitle">
            </div>

            <!-- Image Field -->
            <div class="form-group">
              <label for="image_file">Image</label>
              <input type="file" class="form-control-file" id="link" name="image">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </form>

    </div>

  </div>
</div>
</div>


<script>
  $(document).ready(function () {
    // Function to add a new option
    // $(".btn-add").click(function () {
    //   const newOption = `
    //            <a class="list-group-item list-group-item-action"></a>`;
    //   $('#layout-container').append(newOption);
    // });

    // Function to remove an option
    // $(document).on("click", ".btn-remove", function () {
    //   $(this).closest('.option-item').remove();
    // });



  });
</script>