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
                        <span style="float:right;"><a href="{{route('admin.add-courier-pincode')}}" title="Download Sample File" class="btn btn-outline-success">Add Pincode</a></span>                        
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <form action="{{route('admin.find-courier-pincode')}}" method="GET">
                                        <p style="color: red;" id="error"></p>
                                        <div class="form-row"> @csrf
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Pincode </label>
                                                <input type="text" class="form-control rounded" maxlength="6" minlength="6" id="pincode" value="{{!empty($_GET['pincode'])?$_GET['pincode']:''}}" name="pincode" placeholder="Pincode">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <button type="submit" class="btn btn-outline-primary mt-4"><i class="fa fa-search" aria-hidden="true"></i></button>
                                                <a href="{{route('admin.find-courier-pincode')}}"class="btn btn-outline-danger mt-4"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <th>SR.No</th>
                                            <th>Pincode</th>
                                            <th>Courier</th>
                                            <th>State</th>
                                            <th>City</th>
                                            <th>Zone</th>
                                            <th>Service</th>
                                            <th>Is ODA</th>
                                        </thead>
                                        <tbody>
                                            @if (!empty($pinList))
                                            @foreach ($pinList as $val)
                                            <tr>
                                                <td>{{$val['sr']}}</td>
                                                <td>{{$val['pincode']}}</td>
                                                <td>{{$val['courier']}}</td>
                                                <td>{{$val['state']}}</td>
                                                <td>{{$val['city']}}</td>
                                                <td>{{$val['zone']}}</td>
                                                <td>{{$val['service']}}</td>
                                                <td>{{$val['oda']}}</td>
                                            </tr>
                                            @endforeach
                                            @else
                                            <tr>
                                                <td colspan="8" style="color:red;">Pincode Not Found</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
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