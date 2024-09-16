// Sort Item


function sortable(sortableClass, url) {
  $(sortableClass).sortable({
    stop: function () {
      var ids = '';
      $(sortableClass + ' tr').each(function () //loop function in javascript
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

        // Populate edit form fields with the response data
        $('#edit_navbar_id').val(response.navbar['id']);
        $('#edit_navbar_name').val(response.navbar['name']);
        $('#edit_navbar_status').val(response.navbar['status']);
        $('#edit_navbar_link').val(response.navbar['slug']);
        $('#edit_child_item_id').val(response.navbar['id']);

        var selectedItems=$('#selectedItems');

        selectedItems.empty();//Clear a current list

        $.each(response.navbar.child_items,function(key,value){
          selectedItems.append('<li class="list-group-item draggable-item" draggable="true" data-id="'+ value.id +'">'+ value.name +'</li>');
        })
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

// Attach drag events to draggable items


// Fetch Child Items
document.getElementById('parentCategorySelect').addEventListener('change', function () {
  var parentCategoryId = this.value;
  var dataId= document.getElementById('edit_navbar_id').value;
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
        attachDragEvents();  // Ensure drag events are attached after DOM update
      }
    };
    xhr.send('parentCategoryId=' + parentCategoryId + '&dataId=' + dataId);
  }
});

function attachDragEvents() {
  var draggableItems = document.querySelectorAll('.draggable-item');
  draggableItems.forEach(function (item) {
    item.addEventListener('dragstart', function (e) {
      e.dataTransfer.setData('text', e.target.getAttribute('data-id'));
      e.target.classList.add('dragging');
    });
    item.addEventListener('dragend', function (e) {
      e.target.classList.remove('dragging');
    });
  });
}

// Sự kiện khi thả vào vùng availableItems
document.getElementById('availableItems').addEventListener('dragover', function (event) {
  event.preventDefault(); // Cho phép thả
});

document.getElementById('availableItems').addEventListener('drop', function (event) {
  event.preventDefault();
  var data = event.dataTransfer.getData('text');
  var draggedItem = document.querySelector('[data-id="' + data + '"]');
  event.target.appendChild(draggedItem);
});

// Sự kiện khi thả vào vùng selectedItems
document.getElementById('selectedItems').addEventListener('dragover', function (event) {
  event.preventDefault(); // Cho phép thả
});

document.getElementById('selectedItems').addEventListener('drop', function (event) {
  event.preventDefault();
  var data = event.dataTransfer.getData('text');
  var draggedItem = document.querySelector('[data-id="' + data + '"]');
  event.target.appendChild(draggedItem);
});


