<div class="container-fluid">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="color:#4a6fdc;text-transform: uppercase;font-weight: 600;">Edit user account</h5>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4" style="padding: 2em 0;">
        <?php
        //Edit account button

        if (isset($_POST['display_news_infor_btn'])) {



            foreach ($data["news"] as $row) {
        ?>

                <form action="editNews" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                        <input type="hidden" name="edit_news_id" value="<?php echo $row['id']; ?>">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="news_title" value="<?php echo $row['title']; ?>" class="form-control" placeholder="Enter username">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" name="news_description" value="<?php echo $row['description']; ?>" class="form-control" placeholder="Enter username">
                        </div>
                        <div class="form-group">
                            <label>Link</label>
                            <input type="text" name="news_link" value="<?php echo $row['link']; ?>" class="form-control" placeholder="Enter username">
                        </div>
                        <div class="form-group">
                            <label>Current Image</label><br>
                            <img src="/dmc_global/mvc/uploads/<?php echo $row['image']; ?>" width="300px" height="300px" alt="Product Img"><br>
                            <span>Current file: <?php echo $row['image']; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="news_image" id="news_image" class="form-control" placeholder="Enter username">
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