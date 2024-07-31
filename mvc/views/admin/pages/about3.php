<!-- Add  form -->
<div class="modal fade" id="addabout3form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add About3 Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- enctype="multipart/form-data": Thuộc tính phải có để uplaod hoặc fetch dữ liệu dạng file(Ảnh) -->

            <!-- thêm -->
            <form action="addAbout3Info" method="POST" enctype="multipart/form-data">

                <div class="modal-body">

                    <div class="form-group">
                        <label> Title </label>
                        <input type="text" name="about3_title" class="form-control" placeholder="Enter Title" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" name="about3_description" class="form-control" placeholder="Enter Description" required>
                    </div>
                    <div class="form-group">
                        <label>Image </label>
                        <input type="file" name="about3_image" id="about3_image" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="addAbout3Btn" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--  Edit form -->
<div class="modal fade" id="editabout3form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add About3 Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- enctype="multipart/form-data": Thuộc tính phải có để uplaod hoặc fetch dữ liệu dạng file(Ảnh) -->

            <!-- thêm -->
            <form action="editAbout3" method="POST" enctype="multipart/form-data">

                <div class="modal-body">

                    <div class="form-group">
                        <label> Title </label>
                        <input type="text" name="about3_title" class="form-control" placeholder="Enter Title" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" name="about3_description" class="form-control" placeholder="Enter Description" required>
                    </div>
                    <div class="form-group">
                        <label>Image </label>
                        <input type="file" name="about3_image" id="about3_image" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="editAbout3Btn" class="btn btn-primary">Save</button>
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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addabout3form">
                        <i class="fas fa-plus"></i>
                    </button>
                    <form action="multipleDeleteInforAbout3" method="POST">
                        <button type="submit" name="delete-multiple-data" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                    </form>
                </div>
            </h6>

        </div>

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
            <div class="table-responsive">
                <?php
                ?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Check</th>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
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
                                    <td>
                                        <input type="checkbox" onclick="toggleCheckbox(this,'../About/toggleCheckboxDelete')" value="<?php echo $row['id'] ?>
                                        <?php echo $row['visible'] === 1 ? "checked" : "" ?>">
                                    </td>
                                    <td><?php echo $counter++; ?></td>
                                    <td><?php echo $row['title']; ?></td>
                                    <td><?php echo $row['description']; ?></td>
                                    <td><?php echo '<img src="/dmc_global/mvc/uploads/' . $row['image'] . '" width="400px" height="200px" alt="Product Img">' ?></td>
                                    <td>
                                            <button type="submit" name="display_about3_infor_btn" class="btn btn-success"  data-toggle="modal" data-target="#addabout3form"> 
                                                <i class="fas fa-edit"></i>
                                            </button>
                                    </td>
                                    <td>
                                        <form action="deleteAbout3Infor" method="POST">
                                            <input type="hidden" name="delete_about3_id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" name="delete_about3_btn" class="btn btn-danger"> <i class="fas fa-trash"></i></button>
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

    <script src="../public/js/admin/checkbox.js"></script>