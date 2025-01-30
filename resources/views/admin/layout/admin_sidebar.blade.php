   <!-- START: Main Menu-->
   <div class="sidebar">
       <div class="site-width">
           <!-- START: Menu-->
           <ul id="side-menu" class="sidebar-menu">
               <li class="dropdown active"><a href="#"><i class="icon-home mr-1"></i> Dashboard</a>
                   <ul>
                       <li class="active"><a href="{{ route('admin.dashboard') }}"><i class="icon-rocket"></i>
                               Dashboard</a></li>
                   </ul>
               </li>
               <li class="dropdown">
                   <ul>
                       @php
                       $cnt = 1;
                       $menu = json_decode(getMenu());
                       @endphp
                       @foreach ($menu as $val)
                       @if ($val->menu_url == '#')
                       @php $menuUrl = '#'; @endphp
                       @else
                       @php $menuUrl = route($val->menu_url); @endphp
                       @endif
                       @if ($val->id == $cnt && $val->id != '1' && $val->master_menu_identity == '1')
                       @php $subMenu = getSubMenu($val->master_menu_id); @endphp
                       <li class="dropdown"><a href="{{ $menuUrl }}">
                               @if ($val->master_menu_id == 2)
                               <i class="fa fa-list" aria-hidden="true"></i>
                               @elseif($val->master_menu_id == 3)
                               <i class="fa fa-location-arrow" aria-hidden="true"></i>
                               @elseif($val->master_menu_id == 4)
                               <i class="fas fa-tools"></i>
                               @elseif($val->master_menu_id == 5)
                               <i class="fas fa-tools"></i>
                               @elseif($val->master_menu_id == 6)
                               <i class="fas fa-shipping-fast"></i>
                               @elseif($val->master_menu_id == 7)
                               <i class="fa fa-file-text" aria-hidden="true"></i>
                               @endif
                               {{ $val->master_menu_name }}</a>
                           <ul class="sub-menu">
                               @if (!empty($subMenu))
                               @foreach ($subMenu as $sub)
                               @if ($sub->menu_url == '#')
                               @php $menuUrl1 = '#'; @endphp
                               @else
                               @php $menuUrl1 = route($sub->menu_url); @endphp
                               @endif
                               @if ($sub->master_menu_identity != '1')
                               <li>
                                   <a href="{{ $menuUrl1 }}">
                                       <i class="icon-energy"></i>
                                       {{ $sub->master_menu_name }}
                                   </a>
                               </li>

                               @endif

                               @endforeach

                               @endif
                           </ul>
                       </li>
                       @endif
                       @php
                       $cnt++;
                       @endphp
                       @endforeach
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