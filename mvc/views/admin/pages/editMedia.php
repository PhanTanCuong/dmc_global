<div class="container-fluid">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="color:#4a6fdc;text-transform: uppercase;font-weight: 600;">Edit user account</h5>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4" style="padding: 2em 0;">
        <?php
        //Edit account button

        if (isset($_POST['display_news_infor_btn'])) {

            $id = $_POST['edit_news_id'];


            foreach ($data["news"] as $row) {
        ?>

                <form action="editNews" method="POST"enctype="multipart/form-data">
                    <div class="card-body">
                        <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                        <div class="form-group">
                            <label> Title </label>
                            <input type="text" name="news_title" class="form-control" placeholder="Enter Product Title" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" name="news_description" class="form-control" placeholder="Enter Product Description" required>
                        </div>
                        <div class="form-group">
                            <label> Link </label>
                            <input type="text" name="news_link" class="form-control" placeholder="Enter Product Link" required>
                        </div>
                        <div class="form-group">
                            <label>Image </label>
                            <input type="file" name="news_image" id="news_image" class="form-control" required>
                        </div>
                    </div>

                    <div>
                        <a href="displayNews" class="btn btn-danger" style="margin-left: 20px;">Cancel</a>
                        <button type="submit" name="news_updatebtn" class="btn btn-primary">Update</button>
                    </div>
                </form>
        <?php
            }
        }
        ?>

    </div>
</div>