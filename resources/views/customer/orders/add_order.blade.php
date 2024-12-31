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
                            <li class="active domestic">Domestic Order</li>
                            <li class="international"><a href="{{route('app.international-order')}}">International Order</a></li>
                        </ul>
                        <hr style="background: grey !important; margin-top:0px;">
                  </div>
                    <form id="DomesticOrderForm" class="domestic-view" method="POST">
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="order_menu mb-3">
                                    <li class="active">Single Order</li>
                                    <li>Bulk Order</li>
                                </ul>
                            </div>
                            <div class="col-md-2">
                                <p><span class="roud-r step1">1</span> Buyer Details</p> <br>
                                <p><span class="roud-r step2">2</span> Pickup Details</p> <br>
                                <p><span class="roud-r step3">3</span> Order Details</p> <br>
                                <p><span class="roud-r step4">4</span> Package Details</p>
                            </div>
                            <div class="col-md-10">
                                <div id="step1">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5>Add Buyer Details</h5>
                                            <p>To whom is the order being delivered? <span style="color:grey;">(Buyer's
                                                    Info)</span></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-4">
                                            <label for="mobileNumber">Mobile Number</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-transparent border-right-0"
                                                        id="basic-addon1"><span style="font-size: 12px;">+91</span></span>
                                                </div>
                                                <input type="text" class="form-control buttonCall" maxlength="10"
                                                    minlength="10" name="buy_mobile" id="buy_mobile"
                                                    placeholder="Mobile Number" aria-label="Password"
                                                    aria-describedby="basic-email">
                                                <p style="color:red;"></p>
                                            </div>
                                            
                                        </div>
                                        <div class="form-group mb-0 col-md-4">
                                            <label for="fullName">Full Name</label>
                                            <input type="text" class="form-control" name="buy_full_name"
                                                id="buy_full_name" placeholder="Enter full name">
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-4">
                                            <label for="email">Email (Optional)</label>
                                            <input type="email" class="form-control" id="buy_email" name="buy_email"
                                                placeholder="Enter email">
                                            <p style="color:red;"></p>
                                        </div>
                                        <span style="color:blue; font-size:13px; cursor:pointer;" id="alterstatus">+ Add
                                            Alternate Mobile
                                            Number, Buyer's
                                            Company Name, Buyer's GSTIN </span>
                                    </div>
                                    <div class="row alternate_status" style="display: none;">
                                        <div class="form-group mb-0 col-md-4">
                                            <label for="mobileNumber">Alternate Mobile Number</label>
                                            <input type="text" class="form-control" maxlength="10" minlength="10"
                                                id="buy_alter_mobile" name="buy_alter_mobile"
                                                placeholder="Alternate Mobile Number">
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-4">
                                            <label for="fullName">Buyer's Company Name</label>
                                            <input type="text" class="form-control" id="buy_company_name"
                                                name="buy_company_name" placeholder="Buyer's Company Name">
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-4">
                                            <label for="email">Buyer's GSTIN</label>
                                            <input type="text" class="form-control" id="buy_gst_in" name="buy_gst_in"
                                                placeholder="Enter Buyer's GSTIN">
                                            <p style="color:red;"></p>
                                        </div>
                                    </div>
                                    <p>Where is the order being delivered to? <span style="color: gray">(Buyer's
                                            Address)</span></p>
                                    <div class="row">
                                        <div class="form-group mb-0 col-md-8">
                                            <label for="email">Complete Address</label>
                                            <input type="text" class="form-control" id="buy_delivery_address"
                                                name="buy_delivery_address"
                                                placeholder="House/Floor No. Building Name or Street, Locality">
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-4">
                                            <label for="email">LandMark</label>
                                            <input type="text" class="form-control" id="buy_delivery_landmark"
                                                name="buy_delivery_landmark" placeholder="LandMark">
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-3">
                                            <label for="email">Pincode</label>
                                            <input type="text" class="form-control" maxlength="6" minlength="6"
                                                id="buy_delivery_pincode" name="buy_delivery_pincode"
                                                placeholder="Pincode">
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-3">
                                            <label for="email">City</label>
                                            <input type="text" class="form-control" id="buy_delivery_city"
                                                name="buy_delivery_city" placeholder="City">
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-3">
                                            <label for="email">State</label>
                                            <select class="form-control" id="buy_delivery_state"
                                                name="buy_delivery_state">
                                                <option value="">-- select state -- </option>
                                                @foreach ($state as $val)
                                                    <option value="{{ $val->id }}">{{ $val->name }}</option>
                                                @endforeach
                                            </select>
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-3">
                                            <label for="email">Country</label>
                                            <input type="text" class="form-control" id="buy_delivery_country"
                                                name="buy_delivery_country" placeholder="Country">
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-12">
                                            <input type="checkbox" id="billing_status_check" name="billing_status"
                                                checked>
                                            Billing address is same as the shipping address
                                        </div>
                                    </div>
                                    {{-- billing address start --}}
                                    <div class="row billing_status" style="display: none;">
                                        <h6><b>Billing Address</b></h6>
                                        <div class="form-group mb-0 col-md-4">
                                            <label for="mobileNumber">Mobile Number</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-transparent border-right-0"
                                                        id="basic-addon1"><span style="font-size: 12px;">+1</span></span>
                                                </div>
                                                <input type="text" class="form-control buttonCall" maxlength="10" minlength="10"
                                                    name="buy_billing_mobile" id="buy_billing_mobile"
                                                    placeholder="Mobile Number" aria-label="Password"
                                                    aria-describedby="basic-email">
                                            </div>
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-4">
                                            <label for="fullName">Full Name</label>
                                            <input type="text" class="form-control" name="buy_full_billing_name"
                                                id="buy_full_billing_name" placeholder="Enter full name">
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-4">
                                            <label for="email">Email (Optional)</label>
                                            <input type="email" class="form-control" id="buy_billing_email"
                                                name="buy_billing_email" placeholder="Enter email">
                                            <p style="color:red;"></p>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="row billing_status" style="display: none;">
                                        <div class="form-group mb-0 col-md-8">
                                            <label for="email">Complete Address</label>
                                            <input type="text" class="form-control" id="buy_delivery_billing_address"
                                                name="buy_delivery_billing_address"
                                                placeholder="House/Floor No. Building Name or Street, Locality">
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-4">
                                            <label for="email">LandMark</label>
                                            <input type="text" class="form-control" id="buy_delivery_billing_landmark"
                                                name="buy_delivery_billing_landmark" placeholder="LandMark">
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-3">
                                            <label for="email">Pincode</label>
                                            <input type="text" class="form-control" maxlength="6" minlength="6"
                                                id="buy_delivery_billing_pincode" name="buy_delivery_billing_pincode"
                                                placeholder="Pincode">
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-3">
                                            <label for="email">City</label>
                                            <input type="text" class="form-control" id="buy_delivery_billing_city"
                                                name="buy_delivery_billing_city" placeholder="City">
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-3">
                                            <label for="email">State</label>
                                            <select class="form-control" id="buy_delivery_billing_state"
                                                name="buy_delivery_billing_state">
                                                <option value="">-- select state -- </option>
                                                @foreach ($state as $val)
                                                    <option value="{{ $val->id }}">{{ $val->name }}</option>
                                                @endforeach
                                            </select>
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-3">
                                            <label for="email">Country</label>
                                            <input type="text" class="form-control" id="buy_delivery_billing_country"
                                                name="buy_delivery_billing_country" placeholder="Country">
                                            <p style="color:red;"></p>
                                        </div>
                                    </div>
                                    {{-- end billing addres --}}
                                    <button type="button" style="float: right" class="btn btn-outline-primary "
                                        onclick="nextStep(2)">Next</button>
                                </div>

                                <!-- Step 2: Pickup Details -->
                                <div id="step2" style="display:none;">
                                    <h5>Pickup Address</h5>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="pickupSearch">Address</label>
                                            <select name="pickup_address" class="form-control" id="pickup_address">
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
                                            <label for="fullName">Warehouse Name</label>
                                            <input type="text" class="form-control" name="pickup_contact_person"
                                                id="pickup_contact_person" placeholder="Warehouse Name">
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
                                        <div class="form-group mb-0 col-md-3">
                                            <label for="email">Warehouse Registerd Name</label>
                                            <input type="text" class="form-control" id="warehouse_r_name"
                                                name="warehouse_r_name" placeholder="Warehouse Registerd Name">
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-6">
                                            <label for="email">Return Address</label>
                                            <input type="text" class="form-control" id="return_address"
                                                name="return_address" placeholder="Return Address">
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-3">
                                            <label for="email">Return Pincode</label>
                                            <input type="text" class="form-control" id="return_pincode"
                                                name="return_pincode" placeholder="Return Pincode">
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-12">
                                            <button type="button" style="float: right;" id="pickup_address_submission"  class="btn btn-primary">Save
                                                Address</button>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-outline-secondary"
                                        onclick="prevStep(1)">Back</button>
                                    <button type="button" class="btn btn-outline-primary"
                                        onclick="nextStep(3)">Next</button>
                                </div>

                                <!-- Step 3: Order Details -->
                                <div id="step3" style="display:none;">
                                    <h5>Order Details</h5>
                                    <div class="row">
                                        <div class="form-group mb-0 col-md-4">
                                            <label for="orderID">Order ID (Auto Generated)</label>
                                            <input type="text" class="form-control" id="order_id" name="order_id"
                                                value="" readonly placeholder="Order ID (Auto Generated)">
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-4">
                                            <label for="orderDate">Order Date</label>
                                            <input type="date" class="form-control" name="orderDate" id="orderDate"
                                                value="{{ date('Y-m-d') }}">
                                            <p style="color:red;"></p>
                                            <input type="hidden" name="order_channel" value ="Custom">
                                        </div>
                                        <div class="form-group mb-0 col-md-4" style="display:none;'">
                                            <label for="orderDate">Order Channel</label>
                                            <select name="order_channel" class="form-control" id="order_channel">
                                                <option value="Custom">CUSTOM</option>
                                                <option value="instagram">Add Custom Channel : Instagram</option>
                                                <option value="facebook">Add Custom Channel : Facebook</option>
                                                <option value="whatsapp">Add Custom Channel : Whatsapp</option>
                                            </select>
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="button" id="reseller_button"
                                                style="color: blue !important; text-decoration: none;"
                                                class="btn btn-link">+ Add Order Tag, Reseller's Name</button>
                                        </div>
                                        <input type="hidden" id="ewayAccess" value="0">
                                    </div>
                                    <div class="row reseller_button_status" style="display: none;">
                                        <div class="form-group mb-0 col-md-4">
                                            <label for="orderID">Order Tag</label>
                                            <input type="text" class="form-control" id="order_tag" name="order_tag"
                                                value="" readonly placeholder="Order Tag">
                                            <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mb-0 col-md-4">
                                            <label for="orderID">Reseller's Name</label>
                                            <input type="text" class="form-control" id="resellar_name"
                                                name="resellar_name" value="" readonly
                                                placeholder="Reseller's Name">
                                            <p style="color:red;"></p>
                                        </div>
                                    </div>
                                    <div id="productList">
                                        <div class="product-item">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label for="productName">Product 1 Name</label>
                                                    <input type="text" class="form-control" name="productName[]"
                                                        placeholder="Enter product name">
                                                        <p style="color:red;"></p>
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="unitPrice">Unit Price</label>
                                                    <input type="text" class="form-control unit-price"
                                                        name="unitPrice[]" value="0.00">
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="quantity">Quantity</label>
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <button type="button"
                                                                class="btn btn-default quantity-minus">-</button>
                                                        </span>
                                                        <input type="text" class="form-control quantity"
                                                            name="quantity[]" value="1">
                                                        <span class="input-group-btn">
                                                            <button type="button"
                                                                class="btn btn-default quantity-plus">+</button>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="productCategory">Product Category</label>
                                                    <input type="text" class="form-control" name="productCategory[]"
                                                        placeholder="Enter category">
                                                    <input type="hidden" class="form-control total-price" readonly
                                                        value="0.00">
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button"
                                                        class="btn btn-danger rounded-btn btn-remove-product hidedelete"
                                                        style="margin-top: 25px;" disabled><i
                                                            class="fa fa-trash"></i></button>
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="productCategory">Weight</label>
                                                    <input type="text" class="form-control" name="weight[]"
                                                        placeholder="Weight">
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="productCategory">Length</label>
                                                    <input type="text" class="form-control" name="length[]"
                                                        placeholder="Length">
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="productCategory">Height</label>
                                                    <input type="text" class="form-control" name="height[]"
                                                        placeholder="Height">
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="productCategory">Width</label>
                                                    <input type="text" class="form-control" name="width[]"
                                                        placeholder="Width">
                                                </div>
                                                <div class="col-md-12">
                                                    <a class="btn btn-link btn-show-details"
                                                        style="color: blue !important;  text-decoration: none;">+ Add HSN
                                                        Code, SKU,
                                                        Tax Rate and Discount <span
                                                            style="color:grey !important;"></span>optional</a>
                                                </div>
                                            </div>
                                            <div class="additional-details" style="display:none; margin-top: 20px;">
                                                <div class="row">
                                                    <div class="form-group col-md-3">
                                                        <label for="order_hsn_code">HSN Code</label>
                                                        <input type="text" class="form-control" id="order_hsn_code"
                                                            name="order_hsn_code[]"
                                                            placeholder="enter your product HSN code" value="">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="order_sku">SKU</label>
                                                        <input type="text" class="form-control" id="order_sku"
                                                            name="order_sku[]" placeholder="enter product SKU"
                                                            value="">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="order_tax_rate">Tax Rate</label>
                                                        <input type="text" class="form-control" id="order_tax_rate"
                                                            name="order_tax_rate[]" placeholder="%" value="">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="order_product_discount">Product Discount</label>
                                                        <input type="text" class="form-control"
                                                            id="order_product_discount" name="order_product_discount[]"
                                                            placeholder="0.00" value="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="button" id="addProduct"
                                                style="color: blue !important; text-decoration: none;"
                                                class="btn btn-link mt-3">+ Add Another
                                                Product</button>
                                        </div>
                                        <div class="form-group mb-0 col-md-12">
                                            <label>Payment Mode</label><br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="paymentMode"
                                                    id="Prepaid" value="Prepaid" checked>
                                                <label class="form-check-label" for="Prepaid">Prepaid</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="paymentMode"
                                                    id="CoD" value="CoD">
                                                <label class="form-check-label" for="CoD">Cash on Delivery</label>
                                                <p style="color:red;"></p>
                                            </div>
                                        </div>
                                        <div class="form-group mt-2 mb-0 col-md-4">
                                            <label for="mobileNumber">Risk Type</label>
                                                <select class="form-control buttonCall" name="riskType" id="riskType">
                                                    @foreach (riskType() as $key => $val )
                                                    <option value="{{$key}}"
                                                     @if ($key ==1)
                                                     {{'selected'}}
                                                     @endif
                                                    >{{$val}}</option>
                                                    @endforeach
                                                </select>
                                                <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mt-2 mb-0 col-md-2">
                                            <label for="mobileNumber">INVOICE No</label>
                                            <input type="text" class="form-control buttonCall"
                                                name="invoice_no" id="invoice_no"
                                                placeholder="INVOICE No" aria-label="Password">
                                                <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mt-2 mb-0 col-md-2">
                                            <label for="mobileNumber">INVOICE AMOUNT</label>
                                            <input type="text" class="form-control buttonCall"
                                                name="invoice_value" id="invoice_value"
                                                placeholder="INVOICE VALUE (AMOUNT)" aria-label="Password" value="0" >
                                                <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mt-2 mb-0 col-md-2">
                                            <label for="mobileNumber">EWAY No</label>
                                            <input type="text" class="form-control buttonCall"
                                                name="eway_no" id="eway_no"
                                                placeholder="EWAY No" aria-label="Password" 
                                                aria-describedby="basic-email">
                                                <p style="color:red;"></p>
                                        </div>
                                        <div class="form-group mt-2 mb-0 col-md-2">
                                            <label for="mobileNumber">INSURANSE CHARGES</label>
                                            <input type="text" class="form-control buttonCall"
                                                name="insuranse_chargeses" id="insuranse_chargeses"
                                                placeholder="INSURANSE CHARGES" aria-label="Password" value="0"
                                                aria-describedby="basic-email">
                                                <p style="color:red;"></p>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="button" id="add_charges"
                                                style="color: blue !important; text-decoration: none;"
                                                class="btn btn-link mt-3">+ Add Shipping Charges, Giftwrap, Transaction fee
                                            </button>
                                        </div>
                                        <div class="col-md-12 show_charges mt-3" style="display: none">
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
                                                            name="order_shipping_charges" id="order_shipping_charges"
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
                                                            name="order_gift_wrap" id="order_gift_wrap"
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
                                                            name="order_transaction_fee" id="order_transaction_fee"
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
                                                            name="order_discounts" id="order_discounts"
                                                            placeholder="0.00" aria-label="Password" value="0"
                                                            aria-describedby="basic-email">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-4">
                                            <p>Sub-total for Product</p>
                                            <p>Other Charges</p>
                                            <p>Discount</p> <br>
                                            <p><b>Total Order Value</b></p>
                                        </div>
                                        <div class="col-md-6"></div>
                                        <div class="col-md-3 text-right">
                                            <p>₹ <span id="grandTotal">0.00</span> <input type="hidden"
                                                    name="product_sub_total" id="product_sub_total"></p>
                                            <p>₹ <span class="product_other_charges">0.00</span> <input type="hidden"
                                                    name="product_other_charges" class="product_other_charges"></p>
                                            <p>₹ <span class="product_discount">0.00</span> <input type="hidden"
                                                    name="product_discount" class="product_discount"></p> <br>
                                            <p><b>₹ <span class="order_total">0.00</span></b><input type="hidden"
                                                    name="order_total" class="order_total"></p>
                                        </div>
                                    </div>
                                    <div style="float: right;">
                                        <button type="button" class="btn btn-outline-secondary"
                                            onclick="prevStep(2)">Back</button>
                                        <button type="button" class="btn btn-outline-primary"
                                            onclick="nextStep(4)">Next</button>
                                    </div>

                                </div>

                                <!-- Step 4: Package Details -->
                                <div id="step4" style="display:none;">
                                    <h5>Package Details</h5>
                                    <!-- Package details input fields go here -->
                                     <p style="color:red;" id="error"></p>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="">Dead Weight</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" placeholder="0.00"
                                                    aria-label="Email" aria-describedby="basic-email" name="dead_weight" id="dead_weight">
                                                <div class="input-group-append">
                                                    <span class="input-group-text bg-transparent border-left-0"
                                                        id="basic-email">KG</span>
                                                </div>
                                                <p style="color: red;"></p>
                                            </div>
                                      p/div>
                                    </div>
                                    <label for="">Volumetric Weight</label>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="0.00"
                                                    aria-label="Email" aria-describedby="basic-email" id="length" name="length">
                                                <div class="input-group-append">
                                                    <span class="input-group-text bg-transparent border-left-0"
                                                        id="basic-email">CM (L)</span>
                                                </div>
                                                <p style="color: red;"></p>
                                            </div>
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="0.00"
                                                    aria-label="Email" aria-describedby="basic-email" id="breath" name="breath">
                                                <div class="input-group-append">
                                                    <span class="input-group-text bg-transparent border-left-0"
                                                        id="basic-email">CM (B)</span>
                                                </div>
                                                <p style="color: red;"></p>
                                            </div>
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="0.00"
                                                    aria-label="Email" aria-describedby="basic-email" id="height" name="height">
                                                <div class="input-group-append">
                                                    <span class="input-group-text bg-transparent border-left-0"
                                                        id="basic-email">CM (H)</span>
                                                </div>
                                                <p style="color: red;"></p>
                                            </div>
                                        </div>
                                        <div class="col-md-12"> <br> <br>
                                            <label for="">Volumetric Weight <span
                                                    id="voluematrix_weight">0.00</span>
                                                <input type="hidden" name="voluematrix_weight"
                                                    class="voluematrix_weight"></label> KG <br><br>
                                        </div>
                                        <div class="col-md-12">
                                            <label for=""><b>Applicable Weight <span
                                                        id="applicable_weight">0.00</span> KG</b> <input type="hidden"
                                                    name="applicable_weight" class="applicable_weight"></label>
                                        </div>
                                    </div> <br>
                                    <div style="float: right;"><button type="button" class="btn btn-outline-secondary"
                                            onclick="prevStep(3)">Back</button>
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
        var getEway = "{{ route('app.get-ewayacess')}}";
    </script>
    <script src="{{ asset('customer-assets/js/domestic_orders.js') }}"></script>
    <script src="{{ asset('customer-assets/js/international_orders.js') }}"></script>
@endsection
