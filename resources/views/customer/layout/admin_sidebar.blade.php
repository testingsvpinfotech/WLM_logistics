   <!-- START: Main Menu-->
   <div class="sidebar">
       <div class="site-width">
           <!-- START: Menu-->
           <ul id="side-menu" class="sidebar-menu">
               <li class="dropdown active"><a href="#"><i class="icon-rocket mr-1"></i> Dashboard</a>
                   <ul>
                       <li class="active"><a href="{{ route('app.home') }}"><i class="icon-home"></i>
                               Home</a></li>
                       <li class="active"><a href="{{ route('app.dashboard') }}"><i class="icon-rocket"></i>
                               Dashboard</a></li>
                               <li class="active"><a href="{{ route('app.view-orders') }}"><i class="fas fa-shopping-cart"></i>
                                Orders</a></li>
                   </ul>
               </li>
               
           </ul>
           <!-- END: Menu-->
           <ol class="breadcrumb bg-transparent align-self-center m-0 p-0 ml-auto">
               <li class="breadcrumb-item"><a href="#">Application</a></li>
               <li class="breadcrumb-item active">Dashboard</li>
           </ol>
       </div>
   </div>
   <!-- END: Main Menu-->
