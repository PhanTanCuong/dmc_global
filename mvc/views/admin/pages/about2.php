<div class="container-fluid">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="color:#4a6fdc;text-transform: uppercase;font-weight: 600;">
            Custom About 2 Information</h5>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4" style="padding: 2em 0;">
        <?php
        if (isset($_SESSION['success']) && $_SESSION['success'] != "") {
            echo '<h2 class="bg-primary text-white">' . $_SESSION['success'] . '</h2>';
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['status']) && $_SESSION['status'] != "") {
            echo '<h2 class="bg-danger text-white">' . $_SESSION['status'] . '</h2>';
            unset($_SESSION['status']);
        }

        foreach ($data["item"] as $row) {
        ?>

            <form action="customAbout2" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <label>Title</label>
                        <textarea type="text" name="about2_title" class="form-control" placeholder="Enter Title"><?php echo $row['title']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea type="text" name="about2_description" class="form-control" placeholder="Enter Description"><?php echo $row['description']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Current Image</label><br>
                        <img src="/dmc_global/mvc/uploads/<?php echo $row['image']; ?>" width="300px" height="300px" alt="Image"><br>
                        <span>Current file: <?php echo $row['image']; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="about2_image" id="about2_image" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label>Current Image</label><br>
                        <img src="/dmc_global/mvc/uploads/<?php echo $row['child_image']; ?>" width="300px" height="300px" alt="Image"><br>
                        <span>Current file: <?php echo $row['child_image']; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Child Image</label>
                        <input type="file" name="about2_child_image" id="about2_child_image" class="form-control">
                    </div>

                </div>

                <div>
                    <a href="displayAbout2" class="btn btn-danger" style="margin-left: 20px;">Cancel</a>
                    <button type="submit" name="about2_updatebtn" class="btn btn-primary">Update</button>
                </div>
            </form>
        <?php
        }
        ?>

    </div>
</div>