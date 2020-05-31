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
                    if (result.is_online == 0) {
                        html += '<span>Left</span>';
                    } else if(result.is_online == "1" && result.current_player === result.sort) {
                        html +=  '<input id="toggle-rotate" class="bttn-small btn-fill btn-' + result.sort + '" type ="button" value ="start">';
                    } else {
                        html += '<input id="toggle-rotate" class="bttn-small btn-fill btn-' + result.sort + '" disabled type ="button" value ="start">';
                    }
                    
                    html += '</div>';
                    html += '</div>';
                });
                } else {
                    html += '<h5></h5>';
                }
                $('.inplay-details').empty();
                $('.inplay-details').append(html);
            }
        });
    }, 20000);
});

