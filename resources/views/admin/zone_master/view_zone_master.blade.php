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
                            <span style="float:right;"><a href="{{route('admin.add-zone')}}" class="btn btn-outline-primary">Add Zone</a></span>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example"
                                    class="display table dataTable table-striped table-bordered layout-primary">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Name</th>
                                            <th>Courier</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($zone))
                                            @php
                                                $count = 1;
                                            @endphp
                                            @foreach ($zone as $val)
                                                <tr>
                                                    <td>{{ $count }}</td>
                                                    <td><a href="{{ route('admin.view-zone',['id'=>$val->id])}}" target="_blank">{{ $val->zone_name }}</a></td>
                                                    <td>{{ $val->company_name }}</td>
                                                    <td>{{ $val->description }}</td>
                                                    <td>@if ($val->status == 0)
                                                        {{'Active'}}
                                                    @else
                                                        {{'In Active'}}
                                                    @endif</td>
                                                    <td> <a style="color:blue"
                                                            href="{{ route('admin.edit-zone', ['id' => $val->id]) }}">
                                                            <i class="fas fa-pencil-alt">
                                                            </i>
                                                        </a>|
                                                        <input type="checkbox" 
                                                        @if ($val->status == '0') 
                                                            {{ 'checked' }} 
                                                        @endif 
                                                        data-toggle="toggle" 
                                                        id="activestatus_{{ $val->id }}" 
                                                        value="1" 
                                                        data-size="xs" 
                                                        onchange="ActiveStatus({{ $val->id }})"> 
                                                        {{-- |
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
    var callurl = "{{ route('admin.delete-zone')}}";
    var view = "{{ route('admin.view-zone-master') }}";
    var statusurl = "{{route('admin.status-zone')}}";
</script>
<script src="{{ asset('admin-assets/admin_custome_js/comancustomjs.js')}}"></script>
@endsection
