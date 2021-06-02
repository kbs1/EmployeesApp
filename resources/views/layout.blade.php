<!doctype html>
<html lang="en" class="h-100">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>@yield('title') | {{ config('app.name') }}</title>
		<link href="{{ mix('css/app.css') }}" rel="stylesheet">
	</head>

	<body class="d-flex flex-column h-100">
		<header>
			<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
				<div class="container-fluid">
					<a class="navbar-brand" href="{{ route('dashboard') }}">{{ config('app.name') }}</a>

					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>

					<div class="collapse navbar-collapse" id="navbarCollapse">
						<ul class="navbar-nav me-auto mb-2 mb-md-0">
							<li class="nav-item">
								<a class="nav-link{{ ($activePage ?? '') == 'dashboard' ? ' active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
							</li>
							<li class="nav-item">
								<a class="nav-link{{ ($activePage ?? '') == 'employees' ? ' active' : '' }}" href="{{ route('employees.listing') }}">Employees</a>
							</li>
							<li class="nav-item">
								<a class="nav-link{{ ($activePage ?? '') == 'projects' ? ' active' : '' }}" href="{{ route('projects.listing') }}">Projects</a>
							</li>
						</ul>

						@yield('controls')
					</div>
				</div>
			</nav>
		</header>

		<main class="mt-5 pt-4 mb-3 flex-shrink-0">
			<div class="container">
				@if ($errors->any())
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						Validation errors:
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>

						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				@endif

				@foreach (['success', 'warning', 'error'] as $session_key)
					@if (Session::has($session_key))
						@php($alert_class = $session_key == 'error' ? 'danger' : $session_key)
						<div class="alert alert-{{ $alert_class }} alert-dismissible fade show" role="alert">
							{{ Session::get($session_key) }}

							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
					@endif
				@endforeach

				@yield('content')
			</div>
		</main>

		<footer class="footer mt-auto border-top pt-2">
			<div class="container">
				<p>&copy; {{ date('Y') }}</p>
			</div>
		</footer>

		<script src="{{ mix('js/app.js') }}"></script>
	</body>
</html>
