@extends('layouts.app')
@section('title', 'User Profile')
@section('content')
    <div class="container-fluid">
        @include('includes.flash')
        <div class="table-responsive m-t-40">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" colspan="2">User Profile</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">First Name</th>
                        <td>{{ auth()->user()->first_name }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Last Name</th>
                        <td>{{ auth()->user()->last_name }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Email</th>
                        <td>{{ auth()->user()->email }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Type</th>
                        <td>{{ auth()->user()->type }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
    </div>
@endsection
