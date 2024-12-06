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
</style>
<main>
    <div class="container-fluid site-width">
        <!-- START: Card Data-->
        <div class="row">
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-header  justify-content-between align-items-center">
                        <h4 class="card-title">{{ $title }}</h4>
                        <span style="float:right;"><a href="{{ route('app.add-orders') }}"
                                class="btn btn-outline-primary">Add Order</a></span>
                        <ul class="order_type mb-0">
                            <li class="domestic"><a href="{{route('app.view-orders')}}">View Domestic Order</a></li>
                            <li class="active international">View International Order</li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Order Details</th>
                                        <th>Customer Details</th>
                                        <th>Payment</th>
                                        <th>Pickup / RTO Addresses</th>
                                        <th>Shipping Details</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $count = 1;
                                    @endphp

                                    @foreach ($interorders as $key => $val)
                                    <tr>
                                        <td>
                                            <a href="#" class="order-link">{{ $val->order_id }}</a><br>
                                            <span
                                                class="order-time">{{ date('d M Y | h:i A', strtotime($val->order_date)) }}</span><br>
                                            <!-- <span class="order-cart-icon"><i class="icon-cart"></i>
                                                            {{ $val->order_channel }}</span><br> -->
                                            <a tabindex="0" class="btn btn-link" role="button"
                                                data-toggle="popover" data-trigger="focus"
                                                title="Package Details" data-html="true"
                                                data-content="<div>
                                                                <b>Package 1</b><br>
                                                                {{ $val->length . 'X' . $val->breath . 'X' . $val->height }} (cm)<br><br>
                                                                <b>Dead wt.:</b> {{ $val->dead_weight }} Kg<br>
                                                                <b>Vol. wt.:</b> {{ $val->volumetric_weight }} Kg
                                                            </div>">Package
                                                Details
                                            </a>
                                        </td>
                                        <td>
                                            <strong>{{ $val->buy_full_name }}</strong><br>
                                            {{ $val->buy_email }}<br>
                                            {{ $val->buy_mobile }}
                                        </td>
                                        <td>
                                            <span class="order-amount">₹ {{ $val->order_total }}</span><br>
                                            <span class="payment-label">{{ ucfirst($val->payment_mode) }}</span>
                                        </td>
                                        <td>
                                            @if ($val->pickup_address == 'primary')
                                            <a href="#" class="text-decoration-none">
                                                Primary
                                            </a>
                                            @else
                                            @php
                                            $addres = DB::table('tbl_pickup_address')->where(['id'=>$val->pickup_address])->first();
                                            @endphp
                                            {{ $addres->contact_person}} <br>
                                            {{ $addres->contact_no}} <br>
                                            {{ $addres->address.','.$addres->landmark.' '.$addres->pincode}}
                                            @endif
                                        </td>
                                        <td>
                                            <strong>AWB #</strong><br>
                                            Not Assigned
                                        </td>
                                        <td>
                                            <span class="status-label">NEW</span>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-action" onclick="return internationalModel('{{$val->id}}');" data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop">
                                                Ship Now
                                            </button>
                                            <button class="btn btn-outline-secondary"><i
                                                    class="fas fa-ellipsis-h"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper">
                                {{ $interorders->links() }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
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
    var modelURL = "{{ route('app.get-international-order') }}";
    var bookingURL = "{{ route('app.api-booking') }}";
    $(function() {
        $('[data-toggle="popover"]').popover();
    });
</script>
<script src="{{asset('customer-assets/js/international_orders.js')}}"></script>
<script src="{{ asset('admin-assets/admin_custome_js/comancustomjs.js') }}"></script>
@endsection