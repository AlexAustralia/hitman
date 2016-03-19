@extends('app')

@section('title') Reset Password | @parent @stop

@section('plugin-styles')
	<link href="{{ asset('theme/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('theme/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
	@stop

	@section('page-styles')
	<!-- BEGIN PAGE LEVEL STYLES -->
	<link href="{{ asset('theme/pages/css/login-5.min.css') }}" rel="stylesheet" type="text/css" />
	<!-- END PAGE LEVEL STYLES -->
@stop

@section('body')
	<body class="login">
	<!-- BEGIN : LOGIN PAGE 5-2 -->
	<div class="user-login-5">
		<div class="row bs-reset">
			<div class="col-md-6 login-container bs-reset">
				<img class="login-logo login-6" src="{{ asset('theme/pages/img/login/login-invert.png') }}" />
				<div class="login-content">

					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<h1>Reset Password</h1>
					<p> Please, input your email address and new password to enter to the Hitman ERP System</p>

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="token" value="{{ $token }}">

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}" autocomplete="off">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Confirm Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn blue">
									Reset Password
								</button>
							</div>
						</div>
					</form>
				</div>
				<div class="login-footer">
					<div class="row bs-reset">
						<div class="col-xs-5"></div>
						<div class="col-xs-7 bs-reset">
							<div class="login-copyright text-right">
								<p>Copyright &copy; Hitman 2016</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 bs-reset">
				<div class="login-bg"> </div>
			</div>
		</div>
	</div>
	<!-- END : LOGIN PAGE 5-2 -->
	@stop

	@section('plugin-scripts')
		<script src="{{ asset('theme/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('theme/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('theme/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('theme/global/plugins/backstretch/jquery.backstretch.min.js') }}" type="text/javascript"></script>
		@stop

		@section('page-scripts')
		<!-- BEGIN PAGE LEVEL SCRIPTS -->
		<script src="{{ asset('theme/pages/scripts/login-5.min.js') }}" type="text/javascript"></script>
		<!-- END PAGE LEVEL SCRIPTS -->
@stop
