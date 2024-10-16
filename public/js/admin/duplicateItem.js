function duplicateElement(btnSelector, htmlContent, targetContainer) {
    $(btnSelector).click(function () {
        $(targetContainer).append(htmlContent);
    });
}

// function duplicateInputField(btnSelector, htmlContent, targetContainer) {
//     doucument.getElememntById(btnSelector).addEventListener('click', function () {
//       const random = Math.floor(Math.random() * 1000);

//       const newHtmlContent = htmlContent.replace(/id="([^"]*)"/g, (match, p1) => `id="${p1}_${random}"`);

//       document.querySelector(targetContainer).insertAdjacentHTML('beforeend', newHtmlContent);
//     });

//   }