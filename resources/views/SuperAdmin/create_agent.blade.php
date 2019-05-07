@extends('Layouts.SuperAdminDashboard')

@section('content')
<div class="col-sm-12">
	<div class="row">
		<div class="col-sm-6">
            @include('message')
			<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Create a New Agent</h5>
			</div>
			<div class="ibox-content" style="">
				<div class="row">
                    <form action="{{url('/admin/agentcreate')}}" method="POST">
                        @csrf
					<div class="col-sm-12 b-r">
						<div class="form-group">
							<div class="row">
								<div class="col-sm-6">
									<label>First Name</label>
									<input type="text" name="agent_first_name" placeholder="First Name" class="form-control" value="{{ old('agent_first_name') }}" >
								</div>
								<div class="col-sm-6">
									<label>Last Name</label>
									<input type="text" name="agent_last_name" placeholder="Last Name" class="form-control" value="{{ old('agent_last_name') }}" >
								</div>
							</div>
						</div>
					
						<div class="form-group">
							<label>Mobile</label>
							<input type="text" name="mobile" placeholder="Mobile number." class="form-control" value="{{ old('mobile') }}">
						</div>
						<label>
							<label style="">Birthday</label>
						</label>
						<div class="row">
							<div class="col-xs-4">
								<div class="form-group">
									<select type="number" name="agent_birthday" class="form-control" data-show-subtext="true" data-live-search="true" value="{{ old('agent_birthday') }}" >
										<option>Day</option>
										<?php  
											for ($x = 1; $x <= 31; $x++) {
												echo "<option value='$x'>$x</option>";
											}
										?>
									</select>
								</div>
							</div>
							<div class="col-xs-4">
								<div class="form-group">
									<select type="text" name="reg_birthmonth" class="form-control" data-show-subtext="true" data-live-search="true" value="{{ old('reg_birthmonth') }}" >
										<option><?php echo trans('month'); ?></option>
										<option value="1">January</option>
										<option value="2">February</option>
										<option value="3">March</option>
										<option value="4">April</option>
										<option value="5">May</option>
										<option value="6">June</option>
										<option value="7">July</option>
										<option value="8">August</option>
										<option value="9">September</option>
										<option value="11">October</option>
										<option value="12">December</option>
									</select>
								</div>
							</div>
							<div class="col-xs-4">
								<div class="form-group">
									<select type="number" name="agent_birthyear" class="form-control" data-show-subtext="true" data-live-search="true" value="{{ old('agent_birthyear') }}" >
										<option>Year</option>
										<?php  
											for ($x = 1900; $x <= date('Y'); $x++) {
												echo "<option value='$x'>$x</option>";
											}
										?>
									</select>
								</div>
							</div>
						</div>
							<div class="form-group">
								<label>
									<label>Gender</label>
								</label>
								<br>
								<label class="radio-inline">
									<div class="form-group">
										<input type="radio" name="agent_gender"  class="radio-primary" value="Male">
										<p style="font-size:16px;"><b>Male</b></p>
									</div>
								</label>
								<label class="radio-inline">
									<div class="form-group">
										<input type="radio" name="agent_gender"  class="radio-primary" value="Female">
										<p style="font-size:16px;"><b>Female</b></p>
									</div>
								</label>
							</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" name="password" placeholder="Password" class="form-control" name="password">
						</div>
						<div class="form-group">
							<label>Confirm Password</label>
							<input type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation">
						</div>
						<div class='form-group'>
							<button type='submit' class='btn btn-primary btn-md pull-right'>Submit</button>
						</div>
					</div>
                    </form>
				</div>
			</div>
		</div>
		</div>
	</div>
</div>			
@endsection
