<link rel="stylesheet" href="/dmc_global/public/css/admin/sortItemTable.css?v=<?= microtime()?>">
<div class="container-fluid">
    <div class="d-flex flex-wrap justify-content-between">
        <!-- First Card (Add Navbar Item) -->
        <div id="addNavbarForm" class="card shadow mb-4 flex-fill mr-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Thông tin danh mục</h6>
            </div>
            <div class="card-body">
                <form action="addNavBar" method="POST">
                    <div class="form-group">
                        <label for="navbar_name">Tên danh mục</label>
                        <input type="text" class="form-control" id="navbar_name" name="navbar_name" required>
                    </div>
                    <div class="form-group">
                        <label for="navbar_status">Trạng thái</label>
                        <select class="form-control" id="navbar_status" name="navbar_status" required>
                            <option value="active">Hiễn thị</option>
                            <option value="inactive">Ẩn</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_navbar_link">Đường dẫn</label>
                        <input type="text" class="form-control" id="navbar_link" name="navbar_link" required>
                    </div>
                    <!-- Container for the additional selectmenu -->
                    <div class="form-group" id="dynamic_field_container" style="display:none;">
                        <label for="dynamic_field">Select Dynamic Option</label>
                        <select class="form-control" id="dynamic_field" name="dynamic_field">
                            <!-- Options will be added here dynamically based on the selected dynamic page -->
                        </select>
                    </div>
                    <button type="submit" name="addNavbarItemBtn" class="btn btn-primary">Lưu</button>
                </form>

            </div>
        </div>
        <!-- Edit Navbar Item Form (Initially hidden) -->
        <div id="editNavbarForm" class="card shadow mb-4 flex-fill mr-3" style="display:none;">
            <div class="edit-navbar card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Cập nhật thông tin</h6>
            </div>
            <div class="card-body">
                <form action="customizeNavBar" method="POST">
                    <input type="hidden" id="edit_navbar_id" name="edit_navbar_id" value="">
                    <div class="form-group">
                        <label for="edit_navbar_name">Tên</label>
                        <input type="text" class="form-control" id="edit_navbar_name" name="edit_navbar_name" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_navbar_status">Trạng thái</label>
                        <select class="form-control" id="edit_navbar_status" name="edit_navbar_status" required>
                            <option value="active">Hiễn thị</option>
                            <option value="inactive">Ẩn</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_navbar_link">Đường dẫn</label>
                        <input type="text" class="form-control" id="edit_navbar_link" name="edit_navbar_link" required>
                    </div>
                    <button type="submit" name="editNavbarItemBtn" class="btn btn-primary">Lưu</button>
                    <button type="button" id="cancelEdit" class="btn btn-danger">Quay về</button>
                </form>
                <!-- Form for child items -->
                <form id="childForm" action="editChildItems" class="mt-3" method="POST">


                    <!-- Checkbox for Child Item -->
                    <div class="form-group">
                        <input type="checkbox" id="childItemCheckbox" name="childItemCheckbox">
                        <label for="childItemCheckbox">Danh mục</label>
                    </div>

                    <!-- Drag-and-drop container for Child Items -->
                    <div id="childItemContainer" style="display:none;">
                        <!-- Select for Parent Category -->
                        <div class="form-group">
                            <label for="parentCategorySelect">Select Parent Category</label>
                            <select id="parentCategorySelect" name="parentCategory" class="form-control">
                                <option value="">-- Select Parent Category --</option>
                                <?php foreach ($data['parent_categories'] as $parentCategory): ?>
                                    <option value="<?= $parentCategory['id']; ?>">
                                        <?= $parentCategory['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="row">
                            <!-- Available Child Items -->
                            <div class="col-md-6">
                                <label>Available Child Items</label>
                                <ul id="availableItems" class="list-group draggable-item"
                                    style="min-height: 200px; border: 1px solid #ccc; padding: 10px;">
                                </ul>
                            </div>
                            <!-- Drop Area for Child Items -->
                            <div class="col-md-6">
                                <label>Selected Child Items</label>
                                <ul id="selectedItems" class="list-group drag-n-drop-box draggable-item"
                                    style="min-height: 200px; border: 1px solid #ccc; padding: 10px;">
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
            <!-- <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List of NavBar Items</h6>
            </div> -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên</th>
                                <th>Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody class="sortable">
                            <?php
                            if (mysqli_num_rows($data["item"]) > 0):
                                $counter = 1;
                                while ($row = mysqli_fetch_array($data["item"])): ?>
                                    <tr id="<?= $row['id'] ?>">
                                        <td>
                                            <i class="fas fa-grip-vertical"></i>
                                            <?= $counter++; ?>
                                        </td>
                                        <td><?= $row['name'] ?></td>
                                        <td style="display:flex; gap:10px;">
                                            <button type="button" class="btn btn-warning edit_btn"
                                                data-id="<?= $row['id']; ?>" data-name="<?= $row['name']; ?>"
                                                data-status="<?= $row['status']; ?>"
                                                data-link="<?= $row['slug']; ?>">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="deleteNavBar" method="POST">
                                                <input type="hidden" name="delete_navbar_id" value="<?= $row['id']; ?>">
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
<script style="text/javascript" src="/dmc_global/public/js/admin/NavbarItems.js?<?= microtime(); ?>"></script>
<script style="text/javascript" src="/dmc_global/public/js/admin/dragNdrop.js?<?= microtime(); ?>"></script>
<script type="text/javascript" src="/dmc_global/public/js/admin/slug.js?v=<?= microtime() ?>"></script>



<script>
    $(document).ready(function () {
        generateToSlug('navbar_name', 'navbar_link');
        
        //sortable
        sortable('.sortable', 'sortNavbarItem');
        attachDragEvents();
        initDragAndDrop('draggable-item', 'availableItems', 'selectedItems');
        setupDragAndSubmit('editChildItemBtn','selectedItems','edit_child_item_id','editChildItems')
    });
</script>