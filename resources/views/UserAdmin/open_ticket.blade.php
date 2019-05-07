@extends('Layouts.UserAdminDashboard')

@section('content')
	<div class="col-sm-12">
		<div class="row">
            <div class="col-sm-6">
		      	<div class="ibox float-e-margins">
		      		<div class="ibox-title">
		      			<h2>Open Tickets</h2>
		      		</div>
		      		<div class="ibox-content">
		  				<form enctype="multipart/form-data">
		  					<div class="form-group">
		  						<div class="row">
		  							<div class="col-sm-6">
		  								<label>Name</label>
		  								<input type="text" class="form-control" name="company_name" placeholder="Software Galaxy">
		  							</div>
		  							<div class="col-sm-6">
		  								<label>Name</label>
		  								<input type="email" class="form-control" name="email" placeholder="Enter Email Address">
		  							</div>
		  						</div>
		  					</div>
		  					<div class="form-group">
		  						<label>Subject</label>
		  						<input type="text" name="subject" class="form-control">
		  					</div>
		  					<div class="form-group">
		  						<div class="row">
		  							<div class="col-sm-4">
		  								<label>Department</label>
		  								<select name="department" class="form-control">
		  									<option value="">Technical</option>
		  									<option value="">Billing</option>
		  								</select>
		  							</div>
		  							<div class="col-sm-4">
		  								<label>Related Service</label>
		  								<select name="related_service" class="form-control">
		  									<option value="">None</option>
		  									<option value="">Domain</option>
		  									<option value="">Reseller</option>
		  								</select>
		  							</div>
		  							<div class="col-sm-4">
		  								<label>Priority</label>
		  								<select name="priority" class="form-control">
		  									<option value="">High</option>
		  									<option value="">Medium</option>
		  									<option value="">Low</option>
		  								</select>
		  							</div>
		  							<div class="form-group">
		  								<label>Message</label>
		  								<textarea class="form-control" rows="3">
		  									
		  								</textarea>
		  							</div>
		  							<div class="form-group">
		  								<div class="row">
		  									<div class="col-sm-9">
				  								<label>Atachments</label>
				  								<span id="attatch">
				  								<input type="file" name="atachment1" style="border:1px solid #e5e6e7;" class="form-control">
				  								</span>
				  								<small>Allowed File Extensions: .jpg, .gif, .jpeg, .png</small>
				  							</div>
				  							<div class="col-sm-3">
				  								<br>
				  								<button class="pull-right btn btn-default btn-block" type="button" onclick="addFile()"><i class="fa fa-plus"></i> Add More</button>
				  							</div>
										</div>				  									
		  							</div>
		  							<div class="form-group">
		  								<div class="row">
		  									<div class="col-sm-5 col-sm-offset-4">
		  										<button class="btn btn-success">Submit</button>
		  										<button class="btn btn-default">Cancel</button>
		  									</div>
		  								</div>
		  							</div>
		  						</div>
		  					</div>
		  				</form>
		      		</div>
		      	</div>
		    </div> 	
		</div>		      	
      </div>		
@endsection