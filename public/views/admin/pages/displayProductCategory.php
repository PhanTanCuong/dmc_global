<!-- Add new icons form -->
<div class="modal fade" id="addProductCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">List of Product Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- enctype="multipart/form-data": Thuộc tính phải có để uplaod hoặc fetch dữ liệu dạng file(Ảnh) -->
            <form action="addProductCategory" method="POST" enctype="multipart/form-data">

                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="product_category_name" id="product_category_name" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="addProductCategoryBtn" class="btn btn-primary">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Edit new icons form -->
<div class="modal fade" id="editProductCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ProductCategory Information </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- enctype="multipart/form-data": Thuộc tính phải có để uplaod hoặc fetch dữ liệu dạng file(Ảnh) -->
            <form action="customizeProductCategory" method="POST" enctype="multipart/form-data">

                <div class="modal-body">
                    <input type="hidden" name="edit_id" id="edit_id">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="product_category_name" id="edit_product_category" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="product_category_updatebtn" class="btn btn-primary">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>


<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List of Product Category</h6>
            <div class="controll-btn">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProductCategory">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <?php
                ?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>EDIT</th>
                            <th>DELETE </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($data["item"]) > 0) {
                            $counter = 1; 
                            while ($row = mysqli_fetch_array($data["item"])) {
                        ?>
                                <tr>
                                    <td><?php echo $counter++; ?></td>
                                    <td><?php echo $row['type'] ?></td>
                                    <td>
                                        <form action="getProductCategoryById" method="POST">
                                            <input type="hidden" name="edit_id" class="edit_id" value="<?php echo $row['id']; ?>">
                                            <button href="#" type="button" name="edit_btn" class="btn btn-warning edit_btn" data-toggle="modal" data-target="#editProductCategory"> <i class="fas fa-edit"></i> </i></i></button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="deleteProductCategory" method="POST">
                                            <input type="hidden" name="delete_product_category_id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" name="delete_product_category_btn" class="btn btn-danger"> <i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.edit_btn').click(function(e) {
                e.preventDefault();

                var product_category_id = $(this).closest('tr').find('.edit_id').val();

                // console.log(product_category_id);

                $.ajax({
                    type: "POST",
                    url: 'ProductCategory/getProductCategoryById/' + product_category_id,
                    data: {
                        'checking_edit_btn': true,
                        'product_category_id': product_category_id,
                    },
                    success: function(response) {
                        console.log(response);
                        $.each(response, function(key, value) {
                            $('#edit_id').val(value['id']);
                            $('#edit_product_category').val(value['type'])

                        });
                        $('#editProductCategory').modal('show');
                    }
                });
            });

        });
    </script>