$(document).ready(function () {
    $('#btn-save').click(function (event) {
        event.preventDefault();

//        $('#btn-save').hide();
        $('#update-loading').show();

        if (!$('#old_password').val() || $('#old_password').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the old password...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            $('#btn-save').show();
            $('#update-loading').hide();

        } else if (!$('#new_password').val() || $('#new_password').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the new password...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            $('#btn-save').show();
            $('#update-loading').hide();

        } else if (!$('#confirmed_password').val() || $('#confirmed_password').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the confirm password...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            $('#btn-save').show();
            $('#update-loading').hide();

        } else if ($('#new_password').val() != $('#confirmed_password').val()) {
            swal({
                title: "Error!",
                text: "New Password and confirmed password does not matched...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            $('#btn-save').show();
            $('#update-loading').hide();

        } else {

            var old_pass = $('#old_password').val();
            var new_pass = $('#new_password').val();
            var confirm_pass = $('#confirm_password').val();

            $.ajax({
                url: "ajax/change-password.php",
                type: 'POST',
                data: {
                    old_pass: old_pass,
                    new_pass: new_pass,
                    confirm_pass: confirm_pass,
                    option: 'CHANGEPASSWORD'
                },
                dataType: "JSON",
                success: function (result) {

                    if (result.status === 'error1') {
                        swal({
                            title: "Error!",
                            text: "There was an error. Please try again later",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        $('#btn-save').show();
                        $('#update-loading').hide();

                        return false;
                    } else if (result.status === 'error2') {
                        swal({
                            title: "Error!",
                            text: "Old Password is incorrect.",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        $('#btn-save').show();
                        $('#update-loading').hide();

                        return false;
                    } else {
                        swal({
                            title: "Success.!",
                            text: " Password changed successfully.",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        window.location.replace('logout.php');
                    }
                }
            });
        }
        return false;
    }
    );
    $('#btn-update').click(function (event) {
        event.preventDefault();

        $('#btn-update').hide();
        $('#update-loading').show();

        if (!$('#game').val() || $('#game').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the game...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            $('#btn-update').show();
            $('#update-loading').hide();

        } else if (!$('#end_date_time').val() || $('#end_date_time').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the end date and time...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            $('#btn-update').show();
            $('#update-loading').hide();

        } else {

            var formData = new FormData($("form#group-form")[0]);

            $.ajax({
                url: "ajax/edit-group.php",
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
                            text: "There was an error. Please try again later1",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        $('#btn-save').show();
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

                        location.reload();
                    }
                }
            });
        }
        return false;
    }
    );
    $('.dataTable').on('click', '.delete-group', function () {
    
        var id = $(this).attr("data-id");

        swal({
            title: "Are you sure?",
            text: "You will not be able to recover!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "ajax/delete-group.php",
                type: "POST",
                data: {id: id, option: 'delete'},
                dataType: "JSON",
                success: function (jsonStr) {
                    if (jsonStr.status) {

                        swal({
                            title: "Deleted!",
                            text: "Group has been deleted.",
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
    $('.dataTable').on('click', '.join-group', function () {

        var group = $(this).attr("data-id");
        var member = $(this).attr("member");

        swal({
            title: "Are you sure?",
            text: "Are you want to join this group!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, join it!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "ajax/join-group.php",
                type: "POST",
                data: {
                    group: group,
                    member: member,
                    option: 'join'
                },
                dataType: "JSON",
                success: function (jsonStr) {
                    if (jsonStr.status) {

                        swal({
                            title: "Joined!",
                            text: "You have been joined this group successfully.",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        location.reload();

                    }
                }
            });
        });
    });
});