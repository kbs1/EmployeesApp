<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>{{ config('app.name') }}</title>
		<link href="{{ mix('css/app.css') }}" rel="stylesheet">
	</head>

	<body>
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
					</div>
				</div>
			</nav>
		</header>

		<main class="mt-5 pt-4">
			<div class="container">
				@yield('content')
			</div>

			<footer class="container mt-3 border-top pt-2">
				<p>&copy; {{ date('Y') }}</p>
			</footer>
		</main>
		<script src="{{ mix('js/app.js') }}"></script>
	</body>
</html>
