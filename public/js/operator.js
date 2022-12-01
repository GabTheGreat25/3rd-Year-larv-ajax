$(document).ready(function () {
    $("#otable").DataTable({
        ajax: {
            //laman nung html ito basically
            url: "/api/operator",
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
                text: "Add Operator",
                className: "btn btn-success",
                action: function (e, dt, node, config) {
                    $("#oform").trigger("reset");
                    $("#operatorModal").modal("show");
                },
            },
        ],
        columns: [
            {
                data: "operator_id",
            },
            {
                data: "name",
            },
            {
                data: "contact_number",
            },
            {
                data: "age",
            },
            {
                data: "address",
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
                        data.operator_id +
                        "><i class='fa-solid fa-pen' aria-hidden='true' style='font-size:24px' ></i></a><a href='#' class='deletebtn' data-id=" +
                        data.operator_id +
                        "><i class='fa-solid fa-trash-can' style='font-size:24px; color:red; margin-left:15px;'></a></i>"
                    );
                },
            },
        ],
    });

    $("#operatorSubmit").on("click", function (e) {
        // when you click save or create ito
        e.preventDefault();
        var data = $("#oform")[0];
        console.log(data);
        let formData = new FormData(data);
        console.log(formData);
        for (var pair of formData.entries()) {
            console.log(pair[0] + "," + pair[1]);
        }

        $.ajax({
            type: "POST",
            url: "/api/operator",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                $("#operatorModal").modal("hide");
                var $otable = $("#otable").DataTable();
                $otable.ajax.reload();
                $otable.row.add(data.operator).draw(false);
            },
            error: function (error) {
                console.log(error);
            },
        });
    });

    $("#otable tbody").on("click", "a.deletebtn", function (e) {
        // pag magbubura ka
        var table = $("#otable").DataTable();
        var id = $(this).data("id");
        var $row = $(this).closest("tr");

        console.log(id);
        e.preventDefault();
        bootbox.confirm({
            message: "do you want to delete this operator",
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
                        url: `/api/operator/${id}`,
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

    $("#otable tbody").on("click", "a.editBtn", function (e) {
        // pag mag edit ka pero titignan nya muna if existing ito
        e.preventDefault();
        $("#operatorModal").modal("show");
        var id = $(this).data("id");

        $.ajax({
            type: "GET",
            enctype: "multipart/form-data",
            processData: false,
            contentType: false,
            cache: false,
            url: `/api/operator/${id}/edit`,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                $("#operator_id").val(data.operator_id);
                $("#name").val(data.name);
                $("#contact_number").val(data.contact_number);
                $("#age").val(data.age);
                $("#address").val(data.address);
            },
            error: function (error) {
                console.log(error);
            },
        });
    });

    $("#operatorUpdate").on("click", function (e) {
        //dito na nya uupdate
        e.preventDefault();
        var id = $("#operator_id").val();
        var data = $("#oform")[0];
        let formData = new FormData(data);
        console.log(formData);
        for (var pair of formData.entries()) {
            console.log(pair[0] + "," + pair[1]);
        }
        var table = $("#otable").DataTable();
        console.log(id);

        $.ajax({
            type: "POST",
            url: `/api/operator/post/${id}`,
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                $("#operatorModal").modal("hide");
                table.ajax.reload();
            },
            error: function (error) {
                console.log(error);
            },
        });
    });
});
