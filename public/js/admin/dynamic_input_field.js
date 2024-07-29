
$(document).ready(function () {
    var max_input_ic_fields = 5;
    var input_ic_wrapper = $('#icon-list');
    var add_ic_input = $('.icon-item').length;

    $('#add-icon').click(function () {
        if (add_ic_input < max_input_ic_fields) {
            add_ic_input++;
            var new_ic_input = `
                <div class="icon-item">
                    <input type="hidden" name="icon_media_id">
                    <input type="text" name="icon_media_na"  placeholder="Enter name" class="form-control mb-2">
                    <input type="text" name="icon_media_value"  placeholder="Enter Value" class="form-control mb-2">
                    <label>Upload Icon Image</label>
                    <input type="file" name="icon_media_image" id="icon_media_image" class="form-control"><br>
                   <div class="controll-btn">
                    <button type="button" name="delete_ic_btn" class="btn btn-danger remove-icon"><i class="fas fa-trash"></i></button>
                    <button type="button" name="edit_ic_btn" class="btn btn-success remove-icon"><i class="fas fa-edit"></i></button>
                    </div>
        `;
            input_ic_wrapper.append(new_ic_input);
        } else {
            alert('You can only add up to ' + max_input_ic_fields + ' icons.');
        }
    });

    $(document).on('click', '.remove-icon', function () {
        $(this).closest('.icon-item').remove();
        add_ic_input--;
    });
});