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
                        <span style="float:right;"><a href="{{route('admin.download-courier-pincode')}}" title="Download Sample File" class="btn btn-outline-success"><i class="fa fa-arrow-circle-down" style="font-size:17px;"></i></a></span>                        
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <form id="pincodecourier" method="POST">
                                        <p style="color: red;" id="error"></p>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Date </label>
                                                <input type="date" class="form-control rounded" id="date" value="{{date('Y-m-d')}}" name="date" placeholder="Company Name">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Courier Name</label>
                                                <Select name="courier_type" class="form-control rounded" id="courier_type">
                                                    <option value="">--Courier --</option>
                                                    @foreach ($Courier as $key=>$val)
                                                    <option value="{{$val->pincode_table}}">{{$val->company_name}}</option>
                                                    @endforeach
                                                </Select>
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputPassword4">Upload File </label>
                                                <input type="file" class="form-control rounded" id="csv_file" name="csv_file">
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
    var view = "{{ route('admin.add-courier-pincode') }}";
    var callurl = "{{ route('admin.upload-domestic-pincode') }}";
</script>
<script src="{{ asset('admin-assets/admin_custome_js/courierwisePincode/add_courierwisePincode.js')}}"></script>
<script src="{{ asset('admin-assets/admin_custome_js/courier_company/add_courier_company.js')}}"></script>
@endsection