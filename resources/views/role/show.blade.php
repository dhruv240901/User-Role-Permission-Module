@extends('layouts.app')
@section('title','Role Details')
@section('content')
<div class="container-fluid">
    @include('includes.flash')
    <a href="{{ route('role-list') }}" type="button" class="btn btn-primary my-2"><i class="bi bi-arrow-left"></i></a>

    <div class="table-responsive m-t-40">
        <div id="myTable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer" style="background-color: burlywood;">
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-striped table-primary">
                          <tr>
                            <th scope="row">Name</th>
                            <td>{{ $role->name }}</td>
                          </tr>
                          <tr>
                            <th scope="row">Description</th>
                            <td>{{ $role->description }}</td>
                          </tr>
                          <tr>
                            <th scope="row">Status</th>
                            <td>
                                @if($role->is_active==true)
                                    Active
                                @else
                                    Inactive
                                @endif
                            </td>
                          </tr>
                          <tr>
                            <th scope="row">Permissions</th>
                            <td>
                                @foreach ($role->permissions as $k => $permission)
                                    {{ $permission->name }},
                                @endforeach
                            </td>
                          </tr>
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


