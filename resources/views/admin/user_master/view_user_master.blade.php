@extends('admin.layout.admin_header')
@section('content')
    <main>
        <div class="container-fluid site-width">
            <!-- START: Card Data-->
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header  justify-content-between align-items-center">
                            <h4 class="card-title">{{ $title }}</h4>
                            <span style="float:right;"><a href="{{ route('admin.add-user') }}"
                                    class="btn btn-outline-primary">Add User</a></span>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example"
                                    class="display table dataTable table-striped table-bordered layout-primary">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Username</th>
                                            <th>User Full Name</th>
                                            <th>UserType</th>
                                            <th>Contact No</th>
                                            <th>Altr Contact No</th>
                                            <th>Email Id</th>
                                            <th>Branch Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($users))
                                            @php
                                                $count = 1;
                                            @endphp
                                            @foreach ($users as $val)
                                                <tr>
                                                    <td>{{ $count }}</td>
                                                    <td>{{ $val->username }}</td>
                                                    <td>{{ $val->user_name }}</td>
                                                    <td>{{ $val->usertype }}</td>
                                                    <td>{{ $val->contact_no }}</td>
                                                    <td>{{ $val->alternate_contact_no }}</td>
                                                    <td>{{ $val->email }}</td>
                                                    <td>{{ $val->branch_name }}</td>
                                                    <td> <a style="color:blue"
                                                            href="{{ route('admin.edit-user', ['id' => $val->id]) }}">
                                                            <i class="fas fa-pencil-alt">
                                                            </i>
                                                        </a> |
                                                        <a style="color:red;  cursor: pointer;"
                                                            onclick="return deleteRole({{ $val->id }});">
                                                            <i class="fas fa-trash">
                                                            </i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @php $count++ @endphp
                                            @endforeach
                                        @else
                                            <tr style="color:red">DATA NOT FOUND</tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- END: Card DATA-->
        </div>
    </main>
@endsection
@section('script')
    <script>
        var callurl = "{{ route('admin.delete-user') }}";
        var view = "{{ route('admin.view-user-master') }}";
    </script>
    <script src="{{ asset('admin-assets/admin_custome_js/comancustomjs.js') }}"></script>
@endsection
