
function initDragAndDrop(draggableItem, availableItemsId, selectedItemsId) {
  // Sự kiện khi bắt đầu kéo
  $('.' + draggableItem).on('dragstart', function(event) {
      event.originalEvent.dataTransfer.setData('text', event.target.dataset.id);
  });

  // Sự kiện khi thả vào vùng availableItems
  $('#' + availableItemsId).on('dragover', function(event) {
      event.preventDefault();
  }).on('drop', function(event) {
      event.preventDefault();
      var data = event.originalEvent.dataTransfer.getData('text');
      var draggedItem = $('[data-id="' + data + '"]');
      $('#' + availableItemsId).append(draggedItem);
  });

  // Sự kiện khi thả vào vùng selectedItems
  $('#' + selectedItemsId).on('dragover', function(event) {
      event.preventDefault();
  }).on('drop', function(event) {
      event.preventDefault();
      var data = event.originalEvent.dataTransfer.getData('text');
      var draggedItem = $('[data-id="' + data + '"]');
      $('#' + selectedItemsId).append(draggedItem);
  });
}

  function setupDragAndSubmit(submitButtonId, selectedItemsId, quickLinkInputId, url) {
    $('#' + submitButtonId).on('click', function(event){
        event.preventDefault();

        // Mảng dữ liệu được chọn 
        var selectedItems = [];

        $('#' + selectedItemsId + ' .draggable-item').each(function(){
            // Đưa thông tin từng draggable items vào mảng
            selectedItems.push({
                id: $(this).data('id').trim().replace(/\//g, ''),
                name: $(this).text().trim().replace(/\s+/g, '').replace(/\//g, '')
            });
        });

        // Lấy giá trị của quick_link_id từ input hidden
        var quickLinkId = $('#' + quickLinkInputId).val();

        // Sử dụng phương pháp AJAX đưa dữ liệu cho controller để lưu trữ vào database
        $.ajax({
            url: url,
            type: 'post',
            data: {
                selectedItems: JSON.stringify(selectedItems),
                quick_link_id: quickLinkId
            },
            success: function(response) {
                toastr.success('Success ! Your data is updated.');            
            },
            error: function(xhr, status, error) {
                toastr.error('Error! Your data is NOT updated');
            }
        });
    });
}

  