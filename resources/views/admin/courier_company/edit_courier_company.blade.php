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
                                                    <option value="{{$key}}" @if ($key==$editData->company_type)
                                                        {{ 'selected' }}
                                                        @endif>{{$val}}
                                                    </option>
                                                    @endforeach
                                                </Select>
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Third Party Booking API</label>
                                                <select name="delivery_service" class="form-control rounded" id="delivery_service">
                                                    <option value="">-Select Courier-</option>
                                                    <option value="1" @if (1==$editData->api_booking_id){{ 'selected' }}@endif>Delhivery</option>
                                                    <option value="2" @if (2==$editData->api_booking_id){{ 'selected' }}@endif>Blue Dart</option>
                                                    <option disabled value="3" @if (3==$editData->api_booking_id){{ 'selected' }}@endif>Ecom Express</option>
                                                    <option disabled value="4" @if (4==$editData->api_booking_id){{ 'selected' }}@endif>XpressBees</option>
                                                    <option disabled value="5" @if (5==$editData->api_booking_id){{ 'selected' }}@endif>DTDC</option>
                                                    <option disabled value="6" @if (6==$editData->api_booking_id){{ 'selected' }}@endif>Shadowfax</option>
                                                    <option disabled value="7" @if (7==$editData->api_booking_id){{ 'selected' }}@endif>India Post</option>
                                                    <option disabled value="8" @if (8==$editData->api_booking_id){{ 'selected' }}@endif>FedEx</option>
                                                    <option disabled value="9" @if (9==$editData->api_booking_id){{ 'selected' }}@endif>DHL</option>
                                                    <option disabled value="10" @if (10==$editData->api_booking_id){{ 'selected' }}@endif>Gati</option>
                                                    <option disabled value="11" @if (11==$editData->api_booking_id){{ 'selected' }}@endif>Trackon Couriers</option>
                                                    <option disabled value="12" @if (12==$editData->api_booking_id){{ 'selected' }}@endif>Wow Express</option>
                                                    <option disabled value="13" @if (13==$editData->api_booking_id){{ 'selected' }}@endif>Amazon Transportation Services</option>
                                                    <option disabled value="14" @if (14==$editData->api_booking_id){{ 'selected' }}@endif>Ekart Logistics</option>
                                                    <option disabled value="15" @if (15==$editData->api_booking_id){{ 'selected' }}@endif>Spoton Logistics</option>
                                                </select>
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
                                                <input type="file" class="form-control rounded" id="img_logo" name="img_logo">
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