@extends('Layouts.SuperAdminDashboard')

@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="ibox-content  m-b-sm border-bottom">
		<div class="row">
			<div class="col-sm-4">
				<div class="well">
					<label class="control-label"><?php echo trans('id'); ?> :</label>
					{{$user_data->user_id}}
					<br>
					<label class="control-label"><?php echo trans('name'); ?> :</label>
					{{$user_data->userDetails->first_name.' '.$user_data->userDetails->last_name}}
					<br>
					<label class="control-label"><?php echo trans('contact'); ?> :</label>
					{{$user_data->userDetails->phone}}
					<br>
					<label class="control-label"><?php echo trans('address'); ?> :</label>
					{{$user_data->userDetails->address}}
				</div>
			</div>
			<div class="col-sm-4">
				<div class="well">
					<label class="control-label">Total Subscribe : {{$user_data->subscribtion->count()}}</label>
					<br>
					<label class="control-label">Total Plugins : {{$plugins}} </label>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h1>Subscribe Details</h1>
				</div>
				<div class="ibox-content">
					<div class="table-responsive">
	                    <table class="table table-bordered table-striped dataTable" id="user_subscribe_details">
	                    	<thead>
	                    		<tr>
									<th class="text-center">Type</th>
									<th class="text-center">Name</th>
									<th class="text-center">For</th>
									<th class="text-center">Start</th>
									<th class="text-center">Renew</th>
									<th class="text-center">Status</th>
									<th class="text-center">Action</th>
	                    		</tr>
	                    	</thead>
	                    </table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="resone" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="javascript:void(0)" id="subscribe_change" enctype="multipart/form-data">
			@csrf
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Resone</h4>
				</div>
				<div class="modal-body">
	  				<input type="hidden" name="subscribe_id" id="subscribe_id">
					<input type="hidden" name="todo" id="todo">
	  				<div class="form-group">
	  					<textarea name="resone" class="form-control"></textarea>
					</div>
					<div class="form-group">
						<input type="file" name="document" class="form-control-file" >
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal" onclick="$('#subscribe_change').trigger('reset')" >Close</button>
					<button class="btn btn-primary" type="submit" id="save">Submit</button>
				</div>
  			</form>
		</div>
	</div>
</div>
@endsection

@section('script')
<script type="text/javascript">

	$(document).ready( function () {
		$('#user_subscribe_details').DataTable({
	        processing: true,
	        serverSide: true,
	        ajax: {
	        	url: '{{ url("/datatable/user_subscribe_details/".$user_data->user_id)}}',
	        	type: 'GET'
	        },

			dom: '<"html5buttons"B>lTfgitp',
			buttons: [
			{extend: 'copy'},
			{extend: 'csv'},
			{extend: 'excel', title: 'Log-Excel'},
			{extend: 'pdf', title: 'Log-Pdf'},
			{extend: 'print',
				customize: function (win){
					$(win.document.body).addClass('white-bg');
					$(win.document.body).css('font-size', '10px');
					
					$(win.document.body).find('table')
					.addClass('compact')
					.css('font-size', 'inherit');
				}
			}
			],
	        columns: [
	                 { data: 'subscribe_type' },
	                 { data: 'name',orderable: false},
	                 { data: 'for'},
	                 { data: 'start' },
	                 { data: 'renew',orderable: false},
	                 { data: 'status',orderable: false },
	                 { data: 'action' }
	              ]
	     });
	});

	$(document).on("click",".change_status", function(){
		var subscribe_id = $(this).attr('subscribe_id');
		var todo = $(this).attr('todo');
		$('#resone').modal('show');
		$("#subscribe_id").val(subscribe_id);
		$("#todo").val(todo);
	});

	if ($("#subscribe_change").length > 0) {
		$("#subscribe_change").validate({
			
			rules: {
				resone: {
					required: true
				},

			},
			submitHandler: function(form) {
				var $formData = new FormData(form);
				$.ajax({
					url: '{{url('/subscribe-change')}}' ,
					type: "post",
					dataType: 'json',
					data: $formData,
					contentType:false,
					cache:false,
					processData:false,
					success: function( response ) {
						$('#subscribe_change').trigger('reset');
						$('#resone').modal('hide');
						$('#user_subscribe_details').DataTable().draw(true);
						toastr.options = {
						  "closeButton": true,
						  "debug": false,
						  "progressBar": true,
						  "preventDuplicates": false,
						  "positionClass": "toast-top-right",
						  "onclick": null
						}
						
						toastr.success('',response.msg);
					}
				});
			}
		})
	}
</script>
@endsection