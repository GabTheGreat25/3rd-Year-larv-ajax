$(document).ready(function () {
    $("#atable").DataTable({
        ajax: {
            url: "/api/accessories",
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
                text: "Add Accessories",
                className: "btn btn-success",
                action: function (e, dt, node, config) {
                    $("#aform").trigger("reset");
                    $("#accessoriesModal").modal("show");
                },
            },
        ],
        columns: [
            {
                data: "accessories_id",
            },
            {
                data: "description",
            },
            {
                data: "quantity",
            },
            {
                data: "costs",
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
                        data.accessories_id +
                        "><i class='fa-solid fa-pen' aria-hidden='true' style='font-size:24px' ></i></a><a href='#' class='deletebtn' data-id=" +
                        data.accessories_id +
                        "><i class='fa-solid fa-trash-can' style='font-size:24px; color:red; margin-left:15px;'></a></i>"
                    );
                },
            },
        ],
    });

    $("#accessoriesSubmit").on("click", function (e) {
        e.preventDefault();
        var data = $("#aform")[0];
        console.log(data);
        let formData = new FormData(data);
        console.log(formData);
        for (var pair of formData.entries()) {
            console.log(pair[0] + "," + pair[1]);
        }

        $.ajax({
            type: "POST",
            url: "/api/accessories",
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
                $("#accessoriesModal").modal("hide");
                var $atable = $("#atable").DataTable();
                $atable.ajax.reload();
                $atable.row.add(data.accessories).draw(false);
            },
            error: function (error) {
                console.log(error);
            },
        });
    });

    $("#atable tbody").on("click", "a.deletebtn", function (e) {
        var table = $("#atable").DataTable();
        var id = $(this).data("id");
        var $row = $(this).closest("tr");

        console.log(id);
        e.preventDefault();
        bootbox.confirm({
            message: "do you want to delete this accessories",
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
                        url: `/api/accessories/${id}`,
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

    $("#atable tbody").on("click", "a.editBtn", function (e) {
        e.preventDefault();
        $("#accessoriesModal").modal("show");
        var id = $(this).data("id");

        $.ajax({
            type: "GET",
            enctype: "multipart/form-data",
            processData: false,
            contentType: false,
            cache: false,
            url: `/api/accessories/${id}/edit`,
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
                $("#accessories_id").val(data.accessories_id);
                $("#description").val(data.description);
                $("#quantity").val(data.quantity);
                $("#costs").val(data.costs);
            },
            error: function (error) {
                console.log(error);
            },
        });
    });

    $("#accessoriesUpdate").on("click", function (e) {
        e.preventDefault();
        var id = $("#accessories_id").val();
        var data = $("#aform")[0];
        let formData = new FormData(data);
        console.log(formData);
        for (var pair of formData.entries()) {
            console.log(pair[0] + "," + pair[1]);
        }
        var table = $("#atable").DataTable();
        console.log(id);

        $.ajax({
            type: "POST",
            url: `/api/accessories/post/${id}`,
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
                $("#accessoriesModal").modal("hide");
                table.ajax.reload();
            },
            error: function (error) {
                console.log(error);
            },
        });
    });
});
