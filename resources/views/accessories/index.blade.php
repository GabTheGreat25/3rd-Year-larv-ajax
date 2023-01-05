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

<div class="container font-bold text-white my-6">
    <table id="atable" class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Accessories ID</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Costs</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="abody">
        </tbody>
    </table>
</div>
</div>

<div class="modal fade font-bold text-white my-6" id="accessoriesModal" role="dialog" style="display:none">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create new accessories</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div style="padding: 0 2rem;">
                <form id="aform" action="#" method="#" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="accessories_id" name="accessories_id">
                    </div>
                    <div class="form-group">
                        <label for="description" class="control-label">Description</label>
                        <input type="text" class="form-control" id="description" name="description">
                    </div>
                    <div class="form-group">
                        <label for="quantity" class="control-label">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" min="1" max="10">
                    </div>
                    <div class="form-group">
                        <label for="costs" class="control-label">Costs</label>
                        <input type="text" class="form-control" id="costs" name="costs">
                    </div>
                    <div class="form-group">
                        <label for="uploads" class="control-label">accessories Image</label>
                        <input type="file" class="form-control" id="uploads" name="uploads">
                    </div>
                </form>
            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                <button id="accessoriesSubmit" type="submit" class="btn btn-primary">Save</button>
                <button id="accessoriesUpdate" type="submit" class="btn btn-info">Update</button>
            </div>
        </div>
    </div>
</div>
@endsection