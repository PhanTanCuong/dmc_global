<div class="container-fluid">

    <div class="modal-header banner" style="    justify-content: center;">
        <h5 class="modal-title" id="exampleModalLabel"
            style="color:#4a6fdc;text-transform: uppercase;font-weight: 600;">
            Custom Banner Information</h5>
    </div>
    <div class="information-banner">
        <!-- Sidebar Menu -->
        <div class="col-md-2">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Menu</h6>
                </div>
                <?php
                if (mysqli_num_rows($data["product_categories"]) > 0) {
                    while ($row = mysqli_fetch_array($data["product_categories"])) {
                        $selected_option = isset($_POST['radio_option']) ? $_POST['radio_option'] : '3';
                        ?>
                        <form action="../<?php echo $row['id']; ?>/<?php echo $selected_option ?>" method="POST">
                            <input type="hidden" name="product_category_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="list-group-item list-group-item-action">
                                <?php echo $row['type']; ?>
                            </button>
                        </form>
                        <?php
                    }
                }
                ?>
            </div>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4 col-md-10" style="padding: 2em 0;">
            <div>
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
                                <label>Title</label>
                                <textarea type="text" name="banner_title" class="form-control"
                                    placeholder="Enter Title"><?php echo $row['title']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea type="text" name="banner_description" class="form-control"
                                    placeholder="Enter Description"><?php echo $row['description']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Current Background Image</label><br>
                                <img src="/dmc_global/public/images/<?php echo $row['image']; ?>" width="100%" height="auto"
                                    alt="Image"><br>
                                <span>Current file: <?php echo $row['image']; ?></span>
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
    </div>
</div>