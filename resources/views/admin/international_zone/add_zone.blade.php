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
                        <span style="float:right;"><a href="{{route('admin.export-zone-master')}}" title="Download Sample File" class="btn btn-outline-success"><i class="fa fa-arrow-circle-down" style="font-size:17px;"></i></a></span>                        
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">                                           
                                <div class="col-12">
                                    <form id="internationalZone" method="POST">
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">From Date</label>
                                                <input type="date" class="form-control rounded" value="{{date('Y-m-d')}}" id="from_date"  name="from_date">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Courier Company</label>
                                                <select name="courier_company" id="courier_company" class="form-control rounded">
                                                    <option value="">Select Courier</option>
                                                    @foreach ($courier_company as $key=> $val)
                                                    <option value="{{$val->id}}">{{$val->company_name}}</option>
                                                    @endforeach
                                                </select>
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Type</label>
                                                <select name="internationalType" id="internationalType" class="form-control rounded">
                                                    <option value="">Select Type</option>
                                                    @foreach (internationalType() as $key=> $val)
                                                    <option value="{{$key}}">{{$val}}</option>
                                                    @endforeach
                                                </select>
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">CSV File</label>
                                                <input type="file" class="form-control rounded"  id="csv_file"  name="csv_file">
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
    var view = "{{ route('admin.view-zone-master') }}";
    var callurl = "{{ route('admin.store-add-zone') }}";
 </script>
 <script src="{{ asset('admin-assets/admin_custome_js/internationalZone/add_zone.js')}}"></script>
@endsection