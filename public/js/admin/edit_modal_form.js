function populateModalFields(buttonSelector, urlPrefix, fieldMapping, modalSelector) {
    $(document).ready(function() {
        $(buttonSelector).click(function(e) {
            e.preventDefault();

            var id = $(this).closest('tr').find('.edit_id').val();

            console.log(id);

            $.ajax({
                type: "POST",
                url: urlPrefix + '/' + id,
                data: {
                    'checking_edit_btn': true,
                    'id': id,
                },
                success: function(response) {
                    console.log(response);
                    $.each(response, function(key, value) {
                        // Populate fields based on the fieldMapping
                        for (var field in fieldMapping) {
                            if (fieldMapping.hasOwnProperty(field)) {
                                var selector = fieldMapping[field];
                                if (field === 'image') {
                                    $(modalSelector).find(selector).attr('src', '/dmc_global/public/images/' + value[field]);
                                } else {
                                    $(modalSelector).find(selector).val(value[field]);
                                }
                            }
                        }
                    });
                    $(modalSelector).modal('show');
                },
                error: function() {
                    alert('Failed to fetch data');
                }
            });
        });
    });
}
