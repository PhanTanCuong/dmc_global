// Sort Item
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


   //Edit button
   $('.edit_btn').click(function (e) {
    e.preventDefault();

    var navbar_id = $(this).data('id'); // Use data attribute to get the id

    $.ajax({
        type: "POST",
        url: 'NavBar/getNavBarById/' + navbar_id,
        data: {
            'checking_edit_btn': true,
            'navbar_id': navbar_id
        },
        success: function (response) {
            // Assuming response is JSON and contains the data
            if (response) {
                $.each(response, function (key, value) {
                    // Populate edit form fields with the response data
                    $('#edit_navbar_id').val(value['id']);
                    $('#edit_navbar_name').val(value['name']);
                    $('#edit_navbar_status').val(value['status']);
                    $('#edit_navbar_link').val(value['link']);
                });

                // Hide the add form and show the edit form
                $('#addNavbarForm').hide();
                $('#editNavbarForm').show();

            } else {
                alert('Error fetching data.');
            }
        },
        error: function () {
            alert('An error occurred.');
        }
    });
});

$('#cancelEdit').click(function () {
    // Hide the edit form and show the add form
    $('#editNavbarForm').hide();
    $('#addNavbarForm').show();
});


//Selections
$(function () {
  $("#navbar_link").selectmenu();
});
$(function () {
  $("#navbar_status").selectmenu();
});

//Child Items
$('#childItemCheckbox').change(function() {
  if ($(this).is(':checked')) {
      $('#childItemContainer').show();
  } else {
      $('#childItemContainer').hide();
  }
});

// drag and drop functionality (optional to extend)
$('.draggable-item').on('dragstart', function(event) {
  event.originalEvent.dataTransfer.setData('text', event.target.dataset.id);
});

$('#selectedItems').on('dragover', function(event) {
  event.preventDefault();
});

$('#selectedItems').on('drop', function(event) {
  event.preventDefault();
  var data = event.originalEvent.dataTransfer.getData('text');
  var draggedItem = $('[data-id="' + data + '"]');
  $('#selectedItems').append(draggedItem);
});