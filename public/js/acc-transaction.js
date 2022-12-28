var itemCount = 0;
var priceTotal = 0.0;
var quantity = 0;
var clone = "";

$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: "/api/accessories",
        dataType: "json",
        beforeSend: function (header) {
            /* Authorization header */
            header.setRequestHeader(
                "Authorization",
                "Bearer " + localStorage.getItem("token")
            );
        },
        success: function (data) {
            console.log(data);
            $.each(data, function (key, value) {
                console.log(key);
                id = value.accessories_id;
                var accessories =
                    "<div class='item'><div class='itemDetails'><div class='itemImage'><img src=" +
                    "/storage/" +
                    value.image_path +
                    " width='200px', height='200px'/></div><div class='itemText'><p class='price-container'>Price: Php <span class='price'>" +
                    value.costs +
                    "</span></p><p>" +
                    value.description +
                    "</p></div><input type='number' class='qty' name='quantity' min='1' max='5'><p class='accessoriesid' hidden>" +
                    value.accessories_id +
                    "</p>      </div><button type='button' class='btn btn-primary add' style='margin-top:5px;'>Add to cart</button></div>";
                $("#accessories").append(accessories);
            });
        },
        error: function (error) {
            console.log("AJAX load did not work");
            console.log(error);
        },
    });

    $("#accessories").on("click", ".add", function () {
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
        let accessories = new Array();

        $("#cartItems")
            .find(".itemDetails")
            .each(function (i, element) {
                // console.log(element);
                let accessoriesid = 0;
                let qty = 0;

                qty = parseInt($(element).find($(".qty")).val());
                accessoriesid = parseInt(
                    $(element).find($(".accessoriesid")).html()
                );

                accessories.push({
                    accessories_id: accessoriesid,
                    quantity: qty,
                });
            });
        console.log(JSON.stringify(accessories));
        var data = JSON.stringify(accessories);

        $.ajax({
            type: "POST",
            url: "/api/accessories/checkout",
            data: data,
            beforeSend: function (header) {
                /* Authorization header */
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
