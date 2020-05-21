
//loging validation
$(document).ready(function () {

    $('#login').click(function (event) {
        event.preventDefault();

        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        if (!$('#login_email').val() || $('#login_email').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the email..!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (!emailReg.test($('#login_email').val())) {
            swal({
                title: "Error!",
                text: "please enter a valid email",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (!$('#login_password').val() || $('#login_password').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the password..!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else {

            var formData = new FormData($("form#login-form")[0]);
            $.ajax({
                url: "post-and-get/ajax/loging.php",
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
                            text: "Invalid username or password!...",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {
                        window.location.replace("index.php");

                    }
                }
            });
        }
        return false;
    });

    $('#register').click(function (event) {
        event.preventDefault();

        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

        if (!$('#name').val() || $('#name').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the name..!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (!$('#phone').val() || $('#phone').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the phone number..!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (!$('#email').val() || $('#email').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the email..!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (!emailReg.test($('#email').val())) {
            swal({
                title: "Error!",
                text: "please enter a valid email",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (!$('#password').val() || $('#password').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the password..!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else {

            var formData = new FormData($("form#registration-form")[0]);
            $.ajax({
                url: "post-and-get/ajax/registration.php",
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function (result) {

                    if (result.status === 'emailex') {
                        swal({
                            title: "Error!",
                            text: "The email is already in use. Please sign in to your account!.",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {
                        window.location.replace("index.php");

                    }
                }
            });
        }
        return false;
    });

}); 