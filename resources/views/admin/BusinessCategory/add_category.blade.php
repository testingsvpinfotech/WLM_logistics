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
                                    <form id="cateSubmission" autocomplete="off" enctype="multipart/form-data" method="POST">
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Category</label>
                                                <select class="form-control rounded" name="category_id" id="category_id">
                                                    <option value=""> -- Select Category -- </option>
                                                    @foreach (business_category() as $key => $val)
                                                    <option value="{{$key}}">{{$val}}</option>
                                                    @endforeach
                                                </select>
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Sub Category Name</label>
                                                <input type="text" class="form-control rounded" id="category_name" value="{{ old('category_name')}}" name="category_name" placeholder="Category Name">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Business Profile</label>
                                                <input type="file" class="form-control rounded" id="business_profile" value="{{ old('business_profile')}}" name="business_profile" placeholder="Contact No">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Description</label>
                                                <textarea name="discription" class="form-control rounded" id="discription" placeholder="Description">{{old('discription')}}</textarea>
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
    $('.select2').select2();
    var view = "{{ route('admin.view-business-category') }}";
    var callurl = "{{ route('admin.store-business-category') }}";
 </script>
 <script src="{{ asset('admin-assets/admin_custome_js/BusinessCategory/add_category.js')}}"></script>
@endsection