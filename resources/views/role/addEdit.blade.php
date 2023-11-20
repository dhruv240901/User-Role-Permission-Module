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
                    @if (isset($role) || $role != null)
                        <form action="{{ route('update-role',$role->id) }}" method="POST" id="roleform">
                        @method('PUT')
                    @else
                        <form action="{{ route('store-role') }}" method="POST" id="roleform">
                    @endif
                        @csrf
                        <div class="form-body">
                            @if (isset($role) || $role != null)
                                <h3 class="card-title">Edit Role</h3>
                            @else
                                <h3 class="card-title">Add Role</h3>
                            @endif
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Role Name</label>
                                        <input type="text" id="rolename" class="form-control" placeholder="Enter rolename" name="roleName" value="{{ $role->name ?? old('roleName') }}">
                                    </div>
                                </div>
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Description</label>
                                        <input type="text" id="description" class="form-control" placeholder="Enter description" name="description" value="{{ $role->description ?? old('description') }}">
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
                                            @if (isset($role) || $role != null)
                                                @foreach ($permissions as $permission)
                                                    <option {{ in_array($permission->id, $role->permissions->pluck('id')->toArray()) ? 'selected' : '' }} value="{{ $permission->id }}">{{ $permission->name }}</option>
                                                @endforeach
                                            @else
                                                @foreach ($permissions as $permission)
                                                    <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                                @endforeach
                                            @endif
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


