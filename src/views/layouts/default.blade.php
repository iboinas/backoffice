<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<title> 
			@section('title') 
			@show 
		</title>

		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">


		<style>
		@section('styles')
			body {
				padding-top: 60px;
			}
		@show
		</style>

		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->


		<!-- jQuery and jQuery validation -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script src="http://cdn.jsdelivr.net/jquery.validation/1.14.0/jquery.validate.js"></script>

	
	</head>

	<body>
		

		<!-- Navbar -->
		<div class="navbar navbar-inverse navbar-fixed-top">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <a class="navbar-brand" href="{{ route('backoffice.home') }}">Backoffice</a>
	        </div>
	        <div class="collapse navbar-collapse">
	          <ul class="nav navbar-nav">
				@if ( Sentinel::check() && Sentinel::getUser()->hasAccess('superuser'))
					<li {{ (Request::is('backoffice/user*') ? 'class=active' : '') }}><a href="{!! route('backoffice.users.index') !!}">Users</a></li>
					<li {{ (Request::is('backoffice/role*') ? 'class=active' : '' ) }}><a href="{!! route('backoffice.roles.index') !!}">Roles</a></li>
				@endif
	          </ul>
	          <ul class="nav navbar-nav navbar-right">
	            @if (Sentinel::check())
					<li {{ (Request::is('profile') ? 'class="active"' : '') }}><a href="#">{{ Session::get('email') }}</a></li>
					<li> <a href="{!! route('backoffice.logout') !!}">Logout</a> </li>
				@else
				<li {{ (Request::is('login') ? 'class="active"' : '') }}><a href="{{ route('backoffice.login') }}">Login</a></li>
				@endif
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </div>
		<!-- ./ navbar -->

		<!-- Container -->
		<div class="container">
			<!-- Notifications -->
			@include('Backoffice::layouts/notifications')
			<!-- ./ notifications -->

			<!-- Content -->
			@yield('content')
			<!-- ./ content -->
		</div>

		<!-- ./ container -->

		<!-- Javascripts
		================================================== -->


		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

	</body>
</html>
