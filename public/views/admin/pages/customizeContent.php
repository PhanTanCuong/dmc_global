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

        foreach ($data["about2"] as $row) {
        ?>

            <form action="customizeAbout2" method="POST" enctype="multipart/form-data">
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
                        <img src="/dmc_global/mvc/uploads/<?php echo $row['parent_image']; ?>" width="50%" height="auto" alt="Image"><br>
                        <span>Current file: <?php echo $row['parent_image']; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Upload Image</label>
                        <input type="file" name="about2_parent_image" id="about2_parent_image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Current Image</label><br>
                        <img src="/dmc_global/mvc/uploads/<?php echo $row['child_image']; ?>" width="20%" height="auto" alt="Image"><br>
                        <span>Current file: <?php echo $row['child_image']; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Upload Image</label>
                        <input type="file" name="about2_child_image" id="about2_child_image" class="form-control">
                    </div>
                </div>
                <div>
                    <button type="submit" name="about2_updatebtn" class="btn btn-primary" style="margin-left:20px">Update</button>
                </div>
            </form>
        <?php
        }
        ?>
    </div>
</div>

<div class="container-fluid">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="color:#4a6fdc;text-transform: uppercase;font-weight: 600;">
            Custom Product 1 Information</h5>
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

        foreach ($data["product1"] as $row) {
        ?>

            <form action="customizeSlider" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <label>Title</label>
                        <textarea type="text" name="product1_title" class="form-control" placeholder="Enter Title"><?php echo $row['title']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea type="text" name="product1_description" class="form-control" placeholder="Enter Description"><?php echo $row['description']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Current Background Image</label><br>
                        <img src="/dmc_global/mvc/uploads/<?php echo $row['image']; ?>" width="100%" height="auto" alt="Image"><br>
                        <span>Current file: <?php echo $row['image']; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Upload Background Image</label>
                        <input type="file" name="product1_image" id="product1_image" class="form-control">
                    </div>
                </div>
                <div>
                    <button type="submit" name="product1_updatebtn" class="btn btn-primary" style="margin-left: 20px;">Update</button>
                </div>
            </form>
        <?php
        }
        ?>

    </div>
</div>

