@extends('Layouts.UserAdminDashboard')

@section('content')
	 <div class="col-lg-12">
	   <div class="col-lg-7">
	      <div class="ibox float-e-margins">
	         <div class="ibox-title">
	            <h5>Create Sub User</h5>
	          
	         </div>
	         <div class="ibox-content" style="">
	            <div class="row">
	               <div class="col-sm-12" id="account_update">
	                  <form role="form" novalidate="novalidate">
	                     <div class="form-group">
	                        <div class="row">
	                           <div class="col-sm-6"><label> First Name</label><input type="text" name="first_name" placeholder="" class="form-control" ></div>
	                           <div class="col-sm-6"><label> Last Name</label><input type="text" name="last_name" placeholder="" class="form-control" ></div>
	                        </div>
	                     </div>
	                     <div class="form-group"><label>Mobile</label><input type="text" name="user_mobile" placeholder="Enter Mobile Number" class="form-control" ></div>
	                     <div class="form-group"><label>Email</label><input type="email" placeholder="Enter Email" class="form-control"  name="user_email"></div>
	                     <div class="form-group">
	                     	<label>Profession</label>
	                     	<input type="text" name="profession" class="form-control" placeholder="Software Engineer" >
	                     </div>
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
                     			<p><input type="radio" name="gender" id="inlineRadio1" value="Female" required>Female</p>
                    		</label>
		                    <label class="radio-inline">
		                      <p><input type="radio" name="gender" id="inlineRadio2" value="Male" required>Male</p>
		                    </label>   
	                     </div>

	                     <div class="form-group"><label>Address</label><textarea rows="3" placeholder="Enter Address" class="form-control" name="user_address"></textarea></div>
	                     <div class="form-group"><label>Old Password</label><input type="password" placeholder="Old Password" class="form-control" value="" name="old_password"></div>
	                     <div class="form-group"><label>New Password</label><input type="password" placeholder="New Password" class="form-control" value="" name="new_password"></div>

	                     <div><button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Save Changes</strong></button></div>
	                  </form>
	               </div>
	            </div>
	         </div>
	      </div>
	   </div>
	</div>                
@endsection