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
                                        @foreach ($parentModules as $parentModule)
                                            @if(count($parentModule->children)>0)
                                            <tr class="table-secondary">
                                                <th scope="row" colspan="6">
                                                    {{ $parentModule->name }}</th>
                                            </tr>
                                            @else
                                            <tr class="table-secondary">
                                                <th scope="row">{{ $parentModule->name }}</th>
                                                <td>
                                                    {!! $permission->modules->contains(function ($value) use ($parentModule) {
                                                        return $value->id === $parentModule->id && $value->pivot->add_access == true && $value->pivot->edit_access == true && $value->pivot->delete_access == true && $value->pivot->view_access == true;
                                                    })
                                                        ? "<i class='bi bi-check2'></i>"
                                                        : "<i class='bi bi-x-lg'></i>" !!}
                                                </td>
                                                <td>
                                                    {!! $permission->modules->contains(function ($value) use ($parentModule) {
                                                        return $value->id === $parentModule->id && $value->pivot->add_access == true;
                                                    })
                                                        ? "<i class='bi bi-check2'></i>"
                                                        : "<i class='bi bi-x-lg'></i>" !!}
                                                </td>
                                                <td>
                                                    {!! $permission->modules->contains(function ($value) use ($parentModule) {
                                                        return $value->id === $parentModule->id && $value->pivot->view_access == true;
                                                    })
                                                        ? "<i class='bi bi-check2'></i>"
                                                        : "<i class='bi bi-x-lg'></i>" !!}
                                                </td>
                                                <td>
                                                    {!! $permission->modules->contains(function ($value) use ($parentModule) {
                                                        return $value->id === $parentModule->id && $value->pivot->edit_access == true;
                                                    })
                                                        ? "<i class='bi bi-check2'></i>"
                                                        : "<i class='bi bi-x-lg'></i>" !!}
                                                </td>
                                                <td>
                                                    {!! $permission->modules->contains(function ($value) use ($parentModule) {
                                                        return $value->id === $parentModule->id && $value->pivot->delete_access == true;
                                                    })
                                                        ? "<i class='bi bi-check2'></i>"
                                                        : "<i class='bi bi-x-lg'></i>" !!}
                                                </td>

                                            </tr>
                                            @endif
                                            @foreach ($modules as $module)
                                                @if ($module->parent->id == $parentModule->id)
                                                    <tr>
                                                        <th scope="row">{{ $module->name }}</th>
                                                        <td>
                                                            {!! $permission->modules->contains(function ($value) use ($module) {
                                                                return $value->id === $module->id && $value->pivot->add_access == true && $value->pivot->edit_access == true && $value->pivot->delete_access == true && $value->pivot->view_access == true;
                                                            })
                                                                ? "<i class='bi bi-check2'></i>"
                                                                : "<i class='bi bi-x-lg'></i>" !!}
                                                        </td>
                                                        <td>
                                                            {!! $permission->modules->contains(function ($value) use ($module) {
                                                                return $value->id === $module->id && $value->pivot->add_access == true;
                                                            })
                                                                ? "<i class='bi bi-check2'></i>"
                                                                : "<i class='bi bi-x-lg'></i>" !!}
                                                        </td>
                                                        <td>
                                                            {!! $permission->modules->contains(function ($value) use ($module) {
                                                                return $value->id === $module->id && $value->pivot->view_access == true;
                                                            })
                                                                ? "<i class='bi bi-check2'></i>"
                                                                : "<i class='bi bi-x-lg'></i>" !!}
                                                        </td>
                                                        <td>
                                                            {!! $permission->modules->contains(function ($value) use ($module) {
                                                                return $value->id === $module->id && $value->pivot->edit_access == true;
                                                            })
                                                                ? "<i class='bi bi-check2'></i>"
                                                                : "<i class='bi bi-x-lg'></i>" !!}
                                                        </td>
                                                        <td>
                                                            {!! $permission->modules->contains(function ($value) use ($module) {
                                                                return $value->id === $module->id && $value->pivot->delete_access == true;
                                                            })
                                                                ? "<i class='bi bi-check2'></i>"
                                                                : "<i class='bi bi-x-lg'></i>" !!}
                                                        </td>

                                                    </tr>
                                                @endif
                                            @endforeach
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
