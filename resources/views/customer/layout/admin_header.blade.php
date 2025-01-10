<!DOCTYPE html>
<html lang="en">
<!-- START: Head-->

<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <link rel="shortcut icon" href="{{ asset('admin-assets/dist/images/favicon.ico') }}" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- START: Template CSS-->
    <link rel="stylesheet" href="{{ asset('admin-assets/dist/vendors/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/dist/vendors/jquery-ui/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/dist/vendors/jquery-ui/jquery-ui.theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/dist/vendors/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/dist/vendors/flags-icon/css/flag-icon.min.css') }}">
    <!-- END Template CSS-->

    <!-- START: Page CSS-->
    <link rel="stylesheet" href="{{ asset('admin-assets/dist/vendors/chartjs/Chart.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.3/dist/sweetalert2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- END: Page CSS-->
    <link rel="stylesheet"
        href="{{ asset('admin-assets/dist/vendors/datatable/css/dataTables.bootstrap4.min.css') }}" />
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet"
        href="{{ asset('admin-assets/dist/vendors/datatable/buttons/css/buttons.bootstrap4.min.css') }}" />
    <!-- START: Page CSS-->
    <link rel="stylesheet" href="{{ asset('admin-assets/dist/vendors/morris/morris.css') }}">
    <link rel="stylesheet"
        href="{{ asset('admin-assets/dist/vendors/weather-icons/css/pe-icon-set-weather.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/dist/vendors/chartjs/Chart.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/dist/vendors/starrr/starrr.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/dist/vendors/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/dist/vendors/ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('admin-assets/dist/vendors/jquery-jvectormap/jquery-jvectormap-2.0.3.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- END: Page CSS-->
    <link rel="stylesheet" href="{{ asset('admin-assets/dist/vendors/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin-assets/dist/vendors/select2/css/select2-bootstrap.min.css') }}" />
    <!-- START: Custom CSS-->
    <link rel="stylesheet" href="{{ asset('admin-assets/dist/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/dist/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/dist/css/style.css') }}">
    <link rel="stylesheet"
        href="{{ asset('admin-assets/dist/vendors/bootstrap4-toggle/css/bootstrap4-toggle.min.css') }}" />
    <!-- END: Custom CSS-->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
        <link rel="stylesheet" href="{{asset('customer-assets/css/customer_dashboard.css')}}">
</head>
<!-- END Head-->

<!-- START: Body-->

