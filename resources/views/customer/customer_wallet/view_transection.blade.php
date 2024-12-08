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
                                    <form action="{{ route('app.view-wallet-transaction')}}" method="get">
                                        @csrf
                                        <div class="form-row">  
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Refrance No</label>
                                                <input type="text" name="reference_no" class="form-control rounded" id="reference_no" placeholder="Refrance No" value="{{!empty($_GET['reference_no'])?$_GET['reference_no']:''}}">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="inputEmail4">From Date</label>
                                                <input type="date" name="from_date" class="form-control rounded" id="from_date" value="{{!empty($_GET['from_date'])?$_GET['from_date']: date('Y-m-d') }}" placeholder="Refrance No">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="inputEmail4">To Date</label>
                                                <input type="date" name="to_date" class="form-control rounded" id="to_date" value="{{!empty($_GET['to_date'])?$_GET['to_date']: date('Y-m-d') }}" placeholder="Refrance No">
                                            </div>
                                            <div class="form-group col-md-2">
                                            <button type="submit" class="btn btn-outline-primary mt-4"><i class="fa fa-search" aria-hidden="true"></i></button>
                                            <a href="{{route('app.view-wallet-transaction')}}" class="btn btn-outline-danger mt-4"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            <div class="table-responsive">
                                <table id="example"
                                    class="display table dataTable table-striped table-bordered layout-primary">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Customer Name</th>
                                            <th>Payment Type</th>
                                            <th>Refrance No</th>
                                            <th>Description</th>
                                            <th>Transection Amount</th>
                                            <th>Balance Amount</th>
                                            <th>Transection Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($transection))
                                            @php
                                                $count = 1;
                                            @endphp
                                            @foreach ($transection as $val)
                                                <tr>
                                                    <td>{{ $count }}</td>
                                                    <td>@php
                                                      $cus = DB::table('tbl_customers')->where(['id'=>$val->customer_id])->first();@endphp
                                                      {{$cus->personal_name.' '.$cus->surname}}
                                                    </td>
                                                    <td>{{ walletType()[$val->transaction_type] }}</td>
                                                    <td>{{ $val->reference_no }}</td>
                                                    <td>{{ $val->description }}</td>
                                                    <td>{{ $val->amount }}</td>
                                                    <td>{{ $val->balance_amount }}</td>
                                                    <td>{{ date('d-m-y',strtotime($val->date)) }}</td>
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
