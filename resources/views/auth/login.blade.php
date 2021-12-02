@extends('layouts.authlayout')
@section('content')

    <!-- Main Wrapper -->
		<div class="main-wrapper login-body">
			<div class="login-wrapper">
				<div class="container">
				
					<a href="{{ url('/') }}"><img class="img-fluid logo-dark mb-2" src="{{$app_logo}}" alt="{{setting('app_name')}}"></a>
					<div class="loginbox">
						
						<div class="login-right">
							<div class="login-right-wrap">
								<h1>Login</h1>
								<p class="account-subtitle">Access to our dashboard</p>
								
								<form action="{{ url('/login') }}" method="post">
								{!! csrf_field() !!}
									<div class="form-group">
										<label class="form-control-label">Email Address</label>
										<input type="email" value="{{ old('email') }}" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="{{ __('auth.email') }}" aria-label="{{ __('auth.email') }}">
										@if ($errors->has('email'))
											<div class="invalid-feedback">
												{{ $errors->first('email') }}
											</div>
										@endif
									</div>
									<div class="form-group">
										<label class="form-control-label">Password</label>
										<div class="pass-group">
											<input type="password" value="{{ old('password') }}" type="password" class="form-control pass-input  {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{__('auth.password')}}" aria-label="{{__('auth.password')}}">
											<span class="fas fa-eye toggle-password"></span>
											@if ($errors->has('password'))
												<div class="invalid-feedback">
													{{ $errors->first('password') }}
												</div>
											@endif
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-6">
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="remember" name="remember">
													<label class="custom-control-label" for="remember">Remember me</label>
												</div>
											</div>
											
										</div>
									</div>
									<button class="btn btn-lg btn-block btn-dark" type="submit">Login</button>																	
								</form>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

@endsection


