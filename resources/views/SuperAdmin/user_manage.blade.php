@extends('Layouts.SuperAdminDashboard')
@section('style')
<style type="text/css">
	th{text-align: center;}
</style>
@endsection
@section('content')
<div class="col-sm-12">
	<div class="ibox float-e-margins">
		<h3>User List</h3>
		<div class="ibox-content">
			@include('message')
			<table class="table table-bordered table-striped table-export" id="user_datatable">
		       <thead>
		       <tr>
			       	<th>User ID</th>
					<th>Name</th>
					<th>Username</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Join Date</th>
					<th>Status</th>
					<th>Action</th>
          		</tr>
		       </thead>
		    </table>
		</div>
	</div>
</div>
<div id="resone" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="javascript:void(0)" id="status_change" enctype="multipart/form-data">
			@csrf
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Resone</h4>
				</div>
				<div class="modal-body">
	  				<input type="hidden" name="user_id" id="user_id">
	  				<div class="form-group">
	  					<textarea name="resone" class="form-control"></textarea>
					</div>
					<div class="form-group">
						<input type="file" name="document" class="form-control-file" >
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal" onclick="$('#status_change').trigger('reset')" >Close</button>
					<button class="btn btn-primary" type="submit" id="save">Submit</button>
				</div>
  			</form>
		</div>
	</div>
</div>
@endsection

@section('script')
<script>
	$(document).ready( function () {

		$('#user_datatable').DataTable({
	        processing: true,
	        serverSide: true,
	        ajax: {
	         url: "{{ url('/datatable/user_datatable') }}",
	         type: 'GET',
	         data: function (d) {
	         }
	        },

			dom: '<"html5buttons"B>lTfgitp',
			buttons: [
			{extend: 'copy'},
			{extend: 'csv'},
			{extend: 'excel', title: 'User-Excel'},
			{extend: 'pdf', title: 'User-Pdf'},
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
	                 { data: 'user_id' },
	                 { data: 'name',orderable: false},
	                 { data: 'username'},
	                 { data: 'email' },
	                 { data: 'phone',orderable: false},
	                 { data: 'register_date' },
	                 { data: 'banned'},
	                 { data: 'action',orderable: false}
	              ]
	     });
	});

	$(document).on("click",".user_status_change", function(){
		var user_id = $(this).attr('user_id');
		$('#resone').modal('show');
		$("#user_id").val(user_id);
	});

	if ($("#status_change").length > 0) {
		$("#status_change").validate({
			
			rules: {
				resone: {
					required: true
				},

			},
			submitHandler: function(form) {
				var $formData = new FormData(form);
				$.ajax({
					url: '{{url('/user-status-change')}}' ,
					type: "post",
					dataType: 'json',
					data: $formData,
					contentType:false,
					cache:false,
					processData:false,
					success: function( response ) {
						$('#status_change').trigger('reset');
						$('#resone').modal('hide');
						$('#user_datatable').DataTable().draw(true);
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
