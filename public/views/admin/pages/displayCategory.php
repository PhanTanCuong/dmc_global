<div class="container-fluid">
    <div class="d-flex flex-wrap justify-content-between">
        <!-- First Card (Add Navbar Item) -->
        <div id="addNavbarForm" class="card shadow mb-4 flex-fill mr-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add Navigation Item Information</h6>
            </div>
            <div class="card-body">
                <form action="addNavBar" method="POST">
                    <div class="form-group">
                        <label for="navbar_name">Item Name</label>
                        <input type="text" class="form-control" id="navbar_name" name="navbar_name" required>
                    </div>
                    <div class="form-group">
                        <label for="navbar_status">Status</label>
                        <select class="form-control" id="navbar_status" name="navbar_status" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <?php
                    use Mvc\Libraries\Pages;
                    $static_pages = Pages::$static_pages;
                    $dynamic_pages = Pages::$dynamic_pages;

                    ?>
                    <div class="form-group">
                        <label for="navbar_link">Link</label>
                        <select class="form-control" id="navbar_link" name="navbar_link" required>
                            <optgroup label="Static Pages">
                                <?php foreach ($static_pages as $page): ?>
                                    <option value="<?php echo $page['link']; ?>">
                                        <?php echo $page['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </optgroup>
                            <optgroup label="Dynamic Pages">
                                <?php foreach ($dynamic_pages as $page): ?>
                                    <option value="<?php echo $page['link']; ?>">
                                        <?php echo $page['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </optgroup>
                        </select>
                    </div>
                    <!-- Container for the additional selectmenu -->
                    <div class="form-group" id="dynamic_field_container" style="display:none;">
                        <label for="dynamic_field">Select Dynamic Option</label>
                        <select class="form-control" id="dynamic_field" name="dynamic_field">
                            <!-- Options will be added here dynamically based on the selected dynamic page -->
                        </select>
                    </div>
                    <button type="submit" name="addNavbarItemBtn" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
        <!-- Edit Navbar Item Form (Initially hidden) -->
        <div id="editNavbarForm" class="card shadow mb-4 flex-fill mr-3" style="display:none;">
            <div class="edit-navbar card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Navigation Item Information</h6>
                <button type="button" id="cancelEdit" class="btn btn-danger">Back</button>
            </div>
            <div class="card-body">
                <form action="customizeNavBar" method="POST">
                    <input type="hidden" id="edit_navbar_id" name="edit_navbar_id" value="">
                    <div class="form-group">
                        <label for="edit_navbar_name">Item Name</label>
                        <input type="text" class="form-control" id="edit_navbar_name" name="edit_navbar_name" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_navbar_status">Status</label>
                        <select class="form-control" id="edit_navbar_status" name="edit_navbar_status" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_navbar_link">Link</label>
                        <select class="form-control" id="edit_navbar_link" name="edit_navbar_link" required>
                            <optgroup label="Static Pages">
                                <?php foreach ($static_pages as $page): ?>
                                    <option value="<?php echo $page['link']; ?>">
                                        <?php echo $page['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </optgroup>
                            <optgroup label="Dynamic Pages">
                                <?php foreach ($dynamic_pages as $page): ?>
                                    <option value="<?php echo $page['link']; ?>">
                                        <?php echo $page['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </optgroup>
                        </select>
                    </div>
                    <button type="submit" name="editNavbarItemBtn" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
        <div class="card shadow mb-4 flex-fill ml-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List of Product Category</h6>
                <div class="controll-btn">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCategory">
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
                                            <form action="getCategoryById" method="POST">
                                                <input type="hidden" name="edit_id" class="edit_id"
                                                    value="<?php echo $row['id']; ?>">
                                                <button href="#" type="button" name="edit_btn" class="btn btn-warning edit_btn"
                                                    data-toggle="modal" data-target="#editCategory"> <i class="fas fa-edit"></i>
                                                    </i></i></button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="deleteCategory" method="POST">
                                                <input type="hidden" name="delete_product_category_id"
                                                    value="<?php echo $row['id']; ?>">
                                                <button type="submit" name="delete_product_category_btn" class="btn btn-danger">
                                                    <i class="fas fa-trash"></i></button>
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
    </div>

</div>
<script>
    $(document).ready(function () {
        $('.edit_btn').click(function (e) {
            e.preventDefault();

            var product_category_id = $(this).closest('tr').find('.edit_id').val();

            // console.log(product_category_id);

            $.ajax({
                type: "POST",
                url: 'Category/getCategoryById/' + product_category_id,
                data: {
                    'checking_edit_btn': true,
                    'product_category_id': product_category_id,
                },
                success: function (response) {
                    console.log(response);
                    $.each(response, function (key, value) {
                        $('#edit_id').val(value['id']);
                        $('#edit_product_category').val(value['type'])

                    });
                    $('#editCategory').modal('show');
                }
            });
        });

    });
</script>