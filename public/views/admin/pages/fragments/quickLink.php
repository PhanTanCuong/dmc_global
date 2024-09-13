<div class="container-fluid">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"
            style="color:#4a6fdc;text-transform: uppercase;font-weight: 600;">
            Product
        </h5>
    </div>


    <div class="card shadow mb-4" style="padding: 2em 0;">
        <form action="customizeQuickLink" method="POST">
            <div class="card-body">
                <div class="row">
                    <!-- Available Child Items -->
                    <div class="col-md-6">
                        <label>Available Child Items</label>
                        <ul id="availableItems" class="list-group drag-n-drop-box"
                            style="min-height: 200px; border: 1px solid #ccc; padding: 10px;">

                            <?php

                            // Sử dụng foreach thay cho mysqli_fetch_assoc(vì hàm này để xuất đối tượng)
                            foreach ($data["category"] as $rows):
                                ?>
                                <li class="list-group-item draggable-item" draggable="true" data-id="<?= $rows['slug']; ?>">
                                    <?= $rows['name']; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <!-- Drop Area for Child Items -->
                    <div class="col-md-6">
                        <label>Selected Child Items</label>
                        <ul id="selectedItems" class="list-group drag-n-drop-box"
                            style="min-height: 200px; border: 1px solid #ccc; padding: 10px;">
                            <?php while ($rows = mysqli_fetch_assoc($data["selected_product_category_items"])): ?>
                                <li class="list-group-item draggable-item" draggable="true"
                                    data-id="<?= $rows['slug']; ?>">
                                    <?= $rows['name']; ?>
                                </li>
                            <?php endwhile; ?>                        
                        </ul>
                    </div>
                </div>
            </div>
            <div>
                <input type="hidden" id="product_category_id" value="12">
                <button id="submit_product_category_Button" type="submit" name="submitButton" class="btn btn-primary"
                    style="margin-left: 20px;">Update</button>
            </div>
        </form>
    </div>
</div>

<div class="container-fluid">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"
            style="color:#4a6fdc;text-transform: uppercase;font-weight: 600;">
            Quick Links
        </h5>
    </div>


    <div class="card shadow mb-4" style="padding: 2em 0;">
        <form action="customizeQuickLink" method="POST">
            <div class="card-body">
                <div class="row">
                    <!-- Available Child Items -->
                    <div class="col-md-6">
                        <label>Available Child Items</label>
                        <ul id="available_quick_link_Item" class="list-group drag-n-drop-box"
                            style="min-height: 200px; border: 1px solid #ccc; padding: 10px;">
                            <?php 
                            foreach($data["navbar_item"] as $row):?>
                                <li class="list-group-item draggable-item" draggable="true" data-id="<?= $row['slug']; ?>">
                                    <?= $row['name']; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <!-- Drop Area for Child Items -->
                    <div class="col-md-6">
                        <label>Selected Child Items</label>
                        <ul id="selected_quick_link_item" class="list-group drag-n-drop-box"
                            style="min-height: 200px; border: 1px solid #ccc; padding: 10px;">
                            <?php while ($rows = mysqli_fetch_assoc($data["selected_quick_link_items"])): ?>
                                <li class="list-group-item draggable-item" draggable="true"
                                    data-id="<?= $rows['slug']; ?>">
                                    <?= $rows['name']; ?>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div>
                <input type="hidden" id="quick_link_id" value="13">
                <button id="submit_quick_link_Button" type="submit" name="submitButton" class="btn btn-primary"
                    style="margin-left: 20px;">Update</button>
            </div>
        </form>
    </div>
</div>

<script style="text/javascript" src="/dmc_global/public/js/admin/dragNdrop.js?<?= microtime(); ?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        //Product
        initDragAndDrop('draggable-item', 'availableItems', 'selectedItems');
        setupDragAndSubmit('submit_product_category_Button', 'selectedItems', 'product_category_id', 'customizeQuickLink');

        //Quick Links 
        initDragAndDrop('draggable-quick-link-item', 'available_quick_link_Item', 'selected_quick_link_item');
        setupDragAndSubmit('submit_quick_link_Button', 'selected_quick_link_item', 'quick_link_id', 'customizeQuickLink');

    });
</script>