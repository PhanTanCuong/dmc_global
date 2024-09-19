<!-- Bootstrap core JavaScript-->
<script src="/dmc_global/public/vendor/jquery/jquery.min.js"></script>
<script src="/dmc_global/public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="/dmc_global/public/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="/dmc_global/public/admin/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="/dmc_global/public/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="/dmc_global/public/js/admin/demo/chart-area-demo.js"></script>
<script src="/dmc_global/public/js/admin/demo/chart-pie-demo.js"></script>
<!-- jquery-ui -->
<script src="https://code.jquery.com/ui/1.14.0/jquery-ui.js"></script>
<!-- datatables-bootstrap5 -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<!-- Summernote Editor -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<!-- Toast -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
  function redirectTo(path) {
    // <!-- The link that will trigger the JavaScript function to redirect -->
    window.location.href = '/dmc_global/' + path;
  }

  function setParentID(parentId, path) {
    //delete old cookie 
    document.cookie="parent_id=" + parentId + ";path=/;expires=" + new Date(new Date().getTime() - 24*60*60*1000).toUTCString();

    //set cookie
    document.cookie = "parent_id=" + parentId + ";path=/;expires=" + new Date(new Date().getTime() + 24*60*60*1000).toUTCString();

    //REdirect to URL
    window.location.href = '/dmc_global/' + path;

  }

  $(document).ready(function () {
    $('.summernote').summernote({
      height: 250
    });
    $('#myTable').DataTable();
  });
</script>