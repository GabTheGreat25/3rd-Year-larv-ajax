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
    <table id="otable" class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Operator ID</th>
                <th>Name</th>
                <th>Contact Number</th>
                <th>Age</th>
                <th>Address</th>
                <th>Email</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="obody">
        </tbody>
    </table>
</div>
</div>

<div class="modal fade font-bold text-white my-6" id="operatorModal" role="dialog" style="display:none">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Operator Information</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div style="padding: 0 2rem;">
                <form id="oform" action="#" method="#" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="operator_id" name="operator_id">
                    </div>
                    <div class="form-group">
                        <label for="full_name" class="control-label">Full Name</label>
                        <input type="text" class="form-control" id="full_name" name="full_name">
                    </div>
                    <div class="form-group">
                        <label for="contact_number" class="control-label">Contact Number</label>
                        <input type="text" class="form-control" id="contact_number" name="contact_number">
                    </div>
                    <div class="form-group">
                        <label for="age" class="control-label">Age</label>
                        <input type="number" class="form-control" id="age" name="age" min="1" max="100">
                    </div>
                    <div class="form-group">
                        <label for="address" class="control-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address">
                    </div>
                    <div class="form-group">
                        <label for="uploads" class="control-label">Operator Image</label>
                        <input type="file" class="form-control" id="uploads" name="uploads">
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                <button id="operatorUpdate" type="submit" class="btn btn-info">Update</button>
            </div>
        </div>
    </div>
</div>
@endsection