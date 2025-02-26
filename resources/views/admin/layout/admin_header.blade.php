<!DOCTYPE html>
<html lang="en">
    <!-- START: Head-->
    <head>
        <meta charset="UTF-8">
        <title>{{ $title }}</title>
        <link rel="shortcut icon" href="{{ asset('admin-assets/dist/images/favicon.ico')}}" />
        <meta name="viewport" content="width=device-width,initial-scale=1"> 
        <meta name="csrf-token" content="{{ csrf_token()}}">
        <!-- START: Template CSS-->
        <link rel="stylesheet" href="{{ asset('admin-assets/dist/vendors/bootstrap/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{ asset('admin-assets/dist/vendors/jquery-ui/jquery-ui.min.css')}}">
        <link rel="stylesheet" href="{{ asset('admin-assets/dist/vendors/jquery-ui/jquery-ui.theme.min.css')}}">
        <link rel="stylesheet" href="{{ asset('admin-assets/dist/vendors/simple-line-icons/css/simple-line-icons.css')}}">        
        <link rel="stylesheet" href="{{ asset('admin-assets/dist/vendors/flags-icon/css/flag-icon.min.css')}}">         
        <!-- END Template CSS-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- START: Page CSS-->
        <link rel="stylesheet"  href="{{ asset('admin-assets/dist/vendors/chartjs/Chart.min.css')}}">
        <link rel="stylesheet"  href="{{ asset('admin-assets/multiselect/bootstrap-multiselect.css')}}">
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.3/dist/sweetalert2.min.css">
        <!-- END: Page CSS-->
        <link rel="stylesheet" href="{{ asset('admin-assets/dist/vendors/datatable/css/dataTables.bootstrap4.min.css')}}" />
        <link rel="stylesheet" href="{{ asset('admin-assets/dist/vendors/datatable/buttons/css/buttons.bootstrap4.min.css') }}"/>
        <!-- START: Page CSS-->   
        <link rel="stylesheet" href="{{ asset('admin-assets/dist/vendors/morris/morris.css')}}"> 
        <link rel="stylesheet" href="{{ asset('admin-assets/dist/vendors/weather-icons/css/pe-icon-set-weather.min.css')}}"> 
        <link rel="stylesheet" href="{{ asset('admin-assets/dist/vendors/chartjs/Chart.min.css')}}"> 
        <link rel="stylesheet" href="{{ asset('admin-assets/dist/vendors/starrr/starrr.css')}}"> 
        <link rel="stylesheet" href="{{ asset('admin-assets/dist/vendors/fontawesome/css/all.min.css')}}">
        <link rel="stylesheet" href="{{ asset('admin-assets/dist/vendors/ionicons/css/ionicons.min.css')}}"> 
        <link rel="stylesheet" href="{{ asset('admin-assets/dist/vendors/jquery-jvectormap/jquery-jvectormap-2.0.3.css')}}">
        <!-- END: Page CSS-->
        <link rel="stylesheet" href="{{ asset('admin-assets/dist/vendors/select2/css/select2.min.css')}}"/>
        <link rel="stylesheet" href="{{ asset('admin-assets/dist/vendors/select2/css/select2-bootstrap.min.css')}}"/>
        <!-- START: Custom CSS-->
        <link rel="stylesheet" href="{{ asset('admin-assets/dist/css/main.css')}}">
        <link rel="stylesheet" href="{{ asset('admin-assets/dist/vendors/bootstrap4-toggle/css/bootstrap4-toggle.min.css')}}" />
        <!-- END: Custom CSS-->
    </head>
    <!-- END Head-->

    <!-- START: Body-->
    <body id="main-container" style="font-family: Arial, Helvetica, sans-serif !important;" class="default compact-menu">

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

                        <span class="h6 font-weight-bold align-self-center mb-0 ml-3">Branch : @php $branch = DB::table('tbl_branches')->where(['id' => session('user.branch_id')])->get(); echo $branch[0]->branch_id.' -- '.$branch[0]->branch_name; @endphp</span>   
                    </form>
                    <div class="navbar-right ml-auto h-100">
                        <ul class="ml-auto p-0 m-0 list-unstyled d-flex top-icon h-100">
                            <li class="d-inline-block align-self-center  d-block d-lg-none">
                                <a href="#" class="nav-link mobilesearch" data-toggle="dropdown" aria-expanded="false"><i class="icon-magnifier h4"></i>                               
                                </a>
                            </li>                        

                            <li class="dropdown align-self-center">
                                <a href="#" class="nav-link" data-toggle="dropdown" aria-expanded="false"><i class="icon-reload h4"></i>
                                    <span class="badge badge-default"> <span class="ring">
                                        </span><span class="ring-point">
                                        </span> </span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right border  py-0">
                                    <li>
                                        <a class="dropdown-item px-2 py-2 border border-top-0 border-left-0 border-right-0" href="#">
                                            <div class="media">
                                                <img src="{{ asset('admin-assets/dist/images/author.jpg')}}" alt="" class="d-flex mr-3 img-fluid rounded-circle">
                                                <div class="media-body">
                                                    <p class="mb-0">john</p>
                                                    <span class="text-success">New user registered.</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item px-2 py-2 border border-top-0 border-left-0 border-right-0" href="#">
                                            <div class="media">
                                                <img src="{{ asset('admin-assets/dist/images/author2.jpg')}}" alt="" class="d-flex mr-3 img-fluid rounded-circle">
                                                <div class="media-body">
                                                    <p class="mb-0">Peter</p>
                                                    <span class="text-success">Server #12 overloaded.</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item px-2 py-2 border border-top-0 border-left-0 border-right-0" href="#">
                                            <div class="media">
                                                <img src="{{ asset('admin-assets/dist/images/author3.jpg')}}" alt="" class="d-flex mr-3 img-fluid rounded-circle">
                                                <div class="media-body">
                                                    <p class="mb-0">Bill</p>
                                                    <span class="text-danger">Application error.</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>

                                    <li><a class="dropdown-item text-center py-2" href="#"> See All Tasks <i class="icon-arrow-right pl-2 small"></i></a></li>
                                </ul>

                            </li>
                            <li class="dropdown align-self-center d-inline-block">
                                <a href="#" class="nav-link" data-toggle="dropdown" aria-expanded="false"><i class="icon-bell h4"></i>
                                    <span class="badge badge-default"> <span class="ring">
                                        </span><span class="ring-point">
                                        </span> </span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right border   py-0">
                                    <li>
                                        <a class="dropdown-item px-2 py-2 border border-top-0 border-left-0 border-right-0" href="#">
                                            <div class="media">
                                                <img src="{{ asset('admin-assets/dist/images/author.jpg')}}" alt="" class="d-flex mr-3 img-fluid rounded-circle w-50">
                                                <div class="media-body">
                                                    <p class="mb-0 text-success">john send a message</p>
                                                    12 min ago
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li >
                                        <a class="dropdown-item px-2 py-2 border border-top-0 border-left-0 border-right-0" href="#">
                                            <div class="media">
                                                <img src="{{ asset('admin-assets/dist/images/author2.jpg')}}" alt="" class="d-flex mr-3 img-fluid rounded-circle">
                                                <div class="media-body">
                                                    <p class="mb-0 text-danger">Peter send a message</p>
                                                    15 min ago
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li >
                                        <a class="dropdown-item px-2 py-2 border border-top-0 border-left-0 border-right-0" href="#">
                                            <div class="media">
                                                <img src="{{ asset('admin-assets/dist/images/author3.jpg')}}" alt="" class="d-flex mr-3 img-fluid rounded-circle">
                                                <div class="media-body">
                                                    <p class="mb-0 text-warning">Bill send a message</p>
                                                    5 min ago
                                                </div>
                                            </div>
                                        </a>
                                    </li>

                                    <li><a class="dropdown-item text-center py-2" href="#"> Read All Message <i class="icon-arrow-right pl-2 small"></i></a></li>
                                </ul>
                            </li>
                            <li class="dropdown user-profile align-self-center d-inline-block">
                                <a href="#" class="nav-link py-0" data-toggle="dropdown" aria-expanded="false"> 
                                    <div class="media">                                   
                                        <img src="{{ asset('admin-assets/user.png')}}" alt="" class="d-flex img-fluid rounded-circle" width="29">
                                    </div>
                                    <b>{{session('user.username')}}</b>
                                </a>

                                <div class="dropdown-menu border dropdown-menu-right p-0">
                                    <a href="" class="dropdown-item px-2 align-self-center d-flex">
                                        <span class="icon-pencil mr-2 h6 mb-0"></span> Edit Profile</a>
                                    <a href="" class="dropdown-item px-2 align-self-center d-flex">
                                        <span class="icon-user mr-2 h6 mb-0"></span> View Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="" class="dropdown-item px-2 align-self-center d-flex">
                                        <span class="icon-support mr-2 h6  mb-0"></span> Help Center</a>
                                    <a href="" class="dropdown-item px-2 align-self-center d-flex">
                                        <span class="icon-globe mr-2 h6 mb-0"></span> Forum</a>
                                    <a href="" class="dropdown-item px-2 align-self-center d-flex">
                                        <span class="icon-settings mr-2 h6 mb-0"></span> Account Settings</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="{{ route('admin.logout')}}" class="dropdown-item px-2 text-danger align-self-center d-flex">
                                        <span class="icon-logout mr-2 h6  mb-0"></span> Sign Out</a>
                                </div>

                            </li>

                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- END: Header-->

        @include('admin.layout.admin_sidebar');
        @yield('content');
        @include('admin.layout.admin_footer');
        @yield('script');