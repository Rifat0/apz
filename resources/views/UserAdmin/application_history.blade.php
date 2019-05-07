@extends('Layouts.UserAdminDashboard')

@section('content')
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h4>Application History</h4>
			</div>
			<div class="ibox-content">
				<table class="table table-bordered table-striped dataTables-example">
					<thead >
                       	<tr>
                       		<th class="text-center">User Id</th>
	                       	<th class="text-center">User Name</th>
	                       	<th class="text-center">Email</th>
	                       	<th class="text-center">Phone</th>
	                       	<th class="text-center">Application Name</th>
	                       	<th class="text-center">Install Date</th>
	                       	<th class="text-center">Renew Date</th>
	                       	<th class="text-center">Status</th>
	                       	<th class="text-center">Action</th>
                       	</tr>
                     </thead>
                     <tbody  class="text-center">
                       	<tr>
                       		<td>1</td>
                       		<td>Mehedi Hasan</td>
                       		<td>mehedi.cse@protonmail.com</td>
                       		<td>+887676767676</td>
                       		<td>POS</td>
                       		<td>25 November 2018</td>
                       		<td>29 November 2019</td>
                       		<td><span class="lable label-primary">Active</span></td>
                       		<td>
                       			<button class="btn btn-success btn-xs"><i class="fa fa-edit"></i> Edit</button>
                       		</td>
                       	</tr>
                     </tbody>
				</table>
			</div>
		</div>
	</div>
@endsection