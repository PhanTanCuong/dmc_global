// Sự kiện khi bắt đầu kéo
$('.draggable-item').on('dragstart', function(event) {
    event.originalEvent.dataTransfer.setData('text', event.target.dataset.id);
  });
  
  $('#availableItems,#selectedItems').on('dragover', function(event) {
    event.preventDefault();
  });
  
  // Sự kiện sau khi thả
  // selectedItems
    $('#selectedItems').on('drop', function(event) {
      event.preventDefault();
      var data = event.originalEvent.dataTransfer.getData('text');
      var draggedItem = $('[data-id="' + data + '"]');
      $('#selectedItems').append(draggedItem);
    });   
    // availableItems
    $('#availableItems').on('drop', function(event) {
      event.preventDefault();
      var data = event.originalEvent.dataTransfer.getData('text');
      var draggedItem = $('[data-id="' + data + '"]');
      $('#availableItems').append(draggedItem);
    });  
    
    $('#submitButton').on('click', function(event){
      event.preventDefault();

      //Mảng dữ liệu được chọn 
      var selectedItems=[];

      $('#selectedItems .draggable-item').each(function(){
        //đưa thông tin từng draggable items vào mảng
        selectedItems.push({
          id: $(this).data('id'),
          name: $(this).text()
        });
      });

      //Sử dụng phương pháp ajax đưa dữ liệu cho controlller để lưu trữ vào database

      $.ajax({
        url:'customizeQuickLink',
        type:'post',
        data:{
          //Chuyển mảng thành dữ liệu json
          selectedItems:JSON.stringify(selectedItems)
        },
        success:function(response) {
          console.log(response);
        },
        error: function(xhr, status, error) {
          console.log(error);
        }
      })
    })