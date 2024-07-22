<?php
include("../includes/security.php");
include ("../includes/header.php");
include ("../includes/nav.php");

?>


<div class="container-fluid">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="color:#4a6fdc;text-transform: uppercase;font-weight: 600;">Edit user account</h5>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4" style="padding: 2em 0;">
        <?php
        //Edit account button
        
        if (isset($_POST['edit_btn'])) {

            $id = $_POST['edit_id'];
            $query = "SELECT * FROM register WHERE id='$id'";
            $query_run = mysqli_query($connection, $query);

            foreach ($query_run as $row) {
                ?>

                <form action="../Controller/account.php" method="POST">
                    <div class="card-body">
                        <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" value="<?php echo $row['username']; ?>" class="form-control"
                                placeholder="Enter username">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" value="<?php echo $row['email']; ?>" class="form-control"
                                placeholder="Enter username">
                        </div>
                        <div class="form-group">
                            <label>Pasword</label>
                            <input type="text" name="password" value="<?php echo $row['password']; ?>" class="form-control"
                                placeholder="Enter username">
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select name="role">
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <a href="register.php" class="btn btn-danger" style="margin-left: 20px;">Cancel</a>
                        <button type="submit" name="user_updatebtn" class="btn btn-primary">Update</button>
                    </div>
                </form>
                <?php
            }

        }
        ?>

    </div>
</div>


<?php
include ("../includes/scripts.php");
include ("../includes/scripts.php");
?>