@extends('layouts.app')
@section('title', 'Permission Details')
@section('content')
    <div class="container-fluid">
        @include('includes.flash')
        <a href="{{ route('permission-list') }}" type="button" class="btn btn-primary my-2"><i
                class="bi bi-arrow-left"></i></a>

        <div class="table-responsive m-t-40">
            <div id="myTable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer"
                style="background-color: burlywood;">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-striped table-primary">
                            <tr>
                                <th scope="row">Name</th>
                                <td>{{ $permission->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Description</th>
                                <td>{{ $permission->description }}</td>
                            </tr>
                            <tr>
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
                                        {{-- @foreach ($permissions as $k => $permission)
                                            @foreach ($role->permissions as $k => $rolepermission)
                                                @if ($permission->id == $rolepermission->id)
                                                    <option value="{{ $permission->id }}" selected>{{ $permission->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                                @endif
                                            @endforeach
                                        @endforeach --}}
                                        {{-- @foreach ($modules as $k => $module)
                                            @if (count($permission->modules) > 0)
                                                @for ($i = 0; $i < count($permissionmodules); $i++)
                                                    @if ($module->id == $permissionmodules[$i]->id)
                                                        <tr>
                                                            <th scope="row">{{ $module->name }}</th>
                                                            @if ($permissionmodules[$i]->add_access == '1')
                                                                <td><i class="bi bi-check2"></td>
                                                            @else
                                                                <td><i class="bi bi-x-lg"></td>
                                                            @endif
                                                            <td><i class="bi bi-check2"></td>
                                                            <td><i class="bi bi-check2"></td>
                                                            <td><i class="bi bi-check2"></td>
                                                            <td><i class="bi bi-check2"></td>
                                                        </tr>
                                                    @else
                                                        <tr>
                                                            <th scope="row">{{ $module->name }}</th>
                                                            <td><i class="bi bi-x-lg"></td>
                                                            <td><i class="bi bi-x-lg"></td>
                                                            <td><i class="bi bi-x-lg"></td>
                                                            <td><i class="bi bi-x-lg"></td>
                                                            <td><i class="bi bi-x-lg"></td>
                                                        </tr>
                                                    @endif
                                                @endfor
                                            @else
                                                <tr>
                                                    <th scope="row">{{ $module->name }}</th>
                                                    <td><i class="bi bi-x-lg"></td>
                                                    <td><i class="bi bi-x-lg"></td>
                                                    <td><i class="bi bi-x-lg"></td>
                                                    <td><i class="bi bi-x-lg"></td>
                                                    <td><i class="bi bi-x-lg"></td>
                                                </tr>
                                            @endif --}}
                                            {{-- @foreach ($permissionmodules as $permissionmodule)
                                                    @if ($permissionmodule->module_id == $module->id)
                                                        <td>
                                                            <i class="bi bi-x-lg"></i>
                                                        </td>
                                                        @if ($permissionmodule->add_access = '1')
                                                            <td>
                                                                <i class="bi bi-check2"></i>
                                                            </td>
                                                        @else
                                                            <td>
                                                                <i class="bi bi-x-lg"></i>
                                                            </td>
                                                        @endif
                                                        @if ($permissionmodule->view_access = '1')
                                                            <td>
                                                                <i class="bi bi-check2"></i>
                                                            </td>
                                                        @else
                                                            <td>
                                                                <i class="bi bi-x-lg"></i>
                                                            </td>
                                                        @endif
                                                        @if ($permissionmodule->edit_access = '1')
                                                            <td>
                                                                <i class="bi bi-check2"></i>
                                                            </td>
                                                        @else
                                                            <td>
                                                                <i class="bi bi-x-lg"></i>
                                                            </td>
                                                        @endif
                                                        @if ($permissionmodule->delete_access = '1')
                                                            <td>
                                                                <i class="bi bi-check2"></i>
                                                            </td>
                                                        @else
                                                            <td>
                                                                <i class="bi bi-x-lg"></i>
                                                            </td>
                                                        @endif --}}
                                            {{-- <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="add" id="flexCheckIndeterminate"
                                                                    name="{{ $module->name }}[]">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="view" id="flexCheckIndeterminate"
                                                                    name="{{ $module->name }}[]">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="modify" id="flexCheckIndeterminate"
                                                                    name="{{ $module->name }}[]">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="delete" id="flexCheckIndeterminate"
                                                                    name="{{ $module->name }}[]">
                                                            </div>
                                                        </td> --}}
                                            {{-- @else
                                                        <td>
                                                            <i class="bi bi-x-lg"></i>
                                                        </td>
                                                        <td>
                                                            <i class="bi bi-x-lg"></i>
                                                        </td>
                                                        <td>
                                                            <i class="bi bi-x-lg"></i>
                                                        </td>
                                                        <td>
                                                            <i class="bi bi-x-lg"></i>
                                                        </td>
                                                        <td>
                                                            <i class="bi bi-x-lg"></i>
                                                        </td>
                                                    @endif --}}
                                            {{-- @endforeach --}}
                                            {{-- </tr> --}}
                                        {{-- @endforeach --}}
                                        @foreach ($modules as $module)
                                            @if ($module->child_names != null)
                                                <tr>
                                                    <th scope="row" colspan="6" style="background-color: gray;">
                                                        {{ $module->parent_name }}</th>
                                                </tr>
                                                @foreach (explode(',', $module->child_names) as $childmodule)
                                                    <tr>
                                                        <th scope="row">{{ $childmodule }}</th>
                                                        <td>
                                                            <i class="bi bi-x-lg"></i>
                                                        </td>
                                                        <td>
                                                            <i class="bi bi-x-lg"></i>
                                                        </td>
                                                        <td>
                                                            <i class="bi bi-x-lg"></i>
                                                        </td>
                                                        <td>
                                                            <i class="bi bi-x-lg"></i>
                                                        </td>
                                                        <td>
                                                            <i class="bi bi-x-lg"></i>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </tr>
                            {{-- <tr>
                            <th scope="row">Permissions</th>
                            <td>
                                @foreach ($role->permissions as $k => $permission)
                                    {{ $permission->name }},
                                @endforeach
                            </td>
                          </tr> --}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
    </div>
@endsection
