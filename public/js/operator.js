$(document).ready(function () {
    $("#otable").DataTable({
        ajax: {
            //laman nung html ito basically
            url: "/api/operator",
            beforeSend: function (header) {
                /* Authorization header */
                header.setRequestHeader(
                    "Authorization",
                    "Bearer " +
                        "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZjhmYTdiYjg0MTgzNWI1MDY3YWM5NjIzZDZjM2IwMjJhNTQ4Yzk2OWZkZDA3ODMwYzMzNTY5YTgzZmViNWRiNTlhOWVkZGMyMmQwZDliZjEiLCJpYXQiOjE2NzAyNTM5NDMuODI5MjU5LCJuYmYiOjE2NzAyNTM5NDMuODI5Mjc0LCJleHAiOjE3MDE3ODk5NDMuODI2NzI0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.ciLfpVdQ-MzKfsDcE_Mn6ndNBOJr7tbw1gxLmSMNLH2MfrF9szSMnn2kVhhgTuaRH_FRz9KlMN0b2ZbzFj7F_w48t6ux2X4S7S4JMs0a59baB7wEz49Pon6mCgwY-NTeYD-yTlUCfVwAPYCqVBEVKrMt-crGS7ymxduQByzH01vftubh7fGv05ex5F-0Sbknz8GDsC6Tvpq6eoAhkI1dlUyIO3R-REOVi7vYBsmNGSYrR2AGy2nJUyWn352lYPb4DUNcho-SUZL0uc6a3Z7_6rS8Urt-ul4J3tMWzLt88ILILT3u5CtOOhAK_J4FhLfpykPBeXPXhBOtWvAcYBnwEk65ctLZABnBqJ_kujNwVDee63BGbY5awwbtdpqa5mYYZCIOW9VXxf3J0LmcXwll2Hzv2tcDGRbisQp4nyVPsso2lShcGJtQ0aINFI_ZxRCapp2Nf2jH6DXaH-x6nh1juUhkpZ6F8m9ah7WSddNYygtoxQJ2X6XKcWrA83tX0SVoIdr_rJMwbHdgIZOg4V-E0gX-scw2nAJOTAdReSk2MIFn-hI4HOfXHs_uajs0H7jV9COicdDOSA7sEF_ZDZw_4uJukPwH4Beg4sG60PXlBSq_w9kW7Nsq5DcU8rCCTbzor5iD55qEUz9TEr89U3mM94K6alC435UZ_hIE7t6innA"
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
