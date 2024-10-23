function duplicateElement(btnSelector, htmlContent, targetContainer) {
    $(btnSelector).click(function () {
        $(targetContainer).append(htmlContent);
    });
}

const setText = (id, content) => {
    const item = document.getElementById(id)
    if (item === null) return

    item.innerText = content
}
let counter = 1; // Đếm số lần nhân bản, đồng thời xác định index của item

function duplicateTemplate(btnSelector, formId, templateId) {
    if (!$(btnSelector).length) {
        console.error(`Button with selector "${btnSelector}" not found`);
        return;
    }
    $(btnSelector).click(function () {

        if(counter>7){
            toastr.error('Exceed the number to be duplicated');
            return;
        }
        
        let formContainer, templateContainer;
        formContainer = document.getElementById(formId);
        templateContainer = document.getElementById(templateId);

        if (!formContainer) {
            console.error(`Element with id "${formId}" not found`);
            return;
        }

        if (!templateContainer) {
            console.error(`Element with id "${templateId}" not found`);
            return;
        }

        // Nhân bản template form

        const clonedElement = templateContainer.cloneNode(true); // Sử dụng cloneNode để sao chép phần tử
        const inputs = clonedElement.querySelectorAll('input, textarea'); // Lấy tất cả input và textarea trong clonedElement

        inputs.forEach(function (input) {
            const oldNameAttribute = input.getAttribute('name');
            const newNameAttribute = oldNameAttribute.replace(/\[\d+\]/, `[${counter}]`); // Thay thế và set index mới
            input.setAttribute('name', newNameAttribute);
            input.value = ''; // Xóa giá trị cũ
        });

        // Nhân đôi nhóm mới sau formContainer
        formContainer.appendChild(clonedElement);

        counter++;

    });
}

