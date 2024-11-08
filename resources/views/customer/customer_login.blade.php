
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
    <body id="main-container" class="default">
        <!-- START: Main Content-->
        <div class="container">
            <div class="row vh-100 justify-content-between align-items-center">
                <div class="col-12">
                    <form action="{{ route('admin.login') }}" id="customerLogin" method="post" class="row row-eq-height lockscreenr  mt-5 mb-5">
                        <div class="lock-image col-12 col-sm-5"></div>
                        <div class="login-form col-12 col-sm-7">
                            <span style="color:red" class="msg"></span>
                            <div class="form-group mb-3">
                                <label for="emailaddress">Email</label>
                                <input class="form-control" type="email" name="email" id="email"  placeholder="Enter your Email">
                                <p style="color:red"></p>
                            </div>

                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <input class="form-control" type="password"  name="password" id="password" placeholder="Enter your password">
                                <p style="color:red"></p>
                            </div>
                            <div class="form-group mb-0 text-right">
                                <button class="btn btn-primary" type="submit"> Sign In </button>
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
