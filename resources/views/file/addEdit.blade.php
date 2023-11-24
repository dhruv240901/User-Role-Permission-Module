@extends('layouts.app')
@section('title', 'Add User')
@section('content')
    <div class="container-fluid">
        @include('includes.flash')

        <a href="{{ route('file-list') }}" type="button" class="btn btn-primary my-2"><i class="bi bi-arrow-left"></i></a>

        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline-info">
                    <div class="card-body">
                        @if (isset($file) || $file != null)
                            <form action="{{ route('update-file',$file->id) }}" method="POST" id="userform">
                                @method('PUT')
                        @else
                            <form action="{{ route('store-file') }}" method="POST" id="userform">
                        @endif
                            @csrf
                            <div class="form-body">
                                @if (isset($file) || $file != null)
                                    <h3 class="card-title">Edit File</h3>
                                @else
                                    <h3 class="card-title">Add File</h3>
                                @endif
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Name <sup class="required_field">*</sup></label>
                                            <input type="text" id="firstName" class="form-control"
                                                placeholder="Enter Name" name="name" value="{{ $file->name ?? old('name') }}">
                                        </div>
                                    </div>

                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Description <sup class="required_field">*</sup></label>
                                            <input type="text" id="description" class="form-control"
                                                placeholder="Enter description" name="description" value="{{ $file->description ?? old('description') }}" >
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
