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
                                    <form id="userUpdate" autocomplete="off" method="POST">
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Username</label>
                                                <input type="hidden" name="id" value="{{ $user->id}}">
                                                <input type="text" class="form-control rounded"  id="username" readonly autocomplete="true" value="{{ $user->username}}" name="username" placeholder="Username">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Password</label>
                                                <input type="password" class="form-control rounded" id="password" value="" name="password" placeholder="Password">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">User Full Name</label>
                                                <input type="text" class="form-control rounded" id="user_name" value="{{ $user->user_name}}" name="user_name" placeholder="User Full Name">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Contact No</label>
                                                <input type="text" class="form-control rounded" id="contact_no" value="{{ $user->contact_no}}" name="contact_no" placeholder="Contact No">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Altr Contact No</label>
                                                <input type="text" class="form-control rounded" id="alternate_contact_no" value="{{ $user->alternate_contact_no}}" name="alternate_contact_no" placeholder="Altr Contact No">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Email</label>
                                                <input type="text" class="form-control rounded" id="email" value="{{ $user->email}}" name="email" placeholder="Email">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">UserType</label>
                                                <select class="form-control select2" name="usertype" id="usertype" style="width: 100%;">
                                                    <option value="">Select userType</option>
                                                    @foreach ($userType as $val)
                                                    <option value="{{$val->id}}" @if (isset($user->usertype) && $user->usertype == $val->id) {{'selected'}} @endif>{{$val->name}}</option>
                                                    @endforeach
                                                  </select>
                                                  <p style="color:red"></p>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Branch Name</label>
                                                <select class="form-control select2" name="branch_id" id="branch_id" style="width: 100%;">
                                                    <option value="">Select Branch</option>
                                                    @foreach ($branch as $val)
                                                    <option value="{{$val->id}}" @if (isset($user->branch_id) && $user->branch_id == $val->id) {{'selected'}} @endif>{{$val->branch_id.' -- '.$val->branch_name}}</option>
                                                    @endforeach
                                                  </select>
                                                  <p style="color:red"></p>
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
    $('.select2').select2();
    var view = "{{ route('admin.view-user-master') }}";
    var callurl = "{{ route('admin.update-user') }}";
 </script>
 <script src="{{ asset('admin-assets/admin_custome_js/user_master/edit_user.js')}}"></script>
@endsection