@extends('layouts.auth')

@section('content')
<section id="wrapper">
        <div class="login-register" style="background-image:url({{ asset('assets/images/background/login-register.jpg') }});">
            <div class="login-box card">
            <div class="card-body">
                <form class="form-horizontal form-material" id="loginform" action="{{ route('reset-password',$token) }}" id="resetpasswordform" method="POST">
                    @csrf
                    <h3 class="box-title mb-3">Reset Password</h3>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" placeholder="Enter New Password" name="newpassword"></div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" placeholder="Confirm Password" name="confirmpassword"></div>
                    </div>
                    <div class="form-group text-center mt-3">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
          </div>
        </div>

 </section>
@endsection
