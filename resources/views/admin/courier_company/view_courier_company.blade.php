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
                            <span style="float:right;"><a href="{{route('admin.add-courier-company')}}" class="btn btn-outline-primary">Add Courier</a></span>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example"
                                    class="display table dataTable table-striped table-bordered layout-primary">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Courier Logo</th>
                                            <th>Courier Name</th>
                                            <th>Company Type</th>
                                            <th>Domestic Url</th>
                                            <th>International Url</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($Courier))
                                            @php
                                                $count = 1;
                                            @endphp
                                            @foreach ($Courier as $val)
                                                <tr>
                                                    <td>{{ $count }}</td>
                                                    <td>
                                                        @if (isset($val->img_logo))
                                                        @php
                                                            $panIMg1 = 'admin-assets/courier_company_logo/' . $val->img_logo;
                                                        @endphp
                                                        <a onclick="return ViewImage('{{ $panIMg1 }}');"
                                                            style="color:blue; cursor:pointer;">View Logo</a> |
                                                        <a style="color:blue"
                                                            href="{{ route('admin.download-courier', ['id' => $val->img_logo]) }}">
                                                            <i class="fas fa-download"></i>
                                                        </a>
                                                    @endif
                                                    </td>
                                                    <td>{{ $val->company_name }}</td>
                                                    <td>{{ company_type()[$val->company_type] }}</td>
                                                    <td>{{ $val->domestic_url }}</td>
                                                    <td>{{ $val->international_url }}</td>
                                                    <td>@if ($val->status == '0')
                                                        {{ 'Active'}}
                                                    @else
                                                    {{'In Active'}}
                                                    @endif
                                                </td>
                                                    <td> 
                                                        <input type="checkbox" 
                                                        @if ($val->status == '0') 
                                                            {{ 'checked' }} 
                                                        @endif 
                                                        data-toggle="toggle" 
                                                        id="activestatus_{{ $val->id }}" 
                                                        value="1" 
                                                        data-size="xs" 
                                                        onchange="ActiveStatus({{ $val->id }})">
                                                        |
                                                        <a style="color:blue"
                                                            href="{{ route('admin.edit-courier-company', ['id' => $val->id]) }}">
                                                            <i class="fas fa-pencil-alt">
                                                            </i>
                                                        </a> |
                                                        <a style="color:red;  cursor: pointer;"
                                                            onclick="return deleteRole({{ $val->id }});">
                                                            <i class="fas fa-trash">
                                                            </i>
                                                        </a>
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
         </div>
    </main>
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
    var Route = "{{ url('/') }}";
    var callurl = "{{ route('admin.delete-courier-company')}}";
    var view = "{{ route('admin.view-courier-company') }}";
    var statusurl = "{{route('admin.status-courier-company')}}";
</script>
<script src="{{ asset('admin-assets/admin_custome_js/comancustomjs.js')}}"></script>
@endsection
