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
                                <p id="error" style="color:red;"></p>    <br>                                     
                                <div class="col-12">
                                    <form id="domesticFuel" method="POST">
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Date</label>
                                                <input type="date" class="form-control rounded" value="{{date('Y-m-d')}}" id="date"  name="date">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Fuel Group</label>
                                                <select name="fuel_group" id="fuel_group" class="form-control rounded">
                                                    <option value="">Select fuel group</option>
                                                    @foreach ($fuelGroup as $key=> $val)
                                                    <option value="{{$val->id}}">{{$val->name}}</option>
                                                    @endforeach
                                                </select>
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Courier </label>
                                                <select name="courier" id="courier" class="form-control rounded">
                                                    <option value="">Select Courier</option>
                                                    <option value="0">ALL</option>
                                                    @foreach ($courier as $key=> $val)
                                                    <option value="{{$val->id}}">{{$val->company_name}}</option>
                                                    @endforeach
                                                </select>
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Docket Charges</label>
                                                <input type="text" class="form-control rounded"  id="docket_charges"  name="docket_charges" placeholder="Docket Charges">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Min Pickup Charges</label>
                                                <input type="text" class="form-control rounded"  id="min_pickup_charges"  name="min_pickup_charges" placeholder="Min Pickup Charges">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Pickup Charges In % </label>
                                                <input type="text" class="form-control rounded"  id="pickup_percentage"  name="pickup_percentage" placeholder="Pickup Charges In %">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Min Rov Charges</label>
                                                <input type="text" class="form-control rounded"  id="min_rov_charges"  name="min_rov_charges" placeholder="Min Rov Charges">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">ROV Charges In % </label>
                                                <input type="text" class="form-control rounded"  id="rov_percentage"  name="rov_percentage" placeholder="ROV Charges In %">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Min ODA Charges</label>
                                                <input type="text" class="form-control rounded"  id="min_oda_charges"  name="min_oda_charges" placeholder="Min ODA Charges">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">ODA Charges Per KG</label>
                                                <input type="text" class="form-control rounded"  id="oda_per_kg"  name="oda_per_kg" placeholder="ODA Charges Per KG">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Min Handaling Charges</label>
                                                <input type="text" class="form-control rounded"  id="handaling_charges"  name="handaling_charges" placeholder="Min Handaling Charges">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Handaling Charges Per KG</label>
                                                <input type="text" class="form-control rounded"  id="handaling_per_kg"  name="handaling_per_kg" placeholder="Handaling Charges Per KG">
                                                <p style="color:red;"></p>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-outline-primary" style="float:right;">Submit</button>
                                    </form>
                                </div>
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
 <script>
    var view = "{{ route('admin.view-domestic-fuel-master') }}";
    var callurl = "{{ route('admin.fuel-master-store') }}";
 </script>
 <script src="{{ asset('admin-assets/admin_custome_js/domesticFuelMaster/add_fuel.js')}}"></script>
@endsection