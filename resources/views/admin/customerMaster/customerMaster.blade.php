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
                        <span style="float:right;"></span>
                    </div>
                    <div class="m-4">
                        <!-- Filter Buttons -->
                        <form action="{{route('admin.view-customer-master')}}" method="get">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Search Data</label>
                                    <input type="text" name="search" id="search" class="form-control buttonCall" placeholder="Customer Code | Customer Name | Company Name | Email ...." value="{{ !empty($_GET['search'])?$_GET['search']:'';}}">
                                </div>
                                <div class="col-md-2">
                                 <label for="">From Date</label>
                                    <input type="date" name="from_date" id="from_date" class="form-control buttonCall" value="{{ !empty($_GET['from_date'])?$_GET['from_date']:'';}}">
                                </div>
                                <div class="col-md-2">
                                    <label for="">To Date</label>
                                    <input type="date" name="to_date" id="to_date" class="form-control buttonCall" value="{{ !empty($_GET['to_date'])?$_GET['to_date']:'';}}">
                                </div>

                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-outline-primary mt-4"><i class="fa fa-search" aria-hidden="true"></i></button>
                                    <button type="submit" class="btn btn-outline-success mt-4" name="Excel" value="download-excel"><i class="fa fa-download" aria-hidden="true"></i></button>
                                    <a href="{{route('admin.view-customer-master')}}" class="btn btn-outline-danger mt-4"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </form>
                        <br>
                        <!-- Table -->
                        <div class="table-responsive table-scroll">
                            <table class="table table-bordered align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>SR No</th>
                                        <th>Account Code</th>
                                        <th>Personal Name</th>
                                        <th>Surname Name</th>
                                        <th>Compnay Name</th>
                                        <th>Email</th>
                                        <th>Mobile No</th>
                                        <th>Wallet Amount</th>
                                        <th>Pincode</th>
                                        <th>Order Types</th>
                                        <th>Bank Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($orders->isNotEmpty())
                                    @php
                                    $count = 1;
                                    @endphp
                                    @foreach ($orders as $key => $val)
                                    <tr>
                                        <td>{{$currentPage}}</td>
                                        <td>{{$val->Customer_Code}}</td>
                                        <td>{{$val->personal_name}}</td>
                                        <td>{{$val->surname}}</td>
                                        <td>{{$val->company_name}}</td>
                                        <td>{{$val->email}}</td>
                                        <td>{{$val->mobile_number}}</td>
                                        <td>{{$val->wallet_amount}}</td>
                                        <td>{{$val->pincode}}</td>
                                        <td>{{ordersMenus()[$val->order_idea]}}</td>
                                        <td>{{$val->bank_name}}</td>
                                        <td>
                                            <a href="{{route('admin.edit-customer',['id'=>$val->id])}}" style="color:blue;"><i class="fas fa-pencil-alt"></i></a>
                                        </td>
                                    </tr>
                                    @php $currentPage++ @endphp
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="16">No Data Found</td>
                                    </tr>
                                    @endif
                                    <!-- Add additional rows as needed -->
                                </tbody>
                            </table>
                        </div>

                        <!-- Footer -->
                        <div class="pagination-wrapper">
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>



        </body>
        <!-- END: Card DATA-->
    </div>
</main>
{{-- ship now button model pop  --}}

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-custom">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Select Courier Partner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <style>
                .preferred-badge {
                    background-color: #826AF9;
                    color: white;
                    padding: 5px 10px;
                    border-radius: 15px;
                    font-size: 12px;
                    display: inline-block;
                    margin-bottom: 5px;
                }

                .icon-circle {
                    display: inline-flex;
                    justify-content: center;
                    align-items: center;
                    width: 50px;
                    height: 50px;
                    border-radius: 50%;
                    background-color: #E8EAF6;
                }

                .rating-circle {
                    width: 50px;
                    height: 50px;
                    border-radius: 50%;
                    background-color: #E8EAF6;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    font-size: 18px;
                    font-weight: bold;
                }

                .highlight {
                    border: 2px solid #826AF9;
                    border-radius: 10px;
                    padding: 10px;
                }

                .sidebar {
                    background-color: #F5F5F5;
                    padding: 15px;
                    height: 100%;
                }

                .sidebar h5,
                .sidebar h6 {
                    margin-bottom: 15px;
                }

                .sidebar p {
                    margin-bottom: 10px;
                }

                .sidebar .icon {
                    width: 40px;
                    height: 40px;
                    background-color: #F4F4F4;
                    display: inline-flex;
                    justify-content: center;
                    align-items: center;
                    border-radius: 50%;
                    margin-right: 10px;
                }
            </style>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Sidebar for Order and Buyer Insights -->
                        <div class="col-md-3 sidebar" id="orders-display">

                        </div>

                        <!-- Main Content -->
                        <div class="col-md-9" style="margin-left:300px;">
                            <div class="d-flex justify-content-between align-items-center mb-4">

                            </div>
                            <div class="curiers" style="height: 75vh; overflow-y: auto;">

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    var callurl = "{{ route('admin.destroy-usertypes') }}";
    var view = "{{ route('admin.view-usertypes') }}";
    var modelURL = "{{ route('app.get-domestic-order') }}";
    var bookingURL = "{{ route('app.api-booking') }}";
    $(function() {
        $('[data-toggle="popover"]').popover();
    });
</script>
<script src="{{ asset('customer-assets/js/domestic_orders.js') }}"></script>
<script src="{{ asset('admin-assets/admin_custome_js/comancustomjs.js') }}"></script>
@endsection