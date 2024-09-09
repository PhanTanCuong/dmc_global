<?php
include("fragments/headerInformation.php");
include("fragments/Logo.php");
include("fragments/footerBackground.php");
?>
<style>
    .drag-n-drop-box{
        height: 35vh;
    }
</style>
<!-- Footer background -->

<div class="modal fade" id="editData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="editFooterData" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="edit_id" id="edit_id">
                        <label> Title </label>
                        <input type="text" name="edit_title" id="edit_title" class="form-control"
                            placeholder="Enter Title">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" name="edit_description" id="edit_description" class="form-control"
                            placeholder="Enter Description">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="editDataBtn" class="btn btn-primary">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"
            style="color:#4a6fdc;text-transform: uppercase;font-weight: 600;">
            Footer Information
        </h5>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <?php
                ?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th> No. </th>
                            <th> Title</th>
                            <th> Description </th>
                            <th> EDIT </th>
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
                                    <td><?php echo $row['title'] ?></td>
                                    <td><?php echo $row['description'] ?></td>
                                    <td>
                                        <form action="getDataById" method="POST">
                                            <input type="hidden" name="edit_id" class="edit_id"
                                                value="<?php echo $row['id']; ?>">
                                            <button href="#" type="button" name="edit_btn" class="btn btn-warning edit_btn"
                                                data-toggle="modal" data-target="#editData"> <i class="fas fa-edit"></i>
                                                </i></i></button>
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
                        <ul id="availableItems"  class="list-group drag-n-drop-box"
                            style="min-height: 200px; border: 1px solid #ccc; padding: 10px;">
                            <?php while ($rows = mysqli_fetch_assoc($data["category"])): ?>
                                <li class="list-group-item draggable-item" draggable="true"
                                    data-id="<?php echo $rows['slug']; ?>">
                                    <?php echo $rows['name']; ?>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                    <!-- Drop Area for Child Items -->
                    <div class="col-md-6">
                        <label>Selected Child Items</label>
                        <ul id="selectedItems" class="list-group drag-n-drop-box"
                            style="min-height: 200px; border: 1px solid #ccc; padding: 10px;">
                            <!-- Items dragged and dropped here will be added as Child Items -->
                        </ul>
                    </div>
                </div>
            </div>
            <div>
                <button id="submitButton" type="submit" name="submitButton" class="btn btn-primary" style="margin-left: 20px;">Update</button>
            </div>
        </form>
    </div>
</div>




<?php include("fragments/footerIcon.php") ?>
<script style="text/javascript" src="/dmc_global/public/js/admin/footerSetting.js?<?php echo microtime(); ?>"></script>
<script style="text/javascript" src="/dmc_global/public/js/admin/dragNdrop.js?<?php echo microtime(); ?>"></script>
