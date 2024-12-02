
<!DOCTYPE html>
<html lang="en">
    <!-- START: Head-->
    <head>
        <meta charset="UTF-8">
        <title>{{$title}}</title>
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
        <link rel="stylesheet" href="{{ asset('admin-assets/dist/vendors/social-button/bootstrap-social.css') }}"/>   
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
                    <form  id="forgotpassword" method="post" class="row row-eq-height lockscreen  mt-5 mb-5">
                        
                        <div class="login-form col-12 col-sm-12">
                            <span style="color:red" class="msg"></span>
                            <h5><b>Forgot Your Password</b></h5>
                            <p>Enter your phone number (without extension) to receive OTP for password reset.</p>
                            <div class="form-group mb-3">
                                <label for="emailaddress">Phone No</label>
                                <input class="form-control" type="text" name="phone" id="phone" maxlength="10" minlength="10"  placeholder="Enter your Phone No">
                                <p style="color:red"></p>
                            </div>
                            <div class="form-group mb-0">
                                <br><br>
                                <button class="btn btn-outline-success " style="width: 100%;" type="submit"> Send OTP </button>
                            </div> <br>
                            <div class="mt-2 text-center"><span style="color:grey;">Remember the password? </span><a href="{{route('sign-in')}}" style="color:blue;">Login</a></div>
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
              headers : {
                 'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
              }
            });
          </script>
          <script>
            var routeUrl = "{{ route('app.login') }}";
            var view = "{{ route('app.dashboard') }}";
        </script>
       <script src="{{ asset('customer-assets/js/register.js') }}"></script>
        <!-- END: Template JS-->  
    </body>
    <!-- END: Body-->
</html>
