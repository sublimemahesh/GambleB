
//loging validation
$(document).ready(function () {
    $('#reset_pass').click(function (event) {
        event.preventDefault();


        if (!$('#reset_code').val() || $('#reset_code').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the Reset code..!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (!$('#new_pass').val() || $('#new_pass').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the Password..!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });

        } else if (!$('#con_pass').val() || $('#con_pass').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the Confirm password..!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if ($('#con_pass').val() !== $('#new_pass').val()) {
            swal({
                title: "Error!",
                text: "New password and confirm password does not match..!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else {

            var formData = new FormData($("form#reset-form")[0]);

            $.ajax({
                url: "ajax/reset-password.php",
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
                            text: "Invalid Reset code !...",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                   
                    } else {
                        swal({
                            title: "Success.!",
                            text: "password was reset successfully !...",
                            type: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        }, function () {
                            setTimeout(function () {
                                window.location.replace("login.php");
                            }, 2000);
                        });
                    }
                }
            });
        }
        return false;
    }
    );
}); 