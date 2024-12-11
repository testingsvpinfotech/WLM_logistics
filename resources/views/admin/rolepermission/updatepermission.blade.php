@extends('admin.layout.admin_header')
@section('content')
<main>
    <div class="container-fluid site-width">
        <!-- START: Card Data-->
        <div class="row">
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-header  justify-content-between align-items-center">
                        <h4 class="card-title">{{ $title }}</h4>
                    </div>
                    <div class="card-body">
                        <form action="" id="userTypePermission">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>User Type</label>
                                            <select class="form-control select2" name="usertype" id="usertype" style="width: 100%;">
                                                @foreach ($userType as $val)
                                                <option value="{{$val->id}}">{{$val->name}}</option>
                                                @endforeach
                                            </select>
                                            <p style="color:red"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <table class="table table-bordered ">
                                        <thead>
                                            <tr>
                                                <th>SR No</th>
                                                <th>Menu Name</th>
                                                <th>View</th>
                                                <th>Add</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                                <th>Others (like pod print....)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($menu_master)) @php
                                            $count = 1;
                                            @endphp
                                            @foreach ($menu_master as $val)
                                            @if ($val->id !='1')
                                            @php
                                            $pre = DB::table('tbl_users_permissions')->where(['menu_id'=>$val->id,'usertype'=>$id])->get();
                                            $data = $pre;
                                            @endphp
                                            <tr>
                                                <td>{{$count}}</td>
                                                <td>{{$val->master_menu_name}}</td>
                                                <td><input type="checkbox" name="view[]" @if (!empty($data[0]) && ($data[0]->menu_id == $val->id) && ($data[0]->view == '1')) {{ 'checked'}} @endif value="{{$val->id.'-1'}}"></td>
                                                <td><input type="checkbox" name="add[]" @if (!empty($data[0]) && ($data[0]->menu_id == $val->id) && ($data[0]->add == '1')) {{ 'checked'}} @endif value="{{$val->id.'-1'}}"></td>
                                                <td><input type="checkbox" name="edit[]" @if (!empty($data[0]) && ($data[0]->menu_id == $val->id) && ($data[0]->edit == '1')) {{ 'checked'}} @endif value="{{$val->id.'-1'}}"></td>
                                                <td><input type="checkbox" name="delete[]" @if (!empty($data[0]) && ($data[0]->menu_id == $val->id) && ($data[0]->delete == '1')) {{ 'checked'}} @endif value="{{$val->id.'-1'}}"></td>
                                                <td><input type="checkbox" name="other[]" @if (!empty($data[0]) && ($data[0]->menu_id == $val->id) && ($data[0]->other == '1')) {{ 'checked'}} @endif value="{{$val->id.'-1'}}">
                                                    <input type="hidden" name="count[]" value="{{$val->id.'-1'}}">
                                                </td>
                                            </tr>
                                            @endif
                                            @php $count++ @endphp
                                            @endforeach

                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-block btn-outline-success" style="width:200px; float:right;">Update</button>
                            </div>
                    </div>
                    </form>
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
    var routeUrl = "{{ route('admin.permisssion-update-data')}}";
    var view = "{{ route('admin.view-usertypes') }}";
</script>
<script src="{{ asset('admin-assets/admin_custome_js/comancustomjs.js')}}"></script>
@endsection