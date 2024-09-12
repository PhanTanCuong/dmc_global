<?php
include("fragments/headerInformation.php");
include("fragments/Logo.php");
include("fragments/footerBackground.php");
?>
<!-- <style>
    .drag-n-drop-box{
        height: 35vh;
    }
</style> -->
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
                            <th> DELETE </th>
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






<?php
include("fragments/quickLink.php");
include("fragments/footerIcon.php");
?>
<script style="text/javascript" src="/dmc_global/public/js/admin/footerSetting.js?<?php echo microtime(); ?>"></script>