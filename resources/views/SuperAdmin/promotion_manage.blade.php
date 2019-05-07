@extends('Layouts.SuperAdminDashboard')

@section('style')
<style>
	.add_btn{margin-top: -7px;}
</style>
@endsection

@section('content')
<div class="col-sm-12">
	<div class="ibox float-e-margins">
		<h3>Promotion List</h3>
		<div class="ibox-title">
			<button class="btn btn-primary pull-right add_btn" data-toggle="modal" data-target="#AddPromocodeModal"> <i class="fa fa-plus-circle"></i> Add</button>
		</div>
		<div class="ibox-content">
			<table class="table table-bordered table-striped" id="promocode_datatable">
		       <thead>
		          <tr>
		             <th class="text-center">SL</th>
		             <th class="text-center">Ptomotion Title</th>
		             <th class="text-center">Promotion Code</th>
		             <th class="text-center">Amount</th>
		             <th class="text-center">Publish For</th>
		             <th class="text-center">Use Limit</th>
		             <th class="text-center">Used</th>
		             <th class="text-center">Created</th>
		             <th class="text-center">Expiry</th>
		             <th class="text-center">Status</th>
		             <th class="text-center">Document</th>
		             <th class="text-center">Action</th>
		          </tr>
		       </thead>
		    </table>
		</div>
	</div>
</div>

<div id="AddPromocodeModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add Promocode</h4>
			</div>
			<div class="modal-body">
  				<form action="javascript:void(0)" id="promocode_add" enctype="multipart/form-data">
				@csrf
  				<div class="form-group">
					<label>Title</label>
					<input type="text" name="title" class="form-control" >
				</div>
				<div class="form-group">
					<label>Code</label>
					<input type="text" name="code" class="form-control" >
				</div>
				<div class="form-group">
					<label>Amount</label>
					<input type="text" name="amount" class="form-control" >
				</div>
				<div class="form-group">
					<label>Publish For</label>
					<select name="publish_for" class="form-control">
						<option value="">Select One</option>
						<option value="Subscription Payment">Subscription Payment</option>
					</select>
				</div>
				<div class="form-group">
					<label>Use Limit</label>
					<input type="text" name="use_limit" class="form-control" >
				</div>
				<div class="form-group date" id="datepicker">
					<label>Expiry</label>
					<div class="input-group date">
						<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
						<input type="text" class="form-control" name="expiry" readonly />
					</div>
				</div>
				<div class="form-group">
					<label>Related document:</label>
					<input type="file" name="document" class="form-control-file" >
					<strong>Only image file</strong>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" onclick="$('#promocode_add').trigger('reset')" >Close</button>
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

 	$('#promocode_datatable').DataTable({
         processing: true,
         serverSide: true,
         ajax: {
          url: "{{ url('/datatable/promocode_datatable') }}",
          type: 'GET',
          data: function (d) {
          }
         },

         dom: '<"html5buttons"B>lTfgitp',
         buttons: [
         {extend: 'copy'},
         {extend: 'csv'},
         {extend: 'excel', title: 'Promotion-Excel'},
         {extend: 'pdf', title: 'Promotion-Pdf'},
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
                  { data: 'promocode_id' },
                  { data: 'title' },
                  { data: 'code',orderable: false },
                  { data: 'amount' },
                  { data: 'publish_for' },
                  { data: 'use_limit' },
                  { data: 'used'},
                  { data: 'created_at'},
                  { data: 'expiry'},
                  { data: 'status'},
                  { data: 'document',orderable: false},
                  { data: 'action',orderable: false}
               ]
           });
 	});

	$(document).on("click",".promocode_status_change", function(){
		var promocode_id = $(this).attr('promocode_id');

	 	$.ajax({
	 		url: '{{ url("/promocode-status")}}'+'/'+promocode_id,
	 		type: "get",
	 		success: function( response ) {
	 			$('#promocode_datatable').DataTable().draw(true);
	 		}
	 	});
	});

	$(document).on("click",".swal-button--confirm", function(){
		$('#promocode_datatable').DataTable().draw(true);
	});

	$(document).on("click",".promocode_delete", function(){
		var promocode_id = $(this).attr('promocode_id');
		swal({
			title: "Delete",
			text: "Are you sure?",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {

				var url = '{{ route("promocode-delete", ":id") }}';
				url = url.replace(':id', promocode_id);
				window.location.href=url;
			}
		});
	});

	$(document).on("click",".swal-button--confirm", function(){
		$('#modal').modal('hide');
	});
	
	if ($("#promocode_add").length > 0) {
		$("#promocode_add").validate({
			
			rules: {
				title: {
					required: true
				},
				code: {
					required: true,
					digits:true,
					minlength:6,
					maxlength:6,
				},
				amount: {
					required: true,
					digits:true,
				},
				publish_for: {
					required: true,
				},
				use_limit: {
					required: true,
					digits:true,
				},
				expiry: {
					required: true,
					date: true
				},

			},
			messages: {
				
				title: {
					required: "Please enter promotion title"
				},
				mobile_number: {
					required: "Please enter promocode",
					minlength: "The promocode should be 6 digits",
					digits: "Please enter only numbers",
					maxlength: "The promocode should be 6 digits",
				},
				amount: {
					required: "Please enter amount",
					digits: "Please enter only numbers",
				},
				publish_for: {
					required: "Please enter darget",
				},
				use_limit: {
					required: "Please enter usages limit",
					digits: "Please enter only numbers",
				},
				expiry: {
					required: "Please enter expiry date",
					date: "Please enter only valid date",
				},
				
			},
			submitHandler: function(form) {
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$('#save').html('Saving..');

				var $formData = new FormData(form);
				$.ajax({
					url: '{{url('/promocode-submit')}}' ,
					type: "post",
					dataType: 'json',
					data: $formData,
					contentType:false,
					cache:false,
					processData:false,
					success: function( response ) {
						console.log(response.message);
						$('#promocode_add').trigger('reset');
						$('#AddPromocodeModal').modal('hide');
						swal(response.msg, {
							icon: "success",
							text: response.msg,
						});
					}
				});
			}
		})
	}
</script>
@endsection