$(document).ready(function () {
    $(document).on('click', '.suspend-member', function () {

        var id = $(this).attr("data-id");

        swal({
            title: "Are you sure?",
            text: "Are you want to suspend this member?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, suspend!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "ajax/member.php",
                type: "POST",
                data: {id: id, option: 'suspend'},
                dataType: "JSON",
                success: function (jsonStr) {
                    if (jsonStr.status) {

                        swal({
                            title: "Suspended!",
                            text: "Member has been suspended.",
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
    $(document).on('click', '.active-member', function () {

        var id = $(this).attr("data-id");

        swal({
            title: "Are you sure?",
            text: "Are you want to active this member?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, active!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "ajax/member.php",
                type: "POST",
                data: {id: id, option: 'active'},
                dataType: "JSON",
                success: function (jsonStr) {
                    if (jsonStr.status) {

                        swal({
                            title: "Suspended!",
                            text: "Member has been activated.",
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