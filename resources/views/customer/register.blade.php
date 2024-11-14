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
    <!-- END: Page CSS-->
    <link rel="stylesheet"
        href="{{ asset('admin-assets/dist/vendors/datatable/css/dataTables.bootstrap4.min.css') }}" />
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
    <!-- END: Page CSS-->
    <link rel="stylesheet" href="{{ asset('admin-assets/dist/vendors/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin-assets/dist/vendors/select2/css/select2-bootstrap.min.css') }}" />
    <!-- START: Custom CSS-->
    <link rel="stylesheet" href="{{ asset('admin-assets/dist/css/main.css') }}">
    <link rel="stylesheet"
        href="{{ asset('admin-assets/dist/vendors/bootstrap4-toggle/css/bootstrap4-toggle.min.css') }}" />
    <!-- END: Custom CSS-->
</head>
<!-- END Head-->

<!-- START: Body-->

<body id="main-container" style="font-family: Arial, Helvetica, sans-serif !important;" class="default">
    <div class="container">
        <div class="row vh-100 justify-content-between ">
            <div class="col-12">
                <div class="row row-eq-height lockscreenr  mt-5 mb-5">
                    <div class="lock-image col-12 col-sm-5"></div>
                    <div class="login-form col-12 col-sm-7">
                        <h5 class="text-center">Get started with a free account</h5>
                        <form action="" method="POST" id="RegistrationCustomer" >
                            <div class="row">
                                <div class="form-group col-6 mb-0">
                                    <label for="">First Name</label>
                                    <input type="text" class="form-control buttonCall" name="personal_name" id="personal_name"
                                        placeholder="First Name">
                                    <p style="color: red;"></p>
                                </div>
                                <div class="form-group col-6 mb-0">
                                    <label for="">Last Name</label>
                                    <input type="text" class="form-control buttonCall" name="surname" id="personal_name"
                                        placeholder="Last Name">
                                    <p style="color: red;"></p>
                                </div>

                                <div class="form-group col-12 mb-0">
                                    <label for="">Compnay Name</label>
                                    <input type="text" class="form-control buttonCall" name="company_name" id="company_name" placeholder="Compnay Name">
                                    <p style="color: red;"></p>
                                </div>
                                <div class="form-group col-12 mb-0">
                                    <label for="">Phone Number</label>
                                    <input type="text" class="form-control buttonCall" name="mobile_number" maxlength="10" minlength="10" id="mobile_number" placeholder="Phone Number">
                                    <p style="color: red;"></p>
                                </div>
                                <div class="form-group col-12 mb-0">
                                    <label for="">E-mail</label>
                                    <input type="email" class="form-control buttonCall" name="email" id="email" placeholder="E-mail">
                                    <p style="color: red;"></p>
                                </div>
                                <div class="form-group col-12 mb-0">
                                    <label for="">Password</label>
                                    <div class="input-group">                                                
                                        <input type="password" class="form-control buttonCall" name="password" id="password" placeholder="Password" aria-label="Password" aria-describedby="basic-email">
                                        <div class="input-group-append" id="togglePassword" style="cursor: pointer;">
                                            <span class="input-group-text bg-transparent border-left-0" id="basic-email"><i id="toggleIcon" class="fas fa-eye"></i></span>
                                        </div>
                                    </div>
                                    <small id="passwordError" class="form-text text-danger" style="display: none;">Password must contain at least 1 uppercase letter, 1 lowercase letter, 1 number, and 1 special character.</small>
                                    <p style="color: red;"></p>
                                </div>
                                <div class="form-group col-12 mb-0">
                                    <label for="">How many orders do you ship in a month ?</label>
                                    <select name="order_idea" id="order_idea" onchange="frontvalidation();" class="form-control buttonCall">
                                       <option value="">Please Select</option>
                                        @foreach (ordersMenus() as $key=>$val )
                                        <option value="{{$key}}">{{$val}}</option>
                                        @endforeach
                                    </select>
                                    <p style="color: red;"></p>
                                </div>
                                <div class="form-group col-12 mb-0">
                                    <button class="btn btn-primary btn-block rounded-pill" id="submitButton" disabled type="submit"> Sign Up For Free </button>
                                </div>
                            </div>
                        </form>

                        <div class="mt-2">Already have an account? <a href="{{route('sign-in')}}">Sign In</a></div>
                    </div>
                </div>
            </div>

        </div>
    </div>







    <!-- START: Template JS-->
    <script src="{{ asset('admin-assets/dist/vendors/jquery/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('admin-assets/dist/vendors/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('admin-assets/dist/vendors/moment/moment.js') }}"></script>
    <script src="{{ asset('admin-assets/dist/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin-assets/dist/vendors/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <!-- END: Template JS-->

    <!-- START: APP JS-->
    <script src="{{ asset('admin-assets/dist/js/app.js') }}"></script>
    <!-- END: APP JS-->

    <!-- START: Page Vendor JS-->
    <script src="{{ asset('admin-assets/dist/vendors/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('admin-assets/dist/vendors/morris/morris.min.js') }}"></script>
    <script src="{{ asset('admin-assets/dist/vendors/chartjs/Chart.min.js') }}"></script>
    <script src="{{ asset('admin-assets/dist/vendors/starrr/starrr.js') }}"></script>
    <script src="{{ asset('admin-assets/dist/vendors/jquery-flot/jquery.canvaswrapper.js') }}"></script>
    <script src="{{ asset('admin-assets/dist/vendors/jquery-flot/jquery.colorhelpers.js') }}"></script>
    <script src="{{ asset('admin-assets/dist/vendors/jquery-flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('admin-assets/dist/vendors/jquery-flot/jquery.flot.saturated.js') }}"></script>
    <script src="{{ asset('admin-assets/dist/vendors/jquery-flot/jquery.flot.browser.js') }}"></script>
    <script src="{{ asset('admin-assets/dist/vendors/jquery-flot/jquery.flot.drawSeries.js') }}"></script>
    <script src="{{ asset('admin-assets/dist/vendors/jquery-flot/jquery.flot.uiConstants.js') }}"></script>
    <script src="{{ asset('admin-assets/dist/vendors/jquery-flot/jquery.flot.legend.js') }}"></script>
    <script src="{{ asset('admin-assets/dist/vendors/jquery-flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('admin-assets/dist/vendors/chartjs/Chart.min.js') }}"></script>
    <script src="{{ asset('admin-assets/dist/vendors/jquery-jvectormap/jquery-jvectormap-2.0.3.min.js') }}"></script>
    <script src="{{ asset('admin-assets/dist/vendors/jquery-jvectormap/jquery-jvectormap-world-mill.js') }}"></script>
    <script src="{{ asset('admin-assets/dist/vendors/jquery-jvectormap/jquery-jvectormap-de-merc.js') }}"></script>
    <script src="{{ asset('admin-assets/dist/vendors/jquery-jvectormap/jquery-jvectormap-us-aea.js') }}"></script>
    <script src="{{ asset('admin-assets/dist/vendors/apexcharts/apexcharts.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- START: Page Vendor JS-->
    <script src="{{ asset('admin-assets/dist/vendors/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin-assets/dist/vendors/datatable/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin-assets/dist/vendors/datatable/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('admin-assets/dist/vendors/datatable/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('admin-assets/dist/vendors/datatable/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('admin-assets/dist/vendors/datatable/buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin-assets/dist/vendors/datatable/buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin-assets/dist/vendors/datatable/buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('admin-assets/dist/vendors/datatable/buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('admin-assets/dist/vendors/datatable/buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('admin-assets/dist/vendors/datatable/buttons/js/buttons.print.min.js') }}"></script>
    <!-- END: Page Vendor JS-->
    <script src="{{ asset('admin-assets/dist/vendors/bootstrap4-toggle/js/bootstrap4-toggle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.3/dist/sweetalert2.all.min.js"></script>
    <!-- START: Page Script JS-->
    <script src="{{ asset('admin-assets/dist/js/datatable.script.js') }}"></script>
    <script src="{{ asset('admin-assets/dist/vendors/select2/js/select2.full.min.js') }}"></script>

    <!-- START: Page JS-->
    <script src="{{ asset('admin-assets/dist/js/home.script.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var callurl ="{{ route('store-register')}}";
    </script>
    <!-- END: Page JS-->
    <script src="{{ asset('customer-assets/js/register.js') }}"></script>
</body>
<!-- END: Body-->

</html>
