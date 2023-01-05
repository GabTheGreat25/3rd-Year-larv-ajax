@extends('layouts.base')
@section('body')

<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

<style>
    td {
        color: white !important;
        text-align: center;
    }
</style>


<body>

    <div class="container text-white">
        <h3 align="center">Camera Transaction History</h3><br />
        <div class="row">
            <h2>Camera Transaction Total Data: <span id="total_records"></span></h2>
            <div class="col-12">
                <div class="form-group">
                    <input type="text" name="search" id="search" class="form-control"
                        placeholder="Search Camera Transaction Data" />
                </div>
                <div class="table-responsive text-white">
                    <table id="Transactiontb" class="table table-striped table-bordered text-white">
                        <thead>
                            <tr>
                                <th>Transaction ID</th>
                                <th>Model</th>
                                <th>Shuttercount</th>
                                <th>Costs</th>
                                <th>Image</th>
                                <th>Quantity</th>
                                <th>Date Of Rent</th>
                                <th>Payment Type</th>
                                <th>Shipment Type</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody></tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {

            fetch_Transaction_data();

            function fetch_Transaction_data(query = '') {
                $.ajax({
                    url: "{{ route('action1') }}",
                    method: 'GET',
                    data: {
                        query: query
                    },
                    beforeSend: function(header) {
                        header.setRequestHeader(
                            "Authorization",
                            "Bearer " + localStorage.getItem("token")
                        );
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#Transactiontb tbody').html(data.table_data);
                        $('#total_records').text(data.total_data);
                    }
                })
            }

            $(document).on('keyup', '#search', function() {
                var query = $(this).val();
                fetch_Transaction_data(query);
            });
        });
    </script>
    @endsection