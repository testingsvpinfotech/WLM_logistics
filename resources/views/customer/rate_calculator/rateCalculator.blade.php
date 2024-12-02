@extends('customer.layout.admin_header')
@section('content')
<style>
                    .preferred-badge {
                        background-color: #826AF9;
                        color: white;
                        padding: 5px 10px;
                        border-radius: 15px;
                        font-size: 12px;
                        display: inline-block;
                        margin-bottom: 5px;
                    }

                    .icon-circle {
                        display: inline-flex;
                        justify-content: center;
                        align-items: center;
                        width: 50px;
                        height: 50px;
                        border-radius: 50%;
                        background-color: #E8EAF6;
                    }

                    .rating-circle {
                        width: 50px;
                        height: 50px;
                        border-radius: 50%;
                        background-color: #E8EAF6;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        font-size: 18px;
                        font-weight: bold;
                    }

                    .highlight {
                        border: 2px solid #826AF9;
                        border-radius: 10px;
                        padding: 10px;
                    }

                    .sidebar {
                        background-color: #F5F5F5;
                        padding: 15px;
                        height: 100%;
                    }

                    .sidebar h5,
                    .sidebar h6 {
                        margin-bottom: 15px;
                    }

                    .sidebar p {
                        margin-bottom: 10px;
                    }

                    .sidebar .icon {
                        width: 40px;
                        height: 40px;
                        background-color: #F4F4F4;
                        display: inline-flex;
                        justify-content: center;
                        align-items: center;
                        border-radius: 50%;
                        margin-right: 10px;
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
                                    <form id="rateCalculator" method="POST">
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Courier Name</label>
                                                <select class="form-control" name="courier_id" id="courier_id">
                                                        <option value="ALL">-ALL-</option>
                                                        <!-- @foreach ($curier as $key => $val)
                                                            <option value="{{$val->id}}">{{$val->company_name}}
                                                            </option>
                                                        @endforeach -->
                                                </select>
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Mode Name</label>
                                                <select class="form-control" name="mode_id" id="mode_id">
                                                        <option value="ALL">-ALL-</option>
                                                        <!-- @foreach ($mode as $key => $val)
                                                            <option value="{{$val->id}}">{{$val->mode_name}}
                                                            </option>
                                                        @endforeach -->
                                                </select>
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Weight</label>
                                                 <input type="text" name="applicable_weight" class="form-control rounded" id="applicable_weight" placeholder="Weight">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">From Pincode</label>
                                                 <input type="text" name="from_pincode" maxlength="6" minlength="6" class="form-control rounded" id="from_pincode" placeholder="From Pincode">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">To Pincode</label>
                                                 <input type="text" name="to_pincode" maxlength="6" minlength="6" class="form-control rounded" id="to_pincode" placeholder="To Pincode">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <br>
                                               <button type="submit" class="btn btn-outline-success mt-1" style="float:left;">Search</button>
                                               <a href="{{route('app.ratecalculator')}}" class="btn btn-outline-danger mt-1 ml-1">Reset</a>
                                            </div>
                                            <div class="col-md-2"> </div>
                                            <div class="form-group col-md-8">
                                                <label for="inputPassword4">Result: </label>
                                                 <div class="curiers ">

                                                 </div>
                                            </div>
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
        var callurl = "{{ route('app.getcalculator') }}";
      
        $(function() {
            $('[data-toggle="popover"]').popover();
        });
    </script>
    <script src="{{ asset('customer-assets/js/rateCalculator.js') }}"></script>
@endsection
