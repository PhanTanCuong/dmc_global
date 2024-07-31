<div class="container-fluid">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="color:#4a6fdc;text-transform: uppercase;font-weight: 600;">Customize footer information</h5>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4" style="padding: 2em 0;">
        <?php

            // $id = $_POST['edit_product_id'];
        ?>

                <form action="editProduct" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        <input type="hidden" name="edit_product_id" >
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="product_title"  class="form-control" placeholder="Enter username">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" name="product_description"  class="form-control" placeholder="Enter username">
                        </div>
                    </div>
                    <div>
                        <a href="displayProduct" class="btn btn-danger" style="margin-left: 20px;">Cancel</a>
                        <button type="submit" name="product_updatebtn" class="btn btn-primary">Update</button>
                    </div>
                </form>

    </div>
</div>