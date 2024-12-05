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
                            <span style="float:right;"><a href="{{route('admin.view-add-zone')}}" class="btn btn-outline-primary">Add Zone</a></span>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example"
                                    class="display table dataTable table-striped table-bordered layout-primary">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($zoneMaster))
                                            @php
                                                $count = 1;
                                            @endphp
                                            @foreach ($zoneMaster as $val)
                                                <tr>
                                                    <td>{{ $count }}</td>
                                                    <td><a href="{{route('admin.view-zone-details',['id1'=>$val->courier_id,'id2'=>$val->type])}}">{{ $val->company_name }}</a></td>
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
                                                        <input type="checkbox" 
                                                        @if ($val->mfd == '0') 
                                                            {{ 'checked' }} 
                                                        @endif 
                                                        data-toggle="toggle" 
                                                        id="activestatus_{{ $val->courier_id }}" 
                                                        value="1" 
                                                        data-size="xs" 
                                                        onchange="ActiveStatusZone({{ $val->courier_id }},{{$val->type}})">
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
    // var callurl = "{{ route('admin.delete-inet-rate-group')}}";
    var view = "{{ route('admin.view-zone-master') }}";
    var statusurl = "{{route('admin.zone-destryment')}}";
</script>
<script src="{{ asset('admin-assets/admin_custome_js/comancustomjs.js')}}"></script>
@endsection
