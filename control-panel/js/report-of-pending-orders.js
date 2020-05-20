$(document).ready(function () {
    $('.form-line').addClass('focused');
    $.ajax({
        type: 'POST',
        url: 'ajax/reports.php',
        dataType: "json",
        data: {
            option: 'GETSTARTANDENDDATE'
        },
        success: function (result) {
            $("#from").val(result.start_date);
            $("#to").val(result.end_date);
            $.ajax({
                type: 'POST',
                url: 'ajax/reports.php',
                dataType: "json",
                data: {
                    from: result.start_date,
                    to: result.end_date,
                    status: 0,
                    option: 'GETPENDINGORDERSBYSTARTANDENDDATE'
                },
                success: function (orders) {
                    var table = $('#pending-orders').DataTable();
                    $("#pending-orders tbody").empty();
                    table.clear();

//                    callLoader();
                    var html = '';
                    var sum = 0;
                    if (orders) {
                        $.each(orders, function (key, order) {

                            key++;
                            sum += parseFloat(order.amount);
                            table.row.add([
                                key,
                                order.orderId,
                                order.orderedAt,
                                order.fullName,
                                order.address,
                                order.product,
                                order.qty,
                                order.amount
                            ]).draw();
                        });
                    } else {
                        html = 'No any orders in database';
                        $("#pending-orders tbody").empty();
                        $("#pending-orders tbody").append(html);
                    }
                    $("#amount-total").empty();
                    $("#amount-total").html(sum);
                }

            });
        }
    });

    $("#from").change(function () {
        var from = $("#from").val();
        var to = $("#to").val();
//        callLoader();
        $.ajax({
            type: 'POST',
            url: 'ajax/reports.php',
            dataType: "json",
            data: {
                from: from,
                to: to,
                status: 0,
                option: 'GETPENDINGORDERSBYSTARTANDENDDATE'
            },
            success: function (orders) {
                var table = $('#pending-orders').DataTable();
                $("#pending-orders tbody").empty();
                table.clear();
//                    callLoader();
                var html = '';
                var sum = 0;

                if (orders) {

                    $.each(orders, function (key, order) {

                        key++;
                        sum += parseFloat(order.amount);
                        table.row.add([
                            key,
                            order.orderId,
                            order.orderedAt,
                            order.fullName,
                            order.address,
                            order.product,
                            order.qty,
                            order.amount
                        ]).draw();



                    });
                } else {
                    html = 'No any orders in database';
                    $("#pending-orders tbody").empty();
                    $("#pending-orders tbody").append(html);
                }
                $("#amount-total").empty();
                $("#amount-total").html(sum);
            }

        });
    });

    $("#to").change(function () {
        var from = $("#from").val();
        var to = $("#to").val();
//        callLoader();
        $.ajax({
            type: 'POST',
            url: 'ajax/reports.php',
            dataType: "json",
            data: {
                from: from,
                to: to,
                status: 0,
                option: 'GETPENDINGORDERSBYSTARTANDENDDATE'
            },
            success: function (orders) {
                var table = $('#pending-orders').DataTable();
                $("#pending-orders tbody").empty();
                table.clear();
//                    callLoader();
                var html = '';
                var sum = 0;

                if (orders) {

                    $.each(orders, function (key, order) {

                        key++;
                        sum += parseFloat(order.amount);
                        table.row.add([
                            key,
                            order.orderId,
                            order.orderedAt,
                            order.fullName,
                            order.address,
                            order.product,
                            order.qty,
                            order.amount
                        ]).draw();



                    });
                } else {
                    html = 'No any orders in database';
                    $("#pending-orders tbody").empty();
                    $("#pending-orders tbody").append(html);
                }
                $("#amount-total").empty();
                $("#amount-total").html(sum);
            }

        });
    });

//    function callLoader() {
//        $.loadingBlockShow({
//            imgPath: 'plugins/loader/img/default.svg',
//            style: {
//                position: 'fixed',
//                width: '100%',
//                height: '100%',
//                background: 'rgba(0, 0, 0, .6)',
//                left: 0,
//                top: 0,
//                zIndex: 10000
//            }
//        });
//
//        setTimeout($.loadingBlockHide, 5000);
//    }
//    ;

});


