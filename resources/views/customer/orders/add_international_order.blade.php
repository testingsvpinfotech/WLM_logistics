@extends('customer.layout.admin_header')
@section('content')
    <style>
        .roud-r {
            font-size: 12px;
            border: 1px solid #745be7;
            border-radius: 20px;
            height: 22px;
            display: inline-block;
            width: 22px;
            text-align: center;
            color: #333;
            background-color: #fff;
            margin-right: 10px;
            padding-top: 2px;
        }

        label{
            font-weight: bold !important;
        }
        .tabinline[_ngcontent-vas-c262] li.active[_ngcontent-vas-c262] span[_ngcontent-vas-c262] {
            padding: 8px 10px;
            color: #745be7;
            font-size: 14px;
            border-bottom: 5px solid #745be7;
        }
        .order_type {
            padding-left: 0px !important;
            font-size: 14px !important;
            list-style-type: none;
            display: flex; /* Enable flexbox */
            justify-content:flex-start; /* Distribute space between items */
            list-style-type: none; /* Remove bullet points */
        }
        .order_type li {
            padding: 10px; /* Add padding to each item */
            cursor: pointer; /* Change cursor to pointer on hover */
            transition: background-color 0.3s; /* Smooth transition for background color */
        }
        .order_type .active {
            color: #745be7;
            font-size: 14px;
            border-bottom: 5px solid #745be7;
        }
        .order_type li:hover {
            background-color: #f0f0f0; /* Change background color on hover */
        }

        .order_menu {
            padding-left: 0px !important;
            font-size: 13px !important;
            list-style-type: none;
            display: flex; /* Enable flexbox */
            justify-content:flex-start; /* Distribute space between items */
            list-style-type: none; /* Remove bullet points */
        }
        .order_menu li {
            font-size: 13px;
            cursor: pointer;
            font-weight: 500;
            color: #191919;
            padding: 4px 12px;
            border: 1px solid lightgrey;
        }
        .order_menu .active {
            color: #745be7;
        }

    </style>
    <main>
        <div class="container-fluid site-width">
            <div class="row card mr-2 ml-2">
                <div class="card-body">
                  <div class="col-md-12">
                       <h4 style="font-weight:bold;">Add Order</h4>
                        <ul class="order_type mb-0">
                            <li class="domestic" ><a href="{{route('app.add-orders')}}">Domestic Order</a></li>
                            <li class="active international">International Order</li>
                        </ul>
                        <hr style="background: grey !important; margin-top:0px;">
                  </div>
                
                    <form id="InternationalOrderFrom" class="international-view" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="order_menu mb-3">
                                    <li class="active single" onclick="InterCourier('single');">Single Order (E-Commerce)</li>
                                    <li>Bulk Upload</li>
                                    <li class="air" onclick="InterCourier('air')">Air Cargo / FBA</li>
                                    <li class="ocean_full_container" onclick="InterCourier('ocean_full_container')">Ocean Full Container</li>
                                    <li class="ocean_less_than_container" onclick="InterCourier('ocean_less_than_container')">Ocean Less Than Container</li>
                                </ul>
                            </div>
                            <div class="col-md-2">
                                <p><span class="roud-r step-in-1">1</span> Buyer Details</p> <br>
                                <p><span class="roud-r step-in-2">2</span> Pickup Details</p> <br>
                                <p><span class="roud-r step-in-3">3</span> Order Details</p> <br>
                                <p><span class="roud-r step-in-4">4</span> Package Details</p>
                            </div>
                            <div class="col-md-10">
                                <div id="step-in-1">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5>Add Buyer Details</h5>
                                            <p>Where is the order being delivered to? <span style="color:grey;">(Buyer's
                                                    Address)</span></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-12 shipment_purpose_other" style="display: none;">
                                            <label>Do you want to ship to FBA ?</label><br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="ship_to_fba"
                                                    id="yes" value="yes">
                                                <label class="form-check-label" for="yes">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="ship_to_fba"
                                                    id="no" value="no" checked>
                                                <label class="form-check-label" for="no">No</label>
                                                <p style="color:red;"></p>
                                            </div>
                                        </div>
                                        <div class="form-group mb-0 col-md-2">
                                            <label for="mobileNumber">Country</label>
                                            <select name="inter_country_id" class="form-control" id="inter_country_id">
                                                @foreach ($country as $val)
                                                <option value="{{$val->id}}" @if($val->id == 183) {{'selected'}} @endif>{{$val->country_name}}</option>
                                                @endforeach
                                            </select>
                                            <p style="color: red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-3">
                                            <label for="fullName">Pincode</label>
                                            <input type="text" class="form-control" name="inter_buy_pincode"
                                                id="inter_buy_pincode" maxlength="6" minlength="6" placeholder="Pincode">
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-3">
                                            <label for="email">State</label>
                                            <input type="text" class="form-control" id="inter_buy_state" name="inter_buy_state"
                                                placeholder="Enter State">
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-2">
                                            <label for="email">City</label>
                                            <input type="text" class="form-control" id="inter_buy_city" name="inter_buy_city"
                                                placeholder="Enter City">
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-2">
                                            <label for="mobileNumber">Currency</label>
                                            <select name="inter_currency_id" class="form-control" id="inter_currency_id">
                                                @foreach ($country as $val)
                                                <option value="{{$val->id}}" @if($val->id == 76) {{'selected'}} @endif >{{$val->currency_code.' -- '.$val->symbol_code}}</option>
                                                @endforeach
                                            </select>
                                            <p style="color: red;"></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group mb-0 col-md-6">
                                            <label for="email">Address Line 1</label>
                                            <input type="text" class="form-control" id="inter_buy_address_line1"
                                                name="inter_buy_address_line1"
                                                placeholder="House/Floor No. Building Name or Street, Locality">
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-6">
                                            <label for="email">Address Line 1</label>
                                            <input type="text" class="form-control" id="inter_buy_address_line2"
                                                name="inter_buy_address_line2" placeholder="House/Floor No. Building Name or Street, Locality">
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-12">
                                            <input type="checkbox" id="inter_billing_status_check" name="inter_billing_status"
                                                checked>
                                            Billing address is same as the shipping address
                                        </div>
                                    </div>
                                    <label>To whom is the order being delivered? <span style="color: gray">(Buyer's
                                        Info)</span></label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="mobileNumber">Mobile No</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-transparent border-right-0"
                                                        id="basic-addon1"><span style="font-size: 12px;">+1</span></span>
                                                </div>
                                                <input type="text" class="form-control buttonCall" maxlength="10" minlength="10"
                                                    name="inter_buy_mobile" id="inter_buy_mobile"
                                                    placeholder="Mobile No" aria-label="Password"
                                                    aria-describedby="basic-email">
                                                    <p style="color:red;"></p>
                                            </div>
                                        </div>
                                        <div class="form-group mb-0 col-md-4">
                                            <label for="fullName">Full Name</label>
                                            <input type="text" class="form-control" id="inter_buy_full_name"
                                                name="inter_buy_full_name" placeholder="Full Name">
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-4">
                                            <label for="fullName">Email Id</label>
                                            <input type="text" class="form-control" id="inter_buy_email"
                                                name="inter_buy_email" placeholder="Email Id">
                                            <p style="color:red;"></p>
                                        </div>
                                        <span style="color:blue; font-size:13px; cursor:pointer;" id="inter_alterstatus">+ Add
                                            Alternate Mobile
                                            Number, Buyer's
                                            Company Name, Buyer's GSTIN </span>
                                    </div>
                                    <div class="row shipment_purpose_own">
                                        <div class="form-group mb-0 col-md-12">
                                            <label>Shipment Purpose ?</label><br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="shipment_purpose"
                                                    id="gift" value="Gift(CSB4)">
                                                <label class="form-check-label" for="gift"> Gift(CSB4) </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="shipment_purpose"
                                                    id="Sample" value="Sample(CSB4)">
                                                <label class="form-check-label" for="Sample"> Sample(CSB4) </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="shipment_purpose"
                                                    id="Commercial" value="Commercial(CSB5)">
                                                <label class="form-check-label" for="Commercial"> Commercial(CSB5)</label>
                                            </div>
                                            <p id="shipment_purpose_error" style="color:red;"></p>
                                        </div>
                                    </div>
                                    <div class="row shipment_purpose_other" style="display: none;">
                                        <div class="form-group mb-0 col-md-12">
                                            <label>Shipment Purpose ?</label><br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="shipment_purpose"
                                                    id="gift" value="Gift(CSB4)">
                                                <label class="form-check-label" for="gift"> Gift(CSB4) </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="shipment_purpose"
                                                    id="Sample" value="Sample(CSB4)">
                                                <label class="form-check-label" for="Sample"> Sample(CSB4) </label>
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="shipment_purpose"
                                                    id="Commercial" value="Commercial(CSB5)">
                                                <label class="form-check-label" for="Commercial"> Commercial(CSB5)</label>
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="shipment_purpose"
                                                    id="Cargo" value="Cargo">
                                                <label class="form-check-label" for="Cargo"> Cargo</label>
                                                <p style="color:red;"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row inter_alternate_status" style="display: none;">
                                        <div class="form-group mb-0 col-md-4">
                                            <label for="mobileNumber">Alternate Mobile Number</label>
                                            <input type="text" class="form-control" maxlength="10" minlength="10"
                                                id="inter_buy_alter_mobile" name="inter_buy_alter_mobile"
                                                placeholder="Alternate Mobile Number">
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-4">
                                            <label for="fullName">Buyer's Company Name</label>
                                            <input type="text" class="form-control" id="inter_buy_company_name"
                                                name="inter_buy_company_name" placeholder="Buyer's Company Name">
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-4">
                                            <label for="email">Buyer's GSTIN</label>
                                            <input type="text" class="form-control" id="inter_buy_gst_in" name="inter_buy_gst_in"
                                                placeholder="Enter Buyer's GSTIN">
                                            <p style="color:red;"></p>
                                        </div>
                                    </div>
                                   
                                    
                                    {{-- billing address start --}}
                                    <div class="row inter_billing_status" style="display: none;">
                                        <h6><b>Billing Address</b></h6>
                                        <div class="form-group mb-0 col-md-3">
                                            <label for="mobileNumber">Country</label>
                                            <select name="inter_delivery_country_id" class="form-control" id="inter_delivery_country_id">
                                                @foreach ($country as $val)
                                                <option value="{{$val->id}}" @if($val->id == 183) {{'selected'}} @endif>{{$val->country_name}}</option>
                                                @endforeach
                                            </select>
                                            <p style="color: red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-3">
                                            <label for="fullName">Pincode</label>
                                            <input type="text" class="form-control" name="inter_delivery_pincode"
                                                id="inter_delivery_pincode" maxlength="6" minlength="6" placeholder="Pincode">
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-3">
                                            <label for="email">State</label>
                                            <input type="text" class="form-control" id="inter_delivery_state" name="inter_delivery_state"
                                                placeholder="Enter State">
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-3">
                                            <label for="email">City</label>
                                            <input type="text" class="form-control" id="inter_delivery_city" name="inter_delivery_city"
                                                placeholder="Enter City">
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-6">
                                            <label for="email">Address Line 1</label>
                                            <input type="text" class="form-control" id="inter_delivery_address_line1"
                                                name="inter_delivery_address_line1"
                                                placeholder="House/Floor No. Building Name or Street, Locality">
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-6">
                                            <label for="email">Address Line 1</label>
                                            <input type="text" class="form-control" id="inter_delivery_address_line2"
                                                name="inter_delivery_address_line2" placeholder="House/Floor No. Building Name or Street, Locality">
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="mobileNumber">Mobile No</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-transparent border-right-0"
                                                        id="basic-addon1"><span style="font-size: 12px;">+1</span></span>
                                                </div>
                                                <input type="text" class="form-control buttonCall" maxlength="10" minlength="10"
                                                    name="inter_delivery_mobile" id="inter_delivery_mobile"
                                                    placeholder="Mobile No" aria-label="Password"
                                                    aria-describedby="basic-email">
                                            </div>
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-4">
                                            <label for="fullName">Full Name</label>
                                            <input type="text" class="form-control" id="inter_delivery_full_name"
                                                name="inter_delivery_full_name" placeholder="Full Name">
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-4">
                                            <label for="fullName">Email Id</label>
                                            <input type="text" class="form-control" id="inter_delivery_email"
                                                name="inter_delivery_email" placeholder="Email Id">
                                            <p style="color:red;"></p>
                                        </div>
                                        <hr>
                                    </div>

                                    {{-- end billing addres --}}
                                    <button type="button" style="float: right" class="btn btn-outline-primary "
                                        onclick="nextStepInter(2)">Next</button>
                                </div>

                                <!-- Step 2: Pickup Details -->
                                <div id="step-in-2" style="display:none;">
                                    <h5>Pickup Address</h5>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="pickupSearch">Address</label>
                                            <select name="inter_pickup_address" class="form-control" id="inter_pickup_address">
                                                <option value="primary">{{$pickup_address->address_line1}}</option>
                                                @foreach ($addressbook as $val)
                                                <option value="{{$val->id}}">{{$val->address}}</option>
                                                @endforeach
                                            </select>
                                            <p style="color: green;"></p>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <button class="btn btn-primary mt-4" type="button" id="add_pickup_button">add
                                                Address</button>
                                            <button class="btn btn-secondary mt-4" type="button"
                                                id="cancel_pikup_button">Cancel</button>
                                        </div>
                                    </div>
                                    <div class="row pikup_status" style="display: none;">
                                        <h6><b>Add New Pick Up Address</b></h6>
                                        <div class="form-group mb-0 col-md-3">
                                            <label for="fullName">Contact Person</label>
                                            <input type="text" class="form-control" name="pickup_contact_person"
                                                id="pickup_contact_person" placeholder="Contact Person">
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-3">
                                            <label for="mobileNumber">Contact Number</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-transparent border-right-0"
                                                        id="basic-addon1"><span style="font-size: 12px;">+91</span></span>
                                                </div>
                                                <input type="text" class="form-control buttonCall"
                                                    name="pickup_contact_no" id="pickup_contact_no" maxlength="10" minlength="10"
                                                    placeholder="Contact Number" aria-label="Password"
                                                    aria-describedby="basic-email">
                                                    <p style="color:red;"></p>
                                            </div>
                                          
                                        </div>
                                        <div class="form-group mb-0 col-md-3">
                                            <label for="mobileNumber">Alternate Phone No</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-transparent border-right-0"
                                                        id="basic-addon1"><span style="font-size: 12px;">+91</span></span>
                                                </div>
                                                <input type="text" class="form-control buttonCall" maxlength="10" minlength="10"
                                                    name="pickup_alter_contact" id="pickup_alter_contact"
                                                    placeholder="Alternate Phone No" aria-label="Password"
                                                    aria-describedby="basic-email">
                                            </div>
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-3">
                                            <label for="email">Email (Optional)</label>
                                            <input type="email" class="form-control" id="pickup_email"
                                                name="pikcup_email" placeholder="Enter email">
                                            <p style="color:red;"></p>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="row pikup_status" style="display: none;">
                                        <div class="form-group mb-0 col-md-8">
                                            <label for="email">Complete Address</label>
                                            <input type="text" class="form-control" id="add_pickup_address"
                                                name="add_pickup_address"
                                                placeholder="House/Floor No. Building Name or Street, Locality">
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-4">
                                            <label for="email">LandMark</label>
                                            <input type="text" class="form-control" id="pickup_landmark"
                                                name="pickup_landmark" placeholder="LandMark">
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-3">
                                            <label for="email">Pincode</label>
                                            <input type="text" class="form-control" maxlength="6" minlength="6" id="pickup_pincode"
                                                name="pickup_pincode" placeholder="Pincode">
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-3">
                                            <label for="email">City</label>
                                            <input type="text" class="form-control" id="pickup_city" name="pickup_city"
                                                placeholder="City">
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-3">
                                            <label for="email">State</label>
                                            <select class="form-control" id="pickup_state" name="pickup_state">
                                                <option value="">-- select state -- </option>
                                                @foreach ($state as $val)
                                                    <option value="{{ $val->id }}">{{ $val->name }}</option>
                                                @endforeach
                                            </select>
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-3">
                                            <label for="email">Country</label>
                                            <input type="text" class="form-control" id="pikup_country"
                                                name="pickup_country" placeholder="Country">
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-12">
                                            <button type="button" style="float: right;" id="pickup_address_submission"  class="btn btn-primary">Save
                                                Address</button>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-outline-secondary"
                                        onclick="prevStepInter(1)">Back</button>
                                    <button type="button" class="btn btn-outline-primary"
                                        onclick="nextStepInter(3)">Next</button>
                                </div>

                                <!-- Step 3: Order Details -->
                                <div id="step-in-3" style="display:none;">
                                    <h5>Order Details</h5>
                                    <div class="row">
                                        <div class="form-group mb-0 col-md-4">
                                            <label for="orderID">Order ID (Auto Generated)</label>
                                            <input type="text" class="form-control" id="inter_order_id" name="inter_order_id"
                                                value="" readonly placeholder="Order ID (Auto Generated)">
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-4">
                                            <label for="orderDate">Order Date</label>
                                            <input type="date" class="form-control" name="inter_orderDate" id="inter_orderDate"
                                                value="{{ date('Y-m-d') }}">
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-4">
                                            <label for="orderDate">Order Channel</label>
                                            <select name="inter_order_channel" class="form-control" id="inter_order_channel">
                                                <option value="Custom">CUSTOM</option>
                                            </select>
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="button" id="inter_reseller_button"
                                                style="color: blue !important; text-decoration: none;"
                                                class="btn btn-link">+ Add Order Tag, Channel Invoice No., Channel Invoice Date</button>
                                        </div>
                                        <br><br>
                                        <div class="col-md-12">
                                            <button type="button" id="inter_International_Order_Clauses"
                                                style="color: blue !important; text-decoration: none;"
                                                class="btn btn-link"> International Order Clauses </button>
                                        </div>
                                    </div>
                                    <div class="row inter_reseller_button_status" style="display: none;">
                                        <div class="form-group mb-0 col-md-6">
                                            <label for="orderID">Order Tag</label>
                                            <input type="text" class="form-control" id="inter_order_tag" name="inter_order_tag"
                                                value="" readonly placeholder="Order Tag">
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-3">
                                            <label for="orderID">Channel Invoice No.</label>
                                            <input type="text" class="form-control" id="inter_channel_invoice"
                                                name="inter_channel_invoice" value=""
                                                placeholder="Channel Invoice No.">
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-3">
                                            <label for="orderID">Channel Invoice Date</label>
                                            <input type="date" class="form-control" id="inter_channel_invoice_date"
                                                name="inter_channel_invoice_date" value=""
                                                placeholder="Channel Invoice No.">
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-3">
                                            <label for="orderID">Payment Transaction ID</label>
                                            <input type="text" class="form-control" id="inter_payment_transection_id"
                                                name="inter_payment_transection_id" value=""
                                                placeholder="Payment Transaction ID">
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-3">
                                            <label for="orderID">Website URL </label>
                                            <input type="text" class="form-control" id="inter_transection_url"
                                                name="inter_transection_url" value=""
                                                placeholder="Channel Url">
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-3">
                                            <label for="orderID">Signature Type</label>
                                            <select name="inter_signature_type" class="form-control" id="inter_signature_type">
                                                <option value="0"> No Signature Required </option>
                                                <option value="1"> Signature Required </option>
                                                <option value="2"> Adult Signature Required </option>
                                            </select>
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-3"> <br><br>
                                            <input type="checkbox" name="inter_saturday_delivery" id="inter_saturday_delivery">
                                            <label for="orderID"> Saturday Delivery</label>
                                            <p style="color:red;"></p>
                                        </div>
                                    </div>
                                    <div class="row inter_International_Order_Clauses" style="display: none;">
                                        <div class="form-group mb-0 col-md-4">
                                            <label>Is Commodity under 3C applicable?</label><br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inter_3Capplicable"
                                                    id="yes" value="yes" checked>
                                                <label class="form-check-label" for="prepaid">Yes</label>
                                                <input class="form-check-input" type="radio" name="inter_3Capplicable"
                                                    id="no" value="no" checked>
                                                <label class="form-check-label" for="no">No</label>
                                            </div>
                                        </div>
                                        <div class="form-group mb-0 col-md-4">
                                            <label>Is Meis applicable?</label><br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inter_Meis_applicable"
                                                    id="yes" value="yes" checked>
                                                <label class="form-check-label" for="prepaid">Yes</label>
                                                <input class="form-check-input" type="radio" name="inter_Meis_applicable"
                                                    id="no" value="no" checked>
                                                <label class="form-check-label" for="no">No</label>
                                            </div>
                                        </div>
                                        <div class="form-group mb-0 col-md-4">
                                            <label>IGST Payment Status</label><br>
                                            <select name="inter_Payment_Status" class="form-control" id="inter_Payment_Status">
                                                <option value="" disabled> Please Select </option>
                                                <option value="A"> A- Not Applicable </option>
                                                <option value="B"> B- LUT or Export under Bond </option>
                                                <option value="C">C- Export Against Payment of IGST</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-0 col-md-3">
                                            <label>Inco Terms</label><br>
                                            <select name="inter_Inco_Terms" class="form-control" id="inter_Inco_Terms">
                                                <option value="FOB">FOB</option>
                                                <option value="CIF" selected>CIF</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-0 col-md-3">
                                            <label for="orderID">Tax Id</label>
                                            <input type="text" class="form-control" id="inter_tax_id"
                                                name="inter_tax_id" value=""
                                                placeholder="Tax Id">
                                            <p style="color:red;"></p>
                                        </div>
                                    </div>
                                    <div id="inter_productList">
                                        <div class="inter_product-item">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label for="productName">Product 1 Name</label>
                                                    <input type="text" class="form-control" name="inter_productName[]"
                                                        placeholder="Enter product name">
                                                        <p style="color:red;"></p>
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="unitPrice">Unit Price</label>
                                                    <input type="text" class="form-control inter_unit-price"
                                                        name="inter_unitPrice[]" value="0.00">
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="quantity">Quantity</label>
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <button type="button"
                                                                class="btn btn-default inter_quantity-minus">-</button>
                                                        </span>
                                                        <input type="text" class="form-control inter_quantity"
                                                            name="inter_quantity[]" value="1">
                                                        <span class="input-group-btn">
                                                            <button type="button"
                                                                class="btn btn-default inter_quantity-plus">+</button>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="productCategory">Product Category</label>
                                                    <input type="text" class="form-control" name="inter_productCategory[]"
                                                        placeholder="Enter category">
                                                    <input type="hidden" class="form-control inter_total-price" readonly
                                                        value="0.00">
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button"
                                                        class="btn btn-danger rounded-btn inter_btn-remove-product inter_hidedelete"
                                                        style="margin-top: 25px;" disabled><i
                                                            class="fa fa-trash"></i></button>
                                                </div>
                                            </div>
                                            <div class="inter_additional-details">
                                                <div class="row">
                                                    <div class="form-group col-md-3">
                                                        <label for="order_hsn_code">HSN Code</label>
                                                        <input type="text" class="form-control" id="inter_order_hsn_code"
                                                            name="inter_order_hsn_code[]"
                                                            placeholder="enter your product HSN code" value="">
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="order_sku">SKU</label>
                                                        <input type="text" class="form-control" id="inter_order_sku"
                                                            name="inter_order_sku[]" placeholder="enter product SKU"
                                                            value="">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="order_tax_rate">Product Description</label>
                                                        <input type="text" class="form-control" id="inter_order_product_desription"
                                                            name="inter_order_product_desription[]" placeholder="Product Description" value="">
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="order_tax_rate">Tax Rate</label>
                                                        <input type="text" class="form-control" id="inter_order_tax_rate"
                                                            name="inter_order_tax_rate[]" placeholder="%" value="">
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="order_product_discount">Product Discount</label>
                                                        <input type="text" class="form-control"
                                                            id="inter_order_product_discount" name="inter_order_product_discount[]"
                                                            placeholder="0.00" value="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="button" id="inter_addProduct"
                                                style="color: blue !important; text-decoration: none;"
                                                class="btn btn-link mt-3">+ Add Another
                                                Product</button>
                                        </div>
                                        <div class="form-group mb-0 col-md-12">
                                            <label>Payment Mode</label><br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inter_paymentMode"
                                                    id="prepaid" value="prepaid" checked>
                                                <label class="form-check-label" for="prepaid">Prepaid</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="button" id="inter_add_charges"
                                                style="color: blue !important; text-decoration: none;"
                                                class="btn btn-link mt-3">+ Add Shipping Charges, Giftwrap, Transaction fee
                                            </button>
                                        </div>
                                        <div class="col-md-12 inter_show_charges mt-3" style="display: none">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label for="mobileNumber">Shipping Charges</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-transparent border-right-0"
                                                                id="basic-addon1"><span
                                                                    style="font-size: 12px;">₹</span></span>
                                                        </div>
                                                        <input type="text" class="form-control buttonCall"
                                                            name="inter_order_shipping_charges" id="inter_order_shipping_charges"
                                                            placeholder="0.00" aria-label="Password" value="0"
                                                            aria-describedby="basic-email">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="mobileNumber">Gift Wrap</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-transparent border-right-0"
                                                                id="basic-addon1"><span
                                                                    style="font-size: 12px;">₹</span></span>
                                                        </div>
                                                        <input type="text" class="form-control buttonCall"
                                                            name="inter_order_gift_wrap" id="inter_order_gift_wrap"
                                                            placeholder="0.00" aria-label="Password" value="0"
                                                            aria-describedby="basic-email">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="mobileNumber">Transaction Fee</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-transparent border-right-0"
                                                                id="basic-addon1"><span
                                                                    style="font-size: 12px;">₹</span></span>
                                                        </div>
                                                        <input type="text" class="form-control buttonCall"
                                                            name="inter_order_transaction_fee" id="inter_order_transaction_fee"
                                                            placeholder="0.00" aria-label="Password" value="0"
                                                            aria-describedby="basic-email">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="mobileNumber">Discounts</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-transparent border-right-0"
                                                                id="basic-addon1"><span
                                                                    style="font-size: 12px;">₹</span></span>
                                                        </div>
                                                        <input type="text" class="form-control buttonCall"
                                                            name="inter_order_discounts" id="inter_order_discounts"
                                                            placeholder="0.00" aria-label="Password" value="0"
                                                            aria-describedby="basic-email">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <p>Sub-total for Product</p>
                                            <p>Other Charges</p>
                                            <p>Discount</p> <br>
                                            <p><b>Total Order Value</b></p>
                                        </div>
                                        <div class="col-md-6"></div>
                                        <div class="col-md-3 text-right">
                                            <p>₹ <span id="inter_grandTotal">0.00</span> <input type="hidden"
                                                    name="inter_product_sub_total" id="inter_product_sub_total"></p>
                                            <p>₹ <span class="inter_product_other_charges">0.00</span> <input type="hidden"
                                                    name="inter_product_other_charges" class="inter_product_other_charges"></p>
                                            <p>₹ <span class="inter_product_discount">0.00</span> <input type="hidden"
                                                    name="inter_product_discount" class="inter_product_discount"></p> <br>
                                            <p><b>₹ <span class="inter_order_total">0.00</span></b><input type="hidden"
                                                    name="inter_order_total" class="inter_order_total"></p>
                                        </div>
                                    </div>
                                    <div style="float: right;">
                                        <button type="button" class="btn btn-outline-secondary"
                                            onclick="prevStepInter(2)">Back</button>
                                        <button type="button" class="btn btn-outline-primary"
                                            onclick="nextStepInter(4)">Next</button>
                                    </div>

                                </div>

                                <!-- Step 4: Package Details -->
                                <div id="step-in-4" style="display:none;">
                                    <h5>Package Details</h5>
                                    <!-- Package details input fields go here -->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="">Dead Weight</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" placeholder="0.00"
                                                    aria-label="Email" aria-describedby="basic-email" name="inter_dead_weight" id="inter_dead_weight">
                                                <div class="input-group-append">
                                                    <span class="input-group-text bg-transparent border-left-0"
                                                        id="basic-email">KG</span>
                                                </div>
                                                <p style="color: red;"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <label for="">Volumetric Weight</label>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="0.00"
                                                    aria-label="Email" aria-describedby="basic-email" id="inter_length" name="inter_length">
                                                <div class="input-group-append">
                                                    <span class="input-group-text bg-transparent border-left-0"
                                                        id="basic-email">CM</span>
                                                </div>
                                                <p style="color: red;"></p>
                                            </div>
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-2">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="0.00"
                                                    aria-label="Email" aria-describedby="basic-email" id="inter_breath" name="inter_breath">
                                                <div class="input-group-append">
                                                    <span class="input-group-text bg-transparent border-left-0"
                                                        id="basic-email">CM</span>
                                                </div>
                                                <p style="color: red;"></p>
                                            </div>
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-2">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="0.00"
                                                    aria-label="Email" aria-describedby="basic-email" id="inter_height" name="inter_height">
                                                <div class="input-group-append">
                                                    <span class="input-group-text bg-transparent border-left-0"
                                                        id="basic-email">CM</span>
                                                </div>
                                                <p style="color: red;"></p>
                                            </div>
                                        </div>
                                        <div class="col-md-12"> <br> <br>
                                            <label for="">Volumetric Weight <span
                                                    id="inter_voluematrix_weight">0.00</span>
                                                <input type="hidden" name="inter_voluematrix_weight"
                                                    class="inter_voluematrix_weight"></label> KG <br><br>
                                        </div>
                                        <div class="col-md-12">
                                            <label for=""><b>Applicable Weight <span
                                                        id="inter_applicable_weight">0.00</span> KG</b> <input type="hidden"
                                                    name="inter_applicable_weight" class="inter_applicable_weight"></label>
                                        </div>
                                    </div> <br>
                                    <div style="float: right;"><button type="button" class="btn btn-outline-secondary"
                                            onclick="prevStepInter(3)">Back</button>
                                        <button type="submit" class="btn btn-success" >Add Order</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </main>
@endsection
@section('script')
    <script>
        var pickup_callURL = "{{ route('app.pickup-address-store')}}";
        var pinURL = "{{ route('app.get-pincode') }}";
        var callurl = "{{ route('app.store-orders')}}";
        var Intercallurl = "{{ route('app.store-international')}}";
        var view = "{{ route('app.view-orders')}}";
    </script>
    <script src="{{ asset('customer-assets/js/domestic_orders.js') }}"></script>
    <script src="{{ asset('customer-assets/js/international_orders.js') }}"></script>
@endsection
