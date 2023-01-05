var itemCount = 0;
var priceTotal = 0.0;
var quantity = 0;
var clone = "";

$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: "/api/camera",
        dataType: "json",
        beforeSend: function (header) {
            header.setRequestHeader(
                "Authorization",
                "Bearer " + localStorage.getItem("token")
            );
        },
        success: function (data) {
            console.log(data);
            $.each(data, function (key, value) {
                console.log(key);
                id = value.camera_id;
                var camera =
                    "<form class='bg-white pt-2' style='padding-left: 13.5rem;'><div class='item'><div class='itemDetails'><div class='itemImage'><img src=" +
                    "/storage/" +
                    value.image_path +
                    " width='200px', height='200px'/></div><div class='itemText'><p class='price-container font-bold'>Price: ₱<span class='price'>" +
                    value.costs +
                    "</span></p><p>" +
                    value.model +
                    "</span></p><p>" +
                    value.shuttercount +
                    "</p></div><input type='number' class='bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-l cursor-pointer outline-none qty' name='quantity' min='1' max='5'><p class='cameraid' hidden>" +
                    value.camera_id +
                    "</p>      </div><button type='button' class='text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 my-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 add'>Add to cart</button></div></form>";
                $("#cameras").append(camera);
            });
        },
        error: function (error) {
            console.log("AJAX load did not work");
            console.log(error);
        },
    });

    $("#cameras").on("click", ".add", function () {
        itemCount++;
        $("#itemCount").text(itemCount).css("display", "block");
        clone = $(this)
            .siblings()
            .clone()
            .appendTo("#cartItems")
            .append('<button class="removeItem">Remove Item</button>');
        var price = parseInt($(this).siblings().find(".price").text());
        priceTotal += price;
        $("#cartTotal").text("Total: $" + priceTotal);
    });

    $(".openCloseCart").click(function () {
        $("#shoppingCart").toggle();
    });

    $("#shoppingCart").on("click", ".removeItem", function () {
        $(this).parent().remove();
        itemCount--;
        $("#itemCount").text(itemCount);

        var price = parseInt($(this).siblings().find(".price").text());
        priceTotal -= price;
        $("#cartTotal").text("Total: php" + priceTotal);

        if (itemCount == 0) {
            $("#itemCount").css("display", "none");
        }
    });

    $("#emptyCart").click(function () {
        itemCount = 0;
        priceTotal = 0;

        $("#itemCount").css("display", "none");
        $("#cartItems").text("");
        $("#cartTotal").text("Total: $" + priceTotal);
    });

    $("#checkout").click(function () {
        itemCount = 0;
        priceTotal = 0;
        let cameras = new Array();

        $("#cartItems")
            .find(".itemDetails")
            .each(function (i, element) {
                let cameraid = 0;
                let qty = 0;

                qty = parseInt($(element).find($(".qty")).val());
                cameraid = parseInt($(element).find($(".cameraid")).html());

                cameras.push({
                    camera_id: cameraid,
                    quantity: qty,
                });
            });
        console.log(JSON.stringify(cameras));
        var data = JSON.stringify(cameras);

        $.ajax({
            type: "POST",
            url: "/api/camera/checkout",
            data: data,
            beforeSend: function (header) {
                header.setRequestHeader(
                    "Authorization",
                    "Bearer " + localStorage.getItem("token")
                );
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            processData: false,
            contentType: "application/json; charset=utf-8",
            success: function (data) {
                console.log(data);
                window.location = "/camera-receipt";
            },
            error: function (error) {
                console.log(error);
            },
        });
        $("#itemCount").css("display", "none");
        $("#cartItems").text("");
        $("#cartTotal").text("Total: P" + priceTotal);
        $("#shoppingCart").css("display", "none");
    });
});
