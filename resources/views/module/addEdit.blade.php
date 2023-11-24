@extends('layouts.app')
@section('title','Add Module')
@section('content')
    <div class="container-fluid">
        @include('includes.flash')
        <a href="{{ route('module-list') }}" type="button" class="btn btn-primary my-2"><i class="bi bi-arrow-left"></i></a>

        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline-info">
                    <div class="card-body">
                        @if (isset($module) || $module != null)
                            <form action="{{ route('update-module',$module->id) }}" method="POST" id="moduleform">
                            @method('PUT')
                        @else
                            <form action="{{ route('store-module') }}" method="POST" id="moduleform">
                        @endif
                            @csrf
                            <div class="form-body">
                                @if (isset($module) || $module != null)
                                    <h3 class="card-title">Edit Module</h3>
                                @else
                                    <h3 class="card-title">Add Module</h3>
                                @endif
                                <hr>
                                <div class="row pt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Module Code <sup class="required_field">*</sup></label>
                                            <input type="text" id="firstName" class="form-control"
                                                placeholder="Enter module code" name="moduleCode" value="{{ $module->module_code ?? old('moduleCode') }}">
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Module Name <sup class="required_field">*</sup></label>
                                            <input type="text" id="lastName" class="form-control"
                                                placeholder="Enter module name" name="moduleName" value="{{ $module->name ?? old('moduleName') }}">
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">is_in_menu</label>
                                            <select class="js-example-basic-multiple form-control" name="is_in_menu">
                                                <option value="1" @if( isset($module) && $module->is_in_menu==1) selected @endif>Yes</option>
                                                <option value="0" @if( isset($module) && $module->is_in_menu==0) selected @endif>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Display Order</label>
                                            <input type="number" id="email" class="form-control" name="display_order" min="1" max="10" value="{{ $module->display_order ?? old('display_order') }}">
                                        </div>
                                    </div>
                                    <!--/span-->
                                    {{-- <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Select Parent Module</label>
                                            <select class="js-example-basic-multiple form-control" name="roles[]" multiple="multiple">
                                                @foreach ($modules as $module)
                                                    <option value="{{ $module->id }}">{{ $module->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div> --}}

                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Select Parent Module</label>
                                            <select class="js-example-basic-multiple form-control" name="parentModule">
                                                <option value="null">No Parent Module</option>
                                                @foreach ($Modules as $value)
                                                    <option value="{{ $value->id }}" @if(isset($module) && $module->parent_id==$value->id) selected @endif>{{ $value->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
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
