<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>APPSZONES | Dashboard</title>

    <link href="{{ asset('public/dashboard/') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('public/dashboard/') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{{ asset('public/dashboard/') }}/css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="{{ asset('public/dashboard/') }}/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
    <link href="{{ asset('public/dashboard/') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('public/dashboard/') }}/css/style.css" rel="stylesheet">
    <link href="{{ asset('public/dashboard/') }}/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
</head>
<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="{{ asset('public/dashboard/') }}/img/profile_small.jpg" />
                             </span>
                            <a href="#">
                                <span class="clear">
                                    <span class="block m-t-xs"> <strong class="font-bold">User Admin</strong></span>
                                    <span class="text-muted text-xs block">Managing Director</span>
                                </span>
                            </a>
                        </div>
                        <div class="logo-element">
                            IN+
                        </div>
                    </li>
                    <li class="active">
                        <a href="{{ url('/UserAdminDashboard') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
                    </li>  
                    <li>
                        <a href="{{ url('/UserAdminProfile') }}"><i class="fa fa-wrench"></i> <span class="nav-label">My Profile</span></a>
                    </li> 
                    <li>
                        <a href="{{ url('/UserAdminSubUser') }}"><i class="fa fa-user"></i> <span class="nav-label">Sub User Manage</span></a>
                    </li>
                    <li>
                        <a href="{{ url('/UserAdminPaymentBill') }}"><i class="fa fa-credit-card"></i> <span class="nav-label">Payment / Bill</span></a>
                    </li> 
                    <!-- <li>
                        <a href="{{ url('/UserAdminApplication') }}"><i class="fa fa-desktop"></i> <span class="nav-label">Aplication</span></a>
                    </li>  -->
                    <li>
                        <a><i class="fa fa-desktop"></i> <span class="nav-label">Subscription</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="{{url('/UserAdminApplicationList')}}">Install</a></li>
                            <li><a href="{{url('/UserAdminApplicationHistory')}}">History</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ url('/UserAdminSupport') }}"><i class="fa fa-support"></i> <span class="nav-label">Support</span></a>
                    </li> 
                    <li>
                        <a href="{{ url('/UserAdminPromotion') }}"><i class="fa fa-slideshare"></i> <span class="nav-label">Promotion</span></a>
                    </li>                                                                                                      
                </ul>

            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" action="">
                <div class="form-group">
                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                </div>
            </form>
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Welcome to APPSZONES.</span>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope"></i>  <span class="label label-warning">16</span>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="img/a7.jpg">
                                </a>
                                <div class="media-body">
                                    <small class="pull-right">46h ago</small>
                                    <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="img/a4.jpg">
                                </a>
                                <div class="media-body ">
                                    <small class="pull-right text-navy">5h ago</small>
                                    <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="img/profile.jpg">
                                </a>
                                <div class="media-body ">
                                    <small class="pull-right">23h ago</small>
                                    <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                    <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="mailbox.html">
                                    <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="mailbox.html">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="profile.html">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="grid_options.html">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="notifications.html">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>


                <li>
                    <a href="login.html">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
                <li>
                    <a class="right-sidebar-toggle">
                        <i class="fa fa-tasks"></i>
                    </a>
                </li>
            </ul>

        </nav>
             @yield('content')  
            <div class="footer">
                <div class="pull-right">
                    Innovated by<strong> Md Mozammel Hoque, Md Maraj Hossain, </strong>Md Nazmul Huda
                </div>
                <div>
                    <strong>Copyright</strong> © Techno System BD Ltd
                </div>
            </div>                
        </div>
        </div>

        </div>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{ asset('public/dashboard/') }}/js/jquery-3.1.1.min.js"></script>
    <script src="{{ asset('public/dashboard/') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('public/dashboard/') }}/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="{{ asset('public/dashboard/') }}/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    <script src="{{ asset('public/dashboard/') }}/js/plugins/flot/jquery.flot.js"></script>
    <script src="{{ asset('public/dashboard/') }}/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="{{ asset('public/dashboard/') }}/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="{{ asset('public/dashboard/') }}/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="{{ asset('public/dashboard/') }}/js/plugins/flot/jquery.flot.pie.js"></script>

    <!-- Peity -->
    <script src="{{ asset('public/dashboard/') }}/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="{{ asset('public/dashboard/') }}/js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('public/dashboard/') }}/js/inspinia.js"></script>
    <script src="{{ asset('public/dashboard/') }}/js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="{{ asset('public/dashboard/') }}/js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- GITTER -->
    <script src="{{ asset('public/dashboard/') }}/js/plugins/gritter/jquery.gritter.min.js"></script>

    <!-- Sparkline -->
    <script src="{{ asset('public/dashboard/') }}/js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="{{ asset('public/dashboard/') }}/js/demo/sparkline-demo.js"></script>

    <!-- ChartJS-->
    <script src="{{ asset('public/dashboard/') }}/js/plugins/chartJs/Chart.min.js"></script>

    <!-- Toastr -->
    <script src="{{ asset('public/dashboard/') }}/js/plugins/toastr/toastr.min.js"></script>
    <script src="{{ asset('public/dashboard/') }}/js/plugins/dataTables/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
              $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExcelFile'},
                    {extend: 'pdf', title: 'PdfFile'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });

            setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                toastr.success('Expending Possibilites', 'Welcome to APPSZONES');

            }, 1300);


            var data1 = [
                [0,4],[1,8],[2,5],[3,10],[4,4],[5,16],[6,5],[7,11],[8,6],[9,11],[10,30],[11,10],[12,13],[13,4],[14,3],[15,3],[16,6]
            ];
            var data2 = [
                [0,1],[1,0],[2,2],[3,0],[4,1],[5,3],[6,1],[7,5],[8,2],[9,3],[10,2],[11,1],[12,0],[13,2],[14,8],[15,0],[16,0]
            ];
            $("#flot-dashboard-chart").length && $.plot($("#flot-dashboard-chart"), [
                data1, data2
            ],
                    {
                        series: {
                            lines: {
                                show: false,
                                fill: true
                            },
                            splines: {
                                show: true,
                                tension: 0.4,
                                lineWidth: 1,
                                fill: 0.4
                            },
                            points: {
                                radius: 0,
                                show: true
                            },
                            shadowSize: 2
                        },
                        grid: {
                            hoverable: true,
                            clickable: true,
                            tickColor: "#d5d5d5",
                            borderWidth: 1,
                            color: '#d5d5d5'
                        },
                        colors: ["#1ab394", "#1C84C6"],
                        xaxis:{
                        },
                        yaxis: {
                            ticks: 4
                        },
                        tooltip: false
                    }
            );

            var doughnutData = {
                labels: ["App","Software","Laptop" ],
                datasets: [{
                    data: [300,50,100],
                    backgroundColor: ["#a3e1d4","#dedede","#9CC3DA"]
                }]
            } ;


            var doughnutOptions = {
                responsive: false,
                legend: {
                    display: false
                }
            };


            var ctx4 = document.getElementById("doughnutChart").getContext("2d");
            new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});

            var doughnutData = {
                labels: ["App","Software","Laptop" ],
                datasets: [{
                    data: [70,27,85],
                    backgroundColor: ["#a3e1d4","#dedede","#9CC3DA"]
                }]
            } ;


            var doughnutOptions = {
                responsive: false,
                legend: {
                    display: false
                }
            };


            var ctx4 = document.getElementById("doughnutChart2").getContext("2d");
            new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});

        });
/*Custom Script for add multiple input field for file upload in open ticket page
    created by MEHEDI HASAN SHUVO
*/
function addFile(){
    $("#attatch").append("<input type='file' class='form-control' style='border:1px solid #e5e6e7;margin-top:10px;' name='attach'>");   
}
    </script>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','../../www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-4625583-2', 'webapplayers.com');
        ga('send', 'pageview');
    </script>
</body>
</html> 
