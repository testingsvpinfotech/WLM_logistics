@extends('admin.layout.admin_header')
@section('content')
<style>
    /* Style the Image Used to Trigger the Modal */
#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (Image) */
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Caption of Modal Image (Image Text) - Same Width as the Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation - Zoom in the Modal */
.modal-content, #caption {
  animation-name: zoom;
  animation-duration: 0.6s;
}

@keyframes zoom {
  from {transform:scale(0)}
  to {transform:scale(1)}
}

/* The Close Button */
.close {
  position: absolute;
  top: 65px;
  right: 35px;
  color: #fff;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}
</style>
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
                                    <form id="updateSubmission" autocomplete="off" enctype="multipart/form-data" method="POST">
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Category</label>
                                                <input type="hidden" name="id" value="{{$editData->id}}">
                                                <select class="form-control rounded" name="category_id" id="category_id">
                                                    <option value=""> -- Select Category -- </option>
                                                    @foreach (business_category() as $key => $val)
                                                    <option value="{{$key}}" @if ($key==$editData->category_id) {{'selected';}}
                                                    @endif>{{$val}}</option>
                                                    @endforeach
                                                </select>
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Sub Category Name</label>
                                                <input type="text" class="form-control rounded" id="category_name" value="{{ $editData->category_name }}" name="category_name" placeholder="Category Name">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Business Profile</label>
                                                <input type="file" class="form-control rounded" id="business_profile" value="{{ old('business_profile')}}" name="business_profile" placeholder="Contact No">
                                                <p style="color:red;"></p>
                                                @if (isset($editData->image))
                                                @php
                                                  $panIMg1 = 'admin-assets/category/'.$editData->image;
                                                @endphp
                                                   <a onclick="return ViewImage('{{$panIMg1}}');" style="color:blue; cursor:pointer;">View Profile</a> |
                                                   <a style="color:blue"
                                                   href="{{ route('admin.download-category', ['id' => $editData->image]) }}">
                                                   <i class="fas fa-download"></i>
                                               </a>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Description</label>
                                                <textarea name="discription" class="form-control rounded" id="discription" placeholder="Description">{{$editData->description}}</textarea>
                                                <p style="color:red;"></p>
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
        <!-- END: Card DATA-->
    </div>
</main>
 <!-- modal code  -->
 <img id="myImg" src="img_snow.jpg" alt="Snow" style="width:100%;max-width:300px">
 <div id="myModal" class="modal">
 <!-- The Close Button -->
 <span class="close">&times;</span>
 <!-- Modal Content (The Image) -->
 <img class="modal-content" id="img01">
 <!-- Modal Caption (Image Text) -->
 <div id="caption"></div>
 </div>
@endsection
@section('script')
 <script>
    $('.select2').select2();
    var Route = "{{ url('/') }}";
    var view = "{{ route('admin.view-business-category') }}";
    var callurl = "{{ route('admin.update-business-category') }}";
 </script>
 <script src="{{ asset('admin-assets/admin_custome_js/BusinessCategory/edit_category.js')}}"></script>
 <script src="{{ asset('admin-assets/admin_custome_js/comancustomjs.js') }}"></script>
@endsection