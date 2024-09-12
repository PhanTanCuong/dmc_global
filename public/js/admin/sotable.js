// Sort Item


function sortable(sortableClass,url){
    $(sortableClass).sortable({
      stop:function(){
        var ids = '';
        $(sortableClass +' tr').each(function () //loop function in javascript
        {
          id = $(this).attr('id');
          if (ids == '') {
            ids = id;
          } else {
            ids += ',' + id;
          }
          // alert(ids)
        })
        $.ajax({
          url: url,
          data: { ids: ids },
          type: 'POST',
          success: function (data) {
            console.log('Navbar item sorted successfully');
          },
          error: function (jqXHR, textStatus, errorThrown) {
            console.error('AJAX Error: ' + textStatus + ': ' + errorThrown);
            console.log(jqXHR.responseText);
          }
        });
      }
    });
  }