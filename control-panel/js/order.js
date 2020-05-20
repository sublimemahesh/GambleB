$(document).ready(function () {
    $('.mark-as-delivered').click(function () {

        var id = $(this).attr("data-id");

        swal({
            title: "Are you sure?",
            text: "Are you want to mark this order as delivered???",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, mark it!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "ajax/order.php",
                type: "POST",
                data: {id: id, option: 'delivered'},
                dataType: "JSON",
                success: function (jsonStr) {
                    if (jsonStr.status) {

                        swal({
                            title: "Marked!",
                            text: "Your order has been marked as delivered.",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        $('#row' + id).remove();

                    }
                }
            });
        });
    });

    $('.mark-as-completed').click(function () {

        var id = $(this).attr("data-id");

        swal({
            title: "Are you sure?",
            text: "Are you want to mark this order as completed???",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, mark it!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "ajax/order.php",
                type: "POST",
                data: {id: id, option: 'completed'},
                dataType: "JSON",
                success: function (jsonStr) {
                    if (jsonStr.status) {

                        swal({
                            title: "Marked!",
                            text: "Order has been marked as completed.",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        $('#row' + id).remove();

                    }
                }
            });
        });
    });

    $(document).on('click', '.cancel-order', function () {

        var id = $(this).attr("data-id");

        swal({
            title: "Are you sure?",
            text: "Are you want to cancel this order???",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, cancel it!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "ajax/order.php",
                type: "POST",
                data: {id: id, option: 'cancel'},
                dataType: "JSON",
                success: function (jsonStr) {
                    if (jsonStr.status) {

                        swal({
                            title: "Canceled!",
                            text: "Your order has been canceled.",
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

    $('.do-payment').click(function () {

        var id = $(this).attr("data-id");

        swal({
            title: "Are you sure?",
            text: "Do you want to pay???",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, pay it!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "ajax/order.php",
                type: "POST",
                data: {id: id, option: 'pay'},
                dataType: "JSON",
                success: function (jsonStr) {
                    if (jsonStr.status) {

                        swal({
                            title: "paid!",
                            text: "The payment was paid successfully.",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        $('#row' + id).remove();

                    }
                }
            });
        });
    });

    $("#qty").keyup(function () {
        var qty, price, total_amount;

        qty = this.value;
        price = $('option:selected', '#product').attr('price');

        total_amount = qty * price;
        $(".amount.form-line").addClass('focused');
        $("#amount").val(total_amount);
    });

    $("#product").change(function () {
        var qty, price, total_amount;

        qty = $("#qty").val();
        price = $('option:selected', this).attr('price');
        if (qty == '') {
            qty = 0;
        }
        total_amount = qty * price;
        $(".amount.form-line").addClass('focused');
        $("#amount").val(total_amount);
    });
});