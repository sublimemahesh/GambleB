
//update
$(document).ready(function () {
    $('#btn-update').click(function (event) {
        event.preventDefault();
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

        $('#btn-update').hide();
        $('#update-loading').show();

        if (!$('#name').val() || $('#name').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the name...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            $('#btn-update').show();
            $('#update-loading').hide();

        } else if (!$('#phone').val() || $('#phone').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the phone number...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            $('#btn-update').show();
            $('#update-loading').hide();

        } else if (!$('#email').val() || $('#email').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the email...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            $('#btn-update').show();
            $('#update-loading').hide();

        } else if (!emailReg.test($('#email').val())) {
            swal({
                title: "Error!",
                text: "please enter a valid email",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            $('#btn-update').show();
            $('#update-loading').hide();

        } else if (!$('#district').val() || $('#district').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select district...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            $('#btn-update').show();
            $('#update-loading').hide();

        } else if (!$('#city').val() || $('#city').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select city...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            $('#btn-update').show();
            $('#update-loading').hide();

        } else if (!$('#address').val() || $('#address').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the address...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            $('#btn-update').show();
            $('#update-loading').hide();

        } else if (!$('#nic').val() || $('#nic').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the NIC Number...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            $('#btn-update').show();
            $('#update-loading').hide();

        } else if ((!$('#nic_fr_photo_ex').val() || $('#nic_fr_photo_ex').val().length === 0) && !$('#nic_fr_photo').val()) {
            swal({
                title: "Error!",
                text: "Please select a copy of NIC front...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            $('#btn-update').show();
            $('#update-loading').hide();

        } else if ((!$('#nic_bk_photo_ex').val() || $('#nic_bk_photo_ex').val().length === 0) && !$('#nic_bk_photo').val()) {
            swal({
                title: "Error!",
                text: "Please select a copy of NIC back...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            $('#btn-update').show();
            $('#update-loading').hide();

        } else if (!$('#business_name').val() || $('#business_name').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the business name...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            $('#btn-update').show();
            $('#update-loading').hide();

        } else if (!$('#br_number').val() || $('#br_number').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the BR number...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            $('#btn-update').show();
            $('#update-loading').hide();

        } else if ((!$('#br_copy_ex').val() || $('#br_copy_ex').val().length === 0) && !$('#br_copy').val()) {
            swal({
                title: "Error!",
                text: "Please select a copy of BR...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            $('#btn-update').show();
            $('#update-loading').hide();

        } else {

            var formData = new FormData($("form#dealer-form")[0]);

            $.ajax({
                url: "ajax/dealer.php",
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
                            text: "There was an error. Please try again later",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        $('#btn-update').show();
                        $('#update-loading').hide();

                        return false;
                    } else if (result.status === 'error1') {
                        swal({
                            title: "Error!",
                            text: "Email address is already exist in the system.",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        $('#email').focus();


                        $('#btn-update').show();
                        $('#update-loading').hide();

                        return false;
                    } else {
                        swal({
                            title: "Success.!",
                            text: " Your details updated successfully.",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        window.location.replace("edit-profile.php");
                    }
                }
            });
        }
        return false;
    }
    );
});

//agreement
$(document).ready(function () {
    $('#send-agreement').click(function () {
        $.ajax({
            url: "post-and-get/ajax/agreement.php",
            method: "POST",
            data: {
                id: $("#send-agreement").attr("data-dealer"),
                action: "send_agreement"
            },
            dataType: "JSON",
            success: function (result) {

                if (result.status === 'success') {
                    swal({
                        title: "Success!...",
                        text: "Your mail has been sent successfully.",
                        type: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    return false;
                } else {
                    swal({
                        title: "Error!...",
                        text: "Unable to send email. Please try again.",
                        type: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    });

                }
            }
        });
    });
});




