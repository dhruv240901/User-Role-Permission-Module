@extends('layouts.app')
@section('title','Add User')
@section('content')
<div class="container-fluid">
    @include('includes.flash')
    <a href="{{ route('role-list') }}" type="button" class="btn btn-primary my-2"><i class="bi bi-arrow-left"></i></a>

    <div class="row">
        <div class="col-lg-6">
            <div class="card card-outline-info">
                <div class="card-body">
                    <form action="{{ route('store-role') }}" method="POST" id="roleform">
                        @csrf
                        <div class="form-body">
                            <h3 class="card-title">+ Add Role</h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Role Name</label>
                                        <input type="text" id="rolename" class="form-control" placeholder="Enter rolename" name="rolename">
                                    </div>
                                </div>
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Description</label>
                                        <input type="text" id="description" class="form-control" placeholder="Enter description" name="description">
                                    </div>
                                </div>
                                <!--/span-->

                                <!--/span-->
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Select Permission</label>
                                        <select class="js-example-basic-multiple form-control" name="permissions[]" multiple="multiple">
                                            @foreach ($permissions as $permission)
                                                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--/row-->
                            <!--/row-->
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                            <button type="button" class="btn btn-inverse">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Right sidebar -->
    <!-- ============================================================== -->
</div>
@endsection


