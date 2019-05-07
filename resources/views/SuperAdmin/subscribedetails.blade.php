@extends('Layouts.SuperAdminDashboard')
@section('style')
<style type="text/css">
	.add_btn{margin-top: -42px;}
</style>
@endsection
@section('content')

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
        	<div class="ibox float-e-margins">
				<div class="ibox-title">
        			<h2>Subscribe Details : {{ $check_result[0]->user->userDetails->first_name." ".$check_result[0]->user->userDetails->last_name }}</h2>
					<button type="button" class="btn btn-primary add_btn pull-right" data-toggle="modal" data-target="#add"><i class="fa fa-plus-circle"></i> Add</button>
				</div>
                <div class="ibox-content">
                	<table class="table table-bordered table-striped text-center dataTables-example dataTable">
						<thead>
							<tr>
								<th class="text-center">Subscribe ID</th>
								<th class="text-center">Software</th>
								<th class="text-center">Software Variation</th>
								<th class="text-center">Start Date</th>
								<th class="text-center">End Date</th>
								<th class="text-center">Payment Amount</th>
								<th class="text-center">Transaction ID</th>
								<th class="text-center">Month</th>
								<th class="text-center">Payment Time</th>
								<th class="text-center">Payment Status</th>
								<th class="text-center">Action</th>
							</tr>
						</thead>
						<tbody>
							@if(isset($check_result))
							@foreach($check_result as $results)
							<tr>
								<td>{{ $results->subscribe_id }}</td>
								<td>{{ $results->softwareDetails->software_title }}</td>
								<td>{{ $results->softwareVariationDetails->software_variation_name }}</td>
								<td>{{ $results->subscribe_start_date }}</td>
								<td>{{ $results->subscribe_end_date }}</td>
								<td>{{ $results->subscribe_payment_amount }}</td>
								<td>{{ $results->subscribe_payment_transaction_id }}</td>
								<td>{{ $results->subscribe_month }}</td>
								<td>{{ $results->payment_time }}</td>
								<td>{{ $results->subscribe_payment_status }}</td>
								<td class="btn-group">
									<button type="button" class="btn btn-info dropdown-toggle btn-xs" data-toggle="dropdown" aria-expanded="false">Action<span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
									<ul class="dropdown-menu pull-right" role="menu">
										@if($results->subscribe_payment_status!='paid')
										<li><a href="{{ url('manuali-active').'/'.$results->subscribe_id }}" ><i class="fa fa-eye"></i> Active</a></li>
										@endif
									</ul>
								</td>
							</tr>
							@endforeach
							@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="ModalForm show_modal">
	<div class="modal_status">
		<div class="modal fade" tabindex="-1" role="dialog" id="add">
			<div class="modal-dialog">
				<div class="modal-content payment_confirm">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
						<div class="modal-title">
							<h3 class="">ADD</h3>
						</div>
					</div>
					<form action="{{url('manual-active')}}" method="post">
					@csrf
					<input type="hidden" value="{{$uri_segments[3]}}" name="subscribe_id">
						<div class="modal-body">
							<div class="row">
								<div class="col-sm-12">
									<div class="row" wfd-id="21">
										<div class="col-sm-4 text-center" wfd-id="24">
											<label wfd-id="25">Package:</label>
										</div>
										<div class="col-sm-8" wfd-id="22">
											<select class="form-control package" name="package_duration" aria-invalid="false" wfd-id="84">
												<option value="1">1 Month</option>
												<option value="3">3 Month</option>
												<option value="6">6 Month</option>
												<option value="12">12 Month</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							
						</div>
						<div class="modal-footer" >
							<button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo trans('close');?></button>
							<button type="submit" class="btn btn-primary" ><?php echo trans('Save');?></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection							