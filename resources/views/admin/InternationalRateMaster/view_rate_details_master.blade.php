@extends('admin.layout.admin_header')
@section('content')
<main>
    <div class="container-fluid site-width">
        <!-- START: Card Data-->
        <div class="row">
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-header  justify-content-between align-items-center">
                        <h4 class="card-title">{{ $title }}</h4> <br>
                        <h4 class="card-title">@php
                         $group = DB::table('tbl_international_rate_group')->where(['id'=>$ratedetails[0]->rate_group_id])->first();
                         $courier = DB::table('tbl_courier_company')->where(['id'=>$ratedetails[0]->courier_company])->first();
                        @endphp
                         {{'Group: '.$group->name}} |
                         {{'Courier: '.$courier->company_name}}
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example"
                                class="display table dataTable table-striped table-bordered layout-primary">
                                <thead>
                                    <tr>
                                        @if (!empty($header))
                                        @php $table_header=array() @endphp
                                        @foreach ($header as $key=>$val)
                                        @php $table_header[] = $val->zone_id; @endphp
                                        @endforeach
                                        @endif
                                        <th>SR No</th>
                                        <th>Export/Import</th>
                                        <th>Doc/Non Doc</th>
                                        <th>Rate Type</th>
                                        <th>Weight Range</th>
                                        @for ($th=0;$th < count($table_header);$th++)
                                            <th>{{$table_header[$th]}}</th>
                                            @endfor

                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($ratedetails))
                                    @php
                                    $count = 1;
                                    @endphp
                                    @foreach ($ratedetails as $val)
                                    <tr>
                                        <td>{{$count}}</td>
                                        <td>{{ internationalType()[$val->type_export_import] }}</td>
                                        <td>{{ docType()[$val->doc_type] }}</td>
                                        <td>@if ($val->fixed_perkg == 0)
                                            {{'Fixed'}}
                                            @else
                                            {{'Fixed'}}
                                            @endif
                                        </td>
                                        <td>{{ $val->from_weight.' - '.$val->to_weight }}
                                        </td>
                                        @php
                                          $rate = DB::table('tbl_international_rate')->where([['mfd', '=', 0],
                                                ['courier_company', '=', $val->courier_company],
                                                ['type_export_import', '=', $val->type_export_import],
                                                ['doc_type', '=', $val->doc_type],
                                                ['rate_group_id', '=', $val->rate_group_id],
                                                ['from_weight', '>=', $val->from_weight],
                                                ['to_weight', '<=', $val->to_weight],
                                                ['from_date', '=', $val->from_date]
                                            ])->get();
                                        @endphp
                                       @foreach ($rate as $key=>$val )
                                           <td>{{$val->rate}}</td>                                       
                                       @endforeach
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
    var callurl = "{{ route('admin.delete-inet-rate-group')}}";
    var view = "{{ route('admin.view-inet-rate-group') }}";
    var statusurl = "{{route('admin.status-inet-rate-group')}}";
</script>
<script src="{{ asset('admin-assets/admin_custome_js/comancustomjs.js')}}"></script>
@endsection