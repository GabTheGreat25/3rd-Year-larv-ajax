@extends('layouts.base')
@section('body')

<div class="container">
    <table id="adtable" class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Admin ID</th>
                <th>Full Name</th>
                <th>Age</th>
                <th>Email</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="adbody">
        </tbody>
    </table>
</div>
</div>

<div class="modal fade" id="adminModal" role="dialog" style="display:none">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Admin Information</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div style="padding: 0 2rem;">
                <form id="adform" action="#" method="#" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="admin_id" name="admin_id">
                    </div>
                    <div class="form-group">
                        <label for="full_name" class="control-label">Full Name</label>
                        <input type="text" class="form-control" id="full_name" name="full_name">
                    </div>
                    <div class="form-group">
                        <label for="age" class="control-label">Age</label>
                        <input type="number" class="form-control" id="age" name="age" min="1" max="100">
                    </div>
                    <div class="form-group">
                        <label for="uploads" class="control-label">Admin Image</label>
                        <input type="file" class="form-control" id="uploads" name="uploads">
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                <button id="adminUpdate" type="submit" class="btn btn-info">Update</button>
            </div>
        </div>
    </div>
</div>
@endsection