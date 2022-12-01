@extends('layouts.base')
@section('body')
<style>
    * {
        margin-top: 10px;
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

<div class="container">{{-- all ajax is ID based remeber this --}}
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

<div class="modal fade" id="accessoriesModal" role="dialog" style="display:none">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create new accessories</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div style="padding: 0 2rem;">
                <form id="oform" action="#" method="#" enctype="multipart/form-data"> {{-- just change the table form
                    body ng isang letter base dun sa umpisa gaya dito accessories kaya o --}}
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="accessories_id" name="accessories_id">
                        {{-- tapos ito accessories id ito primary key taz sa baba mga name contact number yung iba laman ng
                        table same dapat yan ah yun lang --}}
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Description</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="contact_number" class="control-label">Quantity</label>
                        <input type="text" class="form-control" id="contact_number" name="contact_number">
                    </div>
                    <div class="form-group">
                        <label for="age" class="control-label">Costs</label>
                        <input type="number" class="form-control" id="age" name="age" min="1" max="100">
                    </div>
                
                    <div class="form-group">
                        <label for="uploads" class="control-label">accessories Image</label> {{-- uploads name nito kasi
                        yun name nya sa controller --}}
                        <input type="file" class="form-control" id="uploads" name="uploads">
                    </div>
                </form>
            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                <button id="accessoriesSubmit" type="submit" class="btn btn-primary">Save</button>
                <button id="accessoriesUpdate" type="submit" class="btn btn-info">Update</button>
                {{-- id base den toh magkaiba yan ginagawa ah --}}
            </div>
        </div>
    </div>
</div>
@endsection