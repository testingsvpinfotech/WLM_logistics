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
                                    <form id="updateuserTypes" method="PUT">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Rate Group</label>
                                                <input type="hidden" name="id" value="{{ $editData->id }}">
                                                <input type="text" class="form-control rounded" id="name" value="{{ $editData->name }}" name="name" placeholder="Rate Group">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4">Description</label>
                                                <textarea name="description" id="description" class="form-control rounded" placeholder="Description">{{ $editData->description }}</textarea>
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
@endsection
@section('script')
 <script>
    var view = "{{ route('admin.view-inet-rate-group') }}";
    var callurl = "{{ route('admin.update-inet-rate-group') }}";
 </script>
 <script src="{{ asset('admin-assets/admin_custome_js/usertypes_master/edit_usertype.js')}}"></script>
@endsection