$(document).ready(function () {
    $("#trtable").DataTable({
        ajax: {
            url: "/api/transaction",
            beforeSend: function (header) {
                header.setRequestHeader(
                    "Authorization",
                    "Bearer " + localStorage.getItem("token")
                );
            },
            dataSrc: "",
        },
        dom: '<"top"<"left-col"B><"center-col"l><"right-col"f>>rtip',
        buttons: [
            {
                extend: "pdf",
                className: "btn btn-success glyphicon glyphicon-file",
            },
            {
                extend: "excel",
                className: "btn btn-success glyphicon glyphicon-list-alt",
            },
        ],
        columns: [
            {
                data: "transaction_id",
            },
            {
                data: "date_of_rent",
            },
            {
                data: "payment_type",
            },
            {
                data: "shipment_type",
            },
            {
                data: "status",
            },
            {
                data: "full_name",
            },
            {
                data: null,
                render: function (data, type, JsonResultRow, row) {
                    return (
                        '<img src="storage/' +
                        JsonResultRow.image_path +
                        '" height="100px" width="100px">'
                    );
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    return (
                        "<a href='#' class='editBtn' id='editbtn' data-id=" +
                        data.transaction_id +
                        "><i class='fa-solid fa-pen' aria-hidden='true' style='font-size:24px' ></i></a><a href='#' class='deletebtn' data-id=" +
                        data.transaction_id +
                        "><i class='fa-solid fa-trash-can' style='font-size:24px; color:red; margin-left:15px;'></a></i>"
                    );
                },
            },
        ],
    });

    $("#trtable tbody").on("click", "a.deletebtn", function (e) {
        var table = $("#trtable").DataTable();
        var id = $(this).data("id");
        var $row = $(this).closest("tr");

        console.log(id);
        e.preventDefault();
        bootbox.confirm({
            message: "do you want to delete this transaction",
            buttons: {
                confirm: {
                    label: "yes",
                    className: "btn-success",
                },
                cancel: {
                    label: "no",
                    className: "btn-danger",
                },
            },
            callback: function (result) {
                console.log(result);
                if (result)
                    $.ajax({
                        type: "DELETE",
                        url: `/api/transaction/${id}`,
                        beforeSend: function (header) {
                            header.setRequestHeader(
                                "Authorization",
                                "Bearer " + localStorage.getItem("token")
                            );
                        },
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        dataType: "json",
                        success: function (data) {
                            console.log(data);
                            $row.fadeOut(4000, function () {
                                table.row($row).remove().draw(false);
                            });
                            bootbox.alert(data.success);
                        },
                        error: function (error) {
                            console.log(error);
                        },
                    });
            },
        });
    });

    $("#trtable tbody").on("click", "a.editBtn", function (e) {
        e.preventDefault();
        $("#transactionModal").modal("show");
        var id = $(this).data("id");

        $.ajax({
            type: "GET",
            processData: false,
            contentType: false,
            cache: false,
            url: `/api/transaction/${id}/edit`,
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
            success: function (data) {
                console.log(data);
                $("#transaction_id").val(data.transaction_id);
                $("#status").val(data.status);
            },
            error: function (error) {
                console.log(error);
            },
        });
    });

    $("#transactionUpdate").on("click", function (e) {
        e.preventDefault();
        var id = $("#transaction_id").val();
        var data = $("#trform")[0];
        let formData = new FormData(data);
        console.log(formData);
        for (var pair of formData.entries()) {
            console.log(pair[0] + "," + pair[1]);
        }
        var table = $("#trtable").DataTable();
        console.log(id);

        $.ajax({
            type: "POST",
            url: `/api/transaction/post/${id}`,
            data: formData,
            contentType: false,
            processData: false,
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
            success: function (data) {
                console.log(data);
                $("#transactionModal").modal("hide");
                table.ajax.reload();
            },
            error: function (error) {
                console.log(error);
            },
        });
    });
});
