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
                        <span style="float:right;"></span>
                    </div>
                    <div class="m-4">
                        <!-- Filter Buttons -->
                        <form action="{{route('admin.view-customer-master')}}" method="get">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Search Data</label>
                                    <input type="text" name="search" id="search" class="form-control buttonCall" placeholder="Customer Code | Customer Name | Company Name | Email ...." value="{{ !empty($_GET['search'])?$_GET['search']:'';}}">
                                </div>
                                <div class="col-md-2">
                                    <label for="">From Date</label>
                                    <input type="date" name="from_date" id="from_date" class="form-control buttonCall" value="{{ !empty($_GET['from_date'])?$_GET['from_date']:'';}}">
                                </div>
                                <div class="col-md-2">
                                    <label for="">To Date</label>
                                    <input type="date" name="to_date" id="to_date" class="form-control buttonCall" value="{{ !empty($_GET['to_date'])?$_GET['to_date']:'';}}">
                                </div>

                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-outline-primary mt-4"><i class="fa fa-search" aria-hidden="true"></i></button>
                                    <button type="submit" class="btn btn-outline-success mt-4" name="Excel" value="download-excel"><i class="fa fa-download" aria-hidden="true"></i></button>
                                    <a href="{{route('admin.view-customer-master')}}" class="btn btn-outline-danger mt-4"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </form>
                        <br>
                        <!-- Table -->
                        <div class="table-responsive table-scroll">
                            <table class="table table-bordered align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>SR No</th>
                                        <th>Account Code</th>
                                        <th>Personal Name</th>
                                        <th>Surname Name</th>
                                        <th>Compnay Name</th>
                                        <th>Email</th>
                                        <th>Mobile No</th>
                                        <th>Pan Card No</th>
                                        <th>Pan Card Copy</th>
                                        <th>GST No</th>
                                        <th>GST Copy</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($orders->isNotEmpty())
                                    @php
                                    $count = 1;
                                    @endphp
                                    @foreach ($orders as $key => $val)
                                    <tr>
                                        <td>{{$currentPage}}</td>
                                        <td>{{$val->Customer_Code}}</td>
                                        <td>{{$val->personal_name}}</td>
                                        <td>{{$val->surname}}</td>
                                        <td>{{$val->company_name}}</td>
                                        <td>{{$val->email}}</td>
                                        <td>{{$val->mobile_number}}</td>
                                        <td>{{$val->pan_no}}</td>
                                        <td>
                                            @if (isset($val->pan_card_copy))
                                            @php
                                            $panIMg1 = 'admin-assets/customer_documents/' . $val->pan_card_copy;
                                            $extention = explode(".",$val->pan_card_copy)
                                            @endphp
                                            @if($extention[1]=='pdf')
                                            <a style="color:blue"
                                                href="{{ route('admin.download-document', ['id' => $val->pan_card_copy]) }}">
                                                <i class="fas fa-download"></i>
                                            </a>
                                            @else
                                            <a onclick="return ViewImage('{{ $panIMg1 }}');"
                                                style="color:blue; cursor:pointer;">View Pan</a> |
                                            <a style="color:blue"
                                                href="{{ route('admin.download-document', ['id' => $val->pan_card_copy]) }}">
                                                <i class="fas fa-download"></i>
                                            </a>
                                            @endif
                                            @endif
                                        </td>
                                        <td>{{$val->gst_no}}</td>
                                        <td> @if (isset($val->gst_copy))
                                            @php
                                            $panIMg = 'admin-assets/customer_documents/' . $val->gst_copy;
                                            $extention1 = explode(".",$val->gst_copy)
                                            @endphp
                                            @if($extention1[1]=='pdf')
                                            <a style="color:blue"
                                                href="{{ route('admin.download-document', ['id' => $val->gst_copy]) }}">
                                                <i class="fas fa-download"></i>
                                            </a>
                                            @else
                                            <a onclick="return ViewImage('{{ $panIMg }}');"
                                                style="color:blue; cursor:pointer;">View GST</a> |
                                            <a style="color:blue"
                                                href="{{ route('admin.download-document', ['id' => $val->gst_copy]) }}">
                                                <i class="fas fa-download"></i>
                                            </a>
                                            @endif
                                            @endif

                                        </td>
                                        <td style="font-size:15px;">
                                            <a href="{{route('admin.edit-customer',['id'=>$val->id])}}" style="color:blue;"><i class="fas fa-pencil-alt"></i></a>
                                           
                                            @if($val->account_status == 0)
                                            |
                                            <a style="color:red;  cursor: pointer;"title="Deactive Account?"
                                                onclick="return Desibaled({{ $val->id }});">
                                                <i class="fa fa-ban" aria-hidden="true"></i>
                                            </a>
                                            @endif
                                            @if($val->verified == 0)
                                            |
                                            <a style="color:green;  cursor: pointer;" title="Verifed Document Status"
                                                onclick="return VerifyRole({{ $val->id }});">
                                                <i class="fas fa-check"></i>
                                            </a>
                                           
                                            @endif
                                        </td>
                                    </tr>
                                    @php $currentPage++ @endphp
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="16">No Data Found</td>
                                    </tr>
                                    @endif
                                    <!-- Add additional rows as needed -->
                                </tbody>
                            </table>
                        </div>

                        <!-- Footer -->
                        <div class="pagination-wrapper">
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>



        </body>
        <!-- END: Card DATA-->
    </div>
</main>
{{-- ship now button model pop  --}}

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
    var callurl = "{{ route('admin.verify-document')}}";
    var disabled = "{{ route('admin.disbaled-account')}}";
    var view = "{{ route('admin.view-customer-master') }}";
    var statusurl = "{{route('admin.status-courier-company')}}";
</script>

<script src="{{ asset('admin-assets/admin_custome_js/comancustomjs.js')}}"></script>
@endsection