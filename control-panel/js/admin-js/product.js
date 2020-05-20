$(document).ready(function () {

    $('#product_category').change(function () {

        var proCategoryID = $(this).val();

        $.ajax({
            url: "post-and-get/ajax/product.php",
            type: "POST",
            data: {
                proCategoryID: proCategoryID,
                action: 'GETPRODUCTBYCATEGORY'
            },
            dataType: "JSON",
            success: function (jsonStr) {

                var html = '<option> -- Please Select a Product -- </option>';
                $.each(jsonStr, function (i, data) {
                    html += '<option value="' + data.id + '">';
                    html += data.name;
                    html += '</option>';
                });
                $('#product').empty();
                $('#product').append(html);
            }
        });
    });

//get sub product
    $('#category').change(function () {

        var proCategoryID = $(this).val();

        $.ajax({
            url: "post-and-get/ajax/product.php",
            type: "POST",
            data: {
                proCategoryID: proCategoryID,
                action: 'GETSUBPRODUCTBYCATEGORY'
            },
            dataType: "JSON",
            success: function (jsonStr) {

                var html = '<option> -- Please Select a Sub Product -- </option>';
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

//Confirm order
$('#confirm_order').click(function (event) {
    event.preventDefault();

    var id = $('#id').val();
    var customer = $('#customer').val();

    swal({
        title: "Confirm Order.!",
        text: "Do you really want to confirm this order?...",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#ff9600",
        confirmButtonText: "  Yes, confirm It!",
        closeOnConfirm: false
    }, function () {

        //Send Form data
        $.ajax({
            url: "post-and-get/ajax/product.php",
            type: 'POST',
            data: {
                id: id,
                customer: customer,
                action: "CONFIRM",
            },

            dataType: "JSON",
            success: function (result) {
                if (result.status === 'error') {
                    swal({
                        title: "Error!",
                        text: "Error!...",
                        type: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    });
                } else {
                    swal({
                        title: "SUCCESS.!",
                        text: "Order has confirmed!...",
                        type: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    }, function () {
                        setTimeout(function () {
                            window.location.replace("confirm-orders.php");
                        }, 2000);
                    });
                }
            }
        });
    });

});

//Cancel order
$('#cancle').click(function (event) {
    event.preventDefault();
    var id = $('#id').val();

    swal({
        title: "Cancel Order.!",
        text: "Do you really want to cancel this order?...",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#fb483a",
        confirmButtonText: "  Yes, cancel It!",
        closeOnConfirm: false
    }, function () {

        //Send Form data
        $.ajax({
            url: "post-and-get/ajax/product.php",
            type: 'POST',
            data: {
                id: id,
                action: "CANCEL",
            },

            dataType: "JSON",
            success: function (result) {
                if (result.status === 'error') {
                    swal({
                        title: "Error!",
                        text: "Error!...",
                        type: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    });
                } else {
                    swal({
                        title: "SUCCESS.!",
                        text: "Order has canceled!...",
                        type: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    }, function () {
                        setTimeout(function () {
                            window.location.replace("cancel-orders.php");
                        }, 2000);
                    });
                }
            }
        });
    });

});

//Deliver order

$('#deliver').click(function (event) {
    event.preventDefault();

    var type = $('#type').val();
    var id = $('#id').val();

    if (!$('#type').val() || $('#type').val().length === 0) {
        swal({
            title: "Error!",
            text: "Please enter the deliver type",
            type: 'error',
            timer: 2000,
            showConfirmButton: false
        });

    } else {

        swal({
            title: "Deliver Order.!",
            text: "Do you really want to deliver this order?...",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#00b0e4",
            confirmButtonText: "  Yes, deliver It!",
            closeOnConfirm: false
        }, function () {

            //Send Form data
            $.ajax({
                url: "post-and-get/ajax/product.php",
                type: 'POST',
                data: {
                    id: id,
                    type: type,
                    action: "DELIVER"
                },
                dataType: "JSON",
                success: function (result) {
                    if (result.status === 'error') {
                        swal({
                            title: "Error!",
                            text: "Error!...",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {
                        swal({
                            title: "SUCCESS.!",
                            text: "Order has canceled!...",
                            type: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        }, function () {
                            setTimeout(function () {
                                $('#myModal').modal('hide');
                                window.location.replace("deliver-orders.php");
                            }, 2000);
                        });
                    }
                }
            });
        });
    }
});


