
//registration validation
$(document).ready(function () {
    $('#btn-save').click(function (event) {
        event.preventDefault();

        if (!$('#district').val() || $('#district').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select district..!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (!$('#city').val() || $('#city').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select city..!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else {

            var formData = new FormData($("form#dealer-form")[0]);

            $.ajax({
                url: "ajax/dealer_area.php",
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function (result) {

                    if (result.status === 'error') {
                        swal({
                            title: "Error!",
                            text: "There was an error. Please try again later.",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        return false;
                    } else if (result.status === 'exist') {
                        swal({
                            title: "Error!",
                            text: "Area already exist.",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        $('#email').focus();
                        return false;
                    } else {
                        $('#city').val('');
                        swal({
                            title: "Success.!",
                            text: "The area was addes successfully.",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });

                    }
                }
            });
        }
        return false;
    }
    );

    $('.delete-area').click(function (eveny) {
        var id = $(this).attr("data-id");

        swal({
            title: "Delete!.",
            text: "Do you really want to delete this area?...",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "ajax/dealer_area.php",
                type: "POST",
                data: {id: id, action: 'delete'},
                dataType: "JSON",
                success: function (jsonStr) {
                    if (jsonStr.status == 'success') {
                        swal({
                            title: "Deleted!",
                            text: "The area was deleted successfully.",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        $('#row_' + id).remove();

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
});
//Registration validation



