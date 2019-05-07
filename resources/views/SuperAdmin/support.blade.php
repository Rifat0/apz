@extends('Layouts.SuperAdminDashboard')
@section('style')

@endsection
@section('content')
  <div class="col-sm-12">
        	<div class="ibox float-e-margins">
          		<div class="ibox-title">
          			<h2>My Support Tickets <small class="h5">Your Ticket History</small></h2>
          			
          		</div>
          		<div class="ibox-content">
              <div class="tabs-container">

                  <div class="tabs">
                      <ul class="nav nav-tabs">
                          <li class="active"><a data-toggle="tab" href="#new" aria-expanded="true">New</a></li>
                          <li class=""><a data-toggle="tab" href="#action" aria-expanded="true">Action</a></li>
                          <li class=""><a data-toggle="tab" href="#view" aria-expanded="true">View</a></li>
                      </ul>
                      <div class="tab-content">
                          <div id="new" class="tab-pane active">
                              <div class="panel-body">
                                   <table class="table table-bordered table-striped dataTables-example dataTable">
                                      <thead>
                                        <th class="text-center">Department</th>
                                        <th class="text-center">Subject</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Last Update</th>
                                        <th class="text-center">Action</th>
                                      </thead>
                                      <tbody class="text-center">
                                        <td>Technical</td>
                                        <td>Something Subject write in here</td>
                                        <td><span class="label label-primary">Complete</span></td>
                                        <td>25 November 2018</td>
                                        <td><a href="{{url('/SuperAdminViewTicket')}}" class="btn btn-xs btn-primary">View</a></td>
                                      </tbody>
                                    </table>
                              </div>
                          </div>
                          <div id="action" class="tab-pane">
                              <div class="panel-body">
                                  <table class="table table-bordered table-striped dataTables-example dataTable">
                                      <thead>
                                        <th class="text-center">Department</th>
                                        <th class="text-center">Subject</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Last Update</th>
                                        <th class="text-center">Action</th>
                                      </thead>
                                      <tbody class="text-center">
                                        <td>Technical</td>
                                        <td>Something Subject write in here</td>
                                        <td><span class="label label-primary">Complete</span></td>
                                        <td>25 November 2018</td>
                                        <td><a href="{{url('/SuperAdminViewTicket')}}" class="btn btn-xs btn-primary">View</a></td>
                                      </tbody>
                                    </table>
                              </div>
                          </div>
                          <div id="view" class="tab-pane">
                              <div class="panel-body">
                                  <table class="table table-bordered table-striped dataTables-example dataTable">
                                      <thead>
                                        <th class="text-center">Department</th>
                                        <th class="text-center">Subject</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Last Update</th>
                                        <th class="text-center">Action</th>
                                      </thead>
                                      <tbody class="text-center">
                                        <td>Technical</td>
                                        <td>Something Subject write in here</td>
                                        <td><span class="label label-primary">Complete</span></td>
                                        <td>25 November 2018</td>
                                        <td><a href="{{url('/SuperAdminViewTicket')}}" class="btn btn-xs btn-primary">View</a></td>
                                      </tbody>
                                    </table>
                              </div>
                          </div>
                      </div>

                  </div>

              </div>
          		</div>
        	</div>

      </div>		 
@endsection