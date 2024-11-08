
@extends('admin.layout.admin_header')
@section('content')
<main>
    <div class="container-fluid site-width">
        <!-- START: Breadcrumbs-->
        <div class="row">
            <div class="col-12  align-self-center">
                <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                    <div class="w-sm-100 mr-auto"><h4 class="mb-0">Dashboard</h4> <p>Welcome to liner admin panel</p></div>

                    <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- END: Breadcrumbs-->

        <!-- START: Card Data-->
        <div class="row">
            <div class="col-12 col-lg-12  mt-3">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="row">
                            <div class="col-12 col-sm-6 mt-3">
                                <div class="card bg-primary">
                                    <div class="card-body">
                                        <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                            <i class="icon-basket icons card-liner-icon mt-2 text-white"></i>
                                            <div class='card-liner-content'>
                                                <h2 class="card-liner-title text-white">2,390</h2>
                                                <h6 class="card-liner-subtitle text-white">Today's Orders</h6>                                       
                                            </div>                                
                                        </div>
                                        <div id="apex_primary_chart"></div>                               
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 mt-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                            <i class="icon-user icons card-liner-icon mt-2"></i>
                                            <div class='card-liner-content'>
                                                <h2 class="card-liner-title">9,390</h2>
                                                <h6 class="card-liner-subtitle">Today's Visitors</h6> 
                                            </div>                                
                                        </div>
                                        <span class="bg-primary card-liner-absolute-icon text-white card-liner-small-tip">+4.8%</span>
                                        <div id="apex_today_visitors"></div> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6  mt-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                            <i class="icon-bag icons card-liner-icon mt-2"></i>
                                            <div class='card-liner-content'>
                                                <h2 class="card-liner-title">$4,390</h2>
                                                <h6 class="card-liner-subtitle">Today's Sale</h6> 
                                            </div>                                
                                        </div>
                                        <div id="apex_today_sale"></div> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 mt-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                            <span class="card-liner-icon mt-1">$</span>
                                            <div class='card-liner-content'>
                                                <h2 class="card-liner-title">$4,390</h2>
                                                <h6 class="card-liner-subtitle">Total Profit</h6> 
                                            </div>                                
                                        </div>
                                        <div id="apex_today_profit"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 mt-3">
                        <div class="card">                           
                            <div class="card-content">
                                <div class="card-body">

                                    <div id="apex_bar_chart" class="height-500"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   

            <div class="col-12 col-md-6 col-lg-4 mt-3">
                <div class="card">                            
                    <div class="card-content">
                        <div class="card-body">  
                            <div class="d-flex"> 
                                <div class="media-body align-self-center ">
                                    <span class="mb-0 h5 font-w-600">Daily Reports</span><br>
                                    <p class="mb-0 font-w-500 tx-s-12">San Francisco, California, USA</p>                                                    
                                </div>
                                <div class="ml-auto border-0 outline-badge-warning circle-50"><span class="h5 mb-0">$</span></div>
                            </div>
                            <div id="flot-report" class="height-175 w-100 mt-3"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mt-3">
                <div class="card">                            
                    <div class="card-content">
                        <div class="card-body"> 
                            <div class="d-flex"> 
                                <div class="media-body align-self-center ">
                                    <span class="mb-0 h5 font-w-600">Stats Reports</span><br>
                                    <p class="mb-0 font-w-500 tx-s-12">San Francisco, California, USA</p>                                                    
                                </div>
                                <div class="ml-auto border-0 outline-badge-success circle-50"><span class="h5 mb-0">$</span></div>
                            </div>
                            <div class="d-flex mt-4">
                                <div class="border-0 outline-badge-info w-50 p-3 rounded text-center"><span class="h5 mb-0">Income</span><br/>                                        
                                    $78,600
                                </div>
                                <div class="border-0 outline-badge-success w-50 p-3 rounded ml-2 text-center"><span class="h5 mb-0">Sales</span><br/>                                        
                                    $1,24,600
                                </div>
                            </div>

                            <div class="d-flex mt-3">
                                <div class="border-0 outline-badge-dark w-50 p-3 rounded text-center"><span class="h5 mb-0">Users</span><br/>                                        
                                    4,600
                                </div>
                                <div class="border-0 outline-badge-danger w-50 p-3 rounded ml-2 text-center"><span class="h5 mb-0">Orders</span><br/>                                        
                                    2,600
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mt-3">
                <div class="card">                            
                    <div class="card-content">
                        <div class="card-body">  
                            <div class="height-235">
                                <canvas id="chartjs-other-pie"></canvas>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- END: Card DATA-->                 
    </div>
</main>
@endsection
@section('script')

@endsection