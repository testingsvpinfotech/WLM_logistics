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
                                                        <span class="order-cart-icon"><i class="icon-cart"></i>
                                                            {{ $val->order_channel }}</span><br>
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
                                                        <span class="payment-label">{{ $val->payment_mode }}</span>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="text-decoration-none">Primary</a>
                                                    </td>
                                                    <td>
                                                        <strong>AWB #</strong><br>
                                                        Not Assigned
                                                    </td>
                                                    <td>
                                                        <span class="status-label">NEW</span>
                                                    </td>
                                                    <td>
                                                        {{-- <button class="btn btn-action">Ship Now</button> --}}
                                                        <button type="button" class="btn btn-action" data-bs-toggle="modal"
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
                                    {{ $orders->links() }}
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
            width: 40px;
            height: 40px;
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
                            <div class="col-md-3 sidebar">
                                <h5>Order Details</h5>
                                <p><strong>Pickup From:</strong> 400070, Maharashtra</p>
                                <p><strong>Deliver To:</strong> 400078, Maharashtra</p>
                                <p><strong>Order Value:</strong> ₹5000.00</p>
                                <p><strong>Payment Mode:</strong> COD</p>
                                <p><strong>Applicable Weight (in Kg):</strong> 26 Kg</p>

                                <h6>Buyer Insights</h6>
                                <p><strong>Last Successful Delivery To Buyer:</strong></p>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="icon">
                                        <img src="icon-store.png" alt="Store" width="20">
                                    </div>
                                    <p class="mb-0">No orders yet</p>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="icon">
                                        <img src="icon-shiprocket.png" alt="Shiprocket" width="20">
                                    </div>
                                    <p class="mb-0">No orders yet</p>
                                </div>
                            </div>

                            <!-- Main Content -->
                            <div class="col-md-9 p-4" style="margin-left:300px;">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div class="form-group">
                                        <select class="form-select">
                                            <option>Sort By: Seller's Preferred Choice</option>
                                            <option>Sort By: Rating</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Tabs -->
                                <ul class="nav nav-tabs mb-3">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#">All</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Air</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Surface</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Local</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Self-Fulfilled</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Non-Serviceable</a>
                                    </li>
                                </ul>

                                <!-- Courier Option -->
                                <div class="highlight mb-3">
                                    <span class="preferred-badge">Seller's Preferred Choice</span>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <div class="icon-circle me-3">
                                                <img src="courier-logo.png" alt="Delhivery" width="30">
                                            </div>
                                            <div>
                                                <h6 class="mb-0">Delhivery Surface 20kg</h6>
                                                <small>Surface | Min-weight: 20 Kg | RTO Charges: ₹721.76</small>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="rating-circle me-3">4.6</div>
                                            <div class="me-3 text-center">
                                                <p class="mb-0">Today</p>
                                                <small>Expected Pickup</small>
                                            </div>
                                            <div class="me-3 text-center">
                                                <p class="mb-0">Oct 29, 2024</p>
                                                <small>Estimated Delivery</small>
                                            </div>
                                            <div class="me-3 text-center">
                                                <p class="mb-0">26 Kg</p>
                                                <small>Chargeable Weight</small>
                                            </div>
                                            <div class="me-3 text-center">
                                                <p class="mb-0">₹977.16</p>
                                                <small>Charges</small>
                                            </div>
                                            <button class="btn btn-primary">Ship Now</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Second Option -->
                                <div class="highlight mb-3">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <div class="icon-circle me-3">
                                                <img src="courier-logo.png" alt="Xpressbees" width="30">
                                            </div>
                                            <div>
                                                <h6 class="mb-0">Xpressbees Surface 10kg</h6>
                                                <small>Surface | Min-weight: 10 Kg | RTO Charges: ₹449.80</small>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="rating-circle me-3">3.9</div>
                                            <div class="me-3 text-center">
                                                <p class="mb-0">Today</p>
                                                <small>Expected Pickup</small>
                                            </div>
                                            <div class="me-3 text-center">
                                                <p class="mb-0">Oct 28, 2024</p>
                                                <small>Estimated Delivery</small>
                                            </div>
                                            <div class="me-3 text-center">
                                                <p class="mb-0">26 Kg</p>
                                                <small>Chargeable Weight</small>
                                            </div>
                                            <div class="me-3 text-center">
                                                <p class="mb-0">₹751.24</p>
                                                <small>Charges</small>
                                            </div>
                                            <button class="btn btn-primary">Ship Now</button>
                                        </div>
                                    </div>
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
        $(function() {
            $('[data-toggle="popover"]').popover();
        });
    </script>
    <script src="{{ asset('admin-assets/admin_custome_js/comancustomjs.js') }}"></script>
@endsection
