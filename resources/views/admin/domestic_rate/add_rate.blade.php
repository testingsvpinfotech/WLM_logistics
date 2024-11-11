@extends('admin.layout.admin_header')
@section('content')
    <main>
        <div class="container-fluid site-width">
            <!-- START: Card Data-->
            <div class="row">
                <div class="col-12 mt-4">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title">{{ $title }}</h6>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <form id="AddRate"  method="POST">
                                            <div class="box-body">
                                                <div class="form-group row">
                                                    <label for="ac_name" class="col-sm-3 col-form-label">Customer
                                                        Name</label>
                                                    <div class="col-sm-3">
                                                        <select name="rate_group_id" class="form-control" id="rate_group_id"
                                                            require>
                                                            <option value="">-- select group --</option>
                                                            @foreach ($rate_group as $key => $val)
                                                                <option value="{{ $val->id }}"> {{ $val->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <p style="color: red;"></p>
                                                    </div>
                                                    <label for="ac_name" class="col-sm-3 col-form-label">Courier Name</label>
                                                    <div class="col-sm-3">
                                                        <select class="form-control" name="company_id" id="company_id">
                                                            <option value="">-Select Courier-</option>
                                                            @foreach ($curier as $key => $val)
                                                                <option value="{{$val->id}}">{{$val->company_name}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <p style="color: red;"></p>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="ac_name" class="col-sm-3 col-form-label">From Zone
                                                        Name</label>
                                                    <div class="col-sm-3">
                                                        <select class="form-control" name="from_zone_id" id="from_zone_id">
                                                            <option value="">-Select Zone-</option>
                                                            @foreach ($zone as $key=>$val )
                                                            <option value="{{$val->id}}">{{$val->zone_name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <p style="color: red;"></p>
                                                    </div>
                                                    <label for="ac_name" class="col-sm-3 col-form-label">To Zone
                                                        Name</label>
                                                    <div class="col-sm-3">
                                                        <select class="form-control" name="to_zone_id" id="to_zone_id">
                                                            <option value="">-Select Zone-</option>
                                                            @foreach ($zone as $key=>$val )
                                                            <option value="{{$val->id}}">{{$val->zone_name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <p style="color: red;"></p>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row">
                                                    <label for="ac_name" class="col-sm-3 col-form-label">Mode Name</label>
                                                    <div class="col-sm-3">
                                                        <select class="form-control" name="mode_id" id="mode_id">
                                                            <option value="">-Select curier-</option>
                                                            @foreach ($mode as $key => $val)
                                                                <option value="{{$val->id}}">{{$val->mode_name}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <p style="color: red;"></p>
                                                    </div>
                                                    <label for="ac_name" class="col-sm-3 col-form-label">TAT</label>
                                                    <div class="col-sm-3"> 
                                                        <input type="text" name="tat" class="form-control" placeholder="TAT"
                                                            id="tat">
                                                            <p style="color: red;"></p>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="ac_name" class="col-sm-3 col-form-label">Minimum Rate</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="minimum_rate" id="minimum_rate" class="form-control" placeholder="Minimum Rate">
                                                        <p style="color: red;"></p>
                                                    </div>
                                                    <label for="ac_name" class="col-sm-3 col-form-label">Minimum Weight</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="minimum_weight" id="minimum_weight" class="form-control" placeholder="Minimum Weight">
                                                        <p style="color: red;"></p>
                                                    </div>
                                                    <label for="ac_name" class="col-sm-3 col-form-label">Applicable
                                                        From</label>
                                                    <div class="col-sm-3">
                                                        <input type="date" name="applicable_from" id="applicable_from"
                                                            value="<?php echo date('Y-m-d'); ?>" class="form-control"
                                                            placeholder="Applicable From">
                                                            <p style="color: red;"></p>
                                                    </div>
                                                    <label for="ac_name" class="col-sm-3 col-form-label">Applicable
                                                        To</label>
                                                    <div class="col-sm-3">
                                                        <input type="date" name="applicable_to" id="applicable_to"
                                                             class="form-control"
                                                            placeholder="Applicable From">
                                                            <p style="color: red;"></p>
                                                    </div>
                                                </div>
                                                <p id="error" style="color: red;"></p>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <div class="table-responsive">
                                                            <table class="table layout-primary bordered weight-table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Weight Range-From</th>
                                                                        <th>Weight Range-To</th>
                                                                        <th>Rate</th>
                                                                        <th>Rate Type</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td><input type="text"
                                                                                name="weight_range_from[]"
                                                                                class="form-control" placeholder="From">
                                                                                <p style="color: red;"></p>
                                                                        </td>
                                                                        <td><input type="text" name="weight_range_to[]"
                                                                                class="form-control" placeholder="To">
                                                                                <p style="color: red;"></p>
                                                                        </td>
                                                                        <td><input type="text" name="rate[]"
                                                                                class="form-control rate"
                                                                                placeholder="Enter Rate">
                                                                                <p style="color: red;"></p></td>
                                                                        <td>
                                                                            <select class="form-control"
                                                                                name="fixed_perkg[]">
                                                                                <option value="">-Select Type-
                                                                                </option>
                                                                                <option value="0">Fixed</option>
                                                                                <option value="1">Addtion 250GM
                                                                                </option>
                                                                                <option value="2">Addtion 500GM
                                                                                </option>
                                                                                <option value="3">Addtion 1000GM
                                                                                </option>
                                                                                <option value="4">Per Kg</option>
                                                                            </select>
                                                                            <p style="color: red;"></p>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                                <tfoot>
                                                                    <a href="javascript:void(0)"
                                                                        class="btn btn-sm btn-primary add-weight-row"
                                                                        style="margin-bottom: 5px;"><i
                                                                            class="icon-plus"></i></a>&nbsp;<a
                                                                        href="javascript:void(0)"
                                                                        class="btn btn-sm btn-danger remove-weight-row"
                                                                        style="margin-bottom: 5px;"><i
                                                                            class="icon-trash"></i></a>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <div class="box-footer">
                                                            <button type="submit" class="btn btn-outline-primary" style="float:right;">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.box-body -->
                                            </div>
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
        var view = "{{ route('admin.view-domestic-rate') }}";
        var callurl = "{{ route('admin.stor-rate') }}";
   
    </script>
    <script src="{{ asset('admin-assets/admin_custome_js/domestic_rate_master/add_rate.js')}}"></script>
    <script src="{{ asset('admin-assets/admin_custome_js/courier_company/add_courier_company.js') }}"></script>
@endsection
