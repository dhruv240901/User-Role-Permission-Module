@extends('layouts.app')
@section('title','Edit User')

@section('content')
<div class="container-fluid">
    @include('includes.flash')
    <a href="{{ route('user-list') }}" type="button" class="btn btn-primary my-2"><i class="bi bi-arrow-left"></i></a>
    {{-- {{ dd($user->roles)}} --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-outline-info">
                <div class="card-body">
                    <form action="{{ route('update-user',$user->id) }}" method="POST" id="userform">
                        @csrf
                        @method('PUT')
                        <div class="form-body">
                            <h3 class="card-title">Edit User</h3>
                            <hr>
                            <div class="row pt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">First Name</label>
                                        <input type="text" id="firstName" class="form-control" placeholder="Enter firstname" name="firstname" value="{{ old('firstname',$user->first_name) }}">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Last Name</label>
                                        <input type="text" id="lastName" class="form-control" placeholder="Enter lastname" name="lastname" value="{{ old('lastname',$user->last_name) }}">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Email</label>
                                        <input type="text" id="email" class="form-control" placeholder="Enter email" name="email" value="{{ old('email',$user->email) }}">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Select Roles</label>
                                        <select class="js-example-basic-multiple form-control" name="roles[]" multiple="multiple">
                                            @foreach ($roles as $k=>$role)
                                                @forelse ($user->roles as $k=>$userrole)
                                                    <option value="{{ $role->id }}" @if ($role->id==$userrole->id) selected @endif>{{ $role->name }}</option>
                                                @empty
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforelse
                                            @endforeach

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


