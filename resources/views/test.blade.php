@extends('Layouts.SuperAdminDashboard')

@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="ibox-content  m-b-sm border-bottom">
		<form id="uploaddiamond" class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">
		     <div class="col-md-6">
		        <div class="block">
		            <div class="panel-body">
		              <div class="form-group">
		                    <label class="col-md-3 control-label">Upload Diamond <span class="required">*</span></label>
		                    <div class="col-md-9">
		                        <input required="" type="file" name="result_file" id="result_file" />
		                    </div>
		                </div>

		                <div class="btn-group pull-right">
		                    <button class="btn btn-primary" type="submit">Submit</button>
		                </div>
		            </div>
		        </div>
		    </div>
		</form>
	</div>
</div>

@endsection

@section('script')

<script type="text/javascript">
	
	$("#uploaddiamond").on("submit", function(e) {
	    e.preventDefault();
	    var extension = $('#result_file').val().split('.').pop().toLowerCase();
	    if ($.inArray(extension, ['csv', 'xls', 'xlsx']) == -1) {
	        $('#errormessage').html('Please Select Valid File... ');
	    } else {

	        var file_data = $('#result_file').prop('files')[0];


	        var form_data = new FormData();
	        form_data.append('file', file_data);
	        $.ajaxSetup({
	            headers: {
	                'X-CSRF-Token': $('meta[name=_token]').attr('content')
	            }
	        });

	        $.ajax({
	            url: '{{url('/test-submit')}}' ,
	            data: form_data,
	            type: 'POST',
	            contentType: false, // The content type used when sending data to the server.
	            cache: false, // To unable request pages to be cached
	            processData: false,
	            success: function(data) {

	            }
	        });
	    }
	});

</script>

@endsection