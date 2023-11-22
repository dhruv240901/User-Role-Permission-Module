@extends('layouts.app')
@section('title','Users List')
@section('content')
<div class="container-fluid">
    @include('includes.flash')
    <div class="row float-right">
        <a href="{{ route('add-user') }}" type="button" class="btn btn-primary">+ Add User</a>
    </div>
    <div class="table-responsive m-t-40">
        <div id="myTable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
            <div class="row">
                <div class="col-sm-12">
                    <table id="usersTable" class="table table-bordered table-striped dataTable no-footer" role="grid"
                        aria-describedby="myTable_info">
                        <thead>
                            <tr>
                                <th style="width: 189.922px;">First Name</th>
                                <th style="width: 292.312px;">Last Name</th>
                                <th style="width: 139.125px;">Type</th>
                                <th style="width: 61.0312px;">Role</th>
                                <th style="width: 108.359px;">Status</th>
                                <th style="width: 130.25px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $k => $user)
                            <tr>
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->type }}</td>
                                <td>
                                    @foreach ($user->roles as $k => $role)
                                        {{ $role->name }},
                                    @endforeach
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input user-status" type="checkbox" role="switch" id="flexSwitchCheckChecked" data-id="{{ $user->id }}" @if($user->is_active==1) checked @endif>
                                    </div>
                                </td>
                                <td>

                                    @if ($user->deleted_at!=null)
                                    <form action="{{route('restore-user',$user->id)}}" method="POST" class="restoreform" data-id="{{ $user->id }}" id="restoreform{{ $user->id }}" style="display: inline">
                                        @csrf
                                    <button type="submit" class="btn btn-warning">
                                      <img src="{{asset('assets/images/restore.svg')}}" alt="">
                                    </button>
                                    </form>
                                    <form action="{{route('force-delete-user',$user->id)}}" method="POST" class="deleteform" data-id="{{ $user->id }}" id="deleteform{{ $user->id }}" style="display: inline">
                                        @csrf
                                    <button type="submit" class="btn btn-danger">
                                      <img src="{{asset('assets/images/delete.svg')}}" alt="">
                                    </button>
                                    </form>
                                    @else
                                    <a href="{{ route('edit-user',$user->id) }}" type="button" class="btn btn-success">
                                        <img src="{{ asset('assets/images/edit.svg') }}" alt="">
                                    </a>
                                    <a href="{{ route('show-user',$user->id) }}" type="button" class="btn btn-info">
                                        <img src="{{ asset('assets/images/show.svg') }}" alt="">
                                    </a>
                                    <form action="{{route('delete-user',$user->id)}}" method="POST" class="softdeleteform" data-id="{{ $user->id }}" id="softdeleteform{{ $user->id }}" style="display: inline">
                                        @csrf
                                        @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                      <img src="{{asset('assets/images/delete.svg')}}" alt="">
                                    </button>
                                    </form>
                                    <form action="{{route('force-logout',$user->id)}}" method="POST" class="forcelogoutform" data-id="{{ $user->id }}" id="forcelogoutform{{ $user->id }}" style="display: inline">
                                        @csrf
                                        <button class="btn btn-dark">
                                            <i class="bi bi-box-arrow-right"></i>
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
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
@section('jscontent')

        $(document).on("change",".user-status",function() {
            const id = $(this).data('id');
            const isChecked = $(this).is(':checked');

            $.ajax({
                type: 'POST',
                url: '{{route('update-user-status')}}',
                data: {
                    id:id,
                    checked: isChecked,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log(response);
                    if(response.status == 200){
                        toastr.success(""+response.message+"");
                    }else{
                        toastr.error(""+response.message+"");
                    }
                },
            });
        });

        $('.softdeleteform').submit(function (e) {
            e.preventDefault();

            Swal.fire({
                title: "Are you sure?",
                text: "You won't to soft delete this user!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
              }).then((result) => {
                if (result.isConfirmed) {
                    var dataid=$(this).attr('data-id');
                    $('#softdeleteform'+dataid).unbind('submit').submit();

                }
              });
        });

        $('.restoreform').submit(function (e) {
            e.preventDefault();

            Swal.fire({
                title: "Are you sure?",
                text: "You won't to restore this user!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, restore it!"
              }).then((result) => {
                if (result.isConfirmed) {
                    var dataid=$(this).attr('data-id');
                    $('#restoreform'+dataid).unbind('submit').submit();
                }
              });
        });

        $('.deleteform').submit(function (e) {
            e.preventDefault();

            Swal.fire({
                title: "Are you sure?",
                text: "You won't to permenantly delete this user!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
              }).then((result) => {
                if (result.isConfirmed) {
                    var dataid=$(this).attr('data-id');
                    $('#deleteform'+dataid).unbind('submit').submit();
                }
              });
        });

        $('.forcelogoutform').submit(function (e) {
            e.preventDefault();

            Swal.fire({
                title: "Are you sure?",
                text: "You won't to force logout this user!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, logout it!"
              }).then((result) => {
                if (result.isConfirmed) {
                    var dataid=$(this).attr('data-id');
                    $('#forcelogoutform'+dataid).unbind('submit').submit();
                }
              });
        });
@endsection

