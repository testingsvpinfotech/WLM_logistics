@extends('admin.layout.admin_header')
@section('content')
<style>
    #invoice-section {
        border: 1px solid #ddd;
        padding: 20px;
        background-color: #fff;
    }
</style>
<main>
    <div class="container-fluid site-width">
        <!-- START: Card Data-->
        <div class="container my-5">
            <div class="text-right mb-4">
                <button class="btn btn-outline-primary" id="print-btn"> <i class="fa fa-print"></i> Print</button>
                <button class="btn btn-outline-success" id="download-btn"><i class="fa fa-download" aria-hidden="true"></i> Download</button>
                <a href="#" class="btn btn-outline-info"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>

            <div id="invoice-section">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="logo"><img src="{{ asset('admin-assets/logo.jpeg') }}"
                            alt="" class="d-flex mr-3" style="width:100%;"></div>
                    <div class="text-end">
                        <h4 class="mb-0"><b>TAX INVOICE</b></h4>
                        <span class="btn mt-3 btn-success">Paid</span>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <div>
                        <p><b>{{$company->company_name}}</b><br>CIN: {{$company->cin}}<br>PAN: {{$company->pan_no}}<br>GST: {{$company->gst_no}}<br>TAN: {{$company->tan}}<br>Original for RECIPITENT</p>
                    </div>
                    <div class="text-end">
                        <p class="text-right !important;"><b>Address:</b><br>{{$company->address.' '.$company->pincode}}<br>+91 {{$company->contact_no}}</p>
                    </div>
                </div>

                <hr>

                <div class="d-flex justify-content-between">
                    <div>
                        <p><strong>Bill To:</strong> OBN Associate Express Industries Private Limited<br>CTS No 103, Deep Bungalow Chowk, Pune<br>GST: 27AABOF7811Z5</p>
                    </div>
                    <div class="text-end">
                        <p><strong>Invoice No:</strong> TC2023-246776<br><strong>Invoice Date:</strong> 15-Sep-2023</p>
                    </div>
                </div>

                <table class="table table-bordered mt-4">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Description</th>
                            <th>SAC</th>
                            <th>Unit Cost</th>
                            <th>Quantity</th>
                            <th>Line Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>B2B Services</td>
                            <td>B2B Services for the date from 10 Sep 2023 to 15 Sep 2023</td>
                            <td>996718</td>
                            <td>956.78</td>
                            <td>1</td>
                            <td>956.78</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-right">Sub Total</td>
                            <td>956.78</td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-right">GST @18%</td>
                            <td>172.22</td>
                        </tr>
                        <tr>
                            <th colspan="5" class="text-right">Total</th>
                            <th>1,129.00</th>
                        </tr>
                    </tfoot>
                </table>

                <div class="mt-4">
                    <p><strong>Terms:</strong><br>Please make all cheques/DD payable to {{$company->company_name}}.<br>Remittance to be made to the following accounts<br>Bank Name: {{$company->bank_name}}<br>A/C Holder Name: {{$company->company_name}}<br>A/C Number: {{$company->account_no}}<br>IFSC Code: {{$company->ifsc_code}} <br>Branch Name : {{$company->branch_name}}</p>
                    <p>Please download the charge calculator from given link: <a href="#" style="color:blue;">Invoice Report</a></p>
                </div>
                <p class="text-center;"><b>Head Office: </b>{{$company->head_office_address}}</p>
            </div>
        </div>
        <!-- END: Card DATA-->
    </div>
</main>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
<script>
    // Print functionality
    document.getElementById('print-btn').addEventListener('click', function() {
        const printContents = document.getElementById('invoice-section').innerHTML;
        const originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        window.location.reload();
    });
    $('#download-btn').click(() => {
        var pdf = new jsPDF('p', 'pt', 'a4');
        const invoice = document.getElementById('invoice-section');
        pdf.addHTML(invoice, function() {
            pdf.save('invoice.pdf');
        });
    })
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
<script src="{{ asset('admin-assets/admin_custome_js/domestic_rate_master/add_rate.js')}}"></script>
<script src="{{ asset('admin-assets/admin_custome_js/courier_company/add_courier_company.js') }}"></script>
@endsection