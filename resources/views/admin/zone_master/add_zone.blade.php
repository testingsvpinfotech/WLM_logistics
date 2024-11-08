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
                                    <form id="Zonemaster" method="POST">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Zone Name</label>
                                                <input type="text" class="form-control rounded" id="zone_name" value="{{ old('zone_name')}}" name="zone_name" placeholder="Zone Name">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputEmail4">About Zone</label>
                                                <textarea name="description" id="description" class="form-control" placeholder="About Zone"></textarea>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">State</label> <br>
                                                <select class="form-control multiselect-container multiple_state" onchange="return getCity(this.value);" name="state_id[]" id="state_id" multiple>
                                                    @foreach ($state as $val)
                                                        <option value="{{$val->id}}">{{strtolower($val->name)}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputEmail4">City</label><br>
                                                <select class="form-control multiselect-container multiple_state" name="city_id[]" id="city_id" multiple>
                                                    <option value="">-- select City --</option>
                                                 </select>
                                                 <p style="color:red;" id="city_error"></p>
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
    var view = "{{ route('admin.view-zone-master') }}";
    var callurl = "{{ route('admin.store-zone') }}";
    var getCityurl = "{{ route('admin.get-city') }}";
 </script>
 <script src="{{asset('admin-assets/admin_custome_js/zone_master/add_zone.js')}}"></script>
 <script src="{{ asset('admin-assets/admin_custome_js/usertypes_master/add_usertype.js')}}"></script>
@endsection