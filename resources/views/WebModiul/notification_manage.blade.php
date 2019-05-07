@extends('Layouts.SuperAdminDashboard')

@section('content')
<div class="col-md-12">
    <div class="row">
    	<div class="col-sm-6">
	      	<div class="ibox float-e-margins">
	      		<div class="ibox-title">
	      			<h2>Add Notification</h2>
	      		</div>
	      		<div class="ibox-content">
	      			@if(isset($notification))
	  				<form action="{{url('/notification-update')}}" method="post">
  					@else
  					<form action="{{url('/notification-submit')}}" method="post">
  					@endif
	  					@csrf
	  					@if(isset($notification))
	  					<input type="hidden" name="notification_id" value="{{$notification->notification_id}}">
	  					@endif
	  					@include('message')
	  					<div class="form-group">
	  						<label>Title</label>
	  						<input type="text" name="title" class="form-control" value="@if(isset($notification)){{$notification->title}}@endif">
	  					</div>
	  					<div class="form-group">
	  						<label>Message</label>
	  						<textarea class="form-control" name="message">@if(isset($notification)){{$notification->message}}@endif</textarea>
	  					</div>
	  					<div class="form-group">
	  						<label>Link</label>
	  						<input type="text" name="link" class="form-control" value="@if(isset($notification)){{$notification->link}}@endif">
			  			</div>
	  					<div class="form-group">
	  						<div class="row">
	  							<div class="col-sm-5">
	  								<button class="btn btn-success" type="submit">Submit</button>
	  							</div>
	  						</div>
	  					</div>
	  				</form>
	      		</div>
	      	</div>
	    </div>
        <div class="col-sm-6">
        	<div class="ibox">
        		<div class="ibox-content">
        			<table class="table table-bordered table-responsive text-center dataTables-example dataTable">
	            		<thead>
	            			<tr>
	            				<th class="text-center">Title</th>
	            				<th class="text-center">Message</th>
	            				<th class="text-center">Send At</th>
	            				<th class="text-center">Status</th>
	            				<th class="text-center">Action</th>
	            			</tr>
	            		</thead>
	            		<tbody>
	            			@if(isset($notifications))
	            			@foreach($notifications as $notification)
	            			<tr>
	            				<td>{{$notification->title}}</td>
	            				<td>{{$notification->message}}</td>
	            				<td>{{ Carbon\Carbon::parse($notification->created_at)->format('H:i:s d-m-Y') }}</td>
	            				<td>
	            					@if($notification->status=="active")
	            					<button type="button" class="btn btn-primary btn-xs">Active</button>
	            					@elseif($notification->status=="deactive")
	            					<button type="button" class="btn btn-danger btn-xs">Deactive</button>
	            					@endif
	            				</td>
	            				<td>
	            					<div class="btn-group">
	            						<button type="button" class="btn btn-info dropdown-toggle btn-xs" data-toggle="dropdown" aria-expanded="false">Action<span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
		            					<ul class="dropdown-menu pull-right">
			            					<li><a href="{{$notification->link}}" target="_blank"><i class="fa fa-eye"></i> View</a></li>
			            					<li><a href="{{url('/notification-edit/'.$notification->notification_id)}}" ><i class="fa fa-edit"></i> Edit</a></li>
			            					<li><a href="{{url('/notification-status/'.$notification->notification_id)}}" ><i class="fa fa-ioxhost"></i> Change Status</a></li>
			            					<li><a href="javascript:void(0)" notification_id="{{$notification->notification_id}}" class="notification_delete" ><i class="fa fa-trash"></i> Delete</a></li>
			            				</ul>
			            			</div>
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
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script type="text/javascript">
	$(document).on("click",".notification_delete", function(){
		var notification_id = $(this).attr('notification_id');
		swal({
			title: "Delete",
			text: "Are you sure?",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				
				var url = '{{ route("notification-delete", ":id") }}';
				url = url.replace(':id', notification_id);
				window.location.href=url;
			}
		});
	});
</script>
@endsection