<body id="main-container" style="font-family: Arial, Helvetica, sans-serif !important;"  class="default"> {{--compact-menu--}} 

    <!-- START: Pre Loader-->
    {{-- <div class="se-pre-con">
            <div class="loader"></div>
        </div> --}}
    <!-- END: Pre Loader-->

    <!-- START: Header-->
    <div id="header-fix" class="header fixed-top">
        <div class="site-width">
            <nav class="navbar navbar-expand-lg  p-0">
                <div class="navbar-header  h-100 h4 mb-0 align-self-center logo-bar text-left">
                    <a href="index.html" class="horizontal-logo text-left">
                    <img src="{{ asset('admin-assets/logo.jpeg') }}"
                    alt="" class="d-flex mr-3" style="width:100%;">
                    </a>
                </div>
                <div class="navbar-header h4 mb-0 text-center h-100 collapse-menu-bar">
                    <a href="#" class="sidebarCollapse" id="collapse"><i class="icon-menu"></i></a>
                </div>

                <form class="float-left d-none d-lg-block search-form">

                    <span class="h6 font-weight-bold align-self-center mb-0 ml-3"></span>
                </form>
                <div class="navbar-right ml-auto h-100">
                    <ul class="ml-auto p-0 m-0 list-unstyled d-flex top-icon h-100">
                        <li class="d-inline-block align-self-center  d-block d-lg-none">
                            <a href="#" class="nav-link mobilesearch" data-toggle="dropdown"
                                aria-expanded="false"><i class="icon-magnifier h4"></i>
                            </a>
                        </li>

                        <li class="dropdown align-self-center">
                            <a href="#"  data-toggle="dropdown" aria-expanded="false">
                                 <img src="{{asset('customer-assets/img/wallet.svg')}}" style="width:30px;" alt=""> <span style="font-weight: bold; font-size:17px;">₹ @php $branch = DB::table('tbl_customers')->where(['id' => session('customer.id')])->get(); echo $branch[0]->wallet_amount; @endphp</span>
                                {{-- <i class="icon-reload"></i> --}}
                              
                            </a>
                        </li>
                        <li class="dropdown align-self-center">
                            <button type="button" class="btn btn-primary" id="reacharge" >
                                Recharge Wallet
                              </button>
                        </li>
                        <li class="dropdown align-self-center d-inline-block">
                            <a href="#" class="nav-link" data-toggle="dropdown" aria-expanded="false"><i
                                    class="icon-bell h4"></i>
                                <span class="badge badge-default"> <span class="ring">
                                    </span><span class="ring-point">
                                    </span> </span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right border   py-0">
                                <li>
                                    <a class="dropdown-item px-2 py-2 border border-top-0 border-left-0 border-right-0"
                                        href="#">
                                        <div class="media">
                                            <img src="{{ asset('admin-assets/dist/images/author.jpg') }}"
                                                alt="" class="d-flex mr-3 img-fluid rounded-circle w-50">
                                            <div class="media-body">
                                                <p class="mb-0 text-success">john send a message</p>
                                                12 min ago
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item px-2 py-2 border border-top-0 border-left-0 border-right-0"
                                        href="#">
                                        <div class="media">
                                            <img src="{{ asset('admin-assets/dist/images/author2.jpg') }}"
                                                alt="" class="d-flex mr-3 img-fluid rounded-circle">
                                            <div class="media-body">
                                                <p class="mb-0 text-danger">Peter send a message</p>
                                                15 min ago
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item px-2 py-2 border border-top-0 border-left-0 border-right-0"
                                        href="#">
                                        <div class="media">
                                            <img src="{{ asset('admin-assets/dist/images/author3.jpg') }}"
                                                alt="" class="d-flex mr-3 img-fluid rounded-circle">
                                            <div class="media-body">
                                                <p class="mb-0 text-warning">Bill send a message</p>
                                                5 min ago
                                            </div>
                                        </div>
                                    </a>
                                </li>

                                <li><a class="dropdown-item text-center py-2" href="#"> Read All Message <i
                                            class="icon-arrow-right pl-2 small"></i></a></li>
                            </ul>
                        </li>
                        <li class="dropdown user-profile align-self-center d-inline-block">
                            <a href="#" class="nav-link py-0" data-toggle="dropdown" aria-expanded="false">
                                <div class="media">
                                    <img src="{{ asset('admin-assets/user.png') }}" alt=""
                                        class="d-flex img-fluid rounded-circle" width="29">
                                </div>
                            </a>

                            <div class="dropdown-menu border dropdown-menu-right p-0">
                                <a href="" class="dropdown-item px-2 align-self-center d-flex">
                                    <span class="icon-user mr-2 h6 mb-0"></span> {{session('customer.personal_name')}}</a>
                                <a href="" class="dropdown-item px-2 align-self-center d-flex">
                                    <span class="icon-pencil mr-2 h6 mb-0"></span> Edit Profile</a>
                                <div class="dropdown-divider"></div>
                                <a href="" class="dropdown-item px-2 align-self-center d-flex">
                                    <span class="icon-support mr-2 h6  mb-0"></span> Help Center</a>
                                <a href="" class="dropdown-item px-2 align-self-center d-flex">
                                    <span class="icon-globe mr-2 h6 mb-0"></span> Forum</a>
                                <a href="" class="dropdown-item px-2 align-self-center d-flex">
                                    <span class="icon-settings mr-2 h6 mb-0"></span> Account Settings</a>
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('app.logout') }}"
                                    class="dropdown-item px-2 text-danger align-self-center d-flex">
                                    <span class="icon-logout mr-2 h6  mb-0"></span> Sign Out</a>
                            </div>

                        </li>

                    </ul>
                </div>
            </nav>
        </div>
    </div>

    <style>
        .modal-header {
            border-bottom: none;
        }
        .modal-title {
            font-weight: bold;
        }
        .amount-buttons button {
            margin: 5px 5px 0 0;
        }
        .summary {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-top: 10px;
        }
        .summary p {
            margin: 0;
        }
        .summary .amount {
            font-weight: bold;
        }
        .btn-primary {
            width: 100%;
        }
    </style>
    <div class="modal fade" id="rechargeModal" tabindex="-1" aria-labelledby="rechargeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rechargeModalLabel">Recharge Your Wallet</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted">Current Wallet Amount: <span class="text-success">₹0.00</span></p>
    
                    <!-- Amount Input -->
                    <label for="rechargeAmount" class="form-label">Enter Amount in Multiples of 100 Below</label>
                    <input type="number" class="form-control mb-2" id="rechargeAmount" value="500" placeholder="₹500" min="500" max="5000000">
    
                    <p class="text-muted small mb-1">Min value: ₹500 & Max value: ₹50,00,000</p>
    
                    <!-- Predefined Amount Buttons -->
                    <div class="amount-buttons d-flex flex-wrap">
                        <button class="btn btn-outline-primary">₹500</button>
                        <button class="btn btn-outline-primary">₹1000</button>
                        <button class="btn btn-outline-primary">₹2500</button>
                        <button class="btn btn-outline-primary">₹5000</button>
                        <button class="btn btn-outline-primary">₹10000</button>
                    </div>
    
                    <!-- Coupon Section -->
                    <label for="couponCode" class="form-label mt-3">Have a Coupon</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="couponCode" placeholder="Enter Coupon Code here">
                        <button class="btn btn-outline-secondary">Apply</button>
                    </div>
    
                    <a href="#" class="text-primary small">View Available Coupons</a>
    
                    <!-- Summary -->
                    <div class="summary p-1">
                        <p>Recharge Amount: <span class="amount">₹500</span></p>
                        <p>Coupon Code Amount: <span class="amount">₹0</span></p>
                        <p>Total Amount to be Credited: <span class="amount">₹500</span></p>
                        <hr>
                        <p>Payable Amount: <span class="amount">₹500</span></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Continue to Payment</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Header-->

    @include('customer.layout.admin_sidebar');
    @yield('content');
    @include('customer.layout.admin_footer');
    @yield('script');
