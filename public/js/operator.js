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
                        "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZjExYmM1NTA3MmRjNGI3ODIzMDEzNzI4MjI3NjRiNDQ5NDM0ZDZkZDMyMDYxYzE4NzFmMDU3ZmZiMWRiMzY2NjFmNWEzZWE1ZTZjZWEyYjUiLCJpYXQiOjE2NzAzMTUwMzEuNDc4ODg5LCJuYmYiOjE2NzAzMTUwMzEuNDc4ODkxLCJleHAiOjE3MDE4NTEwMzEuNDc1Nzc3LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.EAnHBibj8oaTGCTY4ZlYGiIEjSBm9spqjj5-jOXTN2uT15MaRAgdGp75vRxxJjMZPck80Rvon5ffo9RAOaIvDz_H00tKYccnTigmvfMp0dCypgbITCBz91G5ejmwYS70NUOwcUY7BDdU80f3mNs65ocmq5802K4pbU-UQb4NPWRG-k_fMRdMaXaDLD4BxEq86xYgW4O-2i1GRYSTz6g07WSLtEJjpTmYHM9cZ2fxQj6RBFU-nm4yH2A5n_FPcSw36YVu40gPypjBkzqEqY-ZtP3OY1hyU8memSnIjPho93BUS3Vqb8lyF0vqkTFx27qknOuNqQzqyEt7caA8r9Hgf5sEvR7M4FwWlwpRtgwuZ4mJiEetUuETT1JACMTtGTju5UOu8w6FZKwJzfsdpCuY6FOd8QG6TJR5zJjsHhJqtvhvw8zi3JwS_Eh_0vEcNYoEHBf0heIbSBIeF8RjDw-PW83RIIYw2Hbtws6vLlsyl27uA76O5vvNE3fFTLPZm06uVA4oKorBQJA76mTmJxjrpdi_aB4y0yaiCEY5PQK2bFk5x0wge56ZBWiFX-efrCL63WwsmIx7mm1gZFAned7hoSNXyngByRnGryB0Sr_wkndZh3sway2cgsCdRj4iG6NlimHWPxAbfwWKUWDa8evHH75fCmNYxaqYc9llUHVmP9E"
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
            beforeSend: function (header) {
                /* Authorization header */
                header.setRequestHeader(
                    "Authorization",
                    "Bearer " +
                        "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZjExYmM1NTA3MmRjNGI3ODIzMDEzNzI4MjI3NjRiNDQ5NDM0ZDZkZDMyMDYxYzE4NzFmMDU3ZmZiMWRiMzY2NjFmNWEzZWE1ZTZjZWEyYjUiLCJpYXQiOjE2NzAzMTUwMzEuNDc4ODg5LCJuYmYiOjE2NzAzMTUwMzEuNDc4ODkxLCJleHAiOjE3MDE4NTEwMzEuNDc1Nzc3LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.EAnHBibj8oaTGCTY4ZlYGiIEjSBm9spqjj5-jOXTN2uT15MaRAgdGp75vRxxJjMZPck80Rvon5ffo9RAOaIvDz_H00tKYccnTigmvfMp0dCypgbITCBz91G5ejmwYS70NUOwcUY7BDdU80f3mNs65ocmq5802K4pbU-UQb4NPWRG-k_fMRdMaXaDLD4BxEq86xYgW4O-2i1GRYSTz6g07WSLtEJjpTmYHM9cZ2fxQj6RBFU-nm4yH2A5n_FPcSw36YVu40gPypjBkzqEqY-ZtP3OY1hyU8memSnIjPho93BUS3Vqb8lyF0vqkTFx27qknOuNqQzqyEt7caA8r9Hgf5sEvR7M4FwWlwpRtgwuZ4mJiEetUuETT1JACMTtGTju5UOu8w6FZKwJzfsdpCuY6FOd8QG6TJR5zJjsHhJqtvhvw8zi3JwS_Eh_0vEcNYoEHBf0heIbSBIeF8RjDw-PW83RIIYw2Hbtws6vLlsyl27uA76O5vvNE3fFTLPZm06uVA4oKorBQJA76mTmJxjrpdi_aB4y0yaiCEY5PQK2bFk5x0wge56ZBWiFX-efrCL63WwsmIx7mm1gZFAned7hoSNXyngByRnGryB0Sr_wkndZh3sway2cgsCdRj4iG6NlimHWPxAbfwWKUWDa8evHH75fCmNYxaqYc9llUHVmP9E"
                );
            },
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
                        beforeSend: function (header) {
                            /* Authorization header */
                            header.setRequestHeader(
                                "Authorization",
                                "Bearer " +
                                    "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZjExYmM1NTA3MmRjNGI3ODIzMDEzNzI4MjI3NjRiNDQ5NDM0ZDZkZDMyMDYxYzE4NzFmMDU3ZmZiMWRiMzY2NjFmNWEzZWE1ZTZjZWEyYjUiLCJpYXQiOjE2NzAzMTUwMzEuNDc4ODg5LCJuYmYiOjE2NzAzMTUwMzEuNDc4ODkxLCJleHAiOjE3MDE4NTEwMzEuNDc1Nzc3LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.EAnHBibj8oaTGCTY4ZlYGiIEjSBm9spqjj5-jOXTN2uT15MaRAgdGp75vRxxJjMZPck80Rvon5ffo9RAOaIvDz_H00tKYccnTigmvfMp0dCypgbITCBz91G5ejmwYS70NUOwcUY7BDdU80f3mNs65ocmq5802K4pbU-UQb4NPWRG-k_fMRdMaXaDLD4BxEq86xYgW4O-2i1GRYSTz6g07WSLtEJjpTmYHM9cZ2fxQj6RBFU-nm4yH2A5n_FPcSw36YVu40gPypjBkzqEqY-ZtP3OY1hyU8memSnIjPho93BUS3Vqb8lyF0vqkTFx27qknOuNqQzqyEt7caA8r9Hgf5sEvR7M4FwWlwpRtgwuZ4mJiEetUuETT1JACMTtGTju5UOu8w6FZKwJzfsdpCuY6FOd8QG6TJR5zJjsHhJqtvhvw8zi3JwS_Eh_0vEcNYoEHBf0heIbSBIeF8RjDw-PW83RIIYw2Hbtws6vLlsyl27uA76O5vvNE3fFTLPZm06uVA4oKorBQJA76mTmJxjrpdi_aB4y0yaiCEY5PQK2bFk5x0wge56ZBWiFX-efrCL63WwsmIx7mm1gZFAned7hoSNXyngByRnGryB0Sr_wkndZh3sway2cgsCdRj4iG6NlimHWPxAbfwWKUWDa8evHH75fCmNYxaqYc9llUHVmP9E"
                            );
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
            beforeSend: function (header) {
                /* Authorization header */
                header.setRequestHeader(
                    "Authorization",
                    "Bearer " +
                        "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZjExYmM1NTA3MmRjNGI3ODIzMDEzNzI4MjI3NjRiNDQ5NDM0ZDZkZDMyMDYxYzE4NzFmMDU3ZmZiMWRiMzY2NjFmNWEzZWE1ZTZjZWEyYjUiLCJpYXQiOjE2NzAzMTUwMzEuNDc4ODg5LCJuYmYiOjE2NzAzMTUwMzEuNDc4ODkxLCJleHAiOjE3MDE4NTEwMzEuNDc1Nzc3LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.EAnHBibj8oaTGCTY4ZlYGiIEjSBm9spqjj5-jOXTN2uT15MaRAgdGp75vRxxJjMZPck80Rvon5ffo9RAOaIvDz_H00tKYccnTigmvfMp0dCypgbITCBz91G5ejmwYS70NUOwcUY7BDdU80f3mNs65ocmq5802K4pbU-UQb4NPWRG-k_fMRdMaXaDLD4BxEq86xYgW4O-2i1GRYSTz6g07WSLtEJjpTmYHM9cZ2fxQj6RBFU-nm4yH2A5n_FPcSw36YVu40gPypjBkzqEqY-ZtP3OY1hyU8memSnIjPho93BUS3Vqb8lyF0vqkTFx27qknOuNqQzqyEt7caA8r9Hgf5sEvR7M4FwWlwpRtgwuZ4mJiEetUuETT1JACMTtGTju5UOu8w6FZKwJzfsdpCuY6FOd8QG6TJR5zJjsHhJqtvhvw8zi3JwS_Eh_0vEcNYoEHBf0heIbSBIeF8RjDw-PW83RIIYw2Hbtws6vLlsyl27uA76O5vvNE3fFTLPZm06uVA4oKorBQJA76mTmJxjrpdi_aB4y0yaiCEY5PQK2bFk5x0wge56ZBWiFX-efrCL63WwsmIx7mm1gZFAned7hoSNXyngByRnGryB0Sr_wkndZh3sway2cgsCdRj4iG6NlimHWPxAbfwWKUWDa8evHH75fCmNYxaqYc9llUHVmP9E"
                );
            },
            url: `/api/operator/${id}/edit`,
            beforeSend: function (header) {
                /* Authorization header */
                header.setRequestHeader(
                    "Authorization",
                    "Bearer " +
                        "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZjExYmM1NTA3MmRjNGI3ODIzMDEzNzI4MjI3NjRiNDQ5NDM0ZDZkZDMyMDYxYzE4NzFmMDU3ZmZiMWRiMzY2NjFmNWEzZWE1ZTZjZWEyYjUiLCJpYXQiOjE2NzAzMTUwMzEuNDc4ODg5LCJuYmYiOjE2NzAzMTUwMzEuNDc4ODkxLCJleHAiOjE3MDE4NTEwMzEuNDc1Nzc3LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.EAnHBibj8oaTGCTY4ZlYGiIEjSBm9spqjj5-jOXTN2uT15MaRAgdGp75vRxxJjMZPck80Rvon5ffo9RAOaIvDz_H00tKYccnTigmvfMp0dCypgbITCBz91G5ejmwYS70NUOwcUY7BDdU80f3mNs65ocmq5802K4pbU-UQb4NPWRG-k_fMRdMaXaDLD4BxEq86xYgW4O-2i1GRYSTz6g07WSLtEJjpTmYHM9cZ2fxQj6RBFU-nm4yH2A5n_FPcSw36YVu40gPypjBkzqEqY-ZtP3OY1hyU8memSnIjPho93BUS3Vqb8lyF0vqkTFx27qknOuNqQzqyEt7caA8r9Hgf5sEvR7M4FwWlwpRtgwuZ4mJiEetUuETT1JACMTtGTju5UOu8w6FZKwJzfsdpCuY6FOd8QG6TJR5zJjsHhJqtvhvw8zi3JwS_Eh_0vEcNYoEHBf0heIbSBIeF8RjDw-PW83RIIYw2Hbtws6vLlsyl27uA76O5vvNE3fFTLPZm06uVA4oKorBQJA76mTmJxjrpdi_aB4y0yaiCEY5PQK2bFk5x0wge56ZBWiFX-efrCL63WwsmIx7mm1gZFAned7hoSNXyngByRnGryB0Sr_wkndZh3sway2cgsCdRj4iG6NlimHWPxAbfwWKUWDa8evHH75fCmNYxaqYc9llUHVmP9E"
                );
            },
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
            beforeSend: function (header) {
                /* Authorization header */
                header.setRequestHeader(
                    "Authorization",
                    "Bearer " +
                        "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZjExYmM1NTA3MmRjNGI3ODIzMDEzNzI4MjI3NjRiNDQ5NDM0ZDZkZDMyMDYxYzE4NzFmMDU3ZmZiMWRiMzY2NjFmNWEzZWE1ZTZjZWEyYjUiLCJpYXQiOjE2NzAzMTUwMzEuNDc4ODg5LCJuYmYiOjE2NzAzMTUwMzEuNDc4ODkxLCJleHAiOjE3MDE4NTEwMzEuNDc1Nzc3LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.EAnHBibj8oaTGCTY4ZlYGiIEjSBm9spqjj5-jOXTN2uT15MaRAgdGp75vRxxJjMZPck80Rvon5ffo9RAOaIvDz_H00tKYccnTigmvfMp0dCypgbITCBz91G5ejmwYS70NUOwcUY7BDdU80f3mNs65ocmq5802K4pbU-UQb4NPWRG-k_fMRdMaXaDLD4BxEq86xYgW4O-2i1GRYSTz6g07WSLtEJjpTmYHM9cZ2fxQj6RBFU-nm4yH2A5n_FPcSw36YVu40gPypjBkzqEqY-ZtP3OY1hyU8memSnIjPho93BUS3Vqb8lyF0vqkTFx27qknOuNqQzqyEt7caA8r9Hgf5sEvR7M4FwWlwpRtgwuZ4mJiEetUuETT1JACMTtGTju5UOu8w6FZKwJzfsdpCuY6FOd8QG6TJR5zJjsHhJqtvhvw8zi3JwS_Eh_0vEcNYoEHBf0heIbSBIeF8RjDw-PW83RIIYw2Hbtws6vLlsyl27uA76O5vvNE3fFTLPZm06uVA4oKorBQJA76mTmJxjrpdi_aB4y0yaiCEY5PQK2bFk5x0wge56ZBWiFX-efrCL63WwsmIx7mm1gZFAned7hoSNXyngByRnGryB0Sr_wkndZh3sway2cgsCdRj4iG6NlimHWPxAbfwWKUWDa8evHH75fCmNYxaqYc9llUHVmP9E"
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
