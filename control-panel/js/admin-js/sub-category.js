$(document).ready(function () {
    $('#category').change(function () {

        var id = $(this).val();

        $.ajax({
            url: "post-and-get/ajax/product.php",
            type: "POST",
            data: {
                id: id,
                action: 'GETSUBCATEGORIESBYCATEGORY'
            },
            dataType: "JSON",
            success: function (jsonStr) {

                var html = '<option> -- Please Select a Sub Category -- </option>';
                $.each(jsonStr, function (i, data) {
                    html += '<option value="' + data.id + '">';
                    html += data.name;
                    html += '</option>';
                });
                $('#sub_category').empty();
                $('#sub_category').append(html);
            }
        });
    });
});


