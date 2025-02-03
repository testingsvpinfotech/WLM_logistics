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
            <div class="col-12 mt-4">
                <div class="card">
                    <div class="card-header">                               
                        <h6 class="card-title">{{$title}}</h6>                                
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">                                           
                                <div class="col-12">
                                    <form id="updatecourierCompany" method="POST">
                                        <p style="color: red;" id="error"></p>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Company Name</label>
                                                <input type="hidden" name="id" value="{{$editData->id}}">
                                                <input type="text" readonly class="form-control rounded" id="company_name" value="{{ $editData->company_name}}" name="company_name" placeholder="Company Name">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Company Type</label>
                                                <Select name="company_type" class="form-control rounded" id="company_type">
                                                 @foreach (company_type() as $key=>$val)
                                                <option value="{{$key}}" @if ($key== $editData->company_type)
                                                     {{ 'selected' }}
                                                @endif>{{$val}}</option>                                                     
                                                 @endforeach
                                                </Select>
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Domestic url <span style="color:grey;">(optional)</span></label>
                                                <input type="text" class="form-control rounded" id="domestic_url" value="{{ $editData->domestic_url}}" name="domestic_url" placeholder="Domestic url">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">International url <span style="color:grey;">(optional)</span></label>
                                                <input type="text" class="form-control rounded" id="international_url" value="{{ $editData->international_url}}" name="international_url" placeholder="International url">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputPassword4">Description <span style="color:grey;">(optional)</span></label>
                                                <textarea name="description" id="description" class="form-control rounded" placeholder="Description">{{ $editData->description}}</textarea>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputPassword4">Company Logo </label>
                                                <input type="file" class="form-control rounded" id="img_logo"  name="img_logo" >
                                                <p style="color:red;"></p>
                                                @if (isset($editData->img_logo))
                                                        @php
                                                            $panIMg1 = 'admin-assets/courier_company_logo/' . $editData->img_logo;
                                                        @endphp
                                                        <a onclick="return ViewImage('{{ $panIMg1 }}');"
                                                            style="color:blue; cursor:pointer;">View Logo</a> 
                                                @endif
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
    </div>
    
    <div id="myModal" class="modal">
        <!-- The Close Button -->
        <span class="close">&times;</span>
        <!-- Modal Content (The Image) -->
        <img class="modal-content" id="img01">
        <!-- Modal Caption (Image Text) -->
        <div id="caption"></div>
    </div>
</main>
@endsection
@section('script')
 <script>
    var Route = "{{ url('/') }}";
    var view = "{{ route('admin.view-courier-company') }}";
    var callurl = "{{ route('admin.update-courier-company') }}";
 </script>
 <script src="{{ asset('admin-assets/admin_custome_js/courier_company/edit_courier_company.js')}}"></script>
 <script src="{{ asset('admin-assets/admin_custome_js/comancustomjs.js')}}"></script>
@endsection