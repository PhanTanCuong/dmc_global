<?php
if (isset($_SESSION['success']) && $_SESSION['success'] != "") {
    echo '
            <div class="alert icon-alert with-arrow alert-success form-alter" role="alert">
              <i class="fa fa-fw fa-check-circle"></i>
              <strong> Success !</strong> <span class="success-message">' . $_SESSION['success'] . '</span>
            </div>';
    unset($_SESSION['success']);
}
if (isset($_SESSION['status']) && $_SESSION['status'] != "") {
    echo '
            <div class="alert icon-alert with-arrow alert-danger form-alter" role="alert">
              <i class="fa fa-fw fa-times-circle"></i>
              <strong> Warning !</strong> <span class="warning-message">' . $_SESSION['status'] . '</span>
            </div>';
    unset($_SESSION['status']);
}
?>