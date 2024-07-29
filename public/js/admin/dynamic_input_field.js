
$(document).ready(function() {
    var max_input_ic_fields = 5;
    var input_ic_wrapper = $('#icon-list');
    var add_ic_input = $('.icon-item').length;

    $('#add-icon').click(function() {
        if (add_ic_input < max_input_ic_fields) {
            add_ic_input++;
            var new_ic_input = `
            <div class="icon-item">
                <input type="text" name="icons[][name]" placeholder="Icon Name" class="form-control mb-2">
                <input type="text" name="icons[][value]" placeholder="Icon Value" class="form-control mb-2">
                <input type="text" name="icons[][icon]" placeholder="Icon Class" class="form-control mb-2">
                <button type="button" class="btn btn-danger remove-icon"><i class="fas fa-trash"></i></button>
            </div>
        `;
            input_ic_wrapper.append(new_ic_input);
        } else {
            alert('You can only add up to ' + max_input_ic_fields + ' icons.');
        }
    });

    $(document).on('click', '.remove-icon', function() {
        $(this).closest('.icon-item').remove();
        add_ic_input--;
    });
});