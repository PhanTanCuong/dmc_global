// Reload table
function refreshTable(tableElement, url) {
    $.ajax({
        url: url,
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            $(tableElement).html(response);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('Error:', textStatus, errorThrown);
        }
    })
}

//Add record function
function addRecord(addFrm){
    var data =new FormData(addFrm);
    // console.log(data);
    $.ajax({
        type:'POST',
        url: $(addFrm).attr('action'),
        data:data,
        cache : false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success:function(response){
            // console.log(response);
            if(response.success===true){
                toastr.success(response.message);
            }else{
                toastr.error(response.message);
            }
        },
        error:function(jqXHR, textStatus, errorThrown){
            console.log('Error:', textStatus, errorThrown);
            console.log('Response:', jqXHR.responseText); 
        },
        complete: function (data) {
            $(addFrm)[0].reset(); // reset lại các trường

            //Kiểm tra tồn tại phần tử summernote editor
            if ($('.summernote').length) {
                $('.summernote').summernote('code', '<p><br></p>'); 
            }
        }
    });
}