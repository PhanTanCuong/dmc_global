function isValidImage(file) {
    const allowedExtensions = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

    if (file) {
        const fileType = file.type;
        return allowedExtensions.includes(fileType);
    }
    return false;
}

function validateImageInputs(inputIds) {
    let isValid = true;
    $.each(inputIds, function(index, id) {
        const fileInput = $(`#${id}`)[0];
        if (fileInput && fileInput.files.length > 0) {
            const file = fileInput.files[0];
            if (!isValidImage(file)) {
                isValid = false; // Nếu bất kỳ tệp nào không hợp lệ, đặt isValid thành false
                return false; // Thoát khỏi vòng lặp
            }
        }
    });
    return isValid;
}

function setupFormValidation(formId, inputIds) {
    $(`#${formId}`).on('submit', function(event) {
        if (!validateImageInputs(inputIds)) {
            event.preventDefault(); // Ngăn chặn việc gửi form nếu tệp không hợp lệ
            alert('Invalid image format. Please upload a valid image.');
        }
    });
}