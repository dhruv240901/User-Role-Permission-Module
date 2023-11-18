@extends('layouts.app')
@section('title', 'Add Permission')
@section('content')
    <div class="container-fluid">
        @include('includes.flash')
        <a href="{{ route('permission-list') }}" type="button" class="btn btn-primary my-2"><i
                class="bi bi-arrow-left"></i></a>

        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline-info">
                    <div class="card-body">
                        @if (isset($permission) || $permission != null)
                            <form action="{{ route('update-permission', $permission->id) }}" method="POST"
                                id="permissionform">
                                @method('PUT')
                            @else
                                <form action="{{ route('store-permission') }}" method="POST" id="permissionform">
                        @endif
                        @csrf
                        <div class="form-body">
                            @if (isset($permission) || $permission != null)
                                <h3 class="card-title">Edit Permission</h3>
                            @else
                                <h3 class="card-title">Add Permission</h3>
                            @endif
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Permission Name</label>
                                        <input type="text" id="rolename" class="form-control"
                                            placeholder="Enter permission name" name="permissionname"
                                            value="{{ $permission->name ?? old('permissionname') }}">
                                    </div>
                                </div>
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Description</label>
                                        <input type="text" id="description" class="form-control"
                                            placeholder="Enter description" name="description"
                                            value="{{ $permission->description ?? old('description') }}">
                                    </div>
                                </div>
                                <!--/span-->

                                <!--/span-->
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">

                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Module Name</th>
                                                    <th scope="col">All</th>
                                                    <th scope="col">Add</th>
                                                    <th scope="col">View</th>
                                                    <th scope="col">Modify</th>
                                                    <th scope="col">Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($parentModules as $parentModule)
                                                    <tr>
                                                        <th scope="row" colspan="6" style="background-color: gray;">
                                                            {{ $parentModule->name }}</th>
                                                    </tr>
                                                    @foreach ($modules as $module)
                                                        @if ($module->parent->id == $parentModule->id)
                                                            <tr>
                                                                <th scope="row">{{ $module->name }}</th>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="flexCheckIndeterminate">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="add" id="flexCheckIndeterminate"
                                                                            @if(isset($permission) && $permission!=null)
                                                                            {{ $permission->modules->contains(function ($value) use ($module) {
                                                                                return $value->id === $module->id && $value->pivot->add_access === 1 && $value->pivot->edit_access === 1 && $value->pivot->delete_access === 1 && $value->pivot->view_access === 1;
                                                                            })
                                                                                ? "checked"
                                                                                : "" }}
                                                                            @endif
                                                                            name="{{ $module->name }}[]"
                                                                            >
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="view" id="flexCheckIndeterminate"
                                                                            name="{{ $module->name }}[]">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="modify" id="flexCheckIndeterminate"
                                                                            name="{{ $module->name }}[]">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="delete" id="flexCheckIndeterminate"
                                                                            name="{{ $module->name }}[]">
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            </tbody>
                                        </table>

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
