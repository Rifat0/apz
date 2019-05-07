@extends('Layouts.SuperAdminDashboard')

@section('style')
<style>
	.add_btn{margin-top: -7px;}
</style>
@endsection

@section('content')
<div class="col-sm-12">
	<div class="ibox float-e-margins">
		<h3>Terms & Condition List</h3>
		<div class="ibox-title">
			<a href="{{url('/terms-condition/add')}}" class="btn btn-primary pull-right add_btn"> <i class="fa fa-plus-circle"></i> Add</a>
		</div>
		<div class="ibox-content">

        	<table class="table table-bordered table-striped" id="tc_datatable">
		       <thead>
		          <tr>
		             <th class="text-center">SL</th>
		             <th class="text-center">Added</th>
		             <th class="text-center">Document</th>
		             <th class="text-center">Body</th>
		             <th class="text-center">Status</th>
		             <th class="text-center">Action</th>
		          </tr>
		       </thead>
		    </table>
		</div>
	</div>
</div>
<div class="modal fade body_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
     <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Terms & Condition Body</h4>
      </div>
	  <div class="modal-body">
			
	  </div>
    </div>
  </div>
</div>
@endsection

@section('script')

 <script>
 $(document).ready( function () {

 	$('#tc_datatable').DataTable({
         processing: true,
         serverSide: true,
         ajax: {
          url: "{{ url('/datatable/tc_datatable') }}",
          type: 'GET',
          data: function (d) {
          }
         },
         columns: [
                  { data: 't_c_id'},
                  { data: 'added_by'},
                  { data: 'document',orderable: false},
                  { data: 'body',orderable: false},
                  { data: 'status'},
                  { data: 'action',orderable: false}
               ]
      });
   });
   
  function show_modal(el){
	  var text = $(el).attr('text') || '';
	  $(".modal-body").html(text);
	  $('.body_modal').modal('toggle');
  }
   
</script>
@endsection