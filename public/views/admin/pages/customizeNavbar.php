<script style="text/css" src="/dmc_global/public/css/admin/navbar.css?<?php echo microtime(); ?>"></script>



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
        <!-- List of Navbar Items -->
        <div class="card shadow mb-4 flex-fill ml-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List of NavBar Items</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Item</th>
                                <th>EDIT</th>
                                <th>DELETE</th>
                            </tr>
                        </thead>
                        <tbody class="sortable">
                            <?php
                            if (mysqli_num_rows($data["item"]) > 0) {
                                $counter = 1;
                                while ($row = mysqli_fetch_array($data["item"])) {
                                    ?>
                                    <tr id="<?php echo $row['id'] ?>">
                                        <td><?php echo $counter++; ?></td>
                                        <td><?php echo $row['name'] ?></td>
                                        <td>
                                            <button type="button" class="btn btn-warning edit_btn"
                                                data-id="<?php echo $row['id']; ?>" data-name="<?php echo $row['name']; ?>"
                                                data-status="<?php echo $row['status']; ?>"
                                                data-link="<?php echo $row['link']; ?>">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <form action="deleteNavBar" method="POST">
                                                <input type="hidden" name="delete_navbar_id" value="<?php echo $row['id']; ?>">
                                                <button type="submit" name="delete_navbar_btn" class="btn btn-danger">
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

            var navbar_id = $(this).data('id'); // Use data attribute to get the id

            $.ajax({
                type: "POST",
                url: 'NavBar/getNavBarById/' + navbar_id,
                data: {
                    'checking_edit_btn': true,
                    'navbar_id': navbar_id
                },
                success: function (response) {
                    // Assuming response is JSON and contains the data
                    if (response) {
                        $.each(response, function (key, value) {
                            // Populate edit form fields with the response data
                            $('#edit_navbar_id').val(value['id']);
                            $('#edit_navbar_name').val(value['name']);
                            $('#edit_navbar_status').val(value['status']);
                            $('#edit_navbar_link').val(value['link']);
                        });

                        // Hide the add form and show the edit form
                        $('#addNavbarForm').hide();
                        $('#editNavbarForm').show();

                    } else {
                        alert('Error fetching data.');
                    }
                },
                error: function () {
                    alert('An error occurred.');
                }
            });
        });

        $('#cancelEdit').click(function () {
            // Hide the edit form and show the add form
            $('#editNavbarForm').hide();
            $('#addNavbarForm').show();
        });
    });
</script>


<script style="text/javascript" src="/dmc_global/public/js/admin/sortItem.js?<?php echo microtime(); ?>"></script>
<script>
    $(function () {
        $("#navbar_link").selectmenu();
    });
    $(function () {
        $("#navbar_status").selectmenu();
    });


</script>

<!-- <script>
    const dynamicPages = <?php echo json_encode($dynamic_pages); ?>;

    $(function () {
        $("#navbar_link").selectmenu().on("selectmenuchange", function () {
            const selectedValue = $(this).val();

            // Check if the selected value corresponds to a dynamic page
            if (dynamicPages[selectedValue]) {
                // Show the dynamic field container
                $("#dynamic_field_container").show();

                // Populate the dynamic selectmenu with the corresponding dynamic options
                // let dynamicOptions = '';
                // for (let key in dynamicPages[selectedValue]) {
                //     dynamicOptions += `<option value="${key}">${dynamicPages[selectedValue][key]}</option>`;
                // }

                // $("#dynamic_field").html(dynamicOptions);
                // $("#dynamic_field").selectmenu("refresh"); // Refresh the selectmenu to apply changes
            } else {
                // Hide the dynamic field container if a static page is selected
                $("#dynamic_field_container").hide();
            }
        });
    });
</script> -->