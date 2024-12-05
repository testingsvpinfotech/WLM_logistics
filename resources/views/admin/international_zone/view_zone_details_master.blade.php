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
                        <span style="float:right;"><a href="{{route('admin.view-add-zone')}}" class="btn btn-outline-primary">Add Zone</a></span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example"
                                class="display table dataTable table-striped table-bordered layout-primary">
                                <thead>
                                    <tr>
                                        <th>Sr No</th>
                                        <th>Courier Name</th>
                                        <th>Country</th>
                                        <th>Zone</th>
                                        <th>Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($zonedetails))
                                    @php
                                    $count = 1;
                                    @endphp
                                    @foreach ($zonedetails as $val)
                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td>{{ $val->company_name }}</td>
                                        <td>{{ $val->country_name }}</td>
                                        <td>{{ $val->zone }}</td>
                                        <td>{{ internationalType()[$val->type] }}</td>
                                    </tr>
                                    @php $count++ @endphp
                                    @endforeach
                                    @else
                                    <tr style="color:red">DATA NOT FOUND</tr>
                                    @endif
                                </tbody>
                            </table>
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
    var callurl = "{{ route('admin.delete-inet-rate-group')}}";
    var view = "{{ route('admin.view-inet-rate-group') }}";
    var statusurl = "{{route('admin.status-inet-rate-group')}}";
</script>
<script src="{{ asset('admin-assets/admin_custome_js/comancustomjs.js')}}"></script>
@endsection