@extends('layouts.auth')

@section('content')
    <section id="wrapper">
        <div class="login-register" style="background-image:url(assets/images/background/login-register.jpg);">
            <div class="login-box card">
                <div class="card-body">
                    @include('includes.flash')
                    <form class="form-horizontal form-material" id="loginform" action="{{ route('custom-login') }}"
                        id="loginform" method="POST">
                        @csrf
                        <h3 class="box-title mb-3">Sign In</h3>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" placeholder="Email" name="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" placeholder="Password" name="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <a href="{{ route('view-forget-password') }}" id="to-recover" class="text-dark float-right"><i
                                        class="fa fa-lock mr-1"></i> Forgot pwd?</a>
                            </div>
                        </div>
                        <div class="form-group text-center mt-3">
                            <div class="col-xs-12">
                                <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light"
                                    type="submit">Log In</button>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <div class="col-sm-12 text-center">
                                <p>Don't have an account? <a href="{{ route('signup') }}" class="text-info ml-1"><b>Sign
                                            Up</b></a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
@endsection
