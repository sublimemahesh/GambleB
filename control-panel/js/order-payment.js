$(document).on('click', '.change-order-payment-status', function () {

    var id = $(this).attr("data-id");
    var status = $(this).attr("status");

    if (status == 2) {
        swal({
            title: "Are you sure?",
            text: "Are you want to mark payment as unsuccess?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, mark it!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "ajax/order-payment.php",
                type: "POST",
                data: {id: id, option: 'unsuccess'},
                dataType: "JSON",
                success: function (jsonStr) {
                    if (jsonStr.status) {

                        swal({
                            title: "Marked!",
                            text: "Payment marked as unsuccess.",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        location.reload();

                    }
                }
            });
        });
    } else {
        swal({
            title: "Are you sure?",
            text: "Are you want to mark payment as success?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, mark it!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "ajax/order-payment.php",
                type: "POST",
                data: {id: id, option: 'success'},
                dataType: "JSON",
                success: function (jsonStr) {
                    if (jsonStr.status) {

                        swal({
                            title: "Marked!",
                            text: "Payment marked as success.",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        location.reload();

                    }
                }
            });
        });
    }

});
$(document).on('click', '.mark-as-refund', function () {

    var id = $(this).attr("data-id");

        swal({
            title: "Are you sure?",
            text: "Are you want to mark order as refund?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, mark it!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "ajax/order-payment.php",
                type: "POST",
                data: {id: id, option: 'refund'},
                dataType: "JSON",
                success: function (jsonStr) {
                    if (jsonStr.status) {

                        swal({
                            title: "Marked!",
                            text: "Payment marked as refund.",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        $('#row_' + id).remove();

                    }
                }
            });
        });
    
});
