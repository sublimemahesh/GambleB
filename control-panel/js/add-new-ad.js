$(document).ready(function () {

    $("#district").change(function () {

        var district = this.value;

        $('#city').empty();

        $.ajax({
            url: "post-and-get/ajax/add-new-ad.php",
            type: "POST",
            data: {
                district: district,
                actiongetSUB: 'GETSUBCITY'
            },
            dataType: "JSON",
            success: function (jsonStr) {
                var html = '<option value=""> -- City -- </option>';

                $.each(jsonStr, function (key, data) {

                    html += '<option value="' + data.id + '">' + data.name + '</option>';

                });

                $('#city').append(html);

            }
        });

    });

    $("#category").change(function () {

        var category = this.value;

        $('#subCategory').empty();

        $.ajax({
            url: "post-and-get/ajax/add-new-ad.php",
            type: "POST",
            data: {
                category: category,
                actiongetSubCategory: 'GETSUBCATEGORY'
            },
            dataType: "JSON",
            success: function (jsonStr) {

                var html = '<option value=""> -- Sub Category -- </option>';

                $.each(jsonStr, function (key, data) {

                    html += '<option value="' + data.id + '">' + data.name + '</option>';

                });

                $('#subCategory').append(html);

            }
        });

    });

    $("#subCategory").change(function () {

        var subCategory = this.value;
        
        $('#brand').empty();

        $.ajax({
            url: "post-and-get/ajax/add-new-ad.php",
            type: "POST",
            data: {
                subCategory: subCategory,
                actiongetBrand: 'actiongetBrand'
            },
            dataType: "JSON",
            success: function (jsonStr) {
          
                var html = '<option value=""> -- Select Brand -- </option>';

                $.each(jsonStr, function (key, data) {

                    html += '<option value="' + data.id + '">' + data.name + '</option>';

                });

                $('#brand').append(html);

            }
        });

    });

});