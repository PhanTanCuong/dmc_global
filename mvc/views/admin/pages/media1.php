<div class="container-fluid">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="color:#4a6fdc;text-transform: uppercase;font-weight: 600;">
            Custom News1 Information</h5>
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
        ?>

        <form action="customNews1" method="POST" enctype="multipart/form-data">
            <div class="card-body">
                <?php
                foreach ($data["background"] as $row) {
                ?>
                    <div class="form-group">
                        <label>Current Background Image</label><br>
                        <img src="/dmc_global/mvc/uploads/<?php echo $row['image']; ?>" width="100%" height="auto" alt="Image"><br>
                        <span>Current file: <?php echo $row['image']; ?></span>
                    </div>
                <?php
                }
                ?>
                <div class="form-group">
                    <label>Upload Background Image</label>
                    <input type="file" name="news1_image" id="news_image" class="form-control">
                </div>
                <div class="form-group">
                    <div style="display:flex; gap:1rem;align-items: center;">
                        <label>Icons</label>
                        <button type="button" id="add-icon" class="btn btn-primary mb-2">
                            <i class="fas fa-plus-circle"></i>
                        </button>
                    </div>

                    <div id="icon-list">
                        <?php
                        foreach ($data["icon"] as $rows) {
                        ?>
                            <div class="icon-item">
                                <input type="hidden" name="icon_media_id" value="<?php echo $rows['id']; ?>">
                                <input type="text" name="icon_media_na" value="<?php echo $rows['name']; ?>" placeholder="Enter name" class="form-control mb-2">
                                <input type="text" name="icon_media_value" value="<?php echo $rows['value']; ?>" placeholder="Enter Value" class="form-control mb-2">
                                <label>Upload Icon Image</label>
                                <input type="file" name="icon_media_image" id="icon_media_image" class="form-control">
                                <img src="/dmc_global/mvc/uploads/<?php echo $rows['image']; ?>" style="background-color: #4a6fdc; margin:.5rem 0;" width="100px" height="100px"; alt="Image"><br>
                                <div class="controll-btn">
                                <button type="button" name="delete_ic_btn" class="btn btn-danger remove-icon"><i class="fas fa-trash"></i></button>
                                <button type="button" name="edit_ic_btn" class="btn btn-success remove-icon"><i class="fas fa-edit"></i></button>
                                </div>
                                
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div>
                <a href="displayNews1" class="btn btn-danger" style="margin-left: 20px;">Cancel</a>
                <button type="submit" name="news1_updatebtn" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
    <script src="../public/js/admin/dynamic_input_field.js"></script>