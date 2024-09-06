$('.edit_btn').click(function(e) {
    e.preventDefault();

    var account_id = $(this).closest('tr').find('.edit_id').val();

    // console.log(account_id);

    $.ajax({
        type: "POST",
        url: 'Customize/getDataById/' + account_id,
        data: {
            'checking_edit_btn': true,
            'data_id': account_id,
        },
        success: function(response) {
            // console.log(response);
            $.each(response, function(key, value) {
                $('#edit_id').val(value['id']);
                $('#edit_title').val(value['title']);
                $('#edit_description').val(value['description']);
            });
            $('#editData').modal('show');
        }
    });
});
