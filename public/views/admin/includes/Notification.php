<?php
if (isset($_SESSION['success']) && $_SESSION['success'] != "") {
  echo '
            <div class="alert icon-alert with-arrow alert-success form-alter" role="alert" id="success-alert">
              <i class="fa fa-fw fa-check-circle"></i>
              <strong> Success !</strong> <span class="success-message">' . $_SESSION['success'] . '</span>
              <div class="progress-bar" id="success-progress-bar"></div>
            </div>';
  unset($_SESSION['success']);
}
if (isset($_SESSION['status']) && $_SESSION['status'] != "") {
  echo '
            <div class="alert icon-alert with-arrow alert-danger form-alter" role="alert" id="status-alert">
              <i class="fa fa-fw fa-times-circle"></i>
              <strong> Warning !</strong> <span class="warning-message">' . $_SESSION['status'] . '</span>
              <div class="progress-bar" id="status-progress-bar"></div>
            </div>';
  unset($_SESSION['status']);
}
?>

<style>
  .alert {
    position: fixed;
    z-index: 1;
    right: 0;
    bottom: 0;
    padding-right: 30px;
    margin-bottom: 20px;
  }

  .progress-bar {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background-color: rgba(0, 0, 0, 0.1);
    animation: progress-animation 4s linear;
  }

  @keyframes progress-animation {
    from {
      width: 100%;
    }

    to {
      width: 0;
    }
  }
</style>

<script>
  // Function to hide the alert after 4 seconds
  function hideAlert(id) {
    setTimeout(function () {
      var element = document.getElementById(id);
      if (element) {
        element.style.display = "none";
      }
    }, 4000); // 4 seconds
  }

  // Call hideAlert for success and status alerts if they exist
  hideAlert('success-alert');
  hideAlert('status-alert');
</script>