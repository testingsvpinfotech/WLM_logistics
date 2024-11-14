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
    .card-custom {
        border: none;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }

    .card img {
        width: 100%;
        height: auto;
    }

    .card-body {
        text-align: center;
    }

    .get-started-link {
        color: #6f42c1;
        font-weight: 600;
    }

    .new-tag {
        background-color: #28a745;
        color: white;
        padding: 2px 8px;
        border-radius: 5px;
        font-size: 0.75rem;
        position: absolute;
        top: 15px;
        right: 15px;
    }
</style>

<!-- END Head-->

<!-- START: Body-->

<body id="main-container" style="font-family: Arial, Helvetica, sans-serif !important;" class="default">
    <div class="container">

        @foreach (business_category() as $key => $val)
            @foreach ($BusinessCategory as $name)
                @if ($key == $name->category_id)
                    <h4 class="mt-5 text-left">{{ $val }}</h4>
                @endif
            @endforeach
            <div class="row g-4">
                @foreach ($BusinessCategory as $name)
                    @if ($key == $name->category_id)
                        <div class="col-lg-3 col-md-6">
                            <div class="card card-custom h-100">
                                <img src="{{ asset('admin-assets/category/' . $name->image) }}" class="card-img-top"
                                    alt="Express Parcel">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $name->category_name }}</h5>
                                    <p class="card-text">{{ $name->description }}</p>
                                    <a style="cursor: pointer;color:blue;" onclick="callcate({{ $name->id }});"
                                        id="get-started-{{ $name->id }}" class="get-started-link">Get Started →</a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endforeach


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
        var callurl = "{{ route('update-category') }}";
        var view = "{{ route('address-details') }}";
    </script>
    <!-- END: Page JS-->
    <script src="{{ asset('customer-assets/js/register.js') }}"></script>
    <script>
        $(document).on('click', '.get-started-link', function(e) {
            e.preventDefault();
            var id = $(this).attr('id').split('-')[2]; // Extracting the id part

            $.ajax({
                url: callurl,
                type: "PUT",
                data: {
                    'category_id': id
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == 'success' || response.status == 'faild') {
                        // var error = response["data"];
                        // console.log(error);
                        window.location.href = view;
                        $('#errormsg').html("");
                    }
                    if (response.status == "false") {
                        var error = response["data"];
                        $('#errormsg').html(error);
                    }
                },
            });
        });
    </script>
</body>
<!-- END: Body-->

</html>
