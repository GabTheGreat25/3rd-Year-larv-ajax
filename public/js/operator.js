$(document).ready(function () {
    $("#otable").DataTable({
        ajax: {
            url: "/api/operator",
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
                data: "operator_id",
            },
            {
                data: "full_name",
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
                        data.operator_id +
                        "><i class='fa-solid fa-pen' aria-hidden='true' style='font-size:24px' ></i></a><a href='#' class='deletebtn' data-id=" +
                        data.operator_id +
                        "><i class='fa-solid fa-trash-can' style='font-size:24px; color:red; margin-left:15px;'></a></i><a href='#' class='restorebtn' data-id=" +
                        data.operator_id +
                        "><i class='fa-solid fa-trash-can-arrow-up' style='font-size:24px; color:green; margin-left:15px;'></a></i>"
                    );
                },
            },
        ],
    });

    $("#operatorSubmit").on("click", function (e) {
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
                window.location = "/login";
            },
            error: function (error) {
                console.log(error);
            },
        });
    });

    $("#otable tbody").on("click", "a.restorebtn", function (e) {
        var table = $("#otable").DataTable();
        var id = $(this).data("id");
        console.log(id);
        e.preventDefault();
        bootbox.confirm({
            message: "do you want to restore this operator",
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
                        url: `/api/operator/restore/${id}`,
                        beforeSend: function (header) {
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

    $("#otable tbody").on("click", "a.deletebtn", function (e) {
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
                        beforeSend: function (header) {
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

    $("#otable tbody").on("click", "a.editBtn", function (e) {
        e.preventDefault();
        $("#operatorModal").modal("show");
        var id = $(this).data("id");

        $.ajax({
            type: "GET",
            enctype: "multipart/form-data",
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function (header) {
                header.setRequestHeader(
                    "Authorization",
                    "Bearer " + localStorage.getItem("token")
                );
            },
            url: `/api/operator/${id}/edit`,
            beforeSend: function (header) {
                header.setRequestHeader(
                    "Authorization",
                    "Bearer " +
                        "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMzA5MmM3YmVhYjQwNmZjOTM4ZmQxYzdiZjgxYzk2MDMyMjQwMjBmZDc5N2I0MTcyMmI3ZTY5ZmMwMWI5YTY2MWJhYmRkZDZjZjBiYmI3NTIiLCJpYXQiOjE2NzAzMTU5MTkuMzU4MTMyLCJuYmYiOjE2NzAzMTU5MTkuMzU4MTM0LCJleHAiOjE3MDE4NTE5MTkuMjk4MzQxLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.AUAfGI62IyXQ1OvlCjXWbC1FNraRYEwGXd-2kLnzESy2fJEg4EZvEZrElPsbjZ7okufOmMqVBtKpxDJLoPiUd1V_U7Fth6L-ra-P4_sEllTv0A5qHq3ewa1bWUapU7yjoCX4Jtgodm5ucoRgViCLN3Nn4-Y2jJmtezc5Huv4hKUKrUiVQQeQmxdv_WhyJXBBQrGWsnUDFOvl9icbh8pKwI7fuxPz9LtVrnceQSZST03Y2b4sBZmco7bWVrvcJ-MBnNLVopjuY3nVmpNmIEpMaBss1wg3VNz-3ERDO7ml9N2TACIA1kX6nA4nONJM7Vg6TlKt6f0G0DJp9VrtyhrzhpvzblE0EiveYqPNAIBiJf2kQUkJvf23_X1W1ugSbCWFaxl68vCC1e8ktDGUlGnSxPgSxJg7UovVAbho1MsrojgTo4t-KYCCBf2Q5stQ5Xi7Jcez_-Vm9s_W2dwzyYNtR7pvNtyVJ0ppuMDtSN9y02ws3Wg0Zxsyr6CJbtZb-goZUyb-IN0G-adaSlkRtUJzO2G7W444RfuWOfxCBEC5lLeFy2HxOxRVWrDf3Dumfrp0PK60zGWoqKSmiMxgvE3W2DJkBW-H_Qy_bkUY9Jo85ERNuwnFxF-vZyZIv_i0FtHjiyta3yp0VquAuBmgTaQ1LNy_2Alqw8OV5jj2lZC4IpE"
                );
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                $("#operator_id").val(data.operator_id);
                $("#full_name").val(data.full_name);
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
            beforeSend: function (header) {
                header.setRequestHeader(
                    "Authorization",
                    "Bearer " + localStorage.getItem("token")
                );
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
