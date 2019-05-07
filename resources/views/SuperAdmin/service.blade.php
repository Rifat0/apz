@extends('Layouts.SuperAdminDashboard')
@section('content')
<div class="col-sm-6">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h2>Add Service</h2>
        </div>
        <div class="ibox-content">
            @include('message')
            <form enctype="multipart/form-data" action="{{url('/SuperAdminServiceAdd')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Service Title</label>
                    <input type="text" name="service_title" class="form-control" value="{{ old('service_title') }}">
                </div>
                <div class="form-group">
                    <label>About Service</label>
                    <textarea class="form-control" rows="3" name="service_details">
                        {{old('service_details')}}
                    </textarea>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12">
                            <label>Atachments</label>
                            <span id="attatch">
				  							<input type="file" name="service_attachment" style="border:1px solid #e5e6e7;" class="form-control">
				  						</span>
                            <small>Allowed File Extensions: .jpg, .jpeg, .png</small>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-5">
                            <button class="btn btn-success" type="submit">Submit</button>
                            <button class="btn btn-default">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-sm-6">
    <div class="ibox float-e-margins">
        <div class="ibox-title">

        </div>
        <div class="ibox-content">
            <table class="table table-bordered table-responsive text-center dataTables-example dataTable">
                <thead>
                    <tr>
                        <th class="text-center">Sl.No</th>
                        <th class="text-center">Title</th>
                        <th class="text-center">About Service</th>
                        <th class="text-center">Image</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $service)
                    <tr>
                        <td>{{$service->service_id}}</td>
                        <td>{{$service->service_title}}</td>
                        <td>{{$service->service_details}}</td>
                        <td>
                            <img src="{{asset('public/dashboard/img/service/')}}/{{$service->service_attachment}}" alt="Service1" style="height: 40px;width: 40px;">
                        </td>
                        <td>
                            {{-- <a href="" class="btn btn-primary btn-xs">View</a> --}}
                            <a href="#myModal" class="btn btn-success btn-xs service_edit{{$service->service_id}}" data-toggle="modal" service_id{{$service->service_id}}="{{$service->service_id}}"
		            					 service_title{{$service->service_id}}="{{$service->service_title}}"
		            					 service_details{{$service->service_id}}="{{$service->service_details}}"
		            					 service_image{{$service->service_id}}="{{$service->service_attachment}}"
		            					 onclick="EditModal({{$service->service_id}})" 
		            					 > <i class="fa fa-edit border-round"></i> </a>
                            <a href="{{url('/SuperAdminServiceDelete')}}/{{$service->service_id}}" class="btn btn-danger btn-xs"><i class="fa fa-trash border-round"></i></a>
                            <!-- Button trigger modal -->
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Service Edit</h4>
            </div>
            <form enctype="multipart/form-data" action="{{url('/SuperAdminServiceUpdate')}}" method="POST">
                @csrf
                <div class="modal-body">

                    <input type="hidden" name="service_id" id="s_id">
                    <input type="hidden" name="service_image" value="" id="service_image">
                    <div class="form-group">
                        <label>Service Title</label>
                        <input type="text" name="service_title" id="service_title" class="form-control" value="{{ old('service_title') }}">
                    </div>
                    <div class="form-group">
                        <label>About Service</label>
                        <textarea class="form-control" rows="3" id="service_details" name="service_details">
                            {{old('service_details')}}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Atachments</label>
                                <span id="attatch">
				  							<input type="file" id="service_attachment" name="service_attachment" style="border:1px solid #e5e6e7;" class="form-control">
				  						</span>
                                <small>Allowed File Extensions: .jpg, .jpeg, .png</small>
                                <br>
                            </div>
                        </div>
                    </div>
                    {{--
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-5">
                                <button class="btn btn-success" type="submit">Submit</button>
                                <button class="btn btn-default">Cancel</button>
                            </div>
                        </div>
                    </div> --}}

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
    function EditModal(id) {

        // var service_id = $(".service_edit"+id).attr('service_id'+id);
        // alert(service_id);
        $("#s_id").val(id);
        var service_title = $(".service_edit" + id).attr('service_title' + id);
        $("#service_title").val(service_title);
        var service_details = $(".service_edit" + id).attr('service_details' + id);
        $("#service_details").val(service_details);
        var service_image = $(".service_edit" + id).attr('service_image' + id);
        $("#service_image").val(service_image);
    }
</script>
@endsection