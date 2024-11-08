@extends('customer.layout.admin_header')
@section('content')
    <main>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
        <link rel="stylesheet" href="{{asset('customer-assets/css/customer_dashboard.css')}}">
        <div class="container-fulid bg-secondary-subtle p-3">
            <div class="d-flex">
                <p class="ms-4 me-4 p-2">DashBoard</p>
                <div class="dropdown">
                    <button class=" btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="true">
                        Domastic
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </div>
            </div>
            <nav class="container-fulid m-4">
                <ul class="nav nav-underline">
                    <li class="nav-item  ">
                        <a class="nav-link active " href="#">Overview</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-color" href="#">Order</a>
                    </li>
                    <li class="nav-item">
                        <a class=" nav-link link-color" href="#">Shipments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-color" href="#">NDR</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link link-color" href="#">WhatsApp Comm</a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link link-color" href="#">RTO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-color" href="#">Courier</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-color" href="#">Delays</a>
                    </li>


                </ul>
            </nav>
            {{-- <div id="carouselExampleDark"
                class="carousel carousel-dark  sample slide mt-0 ms-4 me-4 h-10 d-flex align-items-center container-fulid carosel">
                <div class="carousel-indicators ">
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="3"
                        aria-label="Slide 4"></button>
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="4"
                        aria-label="Slide 5"></button>
                </div>
                <div class="carousel-inner sample">
                    <div class="carousel-item active" data-bs-interval="10000">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="col-md-2 ms-2  d-flex justify-content-start">

                                <img src="{{asset('customer-assets/img/fluter.png')}}" width="50px" height="50px" class="mt-4">


                                <p class="ms-3 shiprckt"> Shiprocket<br>
                                    <span class="chkout">Checkout</span>
                                </p>
                            </div>

                            <div class="col-md-6">
                                <p class="carosel-words">Increase Conversion By 60% With An Easy, Fast & Secure Checkout</p>
                            </div>
                            <div class="col-md-2 p-2">
                                <img style="width: 100px; height:auto;"
                                    src="{{asset('customer-assets/img/Images/Screenshot 2024-10-25 at 10.42.50 AM.png')}}">
                            </div>
                            <div class="col-md-2">
                                <button class="get-start-btn">Get Start</button>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item" data-bs-interval="2000">
                        <div class="d-flex align-items-center">
                            <div class="col-md-1 ms-5">
                                <h1>Hai</h1>
                            </div>
                            <div class="col-md-2">
                                <h1>hai</h1>
                            </div>
                            <div class="col-md-5">
                                <h1>hai</h1>
                            </div>
                            <div class="col-md-2">
                                <h1>hai</h1>
                            </div>
                            <div class="col-md-2">
                                <h1>hai</h1>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="d-flex align-items-center">
                            <div class="col-md-1 ms-5">
                                <h1>Wel</h1>
                            </div>
                            <div class="col-md-2">
                                <h1>wel</h1>
                            </div>
                            <div class="col-md-5">
                                <h1>wel</h1>
                            </div>
                            <div class="col-md-2">
                                <h1>wel</h1>
                            </div>
                            <div class="col-md-2">
                                <h1>wel</h1>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="d-flex align-items-center">
                            <div class="col-md-1 ms-5">
                                <h1>Wel</h1>
                            </div>
                            <div class="col-md-2">
                                <h1>wel</h1>
                            </div>
                            <div class="col-md-5">
                                <h1>wel</h1>
                            </div>
                            <div class="col-md-2">
                                <h1>wel</h1>
                            </div>
                            <div class="col-md-2">
                                <h1>wel</h1>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="d-flex align-items-center">
                            <div class="col-md-1 ms-5">
                                <h1>Wel</h1>
                            </div>
                            <div class="col-md-2">
                                <h1>wel</h1>
                            </div>
                            <div class="col-md-5">
                                <h1>wel</h1>
                            </div>
                            <div class="col-md-2">
                                <h1>wel</h1>
                            </div>
                            <div class="col-md-2">
                                <h1>wel</h1>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev  " style="width: 15px; height: 15px" type="button"
                        data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next  text-danger"
                        style="width: 15px; height: 15px; margin-bottom: 10px;" type="button"
                        data-bs-target="#carouselExampleDark" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div> --}}
            <div class=" row mt-3  mx-4 d-flex justify-content-between ">
                <div class="col-md-4 p-1">
                    <div class=" d-flex align-items-center item1">

                        <img class="ms-5" src="{{asset('customer-assets/img/Images/gift.png')}}" width="70px" height="70px"
                            style="border-radius: 50%;">

                        <p class="ms-5 order-text">Today's Order<br>
                            <span class="zero-text">$0</span>
                            <br>
                            <span>Yesderday</span>
                        </p>

                    </div>
                </div>
                <div class="col-md-8 p-1">
                    <div class=" shipment-right-box ">
                        <div class=" m-3 d-flex justify-content-between">
                            <p class="order-text">Shipments Details</p>
                            <p class="light-text">Last 30 Days</p>
                        </div>
                        <div class=" ms-5 d-flex justify-content-between align-items-center ">
                            <div class="col-md-2 d-flex flex-column justify-content-center align-items-center ">
                                <button class=" button-type-shipment">0</button>
                                <span style="text-align: center; padding: auto;">Total Shipment</span>

                            </div>
                            <div class="col-md-2 d-flex flex-column justify-content-center align-items-center ">
                                <button class=" button-type-shipment">0</button>
                                <span class="my-3" style="text-align: center;padding: auto;">Pickup Pending</span>

                            </div>
                            <div class="col-md-2 d-flex flex-column justify-content-center align-items-center ">
                                <button class=" button-type-shipment">0</button>
                                <span class="my-3" style="text-align: center;padding: auto;"> In-Transit</span>

                            </div>
                            <div class="col-md-2 d-flex flex-column justify-content-center align-items-center ">
                                <button class=" button-type-shipment">0</button>
                                <span class="my-3" style="text-align: center;padding: auto;"> Delivered</span>

                            </div>
                            <div class="col-md-2 d-flex flex-column justify-content-center align-items-center ">
                                <button class=" button-type-shipment">0</button>
                                <span class=" my-3" class="my-3" style="text-align: center;"> NDR Pending</span>


                            </div>
                            <div class="col-md-2 d-flex flex-column justify-content-center align-items-center ">
                                <button class=" button-type-shipment">0</button>
                                <span class="my-3" style="text-align: center;padding: auto"> RTO</span>

                            </div>

                        </div>

                    </div>
                </div>


            </div>
            <div class=" row mt-3  mx-4 d-flex justify-content-between ">
                <div class="col-md-4 p-1">
                    <div class=" d-flex align-items-center box2">

                        <img class="ms-5" src="{{asset('customer-assets/img/Images/gift.png')}}" width="70px" height="70px"
                            style="border-radius: 50%;">

                        <p class="ms-5 order-text">Today's Order<br>
                            <span class=" zero-text">$0</span>
                            <br>
                            <span class="order-text">Yesderday</span>
                        </p>

                    </div>
                </div>
                <div class="col-md-8 p-1">
                    <div class=" NDR-right-box ">
                        <div class=" m-3 d-flex justify-content-between">
                            <p class="order-text">NDR Details</p>
                            <p class="light-text">Last 30 Days</p>
                        </div>
                        <div class=" ms-5 d-flex justify-content-between align-items-center ">
                            <div class="col-md-2 d-flex flex-column justify-content-center align-items-center ">
                                <button class=" button-type-NDR">0</button>
                                <span style="text-align: center; padding: auto;">Total NDR</span>

                            </div>
                            <div class="col-md-2 d-flex flex-column justify-content-center align-items-center ">
                                <button class=" button-type-NDR">0</button>
                                <span style="text-align: center; padding: auto;">Your Reattampt Request</span>

                            </div>
                            <div class="col-md-2 d-flex flex-column justify-content-center align-items-center ">
                                <button class=" button-type-NDR">0</button>
                                <span class="my-2" style="text-align: center; padding: auto;">Buyer Reattempt
                                    Request</span>
                            </div>
                            <div class="col-md-2 d-flex flex-column justify-content-center align-items-center ">
                                <button class=" button-type-NDR">0</button>
                                <span class="my-2" style="text-align: center; padding: auto;">NDR Delevered</span>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
            <div class=" row mt-3  mx-4 d-flex justify-content-between ">
                <div class="col-md-4 p-1">
                    <div class="d-flex align-items-center item1">

                        <img class="ms-5" src="{{asset('customer-assets/img/Images/gift.png')}}" width="70px" height="70px"
                            style="border-radius: 50%;">

                        <p class="ms-5 order-text">Today's Order<br>
                            <span class="zero-text">$0</span>
                            <br>

                        </p>

                    </div>
                </div>
                <div class="col-md-8 p-1">
                    <div class=" NDR-right-box ">
                        <div class=" m-3 d-flex justify-content-between">
                            <p class="order-text">COD Status</p>
                            <p class="light-text">Last 30 Days</p>
                        </div>
                        <div class=" ms-5 d-flex justify-content-between align-items-center ">
                            <div class="col-md-2 d-flex flex-column justify-content-center align-items-center ">
                                <button class=" button-type-NDR">$0</button>
                                <span style="text-align: center; padding: auto;">Total COD<Last 30 Days)</span>
                            </div>
                            <div class="col-md-2 d-flex flex-column justify-content-center align-items-center ">
                                <button class=" button-type-NDR">$0</button>
                                <span style="text-align: center; padding: auto;">COD Available</span>
                            </div>
                            <div class="col-md-2 d-flex flex-column justify-content-center align-items-center ">
                                <button class=" button-type-NDR">$0</button>
                                <span style="text-align: center; padding: auto;">COD Pending(Greater then 8 days)</span>
                            </div>
                            <div class="col-md-2 d-flex flex-column justify-content-center align-items-center ">
                                <button class=" button-type-NDR">$0</button>
                                <span style="text-align: center; padding: auto;">Last COD Remitted</span>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
        <div class="container-fulid bg-secondary-subtle p-3 mt-3">
            <div class=" row mx-4 mt-3  d-flex justify-content-between">
                <div class="col-md-4 p-1">
                    <div class="other-right-box ">
                        <div class=" m-3 d-flex justify-content-between">
                            <p class="order-text">Couriers Spilt</p>
                            <p class="light-text">Last 30 Days</p>
                        </div>
                        <div class=" ms-5 d-flex justify-content-between align-items-center ">

                            <div class="col-md-11 d-flex flex-column justify-content-center align-items-center ">
                                <img src="{{asset('customer-assets/img/Images/Notes.png')}}" style="width: 160px; height: 160px;">
                                <p class="mt-2 filter-label">Data Not Found For the selected filter</p>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="col-md-4 p-1">
                    <div class="other-right-box ">
                        <div class=" m-3 d-flex justify-content-between">
                            <p class="order-text">Overall shipment Status</p>
                            <p class="light-text">Last 30 Days</p>
                        </div>
                        <div class=" ms-5 d-flex justify-content-between align-items-center ">

                            <div class="col-md-11 d-flex flex-column justify-content-center align-items-center ">
                                <img src="{{asset('customer-assets/img/Images/Notes.png')}}" style="width: 160px; height: 160px;">
                                <p class="mt-2 filter-label">Data Not Found For the selected filter</p>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="col-md-4 p-1">
                    <div class="other-right-box ">
                        <div class=" m-3 d-flex justify-content-between">
                            <p class="order-text">Delivery Performance</p>
                            <p class="light-text">Last 30 Days</p>
                        </div>
                        <div class=" ms-5 d-flex justify-content-between align-items-center ">

                            <div class="col-md-11 d-flex flex-column justify-content-center align-items-center ">
                                <img src="{{asset('customer-assets/img/Images/Notes.png')}}" style="width: 160px; height: 160px;">
                                <p class="mt-2 filter-label">Data Not Found For the selected filter</p>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <div class=" row mx-4 mt-3  d-flex justify-content-between ">
                <div class="col-md-4 p-1">
                    <div class="other-right-box-table ">
                        <div class=" m-3 d-flex justify-content-between">
                            <p class="order-text">ShipmentsnDetails</p>
                            <p class="light-text">Last 30 Days</p>
                        </div>
                        <div class=" ms-5 d-flex justify-content-between align-items-center ">

                            <div class="col-md-11 d-flex flex-column justify-content-center align-items-center ">
                                <img src="{{asset('customer-assets/img/Images/India map.png')}}" style="width: 300px; height: 300px;">
                                <p class="mt-2"><img src="/assets/Images/liner-gradient.png"
                                        style="width: 150px; height: 10px;"></p>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="col-md-4 p-1">
                    <div class="other-right-box-table ">
                        <div class=" m-3 d-flex justify-content-between">
                            <p class="order-text">Shipment-Zone</p>
                            <p class="li">Last 30 Days</p>
                        </div>
                        <div class=" ms-5 d-flex justify-content-between align-items-center ">
                        </div>
                        <div class="d-flex justify-content-between list-table">
                            <li>Zone Ale</li>
                            <li>0</li>
                        </div>
                        <div class="d-flex justify-content-between list-table">
                            <li>Zone B</li>
                            <li>0</li>
                        </div>
                        <div class="d-flex justify-content-between list-table">
                            <li>Zone C</li>
                            <li>0</li>
                        </div>
                        <div class="d-flex justify-content-between list-table">
                            <li>Zone D</li>
                            <li>0</li>
                        </div>
                        <div class="d-flex justify-content-between list-table">
                            <li>Zone E</li>
                            <li>0</li>
                        </div>




                    </div>
                </div>
                <div class="col-md-4 p-1">
                    <div class="other-right-box-table ">
                        <div class=" m-3 d-flex justify-content-between">
                            <p class="order-text">Revenew</p>

                        </div>
                        <div class=" ms-5 d-flex justify-content-between align-items-center ">
                        </div>
                        <div class="d-flex justify-content-between list-table">
                            <li>Last 90 days</li>
                            <li>$0</li>
                        </div>
                        <div class="d-flex justify-content-between list-table">
                            <li>This Week</li>
                            <li>$0</li>
                        </div>
                        <div class="d-flex justify-content-between list-table">
                            <li>This Month</li>
                            <li>$0</li>
                        </div>
                        <div class="d-flex justify-content-between list-table ">
                            <li>This Quater</li>
                            <li>$0</li>
                        </div>




                    </div>
                </div>

            </div>


        </div>
        </div>
        <div class="container-fulid bg-secondary-subtle p-3 mt-3">
            <div class="container-fulid mx-4 other-right-box ">
                <div class=" m-3 d-flex justify-content-between">
                    <p class="order-text"> ShipmentsnDetails</p>
                    <p class="light-text">Last 30 Days</p>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Header 1</th>
                                <th>Header 2</th>
                                <th>Header 3</th>
                                <th>Header 4</th>
                                <th>Header 4</th>
                                <th>Header 4</th>
                                <th>Header 4</th>
                                <th>Header 4</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                            </tr>

                        </tbody>
                    </table>
                </div>


                <div class=" ms-5 d-flex justify-content-between align-items-center ">

                    <div class="col-md-11 d-flex flex-column justify-content-center align-items-center ">
                        <img src="{{asset('customer-assets/img/Images/Notes.png')}}" style="width: 200px; height: 200px;">
                        <p class="mt-2 filter-label">Data Not Found For the selected filter</p>
                    </div>

                </div>

            </div>
    </main>
@endsection
@section('script')
@endsection
