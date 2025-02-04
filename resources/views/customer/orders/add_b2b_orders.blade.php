@extends('customer.layout.admin_header')
@section('content')
<style>
    .preferred-badge {
        background-color: #826AF9;
        color: white;
        padding: 5px 10px;
        border-radius: 15px;
        font-size: 12px;
        display: inline-block;
        margin-bottom: 5px;
    }

    .icon-circle {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: #E8EAF6;
    }

    .rating-circle {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: #E8EAF6;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 18px;
        font-weight: bold;
    }

    .highlight {
        border: 2px solid #826AF9;
        border-radius: 10px;
        padding: 10px;
    }

    .sidebar {
        background-color: #F5F5F5;
        padding: 15px;
        height: 100%;
    }

    .sidebar h5,
    .sidebar h6 {
        margin-bottom: 15px;
    }

    .sidebar p {
        margin-bottom: 10px;
    }

    .sidebar .icon {
        width: 40px;
        height: 40px;
        background-color: #F4F4F4;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        margin-right: 10px;
    }
</style>
<main>
    <div class="container-fluid site-width">
        <!-- START: Card Data-->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">{{$title}}</h6>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <p id="error" style="color:red;"></p>
                                <form id="b2bdomesticbooking" method="POST">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header" style="background: #4c66fb !important; Color:#fff;">
                                                    <h6 class="card-title" style="font-weight:600;">{{$title}}</h6>
                                                </div>
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <div class="form-row">
                                                            <div class="form-group col-md-3">
                                                                <label for="inputEmail4">Order Id</label>
                                                                <input type="text" name="order_id" readonly class="form-control rounded" id="order_id" placeholder="Order Id">
                                                                <p style="color:red;"></p>
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label for="inputEmail4">Order Type</label>
                                                                <select name="paymentMode" class="form-control rounded" id="paymentMode">
                                                                    <option value="Prepaid">Prepaid</option>
                                                                    <option value="Cod" disabled>Cash on Delivery</option>
                                                                </select>
                                                                <p style="color:red;"></p>
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label for="inputEmail4">Pickup type</label>
                                                                <select name="pickup_type" class="form-control rounded" id="pickup_type">
                                                                    <option value="1">Forward</option>
                                                                    <option value="2" selected>Reversible</option>
                                                                </select>
                                                                <p style="color:red;"></p>
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label for="inputEmail4">Wearhouse Location</label>
                                                                <select name="pickup_location_wearhouse" class="form-control rounded" id="pickup_location_wearhouse">
                                                                    <option value="">Select Wearhouse</option>
                                                                    @foreach ($addressbook as $key => $val )
                                                                    <option value="{{$val->id}}">{{$val->contact_person}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <p style="color:red;"></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-4 consigner_locations" style="display:none;">
                                        <div class="col-6">
                                            <div class="card">
                                                <div class="card-header" style="background: #4c66fb !important; Color:#fff;">
                                                    <h6 class="card-title" style="font-weight:600;">Consigner Information</h6>
                                                </div>
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <div class="form-row">
                                                            <div class="form-group col-md-12 mb-0">
                                                                <label for="inputEmail4">Consigner Name <span style="color:red; font-size:17px;font-weight:600;" class="mt-5">*</span></label>
                                                                <input type="text" name="consigner_name" class="form-control rounded" id="consigner_name" placeholder="Consigner Name">
                                                                <p style="color:red;"></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-12 mb-0">
                                                                <label for="inputEmail4">Phone No <span style="color:red; font-size:17px;font-weight:600;" class="mt-5">*</span></label>
                                                                <input type="text" name="consiger_phone_no" maxlength="10" minlength="10" class="form-control rounded" id="consiger_phone_no" placeholder="Phone No">
                                                                <p style="color:red;"></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-12 mb-0">
                                                                <label for="inputEmail4">GST Number (Optional)</label>
                                                                <input type="text" name="consiger_gst_no" class="form-control rounded" id="consiger_gst_no" placeholder="GST Number">
                                                                <p style="color:red;"></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="card">
                                                <div class="card-header" style="background: #4c66fb !important; Color:#fff;">
                                                    <h6 class="card-title" style="font-weight:600;">Consigner Address</h6>
                                                </div>
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <div class="form-row">
                                                            <div class="form-group col-md-12 mb-0">
                                                                <label for="inputEmail4" class="m-0">Consigner Address <span style="color:red; font-size:17px;font-weight:600;" class="mt-5">*</span></label>
                                                                <textarea name="consiger_address" class="form-control rounded" id="consiger_address" placeholder="Consigner Address"></textarea>
                                                                <p style="color:red;"></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-12 mb-0">
                                                                <label for="inputEmail4" class="m-0">Pincode<span style="color:red; font-size:17px;font-weight:600;" class="mt-5">*</span></label>
                                                                <input type="text" name="consiger_pincode" maxlength="6" minlength="6" class="form-control rounded" id="consiger_pincode" placeholder="Pincode">
                                                                <p style="color:red;"></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6 mb-0">
                                                                <label for="inputEmail4" class="m-0">City<span style="color:red; font-size:17px;font-weight:600;" class="mt-5">*</span></label>
                                                                <input type="text" name="consiger_city" class="form-control rounded" id="consiger_city" placeholder="City">
                                                                <p style="color:red;"></p>
                                                            </div>
                                                            <div class="form-group col-md-6 mb-0">
                                                                <label for="inputEmail4" class="m-0">State<span style="color:red; font-size:17px;font-weight:600;" class="mt-5">*</span></label>
                                                                <input type="text" name="consiger_state" class="form-control rounded" id="consiger_state" placeholder="State">
                                                                <p style="color:red;"></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-6">
                                            <div class="card">
                                                <div class="card-header" style="background: #4c66fb !important; Color:#fff;">
                                                    <h6 class="card-title" style="font-weight:600;">Consignee Information</h6>
                                                </div>
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6 mb-0">
                                                                <label for="inputEmail4">Consignee Name <span style="color:red; font-size:17px;font-weight:600;" class="mt-5">*</span></label>
                                                                <input type="text" name="consignee_name" class="form-control rounded" id="consignee_name" placeholder="Consignee Name">
                                                                <p style="color:red;"></p>
                                                            </div>
                                                            <div class="form-group col-md-6 mb-0">
                                                                <label for="inputEmail4">Company Name<span style="color:red; font-size:17px;font-weight:600;" class="mt-5">*</span></label>
                                                                <input type="text" name="company_name" class="form-control rounded" id="company_name" placeholder="Company Name">
                                                                <p style="color:red;"></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-12 mb-0">
                                                                <label for="inputEmail4">Phone No <span style="color:red; font-size:17px;font-weight:600;" class="mt-5">*</span></label>
                                                                <input type="text" name="phone_no" maxlength="10" minlength="10" class="form-control rounded" id="phone_no" placeholder="Phone No">
                                                                <p style="color:red;"></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-12 mb-0">
                                                                <label for="inputEmail4">GST Number (Optional)</label>
                                                                <input type="text" name="gst_no" class="form-control rounded" id="gst_no" placeholder="GST Number">
                                                                <p style="color:red;"></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="card">
                                                <div class="card-header" style="background: #4c66fb !important; Color:#fff;">
                                                    <h6 class="card-title" style="font-weight:600;">Consignee Address</h6>
                                                </div>
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <div class="form-row">
                                                            <div class="form-group col-md-12 mb-0">
                                                                <label for="inputEmail4" class="m-0">Consignee Address <span style="color:red; font-size:17px;font-weight:600;" class="mt-5">*</span></label>
                                                                <textarea name="consignee_address" class="form-control rounded" id="consignee_address" placeholder="Consignee Address"></textarea>
                                                                <p style="color:red;"></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-12 mb-0">
                                                                <label for="inputEmail4" class="m-0">Pincode<span style="color:red; font-size:17px;font-weight:600;" class="mt-5">*</span></label>
                                                                <input type="text" name="pincode" maxlength="6" minlength="6" class="form-control rounded" id="pincode" placeholder="Pincode">
                                                                <p style="color:red;"></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6 mb-0">
                                                                <label for="inputEmail4" class="m-0">City<span style="color:red; font-size:17px;font-weight:600;" class="mt-5">*</span></label>
                                                                <input type="text" name="city" class="form-control rounded" id="city" placeholder="City">
                                                                <p style="color:red;"></p>
                                                            </div>
                                                            <div class="form-group col-md-6 mb-0">
                                                                <label for="inputEmail4" class="m-0">State<span style="color:red; font-size:17px;font-weight:600;" class="mt-5">*</span></label>
                                                                <input type="text" name="state" class="form-control rounded" id="state" placeholder="State">
                                                                <p style="color:red;"></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-header" style="background: #19b5fe !important; Color:#fff;">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <h6 class="card-title" style="font-weight:600;">Number of Invoices</h6>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <h6 class="card-title" style="font-weight:600;">Number of Boxes</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-2 mb-3">
                                                    <div class="col-lg-6">
                                                        <select name="no_of_invoice" class="form-control rounded" id="no_of_invoice">
                                                            @for ($count = 1; $count <= 20; $count++)
                                                                <option value="{{$count}}">{{$count}}</option>
                                                                @endfor
                                                        </select>
                                                        <p style="color:red;"></p>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <select name="no_of_box" class="form-control rounded" id="no_of_box">
                                                            @for ($count = 1; $count <=100; $count++)
                                                                <option value="{{$count}}">{{$count}}</option>
                                                                @endfor
                                                        </select>
                                                        <p style="color:red;"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-lg-12">
                                            <table class="table table-bordered">
                                                <thead style="background: #19b5fe !important; Color:#fff;">
                                                    <tr class="table-header">
                                                        <th>No of Boxes<span class="text-danger">*</span></th>
                                                        <th>Product Name<span class="text-danger">*</span></th>
                                                        <th>HSN Code<span class="text-danger">*</span></th>
                                                        <th>LBH<span class="text-danger">*</span></th>
                                                        <th>Actual Weight<span class="text-danger">*</span></th>
                                                        <th>Chargeable Weight<span class="text-danger">*</span></th>
                                                        <th>Volume Matrix<span class="text-danger">*</span></th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="dynamicTable">
                                                    <tr>
                                                        <td><input type="number" step="any" name="no_of_pkt[]" id="no_of_pkt" class="form-control noOfBoxes" value="1" placeholder="No of Boxes"></td>
                                                        <td><input type="text" class="form-control" name="box_name[]" id="box_name" placeholder="Box Name"></td>
                                                        <td><input type="text" class="form-control" name="hsn_code[]" id="hsn_code" placeholder="HSN Code"></td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <input type="number" step="any" name="lenght[]" id="lenght" class="form-control" placeholder="L">
                                                                <input type="number" step="any" name="breath[]" id="breath" class="form-control" placeholder="B">
                                                                <input type="number" step="any" name="height[]" id="height" class="form-control" placeholder="H">
                                                            </div>
                                                        </td>
                                                        <td><input type="number" step="any" name="actual_weight[]" id="actual_weight" class="form-control" placeholder="Actual Weight"></td>
                                                        <td><input type="number" step="any" readonly name="chargable_weight[]" id="chargable_weight" class="form-control" placeholder="Chargeable Weight"></td>
                                                        <td><input type="number" step="any" readonly name="volumeMatrix[]" id="volumeMatrix" class="form-control" placeholder="Volume Matrix Weight"></td>
                                                        <td>
                                                            <button type="button" class="btn btn-outline-success action-btn add-row">+</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td class="pt-3"><b>Chargeable Weight:</b></td>
                                                        <td colspan="2"><input type="number" step="any" value="0" readonly name="total_chargable_weight" id="total_chargable_weight" class="form-control"></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-lg-12">
                                            <table class="table table-bordered" id="invoiceTable">
                                                <thead style="background: #19b5fe !important; Color:#fff;">
                                                    <tr class="table-header">
                                                        <th>Invoice Number<span class="text-danger">*</span></th>
                                                        <th>Invoice Date<span class="text-danger">*</span></th>
                                                        <th>Invoice Amount<span class="text-danger">*</span></th>
                                                        <th>EBN Number</th>
                                                        <th>EBN Expiry</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><input type="text" name="invoice_no[]" id="invoice_no" class="form-control" placeholder="Invoice Number"></td>
                                                        <td><input type="date" name="invoice_date[]" id="invoice_date" class="form-control" placeholder="mm/dd/yyyy"></td>
                                                        <td><input type="number" step="any" name="invoice_amount[]" id="invoice_amount" class="form-control" placeholder="Invoice Value"></td>
                                                        <td><input type="text" name="eway_no[]" id="eway_no" class="form-control" placeholder="EBN Number"></td>
                                                        <td><input type="date" name="eway_date[]" id="eway_date" class="form-control" placeholder="mm/dd/yyyy"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12 text-right">
                                        <br>
                                        <button type="submit" class="btn btn-outline-success mt-1 ml-1" style="float:right;">Save</button>
                                        <a href="{{route('app.view-orders')}}" class="btn btn-outline-danger mt-1 ">Back</a>
                                    </div>
                                </form>
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
<script>
    var pinURL = "{{ route('app.get-pincode') }}";
    var callurl = "{{ route('app.b2bbooking-store') }}";
    var view = "{{ route('app.view-orders')}}";
</script>
<script src="{{ asset('customer-assets/js/domesticb2b2_orders.js') }}"></script>
@endsection