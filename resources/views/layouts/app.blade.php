<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title>{{setting('app_name')}} | {{setting('app_short_description')}}</title>		
	<!-- Favicon -->
	<link rel="icon" type="image/png" href="{{$app_logo ?? ''}}"/>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css') }}">
	
	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
	<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css') }}">
	@stack('css_lib')
	<!-- Main CSS -->
	<link rel="stylesheet" href="{{asset('assets/css/style.css') }}">
	
	<!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
	 @yield('css_custom')
</head>
<body>
<!-- Main Wrapper -->
<div class="main-wrapper">
@include('layouts.header')
@include('layouts.sidenav')
@yield('content')
</div>
<!-- /Main Wrapper -->
		
		<!-- jQuery -->
		<script src="{{asset('assets/js/jquery-3.5.1.min.js') }}"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="{{asset('assets/js/popper.min.js') }}"></script>
		<script src="{{asset('assets/js/bootstrap.min.js') }}"></script>
		
		<!-- Feather Icon JS -->
		<script src="{{asset('assets/js/feather.min.js') }}"></script>
		
		<!-- Slimscroll JS -->
		<script src="{{asset('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
		
		<!-- Chart JS -->
		<script src="{{asset('assets/plugins/apexchart/apexcharts.min.js') }}"></script>
		<script src="{{asset('assets/plugins/apexchart/chart-data.js') }}"></script>
		
		<!-- Custom JS -->
		<script src="{{asset('assets/js/script.js') }}"></script>
		<!-- The core Firebase JS SDK is always required and must be listed first -->
		<script src="{{asset('https://www.gstatic.com/firebasejs/7.2.0/firebase-app.js')}}"></script>

		<script src="{{asset('https://www.gstatic.com/firebasejs/7.2.0/firebase-messaging.js')}}"></script>

		<script type="text/javascript">@include('vendor.notifications.init_firebase')</script>

		<script type="text/javascript">
		const messaging = firebase.messaging();
		navigator.serviceWorker.register("{{url('firebase/sw-js')}}")
			.then((registration) => {
				messaging.useServiceWorker(registration);
				messaging.requestPermission()
					.then(function () {
						console.log('Notification permission granted.');
						getRegToken();

					})
					.catch(function (err) {
						console.log('Unable to get permission to notify.', err);
					});
				messaging.onMessage(function (payload) {
					console.log("Message received. ", payload);
					notificationTitle = payload.data.title;
					notificationOptions = {
						body: payload.data.body,
						icon: payload.data.icon,
						image: payload.data.image
					};
					var notification = new Notification(notificationTitle, notificationOptions);
				});
			});

		function getRegToken(argument) {
			messaging.getToken().then(function (currentToken) {
				if (currentToken) {
					saveToken(currentToken);
					console.log(currentToken);
				} else {
					console.log('No Instance ID token available. Request permission to generate one.');
				}
			})
				.catch(function (err) {
					console.log('An error occurred while retrieving token. ', err);
				});
		}


		function saveToken(currentToken) {
			$.ajax({
				type: "POST",
				data: {'device_token': currentToken, 'api_token': '{!! auth()->user()->api_token !!}'},
				url: '{!! url('api/users',['id'=>auth()->id()]) !!}',
				success: function (data) {

				},
				error: function (err) {
					console.log(err);
				}
			});
		}
</script>
@stack('scripts_lib')
<script src="{{asset('js/scripts.min.js')}}"></script>
@stack('scripts')
</body>
</html>