$(document).ready(function () {
    $('#start-game').click(function () {
        var group = $('#group').val();
        var member = $('#member').val();

        $.ajax({
            url: "post-and-get/ajax/game-session.php",
            type: "POST",
            dataType: "JSON",
            data: {
                group: group,
                member: member,
                action: "STARTGAMESESSION"
            },
            success: function (data) {
                if (data) {
                    swal({
                        title: "Success.!",
                        text: "Let's Start the Game",
                        type: 'success',
                        showConfirmButton: true
                    });
                    window.location.replace("./play-game.php?id=" + group);
                }
            }
        });
    });
});
