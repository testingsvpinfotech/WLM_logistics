@extends('customer.layout.admin_header')
@section('content')
<style>
    .modal-fullscreen-custom {
        width: 100vw;
        height: 100vh;
        max-width: 100%;
        margin: 0;
        padding: 0;
    }

    .modal-fullscreen-custom .modal-content {
        height: 100%;
        border-radius: 0;
        /* To remove any default border radius */
    }

    .order_type {
        padding-left: 0px !important;
        font-size: 14px !important;
        list-style-type: none;
        display: flex;
        /* Enable flexbox */
        justify-content: flex-start;
        /* Distribute space between items */
        list-style-type: none;
        /* Remove bullet points */
    }

    .order_type li {
        padding: 10px;
        /* Add padding to each item */
        cursor: pointer;
        /* Change cursor to pointer on hover */
        transition: background-color 0.3s;
        /* Smooth transition for background color */
    }

    .order_type .active {
        color: #745be7;
        font-size: 14px;
        border-bottom: 5px solid #745be7;
    }

    .order_type li:hover {
        background-color: #f0f0f0;
        /* Change background color on hover */
    }

    .order_menu {
        padding-left: 0px !important;
        font-size: 13px !important;
        list-style-type: none;
        display: flex;
        /* Enable flexbox */
        justify-content: flex-start;
        /* Distribute space between items */
        list-style-type: none;
        /* Remove bullet points */
    }

    .order_menu li {
        font-size: 13px;
        cursor: pointer;
        font-weight: 500;
        color: #191919;
        padding: 4px 12px;
        border: 1px solid lightgrey;
    }

    .order_menu .active {
        color: #745be7;
    }




    .status-pill {
        font-size: 0.75rem;
        padding: 0.2rem 0.6rem;
        border-radius: 5px;
        color: #fff;
        font-weight: bold;
    }

    .status-delivered {
        background-color: #28a745;
    }

    .status-forwarded {
        background-color: #007bff;
    }

    .status-cod {
        background-color: #17a2b8;
    }

    .status-prepaid {
        background-color: #ffc107;
        color: #212529;
    }

    .filter-buttons span {
        cursor: pointer;
        margin-right: 10px;
    }

    .table-scroll {
        overflow-x: auto;
    }

    .btn-icon {
        padding: 0.4rem 0.7rem;
        font-size: 0.9rem;
    }
