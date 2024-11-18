@extends('admin.layout.admin_header')
@section('content')
<style>
    /* Style the Image Used to Trigger the Modal */
    #myImg {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    #myImg:hover {
        opacity: 0.7;
    }

    /* The Modal (background) */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        padding-top: 100px;
        /* Location of the box */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.9);
        /* Black w/ opacity */
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
    .modal-content,
    #caption {
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @keyframes zoom {
        from {
            transform: scale(0)
        }

        to {
            transform: scale(1)
        }
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
    @media only screen and (max-width: 700px) {
        .modal-content {
            width: 100%;
        }
    }
</style>
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
