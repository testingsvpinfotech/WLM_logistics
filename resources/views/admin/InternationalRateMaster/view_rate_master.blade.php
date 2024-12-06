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
                            <span style="float:right;"><a href="{{route('admin.view-add-rate-master')}}" class="btn btn-outline-primary">Add Rate</a></span>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example"
                                    class="display table dataTable table-striped table-bordered layout-primary">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Group Name</th>
                                            <th>COURIER Name</th>
                                            <th>Type</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($rateMaster))
                                            @php
                                                $count = 1;
                                            @endphp
                                            @foreach ($rateMaster as $val)
                                                <tr>
                                                    <td>{{ $count }}</td>
                                                    <td>{{ $val->name}}</a></td>
                                                    <td><a href="{{route('admin.view-intRate-details',['id1'=>$val->courier_company,'id2'=>$val->type,'id3'=>$val->id,'id4'=>$val->date])}}" target="_blank" style="color:blue;">{{ $val->company_name }}</a></td>
                                                    <td>{{ internationalType()[$val->type] }}</td>
                                                    <td>{{ date('d-m-Y',strtotime($val->date)) }}</td>
                                                    <td>
                                                        @if ($val->mfd=='0')
                                                            {{'Active'}}                                                            
                                                        @else
                                                           {{'In Active'}}    
                                                        @endif
                                                    </td>
                                                    <td>                                                        
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
    var callurl = "{{ route('admin.rate-destryment')}}";
    var view = "{{ route('admin.view-international-rate') }}";
</script>
<script src="{{ asset('admin-assets/admin_custome_js/comancustomjs.js')}}"></script>
@endsection
