@extends('layouts.app')
@section('title','Permissions List')
@section('content')
    <div class="container-fluid">
        @include('includes.flash')
        @if(auth()->user()->UserAccess('PER','add'))
        <div class="row float-right">
            <a href="{{ route('add-permission') }}" type="button" class="btn btn-primary">+ Add Permission</a>
        </div>
        @endif
        <div class="table-responsive m-t-40">
            <div id="myTable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="permissionsTable" class="table table-bordered table-striped dataTable no-footer" role="grid"
                            aria-describedby="myTable_info">
                            <thead>
                                <tr>
                                    <th style="width: 189.922px;">Name</th>
                                    <th style="width: 292.312px;">Status</th>
                                    <th style="width: 139.125px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $k => $permission)
                                    <tr>
                                        <td>{{ $permission->name }}</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input permission-status" type="checkbox" role="switch" id="flexSwitchCheckChecked" data-id="{{ $permission->id }}" @if($permission->is_active==true) checked @endif @if(!auth()->user()->UserAccess('PER','edit')) disabled @endif>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($permission->deleted_at != null)
                                                @if(auth()->user()->UserAccess('PER','delete'))
                                                <form action="{{ route('restore-permission', $permission->id) }}" method="POST" class="restoreform" data-id="{{ $permission->id }}" id="restoreform{{ $permission->id }}"
                                                    style="display: inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-warning">
                                                        <img src="{{ asset('assets/images/restore.svg') }}" alt="">
                                                    </button>
                                                </form>
                                                <form action="{{ route('force-delete-permission', $permission->id) }}" method="POST" class="deleteform" data-id="{{ $permission->id }}" id="deleteform{{ $permission->id }}"
                                                    style="display: inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">
                                                        <img src="{{ asset('assets/images/delete.svg') }}" alt="">
                                                    </button>
                                                </form>
                                                @endif
                                            @else
                                                @if(auth()->user()->UserAccess('PER','edit'))
                                                <a href="{{ route('edit-permission', $permission->id) }}" type="button"
                                                    class="btn btn-success">
                                                    <img src="{{ asset('assets/images/edit.svg') }}" alt="">
                                                </a>
                                                @endif
                                                @if(auth()->user()->UserAccess('PER','view'))
                                                <a href="{{ route('show-permission',$permission->id) }}" type="button" class="btn btn-info">
                                                    <img src="{{ asset('assets/images/show.svg') }}" alt="">
                                                </a>
                                                @endif
                                                @if(auth()->user()->UserAccess('PER','delete'))
                                                <form action="{{ route('delete-permission', $permission->id) }}" method="POST" class="softdeleteform" data-id="{{ $permission->id }}" id="softdeleteform{{ $permission->id }}"
                                                    style="display: inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        <img src="{{ asset('assets/images/delete.svg') }}" alt="">
                                                    </button>
                                                </form>
                                                @endif
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
$(document).ready(function() {

    $('.permission-status').on('change', function() {
        const id = $(this).data('id');
        const isChecked = $(this).is(':checked');

        $.ajax({
            type: 'POST',
            url: '{{route('update-permission-status')}}',
            data: {
                id:id,
                checked: isChecked,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
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
            text: "You won't to soft delete this permission!",
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
            text: "You won't to restore this permission!",
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
            text: "You won't to permenantly delete this permission!",
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

});
@endsection
