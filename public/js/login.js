$(document).ready(function () {
    $("#loginbtn").on("click", function (e) {
        e.preventDefault();
        var data = $("#loginform")[0];
        console.log(data);
        let formData = new FormData(data);
        console.log(formData);
        for (var pair of formData.entries()) {
            console.log(pair[0] + "," + pair[1]);
        }
        $.ajax({
            type: "POST",
            url: "/api/login-auth",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function () {
                window.location = "/home";
            },
            error: function (error) {
                console.log(error);
            },
        });
    });
});
