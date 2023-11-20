@extends('layouts.auth')
@section('title','Change Password')
@section('content')
<section id="wrapper">
        <div class="login-register" style="background-image:url(assets/images/background/login-register.jpg);">
            <div class="login-box card">
            <div class="card-body">
                @include('includes.flash')
                <form class="form-horizontal form-material" id="loginform" action="{{ route('change-password') }}" id="changepasswordform" method="POST">
                    @csrf
                    <h3 class="box-title mb-3">Change Password</h3>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" placeholder="Enter New Password" name="newPassword" id="newPassword"></div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" placeholder="Please Confirm Password" name="confirmPassword"></div>
                    </div>
                    <div class="form-group text-center mt-3">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Change Password</button>
                        </div>
                    </div>
                </form>
            </div>
          </div>
        </div>

 </section>
@endsection
