<!-- Head Tab -->
<div class="container-fluid">

    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"
            style="color:#4a6fdc;text-transform: uppercase;font-weight: 600;">
            Tab</h5>
    </div>


    <div class="card shadow mb-4" style="padding: 2em 0;">
        <?php
        foreach ($data["head"] as $row) {
            ?>

            <form action="customizeTab" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="head_title" class="form-control" placeholder="Enter Title"
                            value="<?php echo $row['title']; ?>"></>
                    </div>
                    <div class="form-group">
                        <label>Current Image</label><br>
                        <img class="icon_logo" src="/dmc_global/public/images/<?php echo $row['image']; ?>" alt="Image"><br>
                        <span>Current file: <?php echo $row['image']; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Upload Image</label>
                        <input type="file" name="head_image" id="image" class="form-control">
                    </div>
                </div>
                <div>
                    <button type="submit" name="head_updatebtn" class="btn btn-primary"
                        style="margin-left:20px">Update</button>
                </div>
            </form>
            <?php
        }
        ?>
    </div>
</div>