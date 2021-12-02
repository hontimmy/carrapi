<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>{{setting('app_name')}} | {{setting('app_short_description')}}</title>
		<!-- Favicon -->
        <link rel="icon" type="image/png" href="{{$app_logo ?? ''}}"/>
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css')}}">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
		
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
 @yield('content')

       <!-- /Main Wrapper -->
		<!-- jQuery -->
		<script src="{{asset('assets/js/jquery-3.5.1.min.js')}}"></script>		
		<!-- Bootstrap Core JS -->
		<script src="{{asset('assets/js/popper.min.js')}}"></script>
		<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>	
		<!-- Feather Icon JS -->
		<script src="{{asset('assets/js/feather.min.js')}}"></script>	
		<!-- Custom JS -->
		<script src="{{asset('assets/js/script.js')}}"></script>
	</body>
</html>