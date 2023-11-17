@extends('layouts.app')
@section('title','User Details')
@section('content')
<div class="container-fluid">
    @include('includes.flash')
    <a href="{{ route('user-list') }}" type="button" class="btn btn-primary my-2"><i class="bi bi-arrow-left"></i></a>

    <div class="table-responsive m-t-40">
        <div id="myTable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer" style="background-color: burlywood;">
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-striped table-primary">
                          <tr>
                            <th scope="row">First Name</th>
                            <td>{{ $user->first_name }}</td>
                          </tr>
                          <tr>
                            <th scope="row">Last Name</th>
                            <td>{{ $user->last_name }}</td>
                          </tr>
                          <tr>
                            <th scope="row">Email</th>
                            <td>{{ $user->email }}</td>
                          </tr>
                          <tr>
                            <th scope="row">Status</th>
                            <td>
                                @if($user->is_active==1)
                                    Active
                                @else
                                    Inactive
                                @endif
                            </td>
                          </tr>
                          <tr>
                            <th scope="row">Roles</th>
                            <td>
                                @foreach ($user->roles as $k => $role)
                                    {{ $role->name }},
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


