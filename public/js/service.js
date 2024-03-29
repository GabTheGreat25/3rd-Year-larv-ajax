$(document).ready(function () {
    $("#stable").DataTable({
        ajax: {
            url: "/api/service",
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
            {
                text: "Add Service",
                className: "btn btn-success",
                action: function (e, dt, node, config) {
                    $("#sform").trigger("reset");
                    $("#serviceModal").modal("show");
                },
            },
        ],
        columns: [
            {
                data: "services_id",
            },
            {
                data: "service_type",
            },
            {
                data: "date_of_service",
            },
            {
                data: "price",
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
                        data.services_id +
                        "><i class='fa-solid fa-pen' aria-hidden='true' style='font-size:24px' ></i></a><a href='#' class='deletebtn' data-id=" +
                        data.services_id +
                        "><i class='fa-solid fa-trash-can' style='font-size:24px; color:red; margin-left:15px;'></a></i>"
                    );
                },
            },
        ],
    });

    $("#serviceSubmit").on("click", function (e) {
        e.preventDefault();
        var data = $("#sform")[0];
        console.log(data);
        let formData = new FormData(data);
        console.log(formData);
        for (var pair of formData.entries()) {
            console.log(pair[0] + "," + pair[1]);
        }

        $.ajax({
            type: "POST",
            url: "/api/service",
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
                window.location = "/service-index";
            },
            error: function (error) {
                console.log(error);
            },
        });
    });

    $("#stable tbody").on("click", "a.deletebtn", function (e) {
        var table = $("#stable").DataTable();
        var id = $(this).data("id");
        var $row = $(this).closest("tr");

        console.log(id);
        e.preventDefault();
        bootbox.confirm({
            message: "do you want to delete this service",
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
                        url: `/api/service/${id}`,
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

    $("#stable tbody").on("click", "a.editBtn", function (e) {
        e.preventDefault();
        $("#serviceModal").modal("show");
        var id = $(this).data("id");

        $.ajax({
            type: "GET",
            enctype: "multipart/form-data",
            processData: false,
            contentType: false,
            cache: false,
            url: `/api/service/${id}/edit`,
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
                $("#services_id").val(data.services_id);
                $("#service_type").val(data.service_type);
                $("#date_of_service").val(data.date_of_service);
                $("#price").val(data.price);
                $("#operator_id").val(data.operator_id);
            },
            error: function (error) {
                console.log(error);
            },
        });
    });

    $("#serviceUpdate").on("click", function (e) {
        e.preventDefault();
        var id = $("#services_id").val();
        var data = $("#sform")[0];
        let formData = new FormData(data);
        console.log(formData);
        for (var pair of formData.entries()) {
            console.log(pair[0] + "," + pair[1]);
        }
        var table = $("#stable").DataTable();
        console.log(id);

        $.ajax({
            type: "POST",
            url: `/api/service/post/${id}`,
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
                $("#serviceModal").modal("hide");
                table.ajax.reload();
            },
            error: function (error) {
                console.log(error);
            },
        });
    });
});
