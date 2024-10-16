<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dynamic Content Management</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .form-group {
      padding: 10px 20px 0;
    }
  </style>
</head>
<body>
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
        </div>
      </div>

      <!-- Main Content -->
      <div class="col-md-9">
        <!-- Combined Form -->
        <form id="combined-form" action="addContent" method="POST" enctype="multipart/form-data">
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h3 class="m-0 font-weight-bold text-primary">Content Management</h3>
            </div>
            <div class="card-body">
              <!-- Content Container -->
              <div class="form-group">
                <input type="checkbox" id="contentContainer"  value="content" data-toggle="collapse" data-target="#contentContainerContent">
                <label for="contentContainer">Include Content Container</label>
              </div>
              <div id="contentContainerContent" class="collapse">
                <!-- Title Field -->
                <div class="form-group">
                  <label for="content_title">Title</label>
                  <input type="text" class="form-control" id="content_title" name="content[title]" placeholder="Enter title">
                </div>

                <!-- Description Field -->
                <div class="form-group">
                  <label for="content_description">Description</label>
                  <textarea class="form-control" id="content_description" name="content[description]" rows="3" placeholder="Enter description"></textarea>
                </div>

                <!-- Image Field -->
                <div class="form-group">
                  <label for="content_image">Image</label>
                  <input type="file" class="form-control-file" id="content_image" name="content[image]">
                </div>
              </div>

              <!-- Button Container -->
              <div class="form-group">
                <input type="checkbox" id="buttonContainer"  value="button" data-toggle="collapse" data-target="#buttonContainerContent">
                <label for="buttonContainer">Include Button Container</label>
              </div>
              <div id="buttonContainerContent" class="collapse">
                <!-- Button Name Field -->
                <div class="form-group">
                  <label for="button_name">Button Name</label>
                  <input type="text" class="form-control" id="button_name" name="button[title]" placeholder="Enter button name">
                </div>

                <!-- Button Link Field -->
                <div class="form-group">
                  <label for="button_link">Button Link</label>
                  <input type="url" class="form-control" id="button_link" name="button[link]" placeholder="Enter button link">
                </div>
              </div>

              <!-- Icon Container -->
              <div class="form-group">
                <input type="checkbox" id="iconContainer"  value="icon" data-toggle="collapse" data-target="#iconContainerContent">
                <label for="iconContainer">Include Icon Container</label>
              </div>
              <div id="iconContainerContent" class="collapse">
                <!-- Title Field -->
                <div class="form-group">
                  <label for="icon_title">Title</label>
                  <input type="text" class="form-control" id="icon_title" name="icon[title]" placeholder="Enter title">
                </div>

                <!-- Subtitle Field -->
                <div class="form-group">
                  <label for="icon_subtitle">Subtitle</label>
                  <input type="text" class="form-control" id="icon_subtitle" name="icon[subtitle]" placeholder="Enter subtitle">
                </div>

                <!-- Image Field -->
                <div class="form-group">
                  <label for="icon_image">Image</label>
                  <input type="file" class="form-control-file" id="icon_image" name="icon[image]">
                </div>
              </div>

              <!-- Submit Button -->
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- jQuery và Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

  <!-- AJAX Script -->
  <script>
    $(document).ready(function() {
      $('#combined-form').on('submit', function(e) {
        e.preventDefault();

        // Tạo đối tượng FormData để bao gồm cả file
        var formData = new FormData(this);

        $.ajax({
          url: $(this).attr('action'),
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            if (response.success) {
              
              // Có thể reset form hoặc cập nhật UI tùy ý
              $('#combined-form')[0].reset();
              $('.collapse').collapse('hide');
            } else {
              alert(response.message);
            }
          },
          error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert('Có lỗi xảy ra khi gửi dữ liệu.');
          }
        });
      });
    });
  </script>
</body>
</html>
