function generateToSlug(input_field,slug_field){
    $('#' + input_field).on('input',function(){
        var name =$(this).val();

        var slug = name.toLowerCase()
        .replace(/á|à|ả|ã|ạ|â|ấ|ầ|ẩ|ẫ|ậ|ă|ắ|ằ|ẳ|ẵ|ặ/g, "a")
        .replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/g, "e")
        .replace(/i|í|ì|ỉ|ĩ|ị/g, "i")
        .replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/g, "o")
        .replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/g, "u")
        .replace(/ý|ỳ|ỷ|ỹ|ỵ/g, "y")
        .replace(/đ/g, "d")
        .replace(/\s+/g, '-')  // Replace spaces with "-"
        .replace(/[^a-z0-9-]/g, '');  // Remove any character that is not a letter, number, or hyphen

        $('#' + slug_field).val(slug);
    })
}

function generateToMeta(input_field,meta_field){
    $('#' + meta_field).val($('#' + input_field).val());
    $('#' + input_field).on('input',function(){
        var input =$(this).val();

        $('#' + meta_field).val(input);
    })
}