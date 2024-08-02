<?php
// session_start();
include ('admin/includes/header.php');
?>
<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-6 col-lg-6 col-md-6">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Create a new account</h1>
                                    <?php
                                    if (isset($_SESSION['status']) && $_SESSION['status'] != "") {
                                        echo '<h2 class="bg-danger text-white">' . $_SESSION['status'] . '</h2>';
                                        unset($_SESSION['status']);
                                    }
                                    ?>
                                </div>
                                <form class="user" action="signup" method="POST">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" name="username" 
                                        placeholder="Enter Username"></div>

                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" name="email"
                                            aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" name="password"
                                            placeholder="Enter Email Password...">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user"
                                            name="confirmpassword" placeholder="Enter Confirm password...">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block"
                                        name="signup_btn">Sign up</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<?php
include ('admin/includes/scripts.php');
?>