@extends('admin.layout.admin_header')
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
                        <a href="{{route('admin.invoice-create')}}" style="float: right;" class="btn btn-outline-primary">Genrate Invoice</a>
                    </div>
                    <div class="m-4">
                        <form action="{{route('admin.invoice-billed-cycle2')}}" method="get">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Search Data</label>
                                    <input type="text" name="search" id="search" class="form-control buttonCall" placeholder="Invoice No | Customer Code | Customer Name" value="{{ !empty($_GET['search'])?$_GET['search']:'';}}">
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
                                    <a href="{{route('admin.invoice-billed-cycle2')}}" class="btn btn-outline-danger mt-4"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </form>
                        <br>
                        @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                        @endif
                        <!-- Table -->
                        <div class="table-responsive table-scroll">
                            <table class="table table-bordered align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Sr No</th>
                                        <th>Invoice No</th>
                                        <th>Invoice Date</th>
                                        <th>Customer Code</th>
                                        <th>Customer Name</th>
                                        <th>Customer Company</th>
                                        <th>Customer Contact No</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Me25-26-73823</td>
                                        <td>{{date('d-m-Y')}}</td>
                                        <td>CIN0010</td>
                                        <td>Pritesh</td>
                                        <td>SVP Infotech</td>
                                        <td>7834625772</td>
                                        <td>
                                            <a href="{{route('admin.invoice-print')}}" target="_blank" title="Print Invoice" class="btn btn-outline-primary"><i class="fa fa-print" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Footer -->
                        <div class="pagination-wrapper">
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </body>
        <!-- END: Card DATA-->
    </div>
</main>
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