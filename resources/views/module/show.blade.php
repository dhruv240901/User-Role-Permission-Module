@extends('layouts.app')
@section('title','Module Details')
@section('content')
<div class="container-fluid">
    @include('includes.flash')
    <a href="{{ route('module-list') }}" type="button" class="btn btn-primary my-2"><i class="bi bi-arrow-left"></i></a>

    <div class="table-responsive m-t-40">
        <div id="myTable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer" style="background-color: burlywood;">
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-striped table-primary">
                          <tr>
                            <th scope="row">Module Code</th>
                            <td>{{ $module->module_code }}</td>
                          </tr>
                          <tr>
                            <th scope="row">Module Name</th>
                            <td>{{ $module->name }}</td>
                          </tr>
                          <tr>
                            <th scope="row">Status</th>
                            <td>
                                @if($module->is_active==1)
                                    Active
                                @else
                                    Inactive
                                @endif
                            </td>
                          </tr>
                          <tr>
                            <th scope="row">is_in_menu</th>
                            <td>
                                @if($module->is_in_menu==1)
                                    Yes
                                @else
                                    No
                                @endif
                            </td>
                          </tr>
                          <tr>
                            <th scope="row">Display Order</th>
                            <td>{{ $module->display_order }}</td>
                          </tr>
                          <tr>
                            <th scope="row">Parent Module</th>
                            @if($module->parent_id!=null)
                                <td>{{ $module->parent->name }}</td>
                            @else
                                <td>No Parent Module Found</td>
                            @endif
                          </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Right sidebar -->
    <!-- ============================================================== -->
</div>
@endsection


