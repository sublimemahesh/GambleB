
//update
$(document).ready(function () {
    $('#btn-save').click(function (event) {
        event.preventDefault();

        $('#btn-save').hide();
        $('#update-loading').show();

        if (!$('#game').val() || $('#game').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the game...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            $('#btn-save').show();
            $('#update-loading').hide();

        } else if (!$('#end_date_time').val() || $('#end_date_time').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the end date and time...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            $('#btn-save').show();
            $('#update-loading').hide();

        } else {

            var formData = new FormData($("form#group-form")[0]);

            $.ajax({
                url: "ajax/group.php",
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




