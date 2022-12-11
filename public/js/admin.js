$(document).ready(function () {
    $("#adtable").DataTable({
        ajax: {
            url: "/api/admin",
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
                data: "admin_id",
            },
            {
                data: "full_name",
            },
            {
                data: "age",
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
                        data.admin_id +
                        "><i class='fa-solid fa-pen' aria-hidden='true' style='font-size:24px' ></i></a><a href='#' class='deletebtn' data-id=" +
                        data.admin_id +
                        "><i class='fa-solid fa-trash-can' style='font-size:24px; color:red; margin-left:15px;'></a></i><a href='#' class='restorebtn' data-id=" +
                        data.admin_id +
                        "><i class='fa-solid fa-trash-can-arrow-up' style='font-size:24px; color:green; margin-left:15px;'></a></i>"
                    );
                },
            },
        ],
    });

    $("#adminSubmit").on("click", function (e) {
        e.preventDefault();
        var data = $("#adform")[0];
        console.log(data);
        let formData = new FormData(data);
        console.log(formData);
        for (var pair of formData.entries()) {
            console.log(pair[0] + "," + pair[1]);
        }

        $.ajax({
            type: "POST",
            url: "/api/admin",
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

    $("#adtable tbody").on("click", "a.restorebtn", function (e) {
        var table = $("#adtable").DataTable();
        var id = $(this).data("id");
        console.log(id);
        e.preventDefault();
        bootbox.confirm({
            message: "do you want to restore this admin",
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
                        url: `/api/admin/restore/${id}`,
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

    $("#adtable tbody").on("click", "a.deletebtn", function (e) {
        var table = $("#adtable").DataTable();
        var id = $(this).data("id");
        var $row = $(this).closest("tr");

        console.log(id);
        e.preventDefault();
        bootbox.confirm({
            message: "do you want to delete this admin",
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
                        url: `/api/admin/${id}`,
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

    $("#adtable tbody").on("click", "a.editBtn", function (e) {
        e.preventDefault();
        $("#adminModal").modal("show");
        var id = $(this).data("id");

        $.ajax({
            type: "GET",
            enctype: "multipart/form-data",
            processData: false,
            contentType: false,
            cache: false,
            url: `/api/admin/${id}/edit`,
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
                $("#admin_id").val(data.admin_id);
                $("#full_name").val(data.full_name);
                $("#age").val(data.age);
            },
            error: function (error) {
                console.log(error);
            },
        });
    });

    $("#adminUpdate").on("click", function (e) {
        e.preventDefault();
        var id = $("#admin_id").val();
        var data = $("#adform")[0];
        let formData = new FormData(data);
        console.log(formData);
        for (var pair of formData.entries()) {
            console.log(pair[0] + "," + pair[1]);
        }
        var table = $("#adtable").DataTable();
        console.log(id);

        $.ajax({
            type: "POST",
            url: `/api/admin/post/${id}`,
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
                $("#adminModal").modal("hide");
                table.ajax.reload();
            },
            error: function (error) {
                console.log(error);
            },
        });
    });
});
