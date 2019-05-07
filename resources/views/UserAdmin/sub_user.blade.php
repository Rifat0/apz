@extends('Layouts.UserAdminDashboard')

@section('content')
			<div class="row">
                <div class="col-md-12">
                    <div class="ibox float-e-margins">
                       <div class="ibox-title">
                       	<h5>Sub User</h5>
                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>New Sub User</strong></button>
                       </div>
                       <div class="ibox-content">
                       		<table class="table table-bordered table-striped dataTables-example">
                       			<thead >
                       				<tr>
                       					<th class="text-center">Serial Number</th>
	                       				<th class="text-center">User Name</th>
	                       				<th class="text-center">Email</th>
	                       				<th class="text-center">Phone</th>
	                       				<th class="text-center">Profession</th>
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
                       					<td>TTC</td>
                       					<td><span class="lable label-primary">Active</span></td>
                       					<td>
                       						<button class="btn btn-success btn-xs"><i class="fa fa-edit"></i>Edit</button>
                       					</td>
                       				</tr>
                       			</tbody>
                       		</table>
                       </div>
                    </div>
                </div>  
			</div>                
                
@endsection