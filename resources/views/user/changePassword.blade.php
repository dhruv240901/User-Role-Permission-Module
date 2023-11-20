@extends('layouts.app')
@section('title','Change Password')
@section('content')
<div class="container-fluid">
    @include('includes.flash')
    <div class="row">
        <div class="col-lg-6">
            <div class="card card-outline-info">
                <div class="card-body">
                    <form action="{{ route('user-change-password') }}" method="POST" id="userchangepassword">
                        @csrf
                        <div class="form-body">
                            <h3 class="card-title">Change Password</h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Enter Password <sup class="required_field">*</sup></label>
                                        <input type="password" id="oldpassword" class="form-control" placeholder="Enter Password" name="oldPassword">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Enter New Password <sup class="required_field">*</sup></label>
                                        <input type="password" id="newpassword" class="form-control" placeholder="Enter New Password" name="newPassword">
                                    </div>
                                </div>
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Confirm Password <sup class="required_field">*</sup></label>
                                        <input type="password" id="confirmpassword" class="form-control" placeholder="Confirm Password" name="confirmPassword">
                                    </div>
                                </div>
                                <!--/span-->

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


