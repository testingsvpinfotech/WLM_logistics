   <!-- START: Main Menu-->
   {{ Session('customers')}}
   <div class="sidebar">
       <div class="site-width">
           <!-- START: Menu-->
           @php
           $access = DB::table('tbl_customers')->where(['id'=> session('customer.id')])->first();
           @endphp
           <ul id="side-menu" class="sidebar-menu">
               <li class="dropdown active pb-0"><a href="#"><i class="icon-rocket mr-1"></i> Dashboard</a>
                   <ul>
                       <!-- <li class="active"><a href="{{ route('app.home') }}"><i class="icon-home"></i>
                               Home</a></li> -->
                       <li><a href="{{ route('app.dashboard') }}"><i class="fas fa-rocket"></i>
                               Dashboard</a></li>
                       @if ($access->verified == '1')
                        <li><a href="{{ route('app.tracking-shipment') }}"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                Shipment Tarcking</a></li>
                        <li><a href="{{ route('app.view-wallet-transaction') }}"><i class="fas fa-wallet"></i>
                                PassBook</a></li>
                       @endif
                   </ul>
               </li>
               @if ($access->verified == '1')
               <li class="dropdown pt-0 pd-0">
                   <ul class="mt-0">
                       <li class="dropdown"><a href="#"><i class="fas fa-box"></i>
                               Orders</a>
                           <ul class="sub-menu">
                               <li>
                                   <a href="{{route('app.add-orders')}}">
                                       <i class="icon-energy"></i>
                                       Create Domestic Orders
                                   </a>
                               </li>
                               <li>
                                   <a href="{{route('app.international-order')}}">
                                       <i class="icon-energy"></i>
                                       Create International
                                   </a>
                               </li>
                               <li>
                                   <a href="{{route('app.add-b2b-order')}}">
                                       <i class="icon-energy"></i>
                                       Create B2B Order
                                   </a>
                               </li>

                           </ul>
                       </li>
                   </ul>
               </li>
               <li class="dropdown pt-0">
                   <ul class="mt-0">
                       <li class="dropdown"><a href="#"><i class="fas fa-shipping-fast"></i>
                               Shipments</a>
                           <ul class="sub-menu">
                               <li>
                                   <a href="{{route('app.view-orders')}}">
                                       <i class="icon-energy"></i>
                                       View Orders
                                   </a>
                               </li>
                           </ul>
                       </li>
                   </ul>
               </li>
               <li class="dropdown pt-0">
                   <ul class="mt-0">
                       <li class="dropdown pt-0"><a href="#"><i class="fas fa-tools"></i>
                               Tools</a>
                           <ul class="sub-menu">

                               <li class="pt-0">
                                   <a href="{{route('app.rate-card')}}">
                                       <i class="icon-energy"></i>
                                       Rate Cards
                                   </a>
                               </li>
                               <li class="pt-0">
                                   <a href="{{route('app.ratecalculator')}}">
                                       <i class="icon-energy"></i>
                                       Rate Calculator
                                   </a>
                               </li>
                           </ul>
                       </li>
                   </ul>
               </li>
               <li class="dropdown pt-0">
                   <ul class="mt-0">
                       <li class="dropdown pt-0"><a href="#"><i class="fa fa-file-text-o" aria-hidden="true"></i></i>
                               Billing</a>
                           <ul class="sub-menu">

                               <li class="pt-0">
                                   <a href="{{route('app.rate-card')}}">
                                       <i class="icon-energy"></i>
                                       View Bill
                                   </a>
                               </li>
                           </ul>
                       </li>
                   </ul>
               </li>
               @endif
           </ul>
           <!-- END: Menu-->
           <ol class="breadcrumb bg-transparent align-self-center m-0 p-0 ml-auto">
               <li class="breadcrumb-item"><a href="#">Application</a></li>
               <li class="breadcrumb-item active">Dashboard</li>
           </ol>
       </div>
   </div>

   <!-- END: Main Menu-->