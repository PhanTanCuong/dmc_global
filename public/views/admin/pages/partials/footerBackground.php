<div class="container-fluid">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"
            style="color:#4a6fdc;text-transform: uppercase;font-weight: 600;">
            Footer Background
        </h5>
    </div>


    <div class="card shadow mb-4" style="padding: 2em 0;">
        <form action="customizeFooterBackground" method="POST" enctype="multipart/form-data">
            <div class="card-body">
                <?php
                foreach ($data["bg_footer"] as $row) {
                    ?>
                    <div class="form-group">
                        <label>Header</label><br>
                        <label>Current Background Image</label><br>
                        <img src="/dmc_global/public/images/<?= $row['image']; ?>" width="100%" height="auto"
                            alt="Image"><br>
                        <span>Current file: <?= $row['image']; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Upload Background Image</label>
                        <input type="file" name="footer_bg_image" class="form-control">
                    </div>
                    <?php
                }
                ?>
            </div>
            <div>
                <button type="submit" name="footer_bg_updatebtn" class="btn btn-primary"
                    style="margin-left: 20px;">Update</button>
            </div>
        </form>


    </div>
</div>
