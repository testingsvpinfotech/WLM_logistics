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
                                    <form id="userTypes" method="POST">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Group Name</label>
                                                <input type="text" class="form-control rounded" id="name" value="{{ old('name')}}" name="name" placeholder="Group Name">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4">Description</label>
                                                <textarea name="description" id="description" class="form-control rounded" placeholder="Description">{{ old('description')}}</textarea>
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
    var view = "{{ route('admin.view-fuel-group') }}";
    var callurl = "{{ route('admin.store-fuel-group') }}";
 </script>
 <script src="{{ asset('admin-assets/admin_custome_js/usertypes_master/add_usertype.js')}}"></script>
@endsection