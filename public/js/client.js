$(document).ready(function () {
    $("#cltable").DataTable({
        ajax: {
            url: "/api/client",
            beforeSend: function (header) {
                /* Authorization header */
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
                data: "client_id",
            },
            {
                data: "full_name",
            },
            {
                data: "age",
            },
            {
                data: "valid_id",
            },
            {
                data: "billing_address",
            },
            {
                data: "address",
            },
            {
                data: "contact_number",
            },
            {
                data: "email",
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
                        data.client_id +
                        "><i class='fa-solid fa-pen' aria-hidden='true' style='font-size:24px' ></i></a><a href='#' class='deletebtn' data-id=" +
                        data.client_id +
                        "><i class='fa-solid fa-trash-can' style='font-size:24px; color:red; margin-left:15px;'></a></i><a href='#' class='restorebtn' data-id=" +
                        data.client_id +
                        "><i class='fa-solid fa-trash-can-arrow-up' style='font-size:24px; color:green; margin-left:15px;'></a></i>"
                    );
                },
            },
        ],
    });

    $("#clientSubmit").on("click", function (e) {
        e.preventDefault();
        var data = $("#clform")[0];
        console.log(data);
        let formData = new FormData(data);
        console.log(formData);
        for (var pair of formData.entries()) {
            console.log(pair[0] + "," + pair[1]);
        }

        $.ajax({
            type: "POST",
            url: "/api/client",
            data: formData,
            contentType: false,
            processData: false,
            // beforeSend: function (header) {
            //     /* Authorization header */
            //     header.setRequestHeader(
            //         "Authorization",
            //         "Bearer " + localStorage.getItem("token")
            //     );
            // },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                window.location = "/login";
            },
            error: function (error) {
                console.log(error);
            },
        });
    });

    $("#cltable tbody").on("click", "a.restorebtn", function (e) {
        var table = $("#cltable").DataTable();
        var id = $(this).data("id");
        console.log(id);
        e.preventDefault();
        bootbox.confirm({
            message: "do you want to restore this client",
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
                        type: "PATCH",
                        url: `/api/client/restore/${id}`,
                        beforeSend: function (header) {
                            /* Authorization header */
                            header.setRequestHeader(
                                "Authorization",
                                "Bearer " + localStorage.getItem("token")
                            );
                        },
                        dataType: "json",
                        success: function (data) {
                            console.log(data);
                            table.ajax.reload();
                            bootbox.alert(data.success);
                        },
                        error: function (error) {
                            console.log(error);
                        },
                    });
            },
        });
    });

    $("#cltable tbody").on("click", "a.deletebtn", function (e) {
        var table = $("#cltable").DataTable();
        var id = $(this).data("id");
        var $row = $(this).closest("tr");

        console.log(id);
        e.preventDefault();
        bootbox.confirm({
            message: "do you want to delete this client",
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
                        url: `/api/client/${id}`,
                        beforeSend: function (header) {
                            /* Authorization header */
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
                            table.ajax.reload();
                            bootbox.alert(data.success);
                        },
                        error: function (error) {
                            console.log(error);
                        },
                    });
            },
        });
    });

    $("#cltable tbody").on("click", "a.editBtn", function (e) {
        e.preventDefault();
        $("#clientModal").modal("show");
        var id = $(this).data("id");

        $.ajax({
            type: "GET",
            enctype: "multipart/form-data",
            processData: false,
            contentType: false,
            cache: false,
            url: `/api/client/${id}/edit`,
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
            success: function (data) {
                console.log(data);
                $("#client_id").val(data.client_id);
                $("#full_name").val(data.full_name);
                $("#age").val(data.age);
                $("#valid_id").val(data.valid_id);
                $("#billing_address").val(data.billing_address);
                $("#address").val(data.address);
                $("#contact_number").val(data.contact_number);
            },
            error: function (error) {
                console.log(error);
            },
        });
    });

    $("#clientUpdate").on("click", function (e) {
        e.preventDefault();
        var id = $("#client_id").val();
        var data = $("#clform")[0];
        let formData = new FormData(data);
        console.log(formData);
        for (var pair of formData.entries()) {
            console.log(pair[0] + "," + pair[1]);
        }
        var table = $("#cltable").DataTable();
        console.log(id);

        $.ajax({
            type: "POST",
            url: `/api/client/post/${id}`,
            data: formData,
            contentType: false,
            processData: false,
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
            success: function (data) {
                console.log(data);
                $("#clientModal").modal("hide");
                table.ajax.reload();
            },
            error: function (error) {
                console.log(error);
            },
        });
    });
});
