@extends('Layouts.UserAdminDashboard')

@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
        		<div class="ibox-title">
        			<h2>Payment/Bill</h2>
        		</div>
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="table-responsive">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            
                            <table class="table table-striped table-bordered table-hover dataTables-example dataTable text-center" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" role="grid">
                                <thead>
									<th class="text-center">Payment Id</th>
									<th class="text-center">User Name</th>
									<th class="text-center">Email</th>
									<th class="text-center">Phone</th>
									<th class="text-center">Applicatiion Name</th>
									<th class="text-center">Application Package</th>
									<th class="text-center">Order Date</th>
									<th class="text-center">Amount</th>
									<th class="text-center">Payment Details</th>
									<th class="text-center">Action</th>
								</thead>
								<tbody>
							
									<tr>
										<td>1</td>
										<td>Mehedi Hasan</td>
										<td>mehedi.cse@protonmail.com</td>
										<td>01252536595</td>
										<td>POS</td>
										<td>3Month</td>
										<td>25 November 2018</td>
										<td>25000</td>
										<td>Something Details</td>
										<td class="footable-visible">
                                           <span class="label label-primary?>">Active</span>
											
                                        </td>
									</tr>
								
								</tbody>
                                
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
</div>
</div>
@endsection