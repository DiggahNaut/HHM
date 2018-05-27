/**
 * Created by diggah on 27.05.18.
 */
$(document).ready(function() {
    $("#saveResults").click(function() {
        var userName = $("#inputName").val();
        var userEmail = $("#inputEmail").val();
        var userComment = $("#inputComment").val();
        var message = "";

        $.ajax({
            data: {UserName:userName, UserEmail:userEmail, UserComment:userComment},
            async: false,
            type: "POST",
            url: "/SaveResults.php",
            success: function(data) {
                message = data;
            }
        });

        $("#feedback").text(message).show();

        var cards = "";

        $.ajax({
            async: false,
            type: "POST",
            url: "/GetResults.php",
            success: function(data) {
                cards = JSON.parse(data);
            }
        });

        if (cards == "" || typeof(cards) == "string") {
            console.log("Some error appeared.");
        } else {
            $("div").remove(".hhm-card");
            for (var i = 0; cards.length > i; i++)
            {
                if (i % 2 == 0) {
                    $("#place-for-cards").append('<div class="col-md-3 offset-md-1 hhm-card"><div class="odd-card-header">' + cards[i].username + '</div><div class="odd-card-body"><div class="card-email">' + cards[i].useremail + '</div><div class="odd-card-comment">' + cards[i].usercomment + '</div></div></div>');
                } else {
                    $("#place-for-cards").append('<div class="col-md-3 offset-md-1 hhm-card"><div class="even-card-header">' + cards[i].username + '</div><div class="even-card-body"><div class="card-email">' + cards[i].useremail + '</div><div class="even-card-comment">' + cards[i].usercomment + '</div></div></div>');
                }
            }
        }
    });
});