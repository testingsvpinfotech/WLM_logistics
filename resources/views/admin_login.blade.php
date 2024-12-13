<!DOCTYPE html>
<html lang="en">
<!-- START: Head-->

<head>
    <meta charset="UTF-8">
    <title>Admin | Login In</title>
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

    <!-- START: Page CSS-->
    <link rel="stylesheet" href="{{ asset('admin-assets/dist/vendors/social-button/bootstrap-social.css') }}" />
    <!-- END: Page CSS-->

    <!-- START: Custom CSS-->
    <link rel="stylesheet" href="{{ asset('admin-assets/dist/css/main.css')}}">
    <!-- END: Custom CSS-->
</head>
<!-- END Head-->

<!-- START: Body-->

<body id="main-container" style="font-family: Arial, Helvetica, sans-serif !important;" class="default">
    <!-- START: Main Content-->
    <div class="container">
        <div class="row vh-100 justify-content-between align-items-center">
            <div class="col-12">
                <form action="{{ route('admin.login') }}" id="userLogin" method="post" class="row row-eq-height lockscreen  mt-5 mb-5">
                    <div class="lock-image col-12 col-sm-5 d-flex justify-content-center align-items-center">
                        <img src="{{ asset('admin-assets/logo.jpeg') }}"
                            alt="" class="d-flex mr-3" style="width:100%;">
                    </div>
                    <div class="login-form col-12 col-sm-7">
                        <span style="color:red" class="msg"></span>
                        <div class="form-group mb-3">
                            <label for="emailaddress">Username</label>
                            <input class="form-control" type="text" name="username" id="username" required="" placeholder="Enter your username">
                            <p style="color:red"></p>
                        </div>

                        <div class="form-group mb-3">
                            <label for="password">Password</label>
                            <input class="form-control" type="password" required="" name="password" id="password" placeholder="Enter your password">
                            <p style="color:red"></p>
                        </div>
                        <div class="form-group mb-0 text-right">
                            <button class="btn btn-primary" type="submit"> Log In </button>
                        </div> <br>
                        <div class="mt-2"><a href="#">Forgot Password</a></div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <!-- END: Content-->

    <!-- START: Template JS-->
    <script src="{{ asset('admin-assets/dist/vendors/jquery/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ asset('admin-assets/dist/vendors/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{ asset('admin-assets/dist/vendors/moment/moment.js')}}"></script>
    <script src="{{ asset('admin-assets/dist/vendors/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('admin-assets/dist/vendors/slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        var routeUrl = "{{ route('admin.login') }}";
        var view = "{{ route('admin.dashboard') }}";
    </script>
    <script src="{{ asset('admin-assets/admin_custome_js/admin_login.js') }}"></script>
    <!-- END: Template JS-->
</body>
<!-- END: Body-->

</html>