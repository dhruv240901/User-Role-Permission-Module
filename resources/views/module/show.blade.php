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
                            <td>{{ $Module->module_code }}</td>
                          </tr>
                          <tr>
                            <th scope="row">Module Name</th>
                            <td>{{ $Module->name }}</td>
                          </tr>
                          <tr>
                            <th scope="row">Status</th>
                            <td>
                                @if($Module->is_active==true)
                                    Active
                                @else
                                    Inactive
                                @endif
                            </td>
                          </tr>
                          <tr>
                            <th scope="row">is_in_menu</th>
                            <td>
                                @if($Module->is_in_menu==true)
                                    Yes
                                @else
                                    No
                                @endif
                            </td>
                          </tr>
                          <tr>
                            <th scope="row">Display Order</th>
                            <td>{{ $Module->display_order }}</td>
                          </tr>
                          <tr>
                            <th scope="row">Parent Module</th>
                            @if($Module->parent_id!=null)
                                <td>{{ $Module->parent->name }}</td>
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


