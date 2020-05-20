$(document).ready(function () {
    $('#confirm-order').click(function () {
        var id = $(this).attr("data-id");
        var dealer = $(this).attr("dealer");

        swal({
            title: "Confirm!",
            text: "Do you really want to confirm the order?...",
            type: "success",
            showCancelButton: true,
            confirmButtonColor: "#28a745",
            confirmButtonText: "Yes, Confirm it!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "post-and-get/ajax/confirm-order.php",
                type: "POST",
                data: {
                    id: id,
                    dealer: dealer,
                    action: 'ASSIGNDEALER'
                },
                dataType: "JSON",
                success: function (jsonStr) {
                    if (jsonStr.status == 'success') {

                        swal({
                            title: "Confirmed!",
                            text: "Order has been confirmed successfully.",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        $('#row_' + id).remove();

                    } else if (jsonStr.status == 'already_assigned') {
                        swal({
                            title: "Already Confirmed!",
                            text: "This order already has been confirmed.",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                }
            });
        });
    });

    $('#complete-order').click(function () {
        var id = $(this).attr("data-id");

        swal({
            title: "complete!",
            text: "Do you really want to complete the order?...",
            type: "success",
            showCancelButton: true,
            confirmButtonColor: "#28a745",
            confirmButtonText: "Yes, Complete it!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "post-and-get/ajax/confirm-order.php",
                type: "POST",
                data: {
                    id: id,
                    action: 'COMPLETEORDER'
                },
                dataType: "JSON",
                success: function (jsonStr) {
                    if (jsonStr.status == 'success') {

                        swal({
                            title: "Completed!",
                            text: "Order has been completed successfully.",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        $('#row_' + id).remove();

                    } else {
                        swal({
                            title: "Error!",
                            text: "There was an error..",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                }
            });
        });
    });



    $('#cancle-order').click(function () {
       
        var id = $(this).attr("data-id");

        swal({
            title: "Cancle!",
            text: "Do you really want to cancle the order?...",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            confirmButtonText: "Yes, Cancle it!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "post-and-get/ajax/confirm-order.php",
                type: "POST",
                data: {
                    id: id,
                    action: 'CANCLEORDER'
                },
                dataType: "JSON",
                success: function (jsonStr) {
                    if (jsonStr.status == 'success') {

                        swal({
                            title: "Canceled!",
                            text: "Order has been canceled successfully.",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        $('#row_' + id).remove();

                    } else {
                        swal({
                            title: "Error!",
                            text: "There was an error..",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                }
            });
        });
    });

});

