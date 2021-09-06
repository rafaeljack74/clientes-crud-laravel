<!doctype html>
<html class="h-100" lang="pt_BR">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Clientes</title>

		{{-- Bootstrap CSS --}}
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

		{{-- Bootstrap Icons --}}
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

		{{-- Fonts --}}
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto">

		{{-- CSS --}}
		<link rel="stylesheet" href="{{ asset('/css/app.css') }}">
	</head>

	<body class="d-flex flex-column h-100">
		<header>
			<nav class="navbar navbar-light bg-custom">
				<div class="container-fluid">
					<a class="navbar-brand">{{ config('app.name') }}</a>
				</div>
			</nav>
		</header>

		<main class="pt-3">
			@yield('content')
		</main>

		<footer class="footer mt-auto">
			<p class="text-center">
				Desenvolvido por <a href="https://www.linkedin.com/in/rafaeljack74/" target="_blank">Rafael Jack</a>
			</p>
		</footer>

		{{-- Popper and Bootstrap JS --}}
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

		{{-- jQuery --}}
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

		{{-- jQuery Mask Plugin --}}
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

		{{-- SweetAlert2 --}}
		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

		@yield('script')
	</body>
</html>