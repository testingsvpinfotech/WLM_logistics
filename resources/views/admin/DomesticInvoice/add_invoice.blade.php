@extends('admin.layout.admin_header')
@section('content')
<main>
    <div class="container-fluid site-width">
        <!-- START: Card Data-->
        <div class="row">
            <div class="col-12 mt-4">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">{{ $title }}</h6>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <form action="{{route('admin.invoice-create')}}" method="GET">
                                        <div class="box-body">
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <label for="ac_name" class="col-form-label">Customer Name</label>
                                                    @csrf
                                                    <select name="customer_id" class="form-control" id="customer_id"
                                                        required>
                                                        <option value="">-- Select Customer --</option>
                                                        @foreach ($customer as $key => $val)
                                                        <option value="{{ $val->id }}"> {{ $val->Customer_Code.' -- '.$val->personal_name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    <p style="color: red;"></p>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label for="ac_name" class="col-form-label">Date Cycle</label>
                                                    <select class="form-control" required name="date_cycle" id="date_cycle">
                                                        @php
                                                        $currentDay = (int)date('d');
                                                        @endphp
                                                        @if($currentDay >= 1 && $currentDay <= 10)
                                                            <option value="2">Cycle 2</option>
                                                            @elseif($currentDay >= 16 && $currentDay <= 25)
                                                                <option value="1">Cycle 1</option>
                                                                @else
                                                                <option value="">No cycle set for today.</option>
                                                                @endif
                                                    </select>
                                                    @if($currentDay >= 1 && $currentDay <= 10)
                                                        <p style="color: green;">{{date('16-M-Y').' to '.date('t-M-Y');}}</p>
                                                        <input type="hidden" name="time_period" id="time_period" value="{{date('16-M-Y').' to '.date('t-M-Y');}}">
                                                        @elseif($currentDay >= 16 && $currentDay <= 25)
                                                            <p style="color: green;">{{date('01-M-Y').' to '.date('15-M-Y');}}</p>
                                                            <input type="hidden" name="time_period" id="time_period" value="{{date('01-M-Y').' to '.date('15-M-Y');}}">
                                                            @else
                                                            <p style="color: red;">No cycle set for today.</p>
                                                            @endif
                                                            <p style="color: red;"></p>
                                                </div>
                                                @if(empty($invoiceData))
                                                <div class="col-sm-3 pt-1">
                                                    <br>
                                                    <button type="submit" class="btn btn-outline-primary mt-2"><i class="fa fa-search" aria-hidden="true"></i></button>
                                                    <a href="{{route('admin.invoice-create')}}" class="btn btn-outline-danger mt-2"><i class="fa fa-refresh"></i></a>
                                                </div>
                                                @endif
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                    </form>
                                </div>
                                <div class="col-lg-12">
                                    @if(!empty($invoiceData))
                                    <form action="">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th><input type="checkbox" checked></th>
                                                    <th>Order Date</th>
                                                    <th>Order Id</th>
                                                    <th>Airway Bill</th>
                                                    <th>Buyers Name</th>
                                                    <th>Pay Mode</th>
                                                    <th>Weight</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($invoiceData as $key=>$val)
                                                <tr>
                                                    <td><input type="checkbox" class="checkeacc" checked value="{{$val->order_id.'_'.$val->id}}"></td>
                                                    <td>{{date('d-m-Y',strtotime($val->orderDate))}}</td>
                                                    <td>{{$val->order_id}}</td>
                                                    <td>{{$val->forwording_no}}</td>
                                                    <td>{{$val->buy_full_name}}</td>
                                                    <td>{{$val->paymentMode}}</td>
                                                    <td>{{$val->dead_weight}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <button type="submit" style="float:right;" class="btn btn-outline-primary">Submit</button>
                                    </form>
                                    @endif
                                </div>
                            </div>
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
    var view = "{{ route('admin.view-domestic-rate') }}";
    var callurl = "{{ route('admin.stor-rate') }}";
</script>
<script src="{{ asset('admin-assets/admin_custome_js/domestic_rate_master/add_rate.js')}}"></script>
<script src="{{ asset('admin-assets/admin_custome_js/courier_company/add_courier_company.js') }}"></script>
@endsection