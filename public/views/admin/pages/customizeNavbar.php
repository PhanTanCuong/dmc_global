<link rel="stylesheet" href="/dmc_global/public/css/admin/sortItemTable.css?v=<?php echo microtime()?>">
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
                    <button type="button" id="cancelEdit" class="btn btn-danger">Back</button>
                </form>
                <!-- Form for child items -->
                <form id="childForm" action="editChildItems" class="mt-3" method="POST">


                    <!-- Checkbox for Child Item -->
                    <div class="form-group">
                        <input type="checkbox" id="childItemCheckbox" name="childItemCheckbox">
                        <label for="childItemCheckbox">Child Items</label>
                    </div>

                    <!-- Drag-and-drop container for Child Items -->
                    <div id="childItemContainer" style="display:none;">
                        <!-- Select for Parent Category -->
                        <div class="form-group">
                            <label for="parentCategorySelect">Select Parent Category</label>
                            <select id="parentCategorySelect" name="parentCategory" class="form-control">
                                <option value="">-- Select Parent Category --</option>
                                <?php foreach ($data['parent_categories'] as $parentCategory): ?>
                                    <option value="<?php echo $parentCategory['id']; ?>">
                                        <?php echo $parentCategory['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="row">
                            <!-- Available Child Items -->
                            <div class="col-md-6">
                                <label>Available Child Items</label>
                                <ul id="availableItems" class="list-group"
                                    style="min-height: 200px; border: 1px solid #ccc; padding: 10px;">
                                </ul>
                            </div>
                            <!-- Drop Area for Child Items -->
                            <div class="col-md-6">
                                <label>Selected Child Items</label>
                                <ul id="selectedItems" class="list-group"
                                    style="min-height: 200px; border: 1px solid #ccc; padding: 10px;">
                                    <!-- Items dragged and dropped here will be added as Child Items -->
                                </ul>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="edit_child_item_id" value="">
                    <button type="submit" name="editChildItemBtn" id="editChildItemBtn" class="btn btn-primary">Save</button>
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
                                <th>Task</th>
                            </tr>
                        </thead>
                        <tbody class="sortable">
                            <?php
                            if (mysqli_num_rows($data["item"]) > 0):
                                $counter = 1;
                                while ($row = mysqli_fetch_array($data["item"])): ?>
                                    <tr id="<?php echo $row['id'] ?>">
                                        <td>
                                            <i class="fas fa-grip-vertical"></i>
                                            <?php echo $counter++; ?>
                                        </td>
                                        <td><?php echo $row['name'] ?></td>
                                        <td style="display:flex; gap:10px;">
                                            <button type="button" class="btn btn-warning edit_btn"
                                                data-id="<?php echo $row['id']; ?>" data-name="<?php echo $row['name']; ?>"
                                                data-status="<?php echo $row['status']; ?>"
                                                data-link="<?php echo $row['slug']; ?>">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="deleteNavBar" method="POST">
                                                <input type="hidden" name="delete_navbar_id" value="<?php echo $row['id']; ?>">
                                                <button type="submit" name="delete_navbar_btn" class="btn btn-danger">
                                                    <i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php
                                endwhile;
                            endif;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script style="text/javascript" src="/dmc_global/public/js/admin/NavbarItems.js?<?php echo microtime(); ?>"></script>
<script style="text/javascript" src="/dmc_global/public/js/admin/dragNdrop.js?<?php echo microtime(); ?>"></script>


<script>
    $(document).ready(function () {
        //sortable
        sortable('.sortable','sortFooterIcons');
        // initDragAndDrop('draggable-item', 'availableItems', 'selectedItems');
        setupDragAndSubmit('editChildItemBtn','selectedItems','edit_child_item_id','editChildItems')
    });
</script>