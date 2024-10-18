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
                            <span style="float:right;"><a href="{{ route('admin.add-business-category') }}"
                                    class="btn btn-outline-primary">Add Category</a></span>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example"
                                    class="display table dataTable table-striped table-bordered layout-primary">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Category</th>
                                            <th>Sub Category Name</th>
                                            <th>Description</th>
                                            <th>Business Profile</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($category))
                                            @php
                                                $count = 1;

                                            @endphp
                                            @foreach ($category as $val)
                                                <tr>
                                                    <td>{{ $count }}</td>
                                                    <td>{{ business_category()[$val->category_id] }}</td>
                                                    <td>{{ $val->category_name }}</td>
                                                    <td>{{ $val->description }}</td>
                                                    <td>
                                                        @if (isset($val->image))
                                                            @php
                                                                $panIMg1 = 'admin-assets/category/' . $val->image;
                                                            @endphp
                                                            <a onclick="return ViewImage('{{ $panIMg1 }}');"
                                                                style="color:blue; cursor:pointer;">View Profile</a> |
                                                            <a style="color:blue"
                                                                href="{{ route('admin.download-category', ['id' => $val->image]) }}">
                                                                <i class="fas fa-download"></i>
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td> @php
                                                        if ($val->status == '0') {
                                                            echo 'Active';
                                                        } else {
                                                            echo 'In-active';
                                                        }
                                                    @endphp</td>
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
                                                            href="{{ route('admin.edit-business-category', ['id' => $val->id]) }}">
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
            <!-- END: Card DATA-->
        </div>
    </main>
    <!-- modal code  -->
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
        var callurl = "{{ route('admin.delete-business-category') }}";
        var view = "{{ route('admin.view-business-category') }}";
        var statusurl = "{{route('admin.status-business-category')}}";
    </script>
    <script src="{{ asset('admin-assets/admin_custome_js/comancustomjs.js') }}"></script>
@endsection
