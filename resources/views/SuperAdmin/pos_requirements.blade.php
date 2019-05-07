@extends('Layouts.SuperAdminDashboard')

@section('content')

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
        	<div class="ibox float-e-margins">
				<div class="ibox-title">
        			<h2>Pos Requirements List</h2>
				</div>
                <div class="ibox-content">
                	<table class="table table-bordered table-striped dataTables-example dataTable">
						<thead>
							<tr>
								<th class='text-center'>ID</th>
								<th class='text-center'>User</th>
								<th class='text-center'>Company Name</th>
								<th class='text-center'>Company Website</th>
								<th class='text-center'>Company Email</th>
								<th class='text-center'>Company Phone</th>
								<th class='text-center'>Company Address</th>
								<th class='text-center'>Company City</th>
								<th class='text-center'>Company Country</th>
								<th class='text-center'>Company Postcode</th>
								<th class='text-center'>Vat No</th>
								<th class='text-center'>Vat Unit</th>
								<th class='text-center'>Status</th>
							</tr>
						</thead>
						<tbody class='text-center'>
							@foreach($pos_requirements as $active)
							<tr>
								<td>{{ $active->pos_requirement_id }}</td>
								<td>{{ $active->user->userDetails->first_name." ".$active->user->userDetails->last_name }}</td>
								<td>{{ $active->company_name }}</td>
								<td>{{ $active->company_website }}</td>
								<td>{{ $active->company_email }}</td>
								<td>{{ $active->company_phone }}</td>
								<td>{{ $active->company_address }}</td>
								<td>{{ $active->company_city }}</td>
								<td>{{ $active->company_country }}</td>
								<td>{{ $active->company_postcode }}</td>
								<td>{{ $active->vat_no }}</td>
								<td>{{ $active->vat_unit }}</td>
								<td>
									@if($active->status=="active")
									<span class="label label-primary">Active</span>
									@elseif($active->status=="inactive")
									<span class="label label-danger">Deactive</span>
									@endif
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

<!-- doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>Laravel 5.7 Ajax Form Submission Example - Tutsmake.com</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>  
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
		<style>
			.error{ color:red; } 
		</style>
	</head>
	
	<body>
		
		<div class="container">
			<h2 style="margin-top: 10px;">Laravel 5.7 Ajax Form Submission Example - <a href="https://www.tutsmake.com" target="_blank">TutsMake</a></h2>
			<br>
			<br>
			
			<form id="contact_us" method="post" action="javascript:void(0)">
				@csrf
				<div class="form-group">
					<label for="formGroupExampleInput">Name</label>
					<input type="text" name="name" class="form-control" id="formGroupExampleInput" placeholder="Please enter name">
					<span class="text-danger">{{ $errors->first('name') }}</span>
				</div>
				<div class="form-group">
					<label for="email">Email Id</label>
					<input type="text" name="email" class="form-control" id="email" placeholder="Please enter email id">
					<span class="text-danger">{{ $errors->first('email') }}</span>
				</div>      
				<div class="form-group">
					<label for="mobile_number">Mobile Number</label>
					<input type="text" name="mobile_number" class="form-control" id="mobile_number" placeholder="Please enter mobile number" maxlength="10">
					<span class="text-danger">{{ $errors->first('mobile_number') }}</span>
				</div>
				<div class="alert alert-success d-none" id="msg_div">
					<span id="res_message"></span>
				</div>
				<div class="form-group">
					<button type="submit" id="send_form" class="btn btn-success">Submit</button>
				</div>
			</form>
			
		</div>
		<script>
			if ($("#contact_us").length > 0) {
				$("#contact_us").validate({
					
					rules: {
						name: {
							required: true,
							maxlength: 50
						},
						
						mobile_number: {
							required: true,
							digits:true,
							minlength: 10,
							maxlength:12,
						},
						email: {
							required: true,
							maxlength: 50,
							email: true,
						},    
					},
					messages: {
						
						name: {
							required: "Please enter name",
							maxlength: "Your last name maxlength should be 50 characters long."
						},
						mobile_number: {
							required: "Please enter contact number",
							minlength: "The contact number should be 10 digits",
							digits: "Please enter only numbers",
							maxlength: "The contact number should be 12 digits",
						},
						email: {
							required: "Please enter valid email",
							email: "Please enter valid email",
							maxlength: "The email name should less than or equal to 50 characters",
						},
						
					},
					submitHandler: function(form) {
						$.ajaxSetup({
							headers: {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							}
						});
						$('#send_form').html('Sending..');
						$.ajax({
							url: '{{ url('/subscribepayment') }}' ,
							type: "get",
							data: $('#contact_us').serialize(),
							success: function( response ) {
								// $('#send_form').html('Submit');
								// $('#res_message').show();
								// $('#res_message').html(response.msg);
								// $('#msg_div').removeClass('d-none');
								
								// document.getElementById("contact_us").reset(); 
								// setTimeout(function(){
								// $('#res_message').hide();
								// $('#msg_div').hide();
								// },10000);
								swal(response.msg, {
									icon: "success",
								});
							}
						});
					}
				})
			}
		</script>
	</body>
</html -->