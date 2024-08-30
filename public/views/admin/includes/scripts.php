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

<script src="https://code.jquery.com/ui/1.14.0/jquery-ui.js"></script>


<script>
  function redirectTo(path) {
    // <!-- The link that will trigger the JavaScript function to redirect -->
    window.location.href = '/dmc_global/' + path;
  }
</script>

<script type="text/JavaScript">
   $(function(){
    $('.sortable').sortable({
      stop: function(){
        var ids=''; 
        $('.sortable tr').each(function() //loop function in javascript
        {
          id=$(this).attr('id');
          if(ids==''){
            ids=id;
          }else{
            ids+=','+id;
          }
          // alert(ids)
        })
        $.ajax({
          url: 'sortNavbarItem',
          data: { ids: ids },
          type: 'POST',
          success: function(data) {
            console.log('Navbar item sorted successfully');
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.error('AJAX Error: ' + textStatus + ': ' + errorThrown);
            console.log(jqXHR.responseText);
          }
        });
      }
    });  
   });
</script>