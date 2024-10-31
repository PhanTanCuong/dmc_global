<?php if (isset($_SESSION['success']) && $_SESSION['success'] != ""): ?>
  <script>
    $(document).ready(function () {
      toastr.success('<?= $_SESSION['success'] ?>')
    });
  </script>
<?php endif; ?>
<?php if (isset($_SESSION['status']) && $_SESSION['status'] != ""): ?>
  <script>$(document).ready(function () {
      toastr.error('<?= $_SESSION['status'] ?>')
    });</script>
<?php endif; ?>
