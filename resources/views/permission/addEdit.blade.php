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
                                        <label class="control-label">Permission Name <sup
                                                class="required_field">*</sup></label>
                                        <input type="text" id="rolename" class="form-control"
                                            placeholder="Enter permission name" name="permissionName"
                                            value="{{ $permission->name ?? old('permissionName') }}">
                                    </div>
                                </div>
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Description <sup class="required_field">*</sup></label>
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
                                                    @if (count($parentModule->children) > 0)
                                                        <tr class="table-secondary">
                                                            <th scope="row" colspan="6">
                                                                {{ $parentModule->name }}</th>
                                                        </tr>
                                                    @else
                                                        <tr class="table-secondary">
                                                            <th scope="row">{{ $parentModule->name }}</th>
                                                            <td>
                                                                <div class="form-check">
                                                                    <input
                                                                        class="form-check-input selectall selectall{{ $parentModule->id }}"
                                                                        type="checkbox" data-id="{{ $parentModule->id }}"
                                                                        @if (isset($permission) && $permission != null) {{ $permission->modules->contains(function ($value) use ($parentModule) {
                                                                            return $value->id === $parentModule->id &&
                                                                                $value->pivot->add_access === 1 &&
                                                                                $value->pivot->edit_access === 1 &&
                                                                                $value->pivot->delete_access === 1 &&
                                                                                $value->pivot->view_access === 1;
                                                                        })
                                                                            ? 'checked'
                                                                            : '' }} @endif
                                                                        value="" id="flexCheckIndeterminate">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-check">
                                                                    <input
                                                                        class="form-check-input add_access{{ $parentModule->id }}"
                                                                        type="checkbox" value="add"
                                                                        id="flexCheckIndeterminate"
                                                                        @if (isset($permission) && $permission != null) {{ $permission->modules->contains(function ($value) use ($parentModule) {
                                                                            return $value->id === $parentModule->id && $value->pivot->add_access == true;
                                                                        })
                                                                            ? 'checked'
                                                                            : '' }} @endif
                                                                        name="{{ $parentModule->name }}[]">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-check">
                                                                    <input
                                                                        class="form-check-input view_access{{ $parentModule->id }}"
                                                                        type="checkbox" value="view"
                                                                        id="flexCheckIndeterminate"
                                                                        @if (isset($permission) && $permission != null) {{ $permission->modules->contains(function ($value) use ($parentModule) {
                                                                            return $value->id === $parentModule->id && $value->pivot->view_access == true;
                                                                        })
                                                                            ? 'checked'
                                                                            : '' }} @endif
                                                                        name="{{ $parentModule->name }}[]">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-check">
                                                                    <input
                                                                        class="form-check-input edit_access{{ $parentModule->id }}"
                                                                        type="checkbox" value="modify"
                                                                        id="flexCheckIndeterminate"
                                                                        @if (isset($permission) && $permission != null) {{ $permission->modules->contains(function ($value) use ($parentModule) {
                                                                            return $value->id === $parentModule->id && $value->pivot->edit_access == true;
                                                                        })
                                                                            ? 'checked'
                                                                            : '' }} @endif
                                                                        name="{{ $parentModule->name }}[]">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-check">
                                                                    <input
                                                                        class="form-check-input delete_access{{ $parentModule->id }}"
                                                                        type="checkbox" value="delete"
                                                                        id="flexCheckIndeterminate"
                                                                        @if (isset($permission) && $permission != null) {{ $permission->modules->contains(function ($value) use ($parentModule) {
                                                                            return $value->id === $parentModule->id && $value->pivot->delete_access == true;
                                                                        })
                                                                            ? 'checked'
                                                                            : '' }} @endif
                                                                        name="{{ $parentModule->name }}[]">
                                                                </div>
                                                            </td>

                                                        </tr>
                                                    @endif
                                                    @foreach ($modules as $module)
                                                        @if ($module->parent->id == $parentModule->id)
                                                            <tr>
                                                                <th scope="row">{{ $module->name }}</th>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input
                                                                            class="form-check-input selectall selectall{{ $module->id }}"
                                                                            type="checkbox" data-id="{{ $module->id }}"
                                                                            @if (isset($permission) && $permission != null) {{ $permission->modules->contains(function ($value) use ($module) {
                                                                                return $value->id === $module->id &&
                                                                                    $value->pivot->add_access === 1 &&
                                                                                    $value->pivot->edit_access === 1 &&
                                                                                    $value->pivot->delete_access === 1 &&
                                                                                    $value->pivot->view_access === 1;
                                                                            })
                                                                                ? 'checked'
                                                                                : '' }} @endif
                                                                            value="" id="flexCheckIndeterminate">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input
                                                                            class="form-check-input add_access{{ $module->id }}"
                                                                            type="checkbox" value="add"
                                                                            id="flexCheckIndeterminate"
                                                                            @if (isset($permission) && $permission != null) {{ $permission->modules->contains(function ($value) use ($module) {
                                                                                return $value->id === $module->id && $value->pivot->add_access == true;
                                                                            })
                                                                                ? 'checked'
                                                                                : '' }} @endif
                                                                            name="{{ $module->name }}[]">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input
                                                                            class="form-check-input view_access{{ $module->id }}"
                                                                            type="checkbox" value="view"
                                                                            id="flexCheckIndeterminate"
                                                                            @if (isset($permission) && $permission != null) {{ $permission->modules->contains(function ($value) use ($module) {
                                                                                return $value->id === $module->id && $value->pivot->view_access == true;
                                                                            })
                                                                                ? 'checked'
                                                                                : '' }} @endif
                                                                            name="{{ $module->name }}[]">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input
                                                                            class="form-check-input edit_access{{ $module->id }}"
                                                                            type="checkbox" value="modify"
                                                                            id="flexCheckIndeterminate"
                                                                            @if (isset($permission) && $permission != null) {{ $permission->modules->contains(function ($value) use ($module) {
                                                                                return $value->id === $module->id && $value->pivot->edit_access == true;
                                                                            })
                                                                                ? 'checked'
                                                                                : '' }} @endif
                                                                            name="{{ $module->name }}[]">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input
                                                                            class="form-check-input delete_access{{ $module->id }}"
                                                                            type="checkbox" value="delete"
                                                                            id="flexCheckIndeterminate"
                                                                            @if (isset($permission) && $permission != null) {{ $permission->modules->contains(function ($value) use ($module) {
                                                                                return $value->id === $module->id && $value->pivot->delete_access == true;
                                                                            })
                                                                                ? 'checked'
                                                                                : '' }} @endif
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
@section('jscontent')
    $('.selectall').on('change', function() {
    var moduleId=$(this).attr('data-id');
    if($('.selectall' + moduleId).is(":checked")){
    $('.add_access' + moduleId).prop('checked',true)
    $('.view_access' + moduleId).prop('checked',true)
    $('.edit_access' + moduleId).prop('checked',true)
    $('.delete_access' + moduleId).prop('checked',true)
    }else{
    $('.add_access' + moduleId).prop('checked',false)
    $('.view_access' + moduleId).prop('checked',false)
    $('.edit_access' + moduleId).prop('checked',false)
    $('.delete_access' + moduleId).prop('checked',false)
    }
    })
@endsection
