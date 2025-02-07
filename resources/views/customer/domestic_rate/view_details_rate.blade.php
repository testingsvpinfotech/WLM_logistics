@extends('customer.layout.admin_header')
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
                            <div class="table-responsive">
                                <table id="example"
                                    class="display table dataTable table-striped table-bordered layout-primary">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Group Name</th>
                                            <th>Mode Name</th>
                                            <th>Courier Name</th>
                                            <th>From Zone</th>
                                            <th>To Zone</th>
                                            <th>From Weight</th>
                                            <th>To Weight</th>
                                            <th>TAT</th>
                                            <th>Minimum Rate</th>
                                            <th>Minimum Weight</th>
                                            <th>Rate</th>
                                            <th>Rate Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($rate))
                                            @php
                                                $count = 1;
                                            @endphp
                                            @foreach ($rate as $val)
                                                <tr>
                                                    <td>{{ $count }}</td>
                                                    <td>{{ $val->group_name }}</a></td>
                                                    <td>{{ $val->mode_name }}</a></td>
                                                    <td>{{ $val->company_name }}</a></td>
                                                    <td>{{ $val->from_zone }}</a></td>
                                                    <td>{{ $val->to_zone }}</a></td>
                                                    <td>{{ $val->from_weight }}</a></td>
                                                    <td>{{ $val->to_weight }}</a></td>
                                                    <td>{{ $val->tat }}</a></td>
                                                    <td>{{ $val->minimum_rate }}</a></td>
                                                    <td>{{ $val->minimum_weight }}</a></td>
                                                    <td>{{ $val->rate }}</a></td>
                                                    <td>{{ rateType()[$val->fixed_perkg] }}</a></td>
                                                    <td>
                                                        {{-- <a style="color:red;  cursor: pointer;"
                                                            onclick="return deleteRole({{ $val->group_id }});">
                                                            <i class="fas fa-trash">
                                                            </i>
                                                        </a> --}}
                                                    </td>
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
    var callurl = "{{ route('admin.delete-fuel-group')}}";
    var view = "{{ route('admin.view-fuel-group') }}";
</script>
<script src="{{ asset('admin-assets/admin_custome_js/comancustomjs.js')}}"></script>
@endsection
