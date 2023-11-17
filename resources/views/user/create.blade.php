@extends('layouts.app')
@section('title', 'Add User')
@section('content')
    <div class="container-fluid">
        @include('includes.flash')

        <a href="{{ route('user-list') }}" type="button" class="btn btn-primary my-2"><i class="bi bi-arrow-left"></i></a>

        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline-info">
                    <div class="card-body">
                        @if (isset($user) || $user != null)
                            <form action="{{ route('update-user',$user->id) }}" method="POST" id="userform">
                                @method('PUT')
                        @else
                            <form action="{{ route('store-user') }}" method="POST" id="userform">
                        @endif
                            @csrf
                            <div class="form-body">
                                @if (isset($user) || $user != null)
                                    <h3 class="card-title">Edit User</h3>
                                @else
                                    <h3 class="card-title">Add User</h3>
                                @endif
                                <hr>
                                <div class="row pt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">First Name</label>
                                            <input type="text" id="firstName" class="form-control"
                                                placeholder="Enter firstname" name="firstname" value="{{ $user->first_name ?? old('firstname') }}">
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Last Name</label>
                                            <input type="text" id="lastName" class="form-control"
                                                placeholder="Enter lastname" name="lastname" value="{{ $user->last_name ?? old('lastname') }}">
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <input type="text" id="email" class="form-control"
                                                placeholder="Enter email" name="email" value="{{ $user->email ?? old('email') }}">
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Select Roles</label>
                                            <select class="js-example-basic-multiple form-control" name="roles[]"
                                                multiple="multiple">
                                                @if (isset($user) || $user != null)
                                                    @foreach ($roles as $role)
                                                        <option {{ in_array($role->id, $user->roles->pluck('id')->toArray()) ? 'selected' : '' }} value="{{ $role->id }}">{{ $role->name }}</option>
                                                    @endforeach
                                                @else
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <!--/span-->
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
