<div class="container-fluid">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="color:#4a6fdc;text-transform: uppercase;font-weight: 600;">
            Custom Navigation Bar Information</h5>
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

            <form action="customProduct1" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <label>Title</label>
                        <textarea type="text" name="product1_title" class="form-control" placeholder="Enter Title"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea type="text" name="product1_description" class="form-control" placeholder="Enter Description"></textarea>
                    </div>
                </div>
                <div>
                    <a href="displayProduct1" class="btn btn-danger" style="margin-left: 20px;">Cancel</a>
                    <button type="submit" name="product1_updatebtn" class="btn btn-primary">Update</button>
                </div>
            </form>

    </div>
</div>