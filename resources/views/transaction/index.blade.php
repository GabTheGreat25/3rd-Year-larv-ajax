@extends('layouts.base')
@section('body')
<style>
    * {
        margin-top: 5px;

    }

    .left-col {
        float: left;
        width: 25%;
    }

    .center-col {
        float: left;
        width: 50%;
    }

    .right-col {
        float: left;
        width: 25%;
    }

    th,
    td {
        color: white !important;
    }
</style>

<div class="container font-bold text-white my-6">
    <table id="trtable" class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Transaction ID</th>
                <th>Date Of Rent</th>
                <th>Payment Type</th>
                <th>Shipment Type</th>
                <th>Status</th>
                <th>Client Name</th>
                <th>Client Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="trbody">
        </tbody>
    </table>
</div>
</div>

<div class="modal fade font-bold text-white my-6" id="transactionModal" role="dialog" style="display:none">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Transaction Information</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div style="padding: 0 2rem;">
                <form id="trform" action="#" method="#" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="transaction_id" name="transaction_id">
                    </div>
                    <div class="form-group">
                        <select class="form-control validate" name="status" id="status">
                            <option value="Not Paid">Not Paid</option>
                            <option value="Pending">Pending</option>
                            <option value="Paid">Paid</option>
                        </select>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                <button id="transactionUpdate" type="submit" class="btn btn-info">Update</button>
            </div>
        </div>
    </div>
</div>
@endsection