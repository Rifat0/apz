@extends('Layouts.UserAdminDashboard')

@section('content')
      <div class="col-sm-12">
      	<div class="ibox float-e-margins">
      		<div class="ibox-title">
      			<h2>My Support Tickets <small class="h5">Your Ticket History</small></h2>
      			 <a href="{{url('UserAdminOpenSupport')}}" class="btn btn-sm btn-primary pull-right m-t-n-xl" type="submit"><strong>Open Ticket</strong></a>
      		</div>
      		<div class="ibox-content">
  				<table class="table table-bordered table-striped dataTables-example">
  					<thead>
  						<th class="text-center">Department</th>
  						<th class="text-center">Subject</th>
  						<th class="text-center">Status</th>
  						<th class="text-center">Last Update</th>
  					</thead>
  					<tbody class="text-center">
  						<td>Technical</td>
  						<td>Something Subject write in here</td>
  						<td><span class="label label-primary">Complete</span></td>
  						<td>25 November 2018</td>
  					</tbody>
  				</table>
      		</div>
      	</div>
      </div>				   
@endsection