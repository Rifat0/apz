@extends('Layouts.SuperAdminDashboard')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Invoice</h2>
    </div>
   {{--  <div class="col-lg-4">
        <div class="title-action">
            <a href="#" class="btn btn-white"><i class="fa fa-pencil"></i> Edit </a>
            <a href="#" class="btn btn-white"><i class="fa fa-check "></i> Save </a>
            <a href="invoice_print.html" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Print Invoice </a>
        </div>
    </div> --}}
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInRight">
           {{--  {{$pay_id}} --}}
            <div class="ibox-content p-xl">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5>From:</h5>
                            <address>
                                <strong>{{$search_result->first_name.' '.$search_result->last_name}}</strong><br>
                                {{$search_result->address}}<br>
                                <abbr title="Phone">P: </abbr> {{$search_result->phone}}
                            </address>
                        </div>

                        <div class="col-sm-6 text-right">
                            <h4>Invoice No.</h4>
                            <h4 class="text-navy">INV-000{{$search_result->payment_id}}</h4>
                            <span>To:</span>
                            <address>
                                <strong>Software Galaxy Lt.</strong><br>
                               House#06, Road#10<br>
                               Nikunjo-2 Dhaka, Bangladesh<br>
                                <abbr title="Phone">P:</abbr> 01687802090
                            </address>
                            <p>
                                <span><strong>Payment Date:</strong> {{date('M j, Y',strtotime($search_result->payment_date))}}</span>
                            </p>
                        </div>
                    </div>

                    <div class="table-responsive m-t">
                        <table class="table invoice-table">
                            <thead>
                            <tr>
                                <th>Payment Id</th>
                                <th>Purpose</th>
                                <th>Amount</th>
                                <th>VAT</th>
                                <th>Total Price</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{$search_result->payment_id}}</td>
                                <td>{{$search_result->payment_details}}</td>
                                <td>{{$search_result->payment_amount}}</td>
                                <td>{{$search_result->payment_charge}}</td>
                                <td>{{$search_result->payment_amount+$search_result->payment_charge}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div><!-- /table-responsive -->

                    <table class="table invoice-total">
                        <tbody>
                        <tr>
                            <td><strong>Sub Total :</strong></td>
                            <td>{{$search_result->payment_amount+$search_result->payment_charge}}</td>
                        </tr>
                        <tr>
                            <td><strong>TAX :</strong></td>
                            <td>{{$search_result->payment_charge}}</td>
                        </tr>
                        <tr>
                            <td><strong>TOTAL :</strong></td>
                            <td>{{$search_result->payment_amount+$search_result->payment_charge}}</td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="text-right">
                        <a href="invoice_print.html" target="_blank" class="btn btn-primary">
                            <i class="fa fa-print"></i> Print Invoice 
                        </a>
                        <button class="btn btn-primary"><i class="fa fa-download"></i> Download</button>
                    </div>
                </div>
            }
        </div>
    </div>
</div>
@endsection        