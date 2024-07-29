


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

        foreach ($data["item"] as $row) {
        ?>

            <form action="customNews1" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <label>Current Background Image</label><br>
                        <img src="/dmc_global/mvc/uploads/<?php echo $row['image']; ?>" width="100%" height="auto" alt="Image"><br>
                        <span>Current file: <?php echo $row['image']; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Upload Background Image</label>
                        <input type="file" name="news_image" id="news_image" class="form-control">
                    </div>
                    <div class="form-group">
                        <div style="display:flex; gap:1rem;align-items: center;">
                            <label>Icons</label>
                            <button type="button" id="add-icon" class="btn btn-primary mb-2">
                                <i class="fas fa-plus-circle"></i>
                            </button>
                        </div>

                        <div id="icon-list">
                            <div class="icon-item">
                                <input type="text" name="icons[][name]" placeholder="Icon Name" class="form-control mb-2">
                                <input type="text" name="icons[][value]"  placeholder="Icon Value" class="form-control mb-2">
                                <input type="text" name="icons[][icon]" placeholder="Icon Class" class="form-control mb-2">
                                <button type="button" class="btn btn-danger remove-icon"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div>   
                    <a href="displayNews1" class="btn btn-danger" style="margin-left: 20px;">Cancel</a>
                    <button type="submit" name="news_updatebtn" class="btn btn-primary">Update</button>
                </div>
            </form>
        <?php
        }
        ?>

    </div>
<script src="../public/js/admin/dynamic_input_field.js"></script>