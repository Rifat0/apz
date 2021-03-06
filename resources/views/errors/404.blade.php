<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{env('APP_NAME')}} || 404 Error</title>

    <link href="{{asset('public/dashboard/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/dashboard/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('public/dashboard/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('public/dashboard/css/style.css')}}" rel="stylesheet">

</head>

<body class="gray-bg">


    <div class="middle-box text-center animated fadeInDown">
        <h1><strong>404</strong></h1>
        <h3 class="font-bold">Page Not Found</h3>

        <div class="error-desc">
            Sorry, but the page you are looking for has note been found. Try checking the URL for error, then hit the refresh button on your browser or try found something else in our app.
            <br/><a href="{{url('/')}}" class="btn btn-primary m-t">Dashboard</a>
    </div>

    <!-- Mainly scripts -->
    <script src="{{asset('public/dashboard/js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('public/dashboard/js/bootstrap.min.js') }}"></script>
    
</body>

</html>
