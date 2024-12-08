@extends('admin.layout.admin_header')
@section('content')
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
                                    <form id="WalletTransection" method="POST">
                                        <div class="form-row">  
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Customer</label>
                                                <select name="customer_id" class="form-control rounded" id="customer_id">
                                                    <option value="">-- Select Customer --</option>
                                                    @foreach ($customer as $key => $val )
                                                      <option value="{{$val->id}}">{{$val->personal_name.' '.$val->surname.' ('.$val->company_name.')'}}</option>
                                                    @endforeach
                                                </select>
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Payment Type</label>
                                                <select name="wallet_type" class="form-control rounded" id="wallet_type">
                                                    @foreach (walletType() as $key => $val )
                                                    @if ($key ==1)
                                                       <option value="{{$key}}">{{$val}}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Recharge Amount</label>
                                                <input type="text" name="recharge_amount" class="form-control rounded" id="recharge_amount" placeholder="Recharge Amount">
                                                <p style="color:red;"></p>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Refrance No</label>
                                                <input type="text" name="reference_no" class="form-control rounded" id="reference_no" placeholder="Refrance No">
                                                <p style="color:red;"></p>
                                            </div>

                                            <div class="form-group col-md-3">
                                                <label for="inputPassword4">Description</label>
                                                <textarea name="description" id="description" class="form-control rounded" placeholder="Description">{{ old('description')}}</textarea>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-outline-primary" style="float:right;">Submit</button>
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
    var view = "{{ route('admin.view-wallet-transaction') }}";
    var callurl = "{{ route('admin.store-toup-transaction') }}";
 </script>
 <script src="{{ asset('admin-assets/admin_custome_js/wallet_transection/wallet_topup.js')}}"></script>
@endsection