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
function addRecord(addFrm,url){
    var data =$(addFrm).serialize();
    console.log(data);
    $.ajax({
        type:'POST',
        url: url,
        data:data,
        success:function(response){
            
            response=JSON.parse(JSON.stringify(response));
            console.log(response);
            if(response.success){
                toastr.success(response.message);
            }else{
                toastr.error(response.message);
            }
        },
        error:function(jqXHR, textStatus, errorThrown){
            console.log('Error:', textStatus, errorThrown);
        }
    });
}