

var icon_container = `
  <!-- Icon Container -->
      <form action="addContent" method="POST" enctype="multipart/form-data" class="add-content">
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
            <div class="form-group ">
              <label for="image_subtitle">Subtitle</label>
              <div class="d-flex"> <input type="text" class="form-control rounded-start" id="subtitle" name="subtitle"
                  placeholder="Enter subtitle">
                <button type="button" id="duplicate-field-btn" class="btn btn-primary !   rounded-end"><i
                    class="fas fa-plus-circle"></i></button>
              </div>
            </div>

            <div id="subtext_field"></div>
            
            <!-- Image Field -->
            <div class="form-group">
              <label for="image_file">Image</label>
              <input type="file" class="form-control-file" id="image" name="image">
            </div>

            <!-- Submit Button -->
            <button name="IconContainer" type="submit" class="btn btn-primary btn-add">Submit</button>
          </div>
        </div>
      </form>
`;


