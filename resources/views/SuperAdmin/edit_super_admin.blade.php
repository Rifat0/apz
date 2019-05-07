@extends('Layouts.SuperAdminDashboard')

@section('content')
<div class="row">
 	<div class="col-lg-12">
		<div class="row">
			<div class="col-lg-7">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Edit New Super Admin</h5>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-sm-12" id="account_update">
								<form role="form" name="edit_super_admin" method="POST" action="{{url('/SuperAdminUpdate/'.$search_result->user_id)}}">
									@csrf
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6"><label> First Name</label><input type="text" name="first_name" placeholder="" class="form-control" 
											value="{{$search_result->first_name}}"></div>
											<div class="col-sm-6"><label> Last Name</label><input type="text" name="last_name" placeholder="" class="form-control" 
											value="{{$search_result->last_name}}"></div>
										</div>
									</div>
									
									<div class="form-group"><label>Mobile</label><input type="text" name="user_mobile" placeholder="Enter Mobile Number" class="form-control" value="{{$search_result->phone}}"></div>
									
									<div class="form-group"><label>Email</label><input type="email" placeholder="Enter Email" class="form-control" value="{{$search_result->email}}" name="user_email"></div>
									{{--   <div class="form-group">
										<label>Profession</label>
										<input type="text" name="profession" class="form-control" placeholder="Software Engineer" value="Software Engineer">
									</div> --}}
									<div class="form-group">
										<label>Birthday</label>
										<div class="row">
											<div class="col-sm-4">
												
												<select class="form-control" name="b_day">
													<option value="0">Day</option>
													@for($i=1;$i<=31;$i++)
													<option value="{{$i}}">{{$i}}</option>
													@endfor
												</select>
											</div>
											<div class="col-sm-4">
												<select class="form-control" name="b_month">
													<option value="0">Month</option>
													<option value="1">January</option>
													<option value="2">February</option>
													<option value="3">March</option>
													<option value="4">April</option>
													<option value="5">May</option>
													<option value="6">June</option>
													<option value="7">July</option>
													<option value="8">August</option>
													<option value="9">September</option>
													<option value="10">October</option>
													<option value="11">November</option>
													<option value="12">December</option>
												</select>
											</div>
											<div class="col-sm-4">
												<select class="form-control" name="b_year">
													<option value="0">Year</option>
													@for($i=1950;$i<=2020;$i++)
													<option value="{{$i}}">{{$i}}</option>
													@endfor
												</select>
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<label>Gender</label>
										<br>          
										<label class="radio-inline">
											<p><input type="radio" name="gender" id="inlineRadio1" value="female" required >Female</p>
										</label>
										<label class="radio-inline">
											<p><input type="radio" name="gender" id="inlineRadio2" value=male" required >Male</p>
										</label>   
									</div>
									<div class="form-group"><label>Address</label>
									<textarea rows="3" placeholder="Enter Address" class="form-control" name="user_address">{{$search_result->address}}</textarea></div>
									<div><button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Save Changes</strong></button></div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>				 
	</div>   
</div>	         
{{-- <script type="text/javascript">
	document.forms['edit_super_admin'].elements['b_day'].value="{{$search_result->b_day}}";
</script> --}}      
@endsection