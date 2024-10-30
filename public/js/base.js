// Reload table
function refreshTable(tableElement, url) {
    $.ajax({
        url: url,
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            $(tableElement).html(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('Error:', textStatus, errorThrown);
        }
    })
}

//Add record function
function addRecord(addFrm) {
    var data = new FormData(addFrm);
    data.append('action', 'add_record')
    console.log(data);
    $.ajax({
        type: 'POST',
        url: $(addFrm).attr('action'),
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function (response) {
            // console.log(response);
            if (response.success === true) {

                $(addFrm)[0].reset(); // reset lại các trường

                //Kiểm tra tồn tại phần tử summernote editor
                if ($('.summernote').length) {
                    $('.summernote').summernote('code', '<p><br></p>');
                }

                toastr.success(response.message);
            } else {
                toastr.error(response.message);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('Error:', textStatus, errorThrown);
            console.log('Response:', jqXHR.responseText);
        },
    });
}


//Delete record 

function deleteRecord(deleteBtn, uri, tableElement, reloadApi) {
    var id = $(deleteBtn).attr("data-id");
    console.log(id);

    $.ajax({
        type: 'GET',
        url: uri,
        data: {
            action: "delete_data",
            id: id
        },
        cache: false,
        dataType: 'json',
        success: function (response) {
            // console.log(response);
            if (response.success === true) {
                toastr.success(response.message);
                refreshTable(tableElement, url);
            } else {
                toastr.error(response.message);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('Error:', textStatus, errorThrown);
            console.log('Response:', jqXHR.responseText);
        }
    });

}