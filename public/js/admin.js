$(document).ready(function () {
    $("#adtable").DataTable({
        ajax: {
            url: "/api/admin",
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
            // {
            //     text: "Add Admin",
            //     className: "btn btn-success",
            //     action: function (e, dt, node, config) {
            //         $("#adform").trigger("reset");
            //         $("#adminModal").modal("show");
            //     },
            // },
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
                        // storage kasi dun naten nilagay publicly
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
                        "><i class='fa-solid fa-trash-can' style='font-size:24px; color:red; margin-left:15px;'></a></i>"
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
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                // $("#adminModal").modal("hide");
                // var $adtable = $("#adtable").DataTable();
                // $adtable.ajax.reload();
                // $adtable.row.add(data.admin).draw(false);
                window.location = "/login";
            },
            error: function (error) {
                console.log(error);
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
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        dataType: "json",
                        success: function (data) {
                            console.log(data);
                            // bootbox.alert('success');
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
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                localStorage.setItem("token");
                $("#admin_id").val(data.admin_id);
                $("#full_name").val(data.full_name);
                $("#age").val(data.age);
                // $("#user_id").val(data.user_id);
                // dito kasama foreign key kasi diba normal lang siya iinput explain ko na yan sa controller
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
