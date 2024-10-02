<!-- Head Logo -->
<div class="container-fluid">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"
            style="color:#4a6fdc;text-transform: uppercase;font-weight: 600;">
            Header Logo
        </h5>
    </div>


    <div class="card shadow mb-4" style="padding: 2em 0;">
        <form action="customizeLogo" method="POST" enctype="multipart/form-data">
            <div class="card-body">
                <?php
                foreach ($data["header_icon"] as $row) {
                    ?>
                    <div class="form-group">
                        <label>Current Background Image</label><br>
                        <img class="icon_logo" src="/dmc_global/public/images/<?= $row['image']; ?>" width="100%"
                            height="auto" alt="Image"><br>
                        <span>Current file: <?= $row['image']; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Upload Background Image</label>
                        <input type="file" name="header_icon" class="form-control">
                    </div>
                    <?php
                }
                ?>
            </div>
            <div>
                <button type="submit" name="head_logo_updatebtn" class="btn btn-primary"
                    style="margin-left: 20px;">Update</button>
            </div>
        </form>


    </div>
</div>

<!-- Footer logo -->
<div class="container-fluid">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"
            style="color:#4a6fdc;text-transform: uppercase;font-weight: 600;">
            Footer Logo
        </h5>
    </div>

    <div class="card shadow mb-4" style="padding: 2em 0;">
        <form action="customizeFooterLogo" method="POST" enctype="multipart/form-data">
            <div class="card-body">
                <?php
                foreach ($data["footer_icon"] as $row) {
                    ?>
                    <div class="form-group">
                        <label>Current Background Image</label><br>
                        <img class="icon_logo" src="/dmc_global/public/images/<?= $row['image']; ?>" width="100%"
                            height="auto" alt="Image"><br>
                        <span>Current file: <?= $row['image']; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Upload Background Image</label>
                        <input type="file" name="footer_icon" class="form-control">
                    </div>
                    <?php
                }
                ?>
            </div>
            <div>
                <button type="submit" name="footer_logo_updatebtn" class="btn btn-primary"
                    style="margin-left: 20px;">Update</button>
            </div>
        </form>


    </div>
</div>