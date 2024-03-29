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
    <table id="ctable" class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Camera ID</th>
                <th>model</th>
                <th>shuttercount</th>
                <th>quantity</th>
                <th>costs</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="cbody">
        </tbody>
    </table>
</div>
</div>

<div class="modal fade font-bold text-white my-6" id="cameraModal" role="dialog" style="display:none">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create new camera</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div style="padding: 0 2rem;">
                <form id="cform" action="#" method="#" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="camera_id" name="camera_id">
                    </div>
                    <div class="form-group">
                        <label for="model" class="control-label">model</label>
                        <input type="text" class="form-control" id="model" name="model">
                    </div>
                    <div class="form-group">
                        <label for="shuttercount" class="control-label">shuttercount</label>
                        <input type="number" class="form-control" id="shuttercount" name="shuttercount" min="1"
                            max="10">
                    </div>
                    <div class="form-group">
                        <label for="quantity" class="control-label">quantity</label>
                        <input type="text" class="form-control" id="quantity" name="quantity">
                    </div>
                    <div class="form-group">
                        <label for="costs" class="control-label">costs</label>
                        <input type="text" class="form-control" id="costs" name="costs">
                    </div>
                    <div class="form-group">
                        <label for="uploads" class="control-label">camera Image</label>
                        <input type="file" class="form-control" id="uploads" name="uploads">
                    </div>
                </form>
            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                <button id="cameraSubmit" type="submit" class="btn btn-primary">Save</button>
                <button id="cameraUpdate" type="submit" class="btn btn-info">Update</button>
            </div>
        </div>
    </div>
</div>
@endsection