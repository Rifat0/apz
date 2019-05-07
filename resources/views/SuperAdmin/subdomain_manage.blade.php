@extends('Layouts.SuperAdminDashboard')

@section('style')
<style type="text/css">
	th{text-align: center;}
</style>
@endsection

@section('content')
<div class="col-sm-12">
	<div class="ibox float-e-margins">
		<div class="ibox-title">
			<h5>Manage Subdomain</h5>
		</div>
		<div class="ibox-content">
			<table class="table table-bordered table-striped dataTable" id="sub_domain_datatable">
				<thead>
					<tr>
						<th>ID</th>
						<th>User</th>
						<th>Subdomain</th>
					</tr>
				</thead>
			</table>	
		</div>
	</div>
</div>	
@endsection

@section('script')
<script type="text/javascript">

	$(document).ready( function () {
		$('#sub_domain_datatable').DataTable({
	        processing: true,
	        serverSide: true,
	        ajax: {
	        	url: '{{ url("/datatable/sub_domain_datatable/")}}',
	        	type: 'GET'
	        },

			dom: '<"html5buttons"B>lTfgitp',
			buttons: [
			{extend: 'copy'},
			{extend: 'csv'},
			{extend: 'excel', title: 'Excel'},
			{extend: 'pdf', title: 'Pdf'},
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
	                 { data: 'domain_id' },
	                 { data: 'user_id'},
	                 { data: 'sub_domain',orderable: false}
	              ]
	     });
	});

</script>
@endsection