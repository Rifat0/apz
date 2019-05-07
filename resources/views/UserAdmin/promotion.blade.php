@extends('Layouts.UserAdminDashboard')

@section('content')
    <div class="col-md-12">
	      <div class="row">
	      	<div class="col-sm-6">
	      		<div class="ibox float-e-margins">
		      		<div class="ibox-title">
		      			<h3>Promotion  <small class="h5">your promotion code</small></h3>
		      		</div>
		      		<form>
			      		<div class="ibox-content">
			      			<h3 class="text-center">You got 300 tk from promo code  </h3>
			      			<br>
			      			<div class="form-group">
			      				<input type="text" name="promo_code" placeholder="Enter Your Promo Code" class="form-control">
			      			</div>
			      			<br>
			      			<div class="form-group">
			      				<button type="submit" class="btn btn-success btn-block">Submit</button>
			      			</div>
			      		</div>
		      		</form>
	           </div>
	      	</div>
	      	<div class="col-sm-6">
	      		<div class="ibox float-e-margins">
		      		<div class="ibox-title">
		      			<h3>Invite <small class="h5">Invite to your friends.</small></h3>
		      		</div>
		      		<div class="ibox-content">
		      			<h3 class="text-center">Your Invitation Code is M5JL9THERD </h3>
		      			<br>
		      			<div class="row">
		      				<div class="col-sm-6 col-sm-offset-3">
		      					<div class="row invite_social_link">
		      						<div class="col-sm-12 text-center">
		      							<a href="" class="h1"><i class="fa fa-facebook-square"></i></a>
		      							<a href="" class="h1"><i class="fa fa-twitter-square"></i></a>
		      							<a href="" class="h1"><i class="fa fa-google"></i></a>
		      							<a href="" class="h1"><i class="fa fa-linkedin"></i></a>
		      						</div>
		      						
		      					</div>
		      				</div>
		      			</div><br><br>
		      			<div class="row">
		      				<div class="col-sm-12">
		      					<p class="text-center">Invite your friend and get 1 Promo code</p>
		      				</div>
		      			</div>
		      		</div>
	           </div>
	      	</div>
	      </div>             
     </div>                 
@endsection