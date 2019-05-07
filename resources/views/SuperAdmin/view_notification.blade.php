@extends('Layouts.SuperAdminDashboard')

@section('content')
	
	<div class="col-sm-12">
		<div class="row">
			<div class="col-sm-8">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>View Notification about {{$search_result->title}}</h5>
					</div>
					<div class="ibox-content">
						<h4 style="color: #1ab394;font-weight: bold;">
							{{$search_result->title}}
						</h4>
						<p>
							 {{$search_result->message}}<br>
						</p>
						<hr>
						@php 
						$files= explode(',', $search_result->atachment)
						@endphp
						<div class="row">
						@foreach($files as $file )
							<div class="col-sm-2">
									{{-- {{$file}} --}}
									@if(strpos($file,'.jpeg')||strpos($file,'.jpg')||strpos($file,'.png'))
									  <div class="lightBoxGallery">
				                            <a href="{{asset('public/dashboard/img/notification')}}/{{$file}}" title="{{$search_result->title}}" data-gallery=""><img src="{{asset('public/dashboard/img/notification')}}/{{$file}}" class="img-responsive" style="height: 100px;width: 100%;" alt="{{$file}}"></a>

				                            <!-- The Gallery as lightbox dialog, should be a child element of the document body -->
				                            <div id="blueimp-gallery" class="blueimp-gallery">
				                                <div class="slides"></div>
				                                <h3 class="title"></h3>
				                                <a class="prev">‹</a>
				                                <a class="next">›</a>
				                                <a class="close">×</a>
				                                <a class="play-pause"></a>
				                                <ol class="indicator"></ol>
				                            </div>

				                        </div>
									@else
									<a href="{{asset('public/dashboard/img/notification')}}/{{$file}}"> <center><span class="fa fa-download" style="font-size: 44px"></span> <br>{{$file}}</center></a>
									@endif

							</div>
						@endforeach
						</div>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>					

@endsection

                      