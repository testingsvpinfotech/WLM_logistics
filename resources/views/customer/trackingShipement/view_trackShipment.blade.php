@extends('customer.layout.admin_header')
@section('content')
    <main>
        <div class="container-fluid site-width">
            <!-- START: Card Data-->
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header  justify-content-between align-items-center">
                            <h4 class="card-title">{{ $title }}</h4>
                        </div>
                        <div class="card-body">
                        <div class="col-12">
                                    <form action="{{ route('app.tracking-shipment')}}" method="get">
                                        @csrf
                                        <div class="form-row">  
                                        <div class="form-group col-md-3">
                                                <label for="inputEmail4">Shipment Type</label>
                                                <select name="shipment_type" class="form-control rounded" id="shipment_type">
                                                    <option value="1" @if (!empty($_GET['shipment_type']))
                                                    {{($_GET['shipment_type'] == 1)?'selected':''}}
                                                    @endif 
                                                    >Domestic</option>
                                                    <option value="2"  @if (!empty($_GET['shipment_type']))
                                                    {{($_GET['shipment_type'] == 2)?'selected':''}}
                                                    @endif  >International</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Order No | Airwaybill No</label>
                                                <input type="text" name="reference_no" class="form-control rounded" id="reference_no" placeholder="Order No | Airwaybill No" value="{{!empty($_GET['reference_no'])?$_GET['reference_no']:''}}">
                                            </div>
                                            <div class="form-group col-md-2">
                                            <button type="submit" class="btn btn-outline-primary mt-4"><i class="fa fa-search" aria-hidden="true"></i></button>
                                            <a href="{{route('app.tracking-shipment')}}" class="btn btn-outline-danger mt-4"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            <div class="table-responsive">
                                <h5>Booking Details</h5>
                                <table 
                                    class="display table dataTable table-striped table-bordered layout-primary">
                                    <thead>
                                        <tr>
                                            <th>Booking Date</th>
                                            <th>Order No</th>
                                            <th>Airwaybill No</th>
                                            <th>Payment Mode</th>
                                            <th>Weight</th>
                                            <th>Amount</th>
                                            <th>Dimention Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($domesticShipment))
                                            @php
                                                $count = 1;
                                            @endphp
                                            @foreach ($domesticShipment as $val)
                                                <tr>
                                                    <td>{{ date('d-m-Y',strtotime($val->orderDate)) }}</td>
                                                    <td>{{ $val->order_id }}</td>
                                                    <td>{{ $val->forwording_no }}</td>
                                                    <td>{{ $val->paymentMode }}</td>
                                                    <td>{{ $val->applicable_weight }}</td>
                                                    <td>{{ $val->order_total }}</td>
                                                    <td>{{ 'L '.$val->length.' X B '.$val->breath.' X H '.$val->height }}</td>
                                                </tr>
                                                @php $count++ @endphp
                                            @endforeach
                                        @else
                                            <tr style="color:red"><td colspan="10">DATA NOT FOUND</td></tr>
                                        @endif
                                    </tbody>
                                </table>
                                <br>
                                <h5>Tracking Details</h5>
                                <table 
                                    class="display table dataTable table-striped table-bordered layout-primary">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Order No</th>
                                            <th>Location</th>
                                            <th>Status</th>
                                            <th>Commet</th>
                                            <th>Remark</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($track))
                                            @php
                                                $count = 1;
                                            @endphp
                                            @foreach ($track as $val)
                                                <tr>
                                                    <td>{{ date('d-m-Y',strtotime($val->dateTime)) }}</td>
                                                    <td>{{ $val->order_id }}</td>
                                                    <td>{{ $val->location }}</td>
                                                    <td>{{ $val->status }}</td>
                                                    <td>{{ $val->comment }}</td>
                                                    <td>{{ $val->remark }}</td>
                                                </tr>
                                                @php $count++ @endphp
                                            @endforeach
                                        @else
                                            <tr style="color:red"><td colspan="10">DATA NOT FOUND</td></tr>
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
    var callurl = "{{ route('admin.destroy-usertypes')}}";
    var view = "{{ route('admin.view-usertypes') }}";
</script>
<script src="{{ asset('admin-assets/admin_custome_js/comancustomjs.js')}}"></script>
@endsection
