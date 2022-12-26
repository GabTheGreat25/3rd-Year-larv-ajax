var itemCount = 0;
var priceTotal = 0.0;
var quantity = 0;
var clone = "";

$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: "/api/camera",
        dataType: "json",
        success: function (data) {
            console.log(data);
            $.each(data, function (key, value) {
                console.log(key);
                id = value.camera_id;
                var camera =
                    "<div class='item'><div class='itemDetails'><div class='itemImage'><img src=" +
                    "/storage/" +
                    value.image_path +
                    " width='200px', height='200px'/></div><div class='itemText'><p class='price-container'>Price: Php <span class='price'>" +
                    value.costs +
                    "</span></p><p>" +
                    value.model +
                    "</span></p><p>" +
                    value.shuttercount +
                    "</p></div><input type='number' class='qty' name='quantity' min='1' max='5'><p class='cameraid' hidden>" +
                    value.camera_id +
                    "</p>      </div><button type='button' class='btn btn-primary add' style='margin-top:5px;'>Add to cart</button></div>";
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

        // Remove Cost of Deleted Item from Total Price
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
                // console.log(element);
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
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            processData: false,
            contentType: "application/json; charset=utf-8",
            success: function (data) {
                console.log(data);
                alert(data.status);
            },
            error: function (error) {
                // alert(data.status);
                console.log(error);
            },
        });
        $("#itemCount").css("display", "none");
        $("#cartItems").text("");
        $("#cartTotal").text("Total: P" + priceTotal);
        $("#shoppingCart").css("display", "none");
    });
});
