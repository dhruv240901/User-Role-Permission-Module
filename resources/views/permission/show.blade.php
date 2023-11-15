@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        @include('includes.flash')
        <div class="table-responsive m-t-40">
            <div id="myTable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer"
                style="background-color: burlywood;">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-striped table-primary">
                            <tr>
                                <th scope="row">Name</th>
                                <td>{{ $permission->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Description</th>
                                <td>{{ $permission->description }}</td>
                            </tr>
                            <tr>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Module Name</th>
                                            <th scope="col">All</th>
                                            <th scope="col">Add</th>
                                            <th scope="col">View</th>
                                            <th scope="col">Modify</th>
                                            <th scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($permissions as $k => $permission)
                                            @foreach ($role->permissions as $k => $rolepermission)
                                                @if ($permission->id == $rolepermission->id)
                                                    <option value="{{ $permission->id }}" selected>{{ $permission->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                                @endif
                                            @endforeach
                                        @endforeach --}}
                                        @foreach ($modules as $k => $module)
                                            @if (count($permission->modules) > 0)
                                                @for ($i = 0; $i < count($permissionmodules); $i++)
                                                    @if ($module->id == $permissionmodules[$i]->id)
                                                        <tr>
                                                            <th scope="row">{{ $module->name }}</th>
                                                            @if ($permissionmodules[$i]->add_access == '1')
                                                                <td><i class="bi bi-check2"></td>
                                                            @else
                                                                <td><i class="bi bi-x-lg"></td>
                                                            @endif
                                                            <td><i class="bi bi-check2"></td>
                                                            <td><i class="bi bi-check2"></td>
                                                            <td><i class="bi bi-check2"></td>
                                                            <td><i class="bi bi-check2"></td>
                                                        </tr>
                                                    @else
                                                        <tr>
                                                            <th scope="row">{{ $module->name }}</th>
                                                            <td><i class="bi bi-x-lg"></td>
                                                            <td><i class="bi bi-x-lg"></td>
                                                            <td><i class="bi bi-x-lg"></td>
                                                            <td><i class="bi bi-x-lg"></td>
                                                            <td><i class="bi bi-x-lg"></td>
                                                        </tr>
                                                    @endif
                                                @endfor
                                                {{-- @foreach ($permission->modules as $k => $permissionmodule)
                                                    @if ($module->id == $permissionmodule->id)

                                                    @endif
                                                @endforeach --}}
                                            @else
                                                <tr>
                                                    <th scope="row">{{ $module->name }}</th>
                                                    <td><i class="bi bi-x-lg"></td>
                                                    <td><i class="bi bi-x-lg"></td>
                                                    <td><i class="bi bi-x-lg"></td>
                                                    <td><i class="bi bi-x-lg"></td>
                                                    <td><i class="bi bi-x-lg"></td>
                                                </tr>
                                            @endif
                                            {{-- @foreach ($permissionmodules as $permissionmodule)
                                                    @if ($permissionmodule->module_id == $module->id)
                                                        <td>
                                                            <i class="bi bi-x-lg"></i>
                                                        </td>
                                                        @if ($permissionmodule->add_access = '1')
                                                            <td>
                                                                <i class="bi bi-check2"></i>
                                                            </td>
                                                        @else
                                                            <td>
                                                                <i class="bi bi-x-lg"></i>
                                                            </td>
                                                        @endif
                                                        @if ($permissionmodule->view_access = '1')
                                                            <td>
                                                                <i class="bi bi-check2"></i>
                                                            </td>
                                                        @else
                                                            <td>
                                                                <i class="bi bi-x-lg"></i>
                                                            </td>
                                                        @endif
                                                        @if ($permissionmodule->edit_access = '1')
                                                            <td>
                                                                <i class="bi bi-check2"></i>
                                                            </td>
                                                        @else
                                                            <td>
                                                                <i class="bi bi-x-lg"></i>
                                                            </td>
                                                        @endif
                                                        @if ($permissionmodule->delete_access = '1')
                                                            <td>
                                                                <i class="bi bi-check2"></i>
                                                            </td>
                                                        @else
                                                            <td>
                                                                <i class="bi bi-x-lg"></i>
                                                            </td>
                                                        @endif --}}
                                            {{-- <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="add" id="flexCheckIndeterminate"
                                                                    name="{{ $module->name }}[]">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="view" id="flexCheckIndeterminate"
                                                                    name="{{ $module->name }}[]">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="modify" id="flexCheckIndeterminate"
                                                                    name="{{ $module->name }}[]">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="delete" id="flexCheckIndeterminate"
                                                                    name="{{ $module->name }}[]">
                                                            </div>
                                                        </td> --}}
                                            {{-- @else
                                                        <td>
                                                            <i class="bi bi-x-lg"></i>
                                                        </td>
                                                        <td>
                                                            <i class="bi bi-x-lg"></i>
                                                        </td>
                                                        <td>
                                                            <i class="bi bi-x-lg"></i>
                                                        </td>
                                                        <td>
                                                            <i class="bi bi-x-lg"></i>
                                                        </td>
                                                        <td>
                                                            <i class="bi bi-x-lg"></i>
                                                        </td>
                                                    @endif --}}
                                            {{-- @endforeach --}}
                                            {{-- </tr> --}}
                                        @endforeach
                                    </tbody>
                                </table>
                            </tr>
                            {{-- <tr>
                            <th scope="row">Permissions</th>
                            <td>
                                @foreach ($role->permissions as $k => $permission)
                                    {{ $permission->name }},
                                @endforeach
                            </td>
                          </tr> --}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="right-sidebar">
            <div class="slimscrollright">
                <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
                <div class="r-panel-body">
                    <ul id="themecolors" class="mt-3">
                        <li><b>With Light sidebar</b></li>
                        <li><a href="javascript:void(0)" data-theme="default" class="default-theme">1</a>
                        </li>
                        <li><a href="javascript:void(0)" data-theme="green" class="green-theme">2</a></li>
                        <li><a href="javascript:void(0)" data-theme="red" class="red-theme">3</a></li>
                        <li><a href="javascript:void(0)" data-theme="blue" class="blue-theme working">4</a>
                        </li>
                        <li><a href="javascript:void(0)" data-theme="purple" class="purple-theme">5</a></li>
                        <li><a href="javascript:void(0)" data-theme="megna" class="megna-theme">6</a></li>
                        <li class="d-block mt-4"><b>With Dark sidebar</b></li>
                        <li><a href="javascript:void(0)" data-theme="default-dark" class="default-dark-theme">7</a></li>
                        <li><a href="javascript:void(0)" data-theme="green-dark" class="green-dark-theme">8</a></li>
                        <li><a href="javascript:void(0)" data-theme="red-dark" class="red-dark-theme">9</a>
                        </li>
                        <li><a href="javascript:void(0)" data-theme="blue-dark" class="blue-dark-theme">10</a></li>
                        <li><a href="javascript:void(0)" data-theme="purple-dark" class="purple-dark-theme">11</a></li>
                        <li><a href="javascript:void(0)" data-theme="megna-dark" class="megna-dark-theme ">12</a></li>
                    </ul>
                    <ul class="mt-3 chatonline">
                        <li><b>Chat option</b></li>
                        <li>
                            <a href="javascript:void(0)"><img src="../assets/images/users/1.jpg" alt="user-img"
                                    class="img-circle"> <span>Varun Dhavan <small
                                        class="text-success">online</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="../assets/images/users/2.jpg" alt="user-img"
                                    class="img-circle"> <span>Genelia Deshmukh <small
                                        class="text-warning">Away</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="../assets/images/users/3.jpg" alt="user-img"
                                    class="img-circle"> <span>Ritesh Deshmukh <small
                                        class="text-danger">Busy</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="../assets/images/users/4.jpg" alt="user-img"
                                    class="img-circle"> <span>Arijit Sinh <small
                                        class="text-muted">Offline</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="../assets/images/users/5.jpg" alt="user-img"
                                    class="img-circle"> <span>Govinda Star <small
                                        class="text-success">online</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="../assets/images/users/6.jpg" alt="user-img"
                                    class="img-circle"> <span>John Abraham<small
                                        class="text-success">online</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="../assets/images/users/7.jpg" alt="user-img"
                                    class="img-circle"> <span>Hritik Roshan<small
                                        class="text-success">online</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="../assets/images/users/8.jpg" alt="user-img"
                                    class="img-circle"> <span>Pwandeep rajan <small
                                        class="text-success">online</small></span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
    </div>
@endsection
