@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @include('includes.flash')
    @auth
    <div class="row">
        <!-- Column -->
        <div class="col-md-6 col-lg-3 col-xlg-3">
            <div class="card card-inverse card-info">
                <div class="box bg-info text-center">
                    <h1 class="font-light text-white">{{  $count['users'] }}</h1>
                    <h6 class="text-white">Users</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-3 col-xlg-3">
            <div class="card card-primary card-inverse">
                <div class="box text-center text-bg-warning">
                    <h1 class="font-light text-white">{{ $count['roles'] }}</h1>
                    <h6 class="text-white">Roles</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-3 col-xlg-3">
            <div class="card card-inverse card-success">
                <div class="box text-center text-bg-primary">
                    <h1 class="font-light text-white">{{ $count['permissions'] }}</h1>
                    <h6 class="text-white">Permissions</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-3 col-xlg-3">
            <div class="card card-inverse card-warning">
                <div class="box text-center text-bg-success">
                    <h1 class="font-light text-white">{{ $count['modules'] }}</h1>
                    <h6 class="text-white">Modules</h6>
                </div>
            </div>
        </div>
    </div>
    @endauth
    @guest
    <h1 class="welcome-text">Welcome to User Role<br>Permission Management</h1>
    @endguest
</div>
@endsection

