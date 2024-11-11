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
                            <span style="float:right;"><a href="{{route('admin.add-rate')}}" class="btn btn-outline-primary">Add Rate</a></span>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example"
                                    class="display table dataTable table-striped table-bordered layout-primary">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($rate))
                                            @php
                                                $count = 1;
                                            @endphp
                                            @foreach ($rate as $val)
                                                <tr>
                                                    <td>{{ $count }}</td>
                                                    <td><a href="{{route('admin.view-domestic-details-rate',['id'=>$val->group_id])}}" target="_blank" rel="noopener noreferrer">{{ $val->name }}</a></td>
                                                    <td>
                                                        <a style="color:red;  cursor: pointer;"
                                                            onclick="return deleteRole({{ $val->group_id }});">
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
    var callurl = "{{ route('admin.delete-fuel-group')}}";
    var view = "{{ route('admin.view-fuel-group') }}";
</script>
<script src="{{ asset('admin-assets/admin_custome_js/comancustomjs.js')}}"></script>
@endsection
