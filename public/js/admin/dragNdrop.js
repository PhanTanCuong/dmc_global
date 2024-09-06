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