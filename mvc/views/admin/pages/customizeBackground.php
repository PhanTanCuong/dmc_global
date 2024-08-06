<div class="container-fluid">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="color:#4a6fdc;text-transform: uppercase;font-weight: 600;">
            Custom Banner Information</h5>
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

            <form action="customizeSlider" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <label>Current Background Image</label><br>
                        <img src="/dmc_global/mvc/uploads/" width="100%" height="auto" alt="Image"><br>
                        <span>Current file: </span>
                    </div>
                    <div class="form-group">
                        <label>Upload Background Image</label>
                        <input type="file" name="banner_image" id="banner_image" class="form-control">
                    </div>
                </div>
                <div>
                    <a href="Slider" class="btn btn-danger" style="margin-left: 20px;">Cancel</a>
                    <button type="submit" name="banner_updatebtn" class="btn btn-primary">Update</button>
                </div>
            </form>
        <?php
        }
        ?>

    </div>
</div>