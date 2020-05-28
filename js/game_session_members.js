$(document).ready(function () {
    setInterval(function () {
        var group = $('#group').val();
        
        $.ajax({
            url: "post-and-get/ajax/group-members.php",
            type: "POST",
            dataType: "JSON",
            data: {
                group: group,
                action: "GROUPSESSIONMEMBERS"
            },
            success: function (data) {
                var html = "";
                if (data.status == 'success') {
                    $.each(data.details, function (i, result) {
                    html += '<div class="single-inplay">';
                    html += '<div class="img">';

                    if (result.profile_pic) {
                        html += '<img src="upload/member/profile_image/' + result.profile_pic + '" class="img-circle" alt="">';
                    } else {
                        html += '<img src="images/user.png" class="img-circle" alt="">';
                    }

                    html += '</div>';
                    html += '<div class="text">';
                    html += '<h4>' + result.name + '</h4>';
                    html += '</div>';
                    html += '<div class="ball active-ball ' + result.is_online + '">';
                    html += '<a href="#"></a>';
                    html += '</div>';
                    html += '</div>';
                });
                } else {
                    html += '<h5>No any members in this group.</h5>';
                }
                $('.inplay-details').empty();
                $('.inplay-details').append(html);
            }
        });
    }, 20000);
});

