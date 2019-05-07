@extends('Layouts.SuperAdminDashboard')

@section('content')
    <div class="col-md-12">
    	@include('message')
            <div class="row">
            	<div class="col-sm-6">
		      	<div class="ibox float-e-margins">
		      		<div class="ibox-title">
		      			<h2>Add Tutorial</h2>
		      		</div>
		      		<div class="ibox-content">
		  				<form method="POST" action="{{url('/SuperAdminTutorialAdd')}}">	
		  				@csrf	  					
		  					<div class="form-group">
		  						<label>Title</label>
		  						<input type="text" name="title" class="form-control">
		  					</div>
		  					<div class="form-group">
		  						<label>Tutorial Link</label>
		  						<input type="text" name="tutorial_link" class="form-control" placeholder="https://youtu.be/dtKdo8lzJiA">
		  					</div>
		  					<div class="form-group">
		  						<label>Short Description</label>
		  						<textarea name="tutorial_description" rows="3" cols="5" class="form-control"></textarea>
		  						<small>Maximaum 150 word</small>
		  					</div>
		  					<div class="form-group">
		  						<div class="row">
		  							<div class="col-sm-5">
		  								<button class="btn btn-success" type="submit">Submit</button>
		  								<button class="btn btn-default" type="reset">Reset</button>
		  							</div>
		  						</div>
		  					</div>
		  				</form>
		      		</div>
		      	</div>
		    </div>
            <div class="col-sm-6">
            	<div class="ibox">
            		<div class="ibox-title">
            			<h3>All Tutorial</h3>
            		</div>
            		<div class="ibox-content">
            			<table class="table table-bordered table-responsive text-center dataTables-example dataTable">
		            		<thead>
		            			<tr>
		            				<th class="text-center">Sl.No</th>
		            				<th class="text-center">Title</th>
		            				<th class="text-center">Short Description</th>
		            				<th class="text-center">Created At</th>
		            				<th class="text-center">Action</th>
		            			</tr>
		            		</thead>
		            		<tbody>
		            			@foreach($search_result as $result)
		            			<tr>
		            				<td>{{$result->tutorial_id}}</td>
		            				<td>{{$result->title}}</td>
		            				<td>{{substr($result->tutorial_description,'0','30')}}.....</td>
		            				<td>{{date('d-m-Y',strtotime($result->created_at))}}</td>
		            				<td>
		            					<a href="{{url('/SuperAdminTutorialView')}}/{{$result->tutorial_id}}" class="btn btn-primary btn-xs"> <i class="fa fa-eye"></i> </a>
		            					<a href="#myModal" class="btn btn-success btn-xs tutorial_edit{{$result->tutorial_id}}" onclick="TutorialEdit({{$result->tutorial_id}})" 
		            						id="{{$result->tutorial_id}}"
		            						title="{{$result->title}}"
		            						description="{{$result->tutorial_description}}"
		            						link="{{$result->youtube_link}}"
		            						data-toggle="modal"
		            					><i class="fa fa-edit"></i>
		            					</a>
		            					<a href="{{url('/SuperAdminTutorialDelete')}}/{{$result->tutorial_id}}" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
		            				</td>
		            			</tr>
		            			@endforeach
		            		</tbody>
            			</table>
            		</div>
            	</div>		
            </div>
            </div>
     </div>  
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tutorial Edit</h4>
            </div>
            <form enctype="multipart/form-data" action="{{url('/SuperAdminTutorialUpdate')}}" method="POST">
                @csrf
                <div class="modal-body">

                    <input type="hidden" name="t_id" id="t_id">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                    </div>
                    <div class="form-group">
		  						<label>Tutorial Link</label>
		  						<input type="text" name="tutorial_link" id="tutorial_link" class="form-control" placeholder="https://youtu.be/dtKdo8lzJiA" value="{{old('tutorial_link')}}">
		  			</div>
		  			<div class="form-group">
		  						<label>Short Description</label>
		  						<textarea name="tutorial_description" id="tutorial_description" rows="5" cols="5" class="form-control">{{old('tutorial_description')}}</textarea>
		  						<small>Maximaum 150 word</small>
		  			</div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>

        </div>
    </div>
</div>
<script type="text/javascript">
	function TutorialEdit(id){
		var title = $(".tutorial_edit"+id).attr('title');
		var des = $(".tutorial_edit"+id).attr('description');
		var link = $(".tutorial_edit"+id).attr('link');
		$("#t_id").val(id);
		$("#title").val(title);
		$("#tutorial_description").val(des);
		$("#tutorial_link").val(link);
	}
</script>
@endsection
