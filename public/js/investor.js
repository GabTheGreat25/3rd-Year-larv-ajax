$(document).ready(function () {
    $("#intable").DataTable({
        ajax: {
            url: "/api/investor",
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
                text: "Add investor",
                className: "btn btn-success",
                action: function (e, dt, node, config) {
                    $("#iform").trigger("reset");
                    $("#investorModal").modal("show");
                },
            },
        ],
        columns: [
            {
                data: "investor_id",
            },
            {
                data: "full_name",
            },
            {
                data: "age",
            },
            {
                data: "contact_number",
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
                        data.investor_id +
                        "><i class='fa-solid fa-pen' aria-hidden='true' style='font-size:24px' ></i></a><a href='#' class='deletebtn' data-id=" +
                        data.investor_id +
                        "><i class='fa-solid fa-trash-can' style='font-size:24px; color:red; margin-left:15px;'></a></i>"
                    );
                },
            },
        ],
    });

    $("#investorSubmit").on("click", function (e) {
        e.preventDefault();
        var data = $("#iform")[0];
        console.log(data);
        let formData = new FormData(data);
        console.log(formData);
        for (var pair of formData.entries()) {
            console.log(pair[0] + "," + pair[1]);
        }

        $.ajax({
            type: "POST",
            url: "/api/investor",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                $("#investorModal").modal("hide");
                var $intable = $("#intable").DataTable();
                $intable.ajax.reload();
                $intable.row.add(data.investor).draw(false);
            },
            error: function (error) {
                console.log(error);
            },
        });
    });

    $("#intable tbody").on("click", "a.deletebtn", function (e) {
        var table = $("#intable").DataTable();
        var id = $(this).data("id");
        var $row = $(this).closest("tr");

        console.log(id);
        e.preventDefault();
        bootbox.confirm({
            message: "do you want to delete this investor",
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
                        url: `/api/investor/${id}`,
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

    $("#intable tbody").on("click", "a.editBtn", function (e) {
        e.preventDefault();
        $("#investorModal").modal("show");
        var id = $(this).data("id");

        $.ajax({
            type: "GET",
            enctype: "multipart/form-data",
            processData: false,
            contentType: false,
            cache: false,
            url: `/api/investor/${id}/edit`,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                $("#investor_id").val(data.investor_id);
                $("#full_name").val(data.full_name);
                $("#age").val(data.age);
                $("#contact_number").val(data.contact_number);
            },
            error: function (error) {
                console.log(error);
            },
        });
    });

    $("#investorUpdate").on("click", function (e) {
        e.preventDefault();
        var id = $("#investor_id").val();
        var data = $("#iform")[0];
        let formData = new FormData(data);
        console.log(formData);
        for (var pair of formData.entries()) {
            console.log(pair[0] + "," + pair[1]);
        }
        var table = $("#intable").DataTable();
        console.log(id);

        $.ajax({
            type: "POST",
            url: `/api/investor/post/${id}`,
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                $("#investorModal").modal("hide");
                table.ajax.reload();
            },
            error: function (error) {
                console.log(error);
            },
        });
    });
});
