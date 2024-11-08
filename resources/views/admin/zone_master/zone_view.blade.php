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
                            <div class="table-responsive">
                                <table id="example"
                                    class="display table dataTable table-striped table-bordered layout-primary">
                                    <thead>
                                        <tr>
                                            <th>Zone Name</th>
                                            <th>State Name</th>
                                            <th>City Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($zone))
                                            @foreach ($zone as $val)
                                                <tr>
                                                    <td>{{ $val->zoneName }}</td>
                                                    <td>{{ $val->state_name }}</td>
                                                    <td>{{ $val->city_name }}</td>
                                                </tr>
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
    var callurl = "{{ route('admin.delete-zone')}}";
    var view = "{{ route('admin.view-zone-master') }}";
</script>
<script src="{{ asset('admin-assets/admin_custome_js/comancustomjs.js')}}"></script>
@endsection
