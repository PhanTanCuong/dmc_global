// // Reload table
// function refreshTable(tableElement, url) {
//     console.log(tableElement);
//     $.ajax({
//         url: url,
//         method: 'GET',
//         cache: false,
//         contentType: false,
//         processData: false,
//         dataType: 'json',
//         success: function (data) {
//             // let tableContent = dataFormatter(response);
//             //    $(tableElement).html(data);
//             // location.reload();
//             // console.log('refresh table successfully');

//             $( tableElement ).load( url+tableElement );
//         },
//         error: function (jqXHR, textStatus, errorThrown) {
//             console.log('Error:', textStatus, errorThrown);
//         }
//     })
// }


//Reload div
function reloadDiv(divElement, url) {
    console.log('divElement');
    $.ajax({
        url: url,
        method: 'GET',
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function (data) {

            // let htmlContent = ''; // Chuỗi để lưu HTML tạo từ dữ liệu
            // data.category.forEach(item => {
            //     htmlContent += `<p>${item.name}</p>`; // Chỉnh sửa HTML theo yêu cầu của bạn
            // });

            // // Gán lại nội dung cho phần tử div
            // $(divElement).html(htmlContent);
            // location.reload();
            // console.log('Div refreshed successfully');

            $( divElement ).load( url+divElement );
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('Error:', textStatus, errorThrown);
        }
    })
}

//Add record function
function addRecord(addFrm, callback) {
    var data = new FormData(addFrm);
    data.append('action', 'add_record')
    // console.log(data);
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
                toastr.success(response.message);
                if (callback && typeof callback === 'function') {
                    callback(response);
                }
            } else {
                toastr.error(response.message || 'Xảy ra lỗi!');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('Error:', textStatus, errorThrown);
            console.log('Response:', jqXHR.responseText);
        },
    });
}


//Delete record 

function deleteRecord(deleteBtn, url, callback) {
    var id = $(deleteBtn).attr("data-id");
    console.log(id);

    $.ajax({
        type: 'GET',
        url: url,
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
                if (callback && typeof callback === 'function') {
                    callback(response);
                }
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