// Sort Item
$(function () {
  $('.sortable').sortable({
    stop: function () {
      var ids = '';
      $('.sortable tr').each(function () //loop function in javascript
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
        url: 'sortNavbarItem',
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
$('#childItemCheckbox').change(function () {
  if ($(this).is(':checked')) {
    $('#childItemContainer').show();
  } else {
    $('#childItemContainer').hide();
  }
});

//Fetch Child Items
document.getElementById('parentCategorySelect').addEventListener('change', function () {
  var parentCategoryId = this.value;
  if (parentCategoryId) {
    // Fetch child categories via AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'fetchChildCategories', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        // Parse the response and display child items in 'availableItems'
        var childItems = JSON.parse(xhr.responseText);
        var availableItems = document.getElementById('availableItems');
        availableItems.innerHTML = '';
        childItems.forEach(function (item) {
          var li = document.createElement('li');
          li.className = 'list-group-item draggable-item';
          li.setAttribute('draggable', 'true');
          li.setAttribute('data-id', item.slug);
          li.textContent = item.name;
          availableItems.appendChild(li);
        });
      }
    };
    xhr.send('parentCategoryId=' + parentCategoryId);
  }
  attachDragEvents();
});

// Attach drag events to draggable items
function attachDragEvents() {
  var draggableItems = document.querySelectorAll('.draggable-item');
  draggableItems.forEach(function(item) {
      item.addEventListener('dragstart', function(e) {
          e.dataTransfer.setData('text', e.target.getAttribute('data-id'));
      });
  });
}


dropZone.addEventListener('dragover', function(e) {
  e.preventDefault();  // Necessary to allow dropping
});


dropZone.addEventListener('drop', function(e) {
  e.preventDefault();
  var data = e.dataTransfer.getData('text');
  var draggedItem = document.querySelector('[data-id="' + data + '"]');

  // Clone and add to the selected list
  if (draggedItem) {
      var newItem = draggedItem.cloneNode(true);
      dropZone.appendChild(newItem);
  }
});

// Initially attach drag events
attachDragEvents();