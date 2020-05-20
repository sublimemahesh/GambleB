
$(document).ready(function () {
    $(document).on('click', '#product-table tbody .btn-pn-delete', function () {
        var pro_id = this.id;
        var pro_name = $('#pro_' + this.id).text();
        swal({
            title: "Delete!.",
            text: "Do you really want to delete " + pro_name + "?...",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function () {
            $.ajax({
                url: "ajax/order-products.php",
                type: "POST",
                data: {id: pro_id, action: 'delete'},
                dataType: "JSON",
                success: function (jsonStr) {
                    if (jsonStr.status == 'success') {

                        swal({
                            title: "Deleted!",
                            text: pro_name + " was deleted successfully.",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        $('#row_' + pro_id).remove();

                    } else {
                        swal({
                            title: "Error!",
                            text: " There was an error while deleting.",
                            type: 'warning',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                }
            });
        });
    });


    $('#btn-pn-add').click(function () {
        $("#add-new-pro-modal").modal('show');
    });

    $('#btn_get_product').click(function () {
        var product_code = $('#product_code').val();
        product_code = product_code.replace("#", "");
        $.ajax({
            url: "ajax/order-products.php",
            type: "POST",
            data: {id: product_code, action: 'get_product'},
            dataType: "JSON",
            success: function (jsonStr) {
                if (jsonStr.status === 'invalid') {
                    swal({
                        title: "Invalid!",
                        text: "You have entred invalid prduct code.",
                        type: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    });
                } else {

                    $('#td_p_code').text('#' + jsonStr.id);
                    $('#td_p_name').text(jsonStr.name);
                    $('#td_p_unite').text(jsonStr.unite);
                    $('#td_p_price').val(parseFloat(jsonStr.price).toFixed(2));
                    $('#price').val(parseFloat(jsonStr.price).toFixed(2));
                    $('#td_p_quantity').val(1);
                    $('#product_id').val(jsonStr.id);
                    call_add_product_tot();
                }
            }
        });
    });

    $('#product_code').keypress(function (e) {
        var key = e.which;
        if (key === 13)  // the enter key code
        {
            $("#btn_get_product").click();
        }
    });

    $('.td-cal-tot').on('keyup keypress blur change', function (e) {
        call_add_product_tot();
    });

    $('#save_product').click(function () {

        var order = $('#order_id').val();
        var product = $('#product_id').val();
        var quantity = $('#td_p_quantity').val();
        var amount = $('#td_p_total').text();

        $.ajax({
            url: "ajax/order-products.php",
            type: "POST",
            data: {
                order: order,
                product: product,
                quantity: quantity,
                amount: amount,
                action: 'add_product'
            },
            dataType: "JSON",
            success: function (jsonStr) {
                if (jsonStr.status === 'error') {
                    swal({
                        title: "Error!",
                        text: " There was an error while saving.",
                        type: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    });
                } else {

                    var newRowContent = "";
                    newRowContent += "<tr id='row_" + jsonStr.status + "'>";
                    newRowContent += "<td>#</td>";
                    newRowContent += "<td id='proid_" + jsonStr.status + "'>" + product + "</td>";
                    newRowContent += "<td id='pro_" + jsonStr.status + "'>" + $('#td_p_name').text() + "</td>";
                    newRowContent += "<td id='price_" + jsonStr.status + "' class='text-right'>" + parseFloat($('#td_p_price').val()).toFixed(2) + "</td>";
                    newRowContent += "<td id='qty_" + jsonStr.status + "' class='text-right'>" + parseFloat(quantity).toFixed(2) + "</td>";
                    newRowContent += "<td id='amount_" + jsonStr.status + "' class='text-right'>" + amount + "</td>";
                    newRowContent += "<td class='text-center'>\n\
                          <div class='btn-pn-delete btn btn-sm btn-danger' id='" + jsonStr.status + "'> \n\
                          <i class='fa fa-trash-o'></i>\n\
                          </div>\n\
                          <div class='btn-pn-edit btn btn-sm btn-info' id='" + jsonStr.status + "'> \n\
                          <i class='fa fa-pencil'></i>\n\
                          </div>\n\
                          </td>";
                    newRowContent += "</tr>";
                    $("#product-table tbody").append(newRowContent);
                    $("#add-new-pro-modal").modal('hide');
                }
            }
        });


    });

    $('.td-cal-tot').keypress(function (e) {
        var key = e.which;
        if (key === 13)  // the enter key code
        {
            $("#save_product").click();
        }
    });

    $(document).on('click', '#product-table tbody .btn-pn-edit', function () {
        var code = $('#proid_' + this.id).text();
        var name = $('#pro_' + this.id).text();
        var price = $('#price_' + this.id).text();
        var qty = $('#qty_' + this.id).text();
        var total = $('#amount_' + this.id).text();

        $('#edit_pro_id').val(this.id);
        $('#ed_p_code').text(code);
        $('#ed_p_name').text(name);
        $('#ed_p_unite').text('XXX');
        $('#ed_p_price').val(price);
        $('#ed_p_quantity').val(qty);
        $('#ed_p_total').text(total);
        $("#edit-pro-modal").modal('show');
    });

    $('.ed-cal-tot').on('keyup keypress blur change', function (e) {
        call_edit_product_tot();
    });

    $('#edit_product').click(function () {

        var edit_pro_id = $('#edit_pro_id').val();
        var order = $('#order_id').val();
        var product = $('#ed_p_code').text();
        var quantity = $('#ed_p_quantity').val();
        var price = $('#ed_p_price').val();
        var amount = $('#ed_p_total').text();

        $.ajax({
            url: "ajax/order-products.php",
            type: "POST",
            data: {
                edit_pro_id: edit_pro_id,
                order: order,
                product: product,
                quantity: quantity,
                amount: amount,
                action: 'edit_product'
            },
            dataType: "JSON",
            success: function (jsonStr) {
                if (jsonStr.status === 'error') {
                    swal({
                        title: "Error!",
                        text: " There was an error while saving.",
                        type: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    });
                } else {

                    $('#price_' + edit_pro_id).text(parseFloat(price).toFixed(2));
                    $('#qty_' + edit_pro_id).text(parseFloat(quantity).toFixed(2));
                    $('#amount_' + edit_pro_id).text(parseFloat(amount).toFixed(2));

                    $("#edit-pro-modal").modal('hide');
                    swal({
                        title: "Updated!",
                        text: $('#ed_p_name').text() + " updated successfully.",
                        type: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });

                }
            }
        });

    });

    function call_add_product_tot() {
        var td_p_price = parseFloat($('#td_p_price').val());
        var td_p_quantity = parseFloat($('#td_p_quantity').val());

        var total = td_p_price * td_p_quantity

        $('#td_p_total').text(total.toFixed(2));
    }

    function call_edit_product_tot() {
        var ed_p_price = parseFloat($('#ed_p_price').val());
        var ed_p_quantity = parseFloat($('#ed_p_quantity').val());

        var total = ed_p_price * ed_p_quantity;

        $('#ed_p_total').text(total.toFixed(2));
    }
});

