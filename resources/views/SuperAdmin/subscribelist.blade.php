@extends('Layouts.SuperAdminDashboard')

@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
        	<div class="ibox float-e-margins">
				<div class="ibox-title">
        			<h2>Subscribe List</h2>
				</div>
                <div class="ibox-content">
                	<table class="table table-bordered table-striped dataTable" id="subscription_log">
						<thead>
							<tr>
								<th class="text-center">Subscribe ID</th>
								<th class="text-center">User</th>
								<th class="text-center">Agent</th>
								<th class="text-center">Software</th>
								<th class="text-center">Software Variation</th>
								<th class="text-center">Subscribe Date</th>
								<th class="text-center">Billing Trams</th>
								<th class="text-center">Subscribe Cupon</th>
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
@endsection

@section('script')
<script>

	$(document).ready( function () {
		$('#subscription_log').DataTable({
	        processing: true,
	        serverSide: true,
	        ajax: {
	        	url: '{{ url("/datatable/subscription_log/")}}',
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
                 { data: 'subscribe_id' },
                 { data: 'user'},
                 { data: 'agent'},
                 { data: 'software',orderable: false},
                 { data: 'variation_name',orderable: false},
                 { data: 'subscribe_date',orderable: false},
                 { data: 'subscribe_billing_trams',orderable: false},
                 { data: 'subscribe_cupon',orderable: false},
                 { data: 'status'},
                 { data: 'action',orderable: false}
              ]
	     });
	});

</script>
@endsection