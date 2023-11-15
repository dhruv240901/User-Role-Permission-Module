@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        @include('includes.flash')
        <div class="row float-right">
            <a href="{{ route('add-permission') }}" type="button" class="btn btn-primary">+ Add Permission</a>
        </div>
        <div class="table-responsive m-t-40">
            <div id="myTable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="usersTable" class="table table-bordered table-striped dataTable no-footer" role="grid"
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
                                                <input class="form-check-input permission-status" type="checkbox" role="switch" id="flexSwitchCheckChecked" data-id="{{ $permission->id }}" @if($permission->is_active=='1') checked @endif>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('edit-permission', $permission->id) }}" type="button"
                                                class="btn btn-success">
                                                <img src="{{ asset('assets/images/edit.svg') }}" alt="">
                                            </a>
                                            <a href="{{ route('show-permission',$permission->id) }}" type="button" class="btn btn-info">
                                                <img src="{{ asset('assets/images/show.svg') }}" alt="">
                                            </a>
                                            @if ($permission->deleted_at != null)
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
                                            @else
                                                <form action="{{ route('delete-permission', $permission->id) }}" method="POST" class="softdeleteform" data-id="{{ $permission->id }}" id="softdeleteform{{ $permission->id }}"
                                                    style="display: inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        <img src="{{ asset('assets/images/delete.svg') }}" alt="">
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
        <div class="right-sidebar">
            <div class="slimscrollright">
                <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
                <div class="r-panel-body">
                    <ul id="themecolors" class="mt-3">
                        <li><b>With Light sidebar</b></li>
                        <li><a href="javascript:void(0)" data-theme="default" class="default-theme">1</a>
                        </li>
                        <li><a href="javascript:void(0)" data-theme="green" class="green-theme">2</a></li>
                        <li><a href="javascript:void(0)" data-theme="red" class="red-theme">3</a></li>
                        <li><a href="javascript:void(0)" data-theme="blue" class="blue-theme working">4</a>
                        </li>
                        <li><a href="javascript:void(0)" data-theme="purple" class="purple-theme">5</a></li>
                        <li><a href="javascript:void(0)" data-theme="megna" class="megna-theme">6</a></li>
                        <li class="d-block mt-4"><b>With Dark sidebar</b></li>
                        <li><a href="javascript:void(0)" data-theme="default-dark" class="default-dark-theme">7</a></li>
                        <li><a href="javascript:void(0)" data-theme="green-dark" class="green-dark-theme">8</a></li>
                        <li><a href="javascript:void(0)" data-theme="red-dark" class="red-dark-theme">9</a>
                        </li>
                        <li><a href="javascript:void(0)" data-theme="blue-dark" class="blue-dark-theme">10</a></li>
                        <li><a href="javascript:void(0)" data-theme="purple-dark" class="purple-dark-theme">11</a></li>
                        <li><a href="javascript:void(0)" data-theme="megna-dark" class="megna-dark-theme ">12</a></li>
                    </ul>
                    <ul class="mt-3 chatonline">
                        <li><b>Chat option</b></li>
                        <li>
                            <a href="javascript:void(0)"><img src="../assets/images/users/1.jpg" alt="user-img"
                                    class="img-circle"> <span>Varun Dhavan <small
                                        class="text-success">online</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="../assets/images/users/2.jpg" alt="user-img"
                                    class="img-circle"> <span>Genelia Deshmukh <small
                                        class="text-warning">Away</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="../assets/images/users/3.jpg" alt="user-img"
                                    class="img-circle"> <span>Ritesh Deshmukh <small
                                        class="text-danger">Busy</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="../assets/images/users/4.jpg" alt="user-img"
                                    class="img-circle"> <span>Arijit Sinh <small
                                        class="text-muted">Offline</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="../assets/images/users/5.jpg" alt="user-img"
                                    class="img-circle"> <span>Govinda Star <small
                                        class="text-success">online</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="../assets/images/users/6.jpg" alt="user-img"
                                    class="img-circle"> <span>John Abraham<small
                                        class="text-success">online</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="../assets/images/users/7.jpg" alt="user-img"
                                    class="img-circle"> <span>Hritik Roshan<small
                                        class="text-success">online</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="../assets/images/users/8.jpg" alt="user-img"
                                    class="img-circle"> <span>Pwandeep rajan <small
                                        class="text-success">online</small></span></a>
                        </li>
                    </ul>
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

            },
            error: function(error) {

            }
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
