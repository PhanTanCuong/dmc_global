<div class="container-fluid">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="color:#4a6fdc;text-transform: uppercase;font-weight: 600;">Update product information</h5>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4" style="padding: 2em 0;">
        <?php
        foreach ($data["background"] as $row) {
        ?>

            <form action="editStatBackground" method="POST" enctype="multipart/form-data">
                <div class="card-body">
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
                    <div class="form-group">
                        <label>Current State background</label><br>
                        <img src="/dmc_global/mvc/uploads/<?php echo $row['image']; ?>" width="100%" height="300px" alt="Icon"><br>
                        <span>Current file: <?php echo $row['image']; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="background_image" id="background_image" class="form-control" placeholder="Enter username">
                    </div>

                </div>

                <div style="margin:0 20px; margin-bottom:20px">
                    <button type="submit" name="background_updatebtn" class="btn btn-primary">Update</button>
                </div>
            </form>
        <?php
        }
        ?>
        <!-- Add  form -->
        <div class="modal fade" id="addstate-ic-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add State Icon </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- enctype="multipart/form-data": Thuộc tính phải có để uplaod hoặc fetch dữ liệu dạng file(Ảnh) -->

                    <!-- thêm -->
                    <form action="addStateIcon" method="POST" enctype="multipart/form-data">

                        <div class="modal-body">

                            <div class="form-group">
                                <label> Title </label>
                                <input type="text" name="icon_name" class="form-control" placeholder="Enter Title" required>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" name="icon_value" class="form-control" placeholder="Enter Description" required>
                            </div>
                            <div class="form-group">
                                <label>Image </label>
                                <input type="file" name="icon_image" id="icon_image" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="addStateIconBtn" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--  Edit form -->
        <div class="modal fade" id="editstate-ic-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add State Icon </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- enctype="multipart/form-data": Thuộc tính phải có để uplaod hoặc fetch dữ liệu dạng file(Ảnh) -->

                    <!-- thêm -->
                    <form action="editStateIcon" method="POST" enctype="multipart/form-data">

                        <div class="modal-body">

                            <div class="form-group">
                                <label> Title </label>
                                <input type="text" name="icon_title" class="form-control" placeholder="Enter Title" required>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" name="icon_description" class="form-control" placeholder="Enter Description" required>
                            </div>
                            <div class="form-group">
                                <label>Image </label>
                                <input type="file" name="icon_image" id="icon_image" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="editStateIconBtn" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="container-fluid">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">List of about3 information
                        <div class="controll-btn">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addstate-ic-form">
                                <i class="fas fa-plus"></i>
                            </button>
                            <form action="multipleDeleteStateIcon" method="POST">
                                <button type="submit" name="deletemultipledata" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </h6>

                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <?php
                        ?>
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Check</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Value</th>
                                    <th>Image</th>
                                    <th>EDIT</th>
                                    <th>DELETE </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (mysqli_num_rows($data["icon"]) > 0) {
                                    $counter = 1;
                                    while ($row = mysqli_fetch_array($data["icon"])) {

                                ?>

                                        <tr>
                                            <td>
                                                <input type="checkbox" onclick="toggleCheckbox(this,'../Media/toggleCheckboxDeleteStateIcon')" value="<?php echo $row['id'] ?>
                                        <?php echo $row['visible'] === 1 ? "checked" : "" ?>">
                                            </td>
                                            <td><?php echo $counter++; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['value']; ?></td>
                                            <td><?php echo '<img src="/dmc_global/mvc/uploads/' . $row['image'] . '" style="background:#4a6fdc;" width="200px" height="200px" alt="Icon">' ?></td>
                                            <td>
                                                <button type="submit" name="display_icon_infor_btn" class="btn btn-success" data-toggle="modal" data-target="#addstate-ic-form">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </td>
                                            <td>
                                                <form action="deleteStateIcon" method="POST">
                                                    <input type="hidden" name="delete_icon_id" value="<?php echo $row['id']; ?>">
                                                    <button type="submit" name="delete_icon_btn" class="btn btn-danger"> <i class="fas fa-trash"></i></button>
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

    <script src="../public/js/admin/checkbox.js"></script>