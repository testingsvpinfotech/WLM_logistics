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
<style>
    .otp-box {
        display: flex;
        justify-content: space-between;
        margin: 20px 0;
    }

    .otp-box input {
        width: 50px;
        height: 50px;
        font-size: 24px;
        text-align: center;
        border-radius: 5px;
        border: 1px solid #ced4da;
    }

    .otp-box input:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, .25);
    }

    .verify-btn {
        width: 100%;
        padding: 10px;
        font-size: 16px;
    }

    .timer {
        display: flex;
        align-items: center;
        font-size: 14px;
    }

    .timer i {
        margin-right: 5px;
    }

    .change-number {
        color: #6f42c1;
        text-decoration: none;
    }
</style>
<!-- END Head-->

<!-- START: Body-->

<body id="main-container" class="default">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="" method="put" id="otpsubmission">
                <div class="card mt-5 p-4">
                    <h3 class="text-center">OTP Verification</h3>
                    <p style="color: red;" class="text-center" id="errormsg"></p>
                    <!-- OTP Input -->
                    <input type="hidden" name="id" id="id" value="{{$editData->id}}">
                    <input type="hidden"  id="mobile_number" value="{{$editData->mobile_number}}">
                    <input type="hidden"  id="customer_id" value="{{$otpCode->customer_id}}">
                    <div class="otp-box">
                        <input type="text" maxlength="1" minlength="1" class="otp-input" id="otp-1">
                        <input type="text" maxlength="1" minlength="1" class="otp-input" id="otp-2">
                        <input type="text" maxlength="1" minlength="1" class="otp-input" id="otp-3">
                        <input type="text" maxlength="1" minlength="1" class="otp-input" id="otp-4">
                        <input type="text" maxlength="1" minlength="1" class="otp-input" id="otp-5">
                        <input type="text" maxlength="1" minlength="1" class="otp-input" id="otp-6">
                    </div>
                    <!-- Timer and Resend -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <button type="button" class="change-number btn btn-btn-link" id="ResndOTP" disabled >Resend</button>
                        <div class="timer">
                            <i class="far fa-clock"></i>
                            <span id="countdown">2:00</span>
                        </div>
                    </div>

                    <!-- Verify Button -->
                    <button class="btn btn-secondary verify-btn" type="submit" id="verifyBtn">Verify Number</button>
                </div>
            </form>
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
        var callurl = "{{ route('verify-otp') }}";
        var view = "{{ route('checkout-category') }}";
        var ResndOTPurl = "{{ route('resend-otp')}}";
        $(document).ready(function() {
            $('.otp-input').on('input', function() {
                if ($(this).val().length === 1) {
                    $(this).next('.otp-input').focus();
                }
            });

            $('.otp-input').on('keydown', function(e) {
                if (e.key === "Backspace" && $(this).val().length === 0) {
                    $(this).prev('.otp-input').focus();
                }
            });
        });
    </script>
    <!-- END: Page JS-->
    <script src="{{ asset('customer-assets/js/register.js') }}"></script>
</body>
<!-- END: Body-->

</html>
