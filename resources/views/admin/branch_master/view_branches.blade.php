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
                            <span style="float:right;"><a href="{{ route('admin.add-branch') }}"
                                    class="btn btn-outline-primary">Add Branch</a></span>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example"
                                    class="display table dataTable table-striped table-bordered layout-primary">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Branch Id</th>
                                            <th>Branch Name</th>
                                            <th>Branch Manager</th>
                                            <th>Contact No</th>
                                            <th>Altr Contact No</th>
                                            <th>Email Id</th>
                                            <th>Pan Card No</th>
                                            <th>GST No</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($branches))
                                            @php
                                                $count = 1;
                                            @endphp
                                            @foreach ($branches as $val)
                                                <tr>
                                                    <td>{{ $count }}</td>
                                                    <td>{{ $val->branch_id }}</td>
                                                    <td>{{ $val->branch_name }}</td>
                                                    <td>{{ $val->branch_head_name }}</td>
                                                    <td>{{ $val->contact_no }}</td>
                                                    <td>{{ $val->alternate_contact_no }}</td>
                                                    <td>{{ $val->email }}</td>
                                                    <td>{{ $val->pan_no }}</td>
                                                    <td>{{ $val->gst_no }}</td>
                                                    <td> 
                                                        {{-- <a style="color:blue"
                                                            href="{{ route('admin.edit-branch', ['id' => $val->id]) }}">
                                                            <i class="fas fa-pencil-alt">
                                                            </i>
                                                        </a> |
                                                        <a style="color:red;  cursor: pointer;"
                                                            onclick="return deleteRole({{ $val->id }});">
                                                            <i class="fas fa-trash">
                                                            </i>
                                                        </a> --}}
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
