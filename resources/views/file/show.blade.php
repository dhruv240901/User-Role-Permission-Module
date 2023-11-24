@extends('layouts.app')
@section('title','Module Details')
@section('content')
<div class="container-fluid">
    @include('includes.flash')
    <a href="{{ route('file-list') }}" type="button" class="btn btn-primary my-2"><i class="bi bi-arrow-left"></i></a>

    <div class="table-responsive m-t-40">
        <div id="myTable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer" style="background-color: burlywood;">
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-striped table-primary">
                          <tr>
                            <th scope="row">Name</th>
                            <td>{{ $file->name }}</td>
                          </tr>
                          <tr>
                            <th scope="row">Description</th>
                            <td>{{ $file->description }}</td>
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


