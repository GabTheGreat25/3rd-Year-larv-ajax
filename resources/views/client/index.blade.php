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
</style>
<div style="display: grid; justify-content: end;">
    <a href="/home" class="btn btn-danger"
        style="padding: .7rem 1.5rem; margin: 3rem 6rem 0 3rem; font-size: 2rem; font-weight: 500; font-style:italic;"
        role="button">Go
        Back</a>
</div>
<div class="container">
    <table id="cltable" class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Client ID</th>
                <th>Full Name</th>
                <th>Age</th>
                <th>Valid ID</th>
                <th>Billing Address</th>
                <th>Address</th>
                <th>Contact Number</th>
                <th>Email</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="clbody">
        </tbody>
    </table>
</div>
</div>

<div class="modal fade" id="clientModal" role="dialog" style="display:none">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Client Information</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div style="padding: 0 2rem;">
                <form id="clform" action="#" method="#" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="client_id" name="client_id">
                    </div>
                    <div class="form-group">
                        <label for="full_name" class="control-label">Full Name</label>
                        <input type="text" class="form-control" id="full_name" name="full_name">
                    </div>
                    <div class="form-group">
                        <label for="age" class="control-label">Age</label>
                        <input type="number" class="form-control" id="age" name="age" min="1" max="10">
                    </div>
                    <div class="form-group">
                        <label for="valid_id" class="control-label">Valid ID</label>
                        <input type="text" class="form-control" id="valid_id" name="valid_id">
                    </div>
                    <div class="form-group">
                        <label for="billing_address" class="control-label">Billing Address</label>
                        <input type="text" class="form-control" id="billing_address" name="billing_address">
                    </div>
                    <div class="form-group">
                        <label for="address" class="control-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address">
                    </div>
                    <div class="form-group">
                        <label for="contact_number" class="control-label">Contact Number</label>
                        <input type="text" class="form-control" id="contact_number" name="contact_number">
                    </div>
                    <div class="form-group">
                        <label for="uploads" class="control-label">client Image</label>
                        <input type="file" class="form-control" id="uploads" name="uploads">
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                <button id="clientUpdate" type="submit" class="btn btn-info">Update</button>
            </div>
        </div>
    </div>
</div>
@endsection