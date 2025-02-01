@extends('admin.layout.admin_header')
@section('content')
<main>
    <div class="container-fluid site-width">
        <!-- START: Card Data-->
        <div class="row">
            <div class="col-12 mt-4">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">{{$title}}</h6>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail4">Account Code : <b>{{$editData->Customer_Code}}</b> &nbsp;&nbsp;&nbsp;Email : <b>{{$editData->email}}</b> &nbsp;&nbsp;&nbsp; Mobile No : <b>{{$editData->mobile_number}}</b>&nbsp;&nbsp;&nbsp; Wallet Amount : <b>{{$editData->wallet_amount}}</b></label>
                                    </div>
                                    <form id="updatecustomer" method="POST">
                                        <p style="color: red;" id="error"></p>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Customer Name</label>
                                                <input type="hidden" name="id" value="{{$editData->id}}">
                                                <input type="text" class="form-control rounded" id="personal_name" value="{{ $editData->personal_name}}" name="personal_name" placeholder="Customer Name">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Surname Name</label>
                                                <input type="hidden" name="id" value="{{$editData->id}}">
                                                <input type="text" class="form-control rounded" id="surname" value="{{ $editData->surname}}" name="surname" placeholder="Surname Name">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Company Name</label>
                                                <input type="hidden" name="id" value="{{$editData->id}}">
                                                <input type="text" class="form-control rounded" id="company_name" value="{{ $editData->company_name}}" name="company_name" placeholder="Company Name">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Order Type</label>
                                                <select name="order_idea" id="order_idea" class="form-control buttonCall">
                                                    <option value="">Please Select</option>
                                                    @foreach (ordersMenus() as $key=>$val )
                                                    <option value="{{$key}}"
                                                        @if ($key==$editData->order_idea)
                                                        {{'selected'}}
                                                        @endif
                                                        >{{$val}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <p style="color: red;"></p>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Category Type</label>
                                                <select class="form-control rounded" name="category_id" id="category_id">
                                                    <option value=""> -- Select Category -- </option>
                                                    <option value="1"
                                                        @if ($editData->category_id=='1')
                                                        {{'selected'}}
                                                        @endif
                                                        >SHIPPING FULFILMENT IN INDIA
                                                    </option>
                                                    <option value="2"
                                                        @if ($editData->category_id=='2')
                                                        {{'selected'}}
                                                        @endif
                                                        >CROSS BORDER COMMERCE
                                                    </option>
                                                </select>
                                                <p style="color: red;"></p>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Demo shedule</label>
                                                <input type="date" class="form-control rounded" id="demo_date" value="{{ !empty($editData->demo_schedule)? date('Y-m-d',strtotime($editData->demo_schedule)):''}}" name="demo_date" placeholder="Domestic url">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Account No </label>
                                                <input type="text" class="form-control rounded" id="account_no" value="{{ $editData->account_no}}" name="account_no" placeholder="Account No">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Account Type </label>
                                                <input type="text" class="form-control rounded" id="account_type" value="{{ $editData->account_type}}" name="account_type" placeholder="Account Type">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Account Holder Name </label>
                                                <input type="text" class="form-control rounded" id="account_holder_name" value="{{ $editData->account_holder_name}}" name="account_holder_name" placeholder="Account Holder Name">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">IFSC Code </label>
                                                <input type="text" class="form-control rounded" id="ifsc_code" value="{{ $editData->ifsc_code}}" name="ifsc_code" placeholder="IFSC Code">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Bank Name</label>
                                                <input type="text" class="form-control rounded" id="bank_name" value="{{ $editData->bank_name}}" name="bank_name" placeholder="Bank Name">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Branch Name</label>
                                                <input type="text" class="form-control rounded" id="branch_name" value="{{ $editData->branch_name}}" name="branch_name" placeholder="Branch Name">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">GST No</label>
                                                <input type="text" class="form-control rounded" id="gstno" value="{{ $editData->gstno}}" name="gstno" placeholder="GST No">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Domestic Fuel Group</label>
                                                <select name="fuel_group_id" id="fuel_group_id" class="form-control buttonCall">
                                                    <option value="">-- Select Fuel Group --</option>
                                                    @foreach ($domestic_fuel as $key => $val )
                                                    <option value="{{$val->id}}"
                                                        @if ($val->id == $editData->fuel_group_id)
                                                        {{'selected'}}
                                                        @endif
                                                        >{{$val->name}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <p style="color: red;"></p>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Domestic Rate Group</label>
                                                <select name="rate_group_id" id="rate_group_id" class="form-control buttonCall">
                                                    <option value="">-- Select Fuel Group --</option>
                                                    @foreach ($domestic_rate as $key => $val )
                                                    <option value="{{$val->id}}"
                                                        @if ($val->id == $editData->rate_group_id)
                                                        {{'selected'}}
                                                        @endif
                                                        >{{$val->name}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <p style="color: red;"></p>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">International fuel Group</label>
                                                <select name="inter_fuel_group" id="inter_fuel_group" class="form-control buttonCall">
                                                    <option value="">-- Select Fuel Group --</option>
                                                    @foreach ($international_fuel as $key => $val )
                                                    <option value="{{$val->id}}"
                                                        @if ($val->id == $editData->inter_fuel_group)
                                                        {{'selected'}}
                                                        @endif
                                                        >{{$val->name}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <p style="color: red;"></p>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">International Rate Group</label>
                                                <select name="inter_rate_group" id="inter_rate_group" class="form-control buttonCall">
                                                    <option value="">-- Select Fuel Group --</option>
                                                    @foreach ($international_rate as $key => $val )
                                                    <option value="{{$val->id}}"
                                                        @if ($val->id == $editData->inter_rate_group)
                                                        {{'selected'}}
                                                        @endif
                                                        >{{$val->name}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <p style="color: red;"></p>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputPassword4">Address </label>
                                                <textarea name="address_line1" id="address_line1" class="form-control rounded" placeholder="Address">{{ $editData->address_line1}}</textarea>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">LandMark</label>
                                                <input type="text" class="form-control rounded" id="address_line2" value="{{ $editData->address_line2}}" name="address_line2" placeholder="GST No">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Pincode</label>
                                                <input type="text" class="form-control rounded" maxlength="6" minlength="6" id="pincode" value="{{ $editData->pincode}}" name="pincode" placeholder="GST No">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Branch Name</label>
                                                <select name="branch_id" id="branch_id" class="form-control buttonCall">
                                                    <option value="">-- Select Branch --</option>
                                                    @foreach ($branches as $key => $val )
                                                    <option value="{{$val->id}}"
                                                        @if ($val->id == $editData->branch_id && $editData->branch_id !=0)
                                                        {{'selected'}}
                                                        @endif
                                                        >{{$val->branch_name}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <p style="color: red;"></p>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-outline-success" style="float:right;">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@section('script')
<script>
    var Route = "{{ url('/') }}";
    var view = "{{ route('admin.view-customer-master') }}";
    var callurl = "{{ route('admin.update-customer') }}";
</script>
<script src="{{ asset('admin-assets/admin_custome_js/customerMaster/edit_customer.js')}}"></script>
<script src="{{ asset('admin-assets/admin_custome_js/comancustomjs.js')}}"></script>
@endsection