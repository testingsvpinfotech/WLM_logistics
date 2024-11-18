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
                                    <form id="courierCompany" method="POST">
                                        <p style="color: red;" id="error"></p>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Company Name</label>
                                                <input type="text" class="form-control rounded" id="company_name" value="{{ old('company_name')}}" name="company_name" placeholder="Company Name">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Company Type</label>
                                                <Select name="company_type" class="form-control rounded" id="company_type">
                                                 @foreach (company_type() as $key=>$val)
                                                <option value="{{$key}}">{{$val}}</option>                                                     
                                                 @endforeach
                                                </Select>
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Domestic url <span style="color:grey;">(optional)</span></label>
                                                <input type="text" class="form-control rounded" id="domestic_url" value="{{ old('domestic_url')}}" name="domestic_url" placeholder="Domestic url">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">International url <span style="color:grey;">(optional)</span></label>
                                                <input type="text" class="form-control rounded" id="international_url" value="{{ old('international_url')}}" name="international_url" placeholder="International url">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputPassword4">Description <span style="color:grey;">(optional)</span></label>
                                                <textarea name="description" id="description" class="form-control rounded" placeholder="Description">{{ old('description')}}</textarea>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputPassword4">Company Logo </label>
                                                <input type="file" class="form-control rounded" id="img_logo"  name="img_logo" >
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
    var view = "{{ route('admin.view-courier-company') }}";
    var callurl = "{{ route('admin.store-courier-company') }}";
 </script>
 <script src="{{ asset('admin-assets/admin_custome_js/courier_company/add_courier_company.js')}}"></script>
@endsection