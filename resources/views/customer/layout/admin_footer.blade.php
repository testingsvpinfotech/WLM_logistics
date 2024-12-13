  <!-- START: Footer-->
  <footer class="site-footer">
  &copy; {{ '2024-'.date('Y').' SVP Infotech , All Rights Reseverd' }}
</footer>
<!-- END: Footer-->


<!-- START: Back to top-->
<a href="#" class="scrollup text-center"> 
    <i class="icon-arrow-up"></i>
</a>
<!-- END: Back to top-->


<!-- START: Template JS-->
<script src="{{ asset('admin-assets/dist/vendors/jquery/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset('admin-assets/dist/vendors/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{ asset('admin-assets/dist/vendors/moment/moment.js')}}"></script>
<script src="{{ asset('admin-assets/dist/vendors/bootstrap/js/bootstrap.bundle.min.js')}}"></script>    
<script src="{{ asset('admin-assets/dist/vendors/slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- END: Template JS-->

<!-- START: APP JS-->
<script src="{{ asset('admin-assets/dist/js/app.js')}}"></script>
<!-- END: APP JS-->

<!-- START: Page Vendor JS-->
<script src="{{ asset('admin-assets/dist/vendors/raphael/raphael.min.js')}}"></script>
<script src="{{ asset('admin-assets/dist/vendors/morris/morris.min.js')}}"></script>
<script src="{{ asset('admin-assets/dist/vendors/chartjs/Chart.min.js')}}"></script>
<script src="{{ asset('admin-assets/dist/vendors/starrr/starrr.js')}}"></script>
<script src="{{ asset('admin-assets/dist/vendors/jquery-flot/jquery.canvaswrapper.js')}}"></script>
<script src="{{ asset('admin-assets/dist/vendors/jquery-flot/jquery.colorhelpers.js')}}"></script>
<script src="{{ asset('admin-assets/dist/vendors/jquery-flot/jquery.flot.js')}}"></script>
<script src="{{ asset('admin-assets/dist/vendors/jquery-flot/jquery.flot.saturated.js')}}"></script>
<script src="{{ asset('admin-assets/dist/vendors/jquery-flot/jquery.flot.browser.js')}}"></script>
<script src="{{ asset('admin-assets/dist/vendors/jquery-flot/jquery.flot.drawSeries.js')}}"></script>
<script src="{{ asset('admin-assets/dist/vendors/jquery-flot/jquery.flot.uiConstants.js')}}"></script>
<script src="{{ asset('admin-assets/dist/vendors/jquery-flot/jquery.flot.legend.js')}}"></script>
<script src="{{ asset('admin-assets/dist/vendors/jquery-flot/jquery.flot.pie.js')}}"></script>        
<script src="{{ asset('admin-assets/dist/vendors/chartjs/Chart.min.js')}}"></script>  
<script src="{{ asset('admin-assets/dist/vendors/jquery-jvectormap/jquery-jvectormap-2.0.3.min.js')}}"></script>
<script src="{{ asset('admin-assets/dist/vendors/jquery-jvectormap/jquery-jvectormap-world-mill.js')}}"></script>
<script src="{{ asset('admin-assets/dist/vendors/jquery-jvectormap/jquery-jvectormap-de-merc.js')}}"></script>
<script src="{{ asset('admin-assets/dist/vendors/jquery-jvectormap/jquery-jvectormap-us-aea.js')}}"></script>
<script src="{{ asset('admin-assets/dist/vendors/apexcharts/apexcharts.min.js')}}"></script>
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
<script src="{{ asset('admin-assets/dist/vendors/bootstrap4-toggle/js/bootstrap4-toggle.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.3/dist/sweetalert2.all.min.js"></script>
<!-- START: Page Script JS-->        
<script src="{{ asset('admin-assets/dist/js/script.js')}}"></script>
<script src="{{ asset('admin-assets/dist/js/datatable.script.js')}}"></script>
<script src="{{ asset('admin-assets/dist/vendors/select2/js/select2.full.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- START: Page JS-->
<script src="{{ asset('admin-assets/dist/js/home.script.js')}}"></script>
<script>
  
   $('#reacharge').click(function(){
    // $('#rechargeModal').modal('show');
    $('#rechargeModal').modal({
        backdrop: 'static',
        keyboard: false
    }).modal('show'); // Ensure the modal is shown
   });
   
  $.ajaxSetup({
    headers : {
       'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
  });
</script>
<!-- END: Page JS-->
</body>
<!-- END: Body-->
</html>