</style>
<main>
    <div class="container-fluid site-width">
        <!-- START: Card Data-->
        <div class="row">
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-header  justify-content-between align-items-center">
                        <h4 class="card-title">{{ $title }}</h4>
                        <span style="float:right;"><a href="{{ route('app.add-b2b-order') }}"
                                class="btn btn-outline-primary">Add Order</a></span>
                        <ul class="order_type mb-0">
                            <li class="active domestic">View Domestic Order</li>
                            <li class="international"><a href="{{ route('app.view-international-orders') }}">View
                                    International Order</a></li>
                        </ul>
                    </div>
                    <div class="m-4">
                        <!-- Filter Buttons -->
                        <div class="d-flex justify-content-between mb-3 align-items-center">
                            <div class="filter-buttons">
                                <a href="{{route('app.view-orders')}}" style="color:blue;"><i class="fa fa-files-o"></i></i> All Orders <button class="badge bg-primary border  rounded-pill">{{ $all_orders }}</button></a>
                                <a href="{{route('app.view-Unprocessing-orders')}}" style="color:blue;" class="ml-3"> <i class="fa fa-info-circle"></i> Not Shipped <button class="badge bg-danger border rounded-pill">{{$Unprocessable}}</button> </a>
                                <a href="{{route('app.view-Processing-orders')}}" style="color:blue;" class="ml-3"> <i class="fa fa-cogs"></i> Booked <button class="badge bg-warning border rounded-pill">{{$Processing}}</button> </a>
                                <!-- <a href="{{route('app.view-readyforship-orders')}}" style="color:blue;" class="ml-3"> <i class="fa fa-dropbox"></i></i> Ready to Ship <button class="badge bg-info border rounded-pill">{{$Ready_to_ship}}</button> </a> -->
                                <a href="{{route('app.view-manifest-orders')}}" style="color:blue;" class="ml-3"> <i class="fa fa-truck"></i> Cancelled <button class="badge bg-success border rounded-pill">{{$Manifest}}</button> </a>
                                <!-- <a href="{{route('app.view-return-orders')}}" style="color:blue;" class="ml-3"> <i class="fa fa-repeat"></i> Returns <button class="badge bg-secondary border rounded-pill">{{$Return}}</button> </a> -->
                            </div>
                        </div>
                        <form action="{{route('app.view-orders')}}" method="get">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Search Data</label>
                                    <input type="text" name="search" id="search" class="form-control buttonCall" placeholder="AWB No | Order No" value="{{ !empty($_GET['search'])?$_GET['search']:'';}}">
                                </div>
                                <div class="col-md-2">
                                    <label for="">From Date</label>
                                    <input type="date" name="from_date" id="from_date" class="form-control buttonCall" value="{{ !empty($_GET['from_date'])?$_GET['from_date']:date('Y-m-01');}}">
                                </div>
                                <div class="col-md-2">
                                    <label for="">To Date</label>
                                    <input type="date" name="to_date" id="to_date" class="form-control buttonCall" value="{{ !empty($_GET['to_date'])?$_GET['to_date']:date('Y-m-d');}}">
                                </div>

                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-outline-primary mt-4"><i class="fa fa-search" aria-hidden="true"></i></button>
                                    <a href="{{route('app.view-orders')}}" class="btn btn-outline-danger mt-4"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </form>
                        <br>
                        <!-- Table -->
                        <div class="table-responsive table-scroll">
                            <table class="table table-bordered align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th><input type="checkbox"></th>
                                        <th>Order Date</th>
                                        <th>Order Source</th>
                                        <th>Order ID</th>
                                        <th>Amount</th>
                                        <th>Product</th>
                                        <th>Customer Details</th>
                                        <th>Delivery Address</th>
                                        <th>Dimension (CM)</th>
                                        <th>Courier Partner</th>
                                        <th>Shipment Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($orders->isNotEmpty())
                                    @foreach ($orders as $key => $val)
                                    <tr>
                                        <td><input type="checkbox"></td>
                                        <td>
                                            Date: {{ date('d/m/Y', strtotime($val->booking_date)) }}<br>
                                            Time: {{ date('h:i A', strtotime($val->booking_time)) }}
                                        </td>
                                        <td>custom</td>
                                        <td>
                                            <a href="#">{{ $val->order_no }}</a><br>
                                            <!-- <span class="status-pill status-delivered">Delivered</span><br>
                                            <span class="status-pill status-forwarded">forward</span> -->
                                        </td>
                                        <td>
                                            Amount: ₹{{ $val->grand_total }}<br>
                                            <span class="btn btn-outline-primary">{{ ucfirst($val->payment_mode) }}</span>
                                        </td>
                                        <td>
                                            @php
                                            $product = json_decode($val->product_name);
                                            $hson_code = json_decode($val->hson_code);
                                            $length_detail = json_decode($val->length_detail);
                                            $breath_detail = json_decode($val->breath_detail);
                                            $height_detail = json_decode($val->height_detail);
                                            $chargable_weight_details = json_decode($val->chargable_weight_details);
                                            @endphp
                                            Name : {{ $product[0]}} <br>
                                            SKU : {{$hson_code[0]}} <br>
                                            Qty : {{$val->no_of_pack}}
                                        </td>
                                        <td>
                                            Name: {{ $val->personal_name.' '.$val->surname }}<br>
                                            Contact: {{ $val->mobile_number }}
                                        </td>
                                        <td>
                                            Name: {{ $val->receiver_name }}<br>
                                            Add /Contact Details: {{ $val->receiver_address.' '.$val->receiver_pincode .'. '.$val->receiver_contact_no }}
                                        </td>
                                        <td>
                                            {{$length_detail[0].' X '.$breath_detail[0].' X '.$height_detail[0].' = '.$chargable_weight_details[0] }}<br>
                                            @if($val->no_of_pack > 1)
                                            {{@$length_detail[1].' X '.@$breath_detail[1].' X '.@$height_detail[1].' = '.@$chargable_weight_details[1] }}<br>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                            $cour = '';
                                            $couriers = DB::table('tbl_courier_company')->where('id', $val->courier)->first();
                                            if(!empty($couriers)){
                                            $cour = $couriers->company_name;
                                            }
                                            @endphp
                                            Courier: {{$cour}} <br>
                                            AWB: {{$val->airway_no}} <br>
                                            Pickup Date : @php if(!empty($val->pickup_date)){ echo date('d-m-Y',strtotime($val->pickup_date)); } @endphp
                                        </td>
                                        <td>

                                        </td>

                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="12">No Data Found</td>
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