@extends('layouts.auth')
@section('title','Signup')
@section('content')
    <section id="wrapper">
        <div class="login-register" style="background-image:url(../assets/images/background/login-register.jpg);">
            <div class="login-box card">
            <div class="card-body">
                @include('includes.flash')
                <form class="form-horizontal form-material" id="signupform" action="{{ route('custom-signup') }}" method="POST">
                    @csrf
                    <h3 class="box-title mb-3">Sign Up</h3>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" placeholder="First Name" name="firstName">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" placeholder="Last Name" name="lastName">
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" placeholder="Email" name="email">
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" placeholder="Password" name="password" id="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" placeholder="Confirm Password" name="confirmPassword">
                        </div>
                    </div>
                    <div class="form-group text-center mt-3">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Sign Up</button>
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <div class="col-sm-12 text-center">
                            <p>Already have an account? <a href="{{ route('login') }}" class="text-info ml-1"><b>Sign In</b></a></p>
                        </div>
                    </div>
                </form>

            </div>
          </div>
        </div>
    </section>
@endsection
