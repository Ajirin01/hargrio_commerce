<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="{{ asset( 'site/favicon.png') }}">

  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />

		<!-- Bootstrap CSS -->
		<link href="{{ asset( 'site/css/bootstrap.min.css') }}" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
		<link href="{{ asset( 'site/css/tiny-slider.css') }}" rel="stylesheet">
		<link href="{{ asset( 'site/css/style.css') }}" rel="stylesheet">
		<title>Hargrio | Premium Digital Commerce</title>
		<meta name="description" content="Hargrio Limited is a UK-based food manufacturing company specialising in heritage and alternative grain flour blends. Wheat-free, nutritious and suitable for traditional and modern cooking.">
		<meta name="keywords" content="Hargrio Limited, heritage grains UK, wheat-free flour, alternative grains, teff flour, millet flour, African swallow UK, healthy staple foods">
	
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	</head>

	<body>

		<!-- Start Header/Navigation -->
		<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

			<div class="container">
				<!-- <a class="navbar-brand" href="{{ url('/') }}">Hargrio<span>.</span></a> -->
				<a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('site/images/hargrio_favicon.png') }}" width="50" height="50" alt="Hargrio Logo"> Hargrio<span>.</span></a>


				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarsFurni">
					<ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
						<li class="nav-item active">
							<a class="nav-link" href="{{ url('/') }}">Home</a>
						</li>
						<li><a class="nav-link" href="{{ url('/shop') }}">Shop</a></li>
						<li><a class="nav-link" href="{{ url('/about') }}">About Hargrio</a></li>
						<!-- <li><a class="nav-link" href="services.html">Services</a></li> -->
						<li><a class="nav-link" href="{{ url('/blog') }}">Insights</a></li>
						<li><a class="nav-link" href="{{ url('/contact') }}">Contact us</a></li>
					</ul>

					<ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">

						@guest
							<!-- Guest: show Login/Register icons -->
							<li class="nav-item">
								<a class="nav-link" href="{{ route('login') }}">
									<img src="{{ asset('site/images/user.svg') }}" alt="Login">
								</a>
							</li>
						@else
							<!-- Authenticated User -->
							@if(auth()->user()->role === 'user')
								<li class="nav-item position-relative">
									<a class="nav-link" href="{{ route('cart.index') }}">
										<img src="{{ asset('site/images/cart.svg') }}" alt="Cart">

										@php
											$cartCount = count(session('cart', []));
										@endphp

										@if($cartCount > 0)
											<span id="cart-count"
												class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
												{{ $cartCount }}
											</span>
										@endif
									</a>
								</li>

							@endif

							<!-- User dropdown -->
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
									{{ auth()->user()->first_name }}
								</a>
								<ul class="dropdown-menu dropdown-menu-end">
									<li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
									<li>
										<form method="POST" action="{{ route('logout') }}">
											@csrf
											<button type="submit" class="dropdown-item">Logout</button>
										</form>
									</li>
								</ul>
							</li>
						@endguest

					</ul>

				</div>
			</div>
				
		</nav>
		<!-- End Header/Navigation -->

		@yield('content')

		<!-- Start Footer Section -->
		<footer class="footer-section">
			<div class="container relative">

				<div class="sofa-img">
					<img src="{{ asset('site/images/sofa.png') }}" alt="Image" class="img-fluid">
				</div>

				<div class="row">
					<div class="col-lg-8">
						<div class="subscription-form">
							<h3 class="d-flex align-items-center"><span class="me-1"><img src="{{ asset('site/images/envelope-outline.svg') }}" alt="Image" class="img-fluid"></span><span>Subscribe to Newsletter</span></h3>

							<form action="#" class="row g-3">
								<div class="col-auto">
									<input type="text" class="form-control" placeholder="Enter your name">
								</div>
								<div class="col-auto">
									<input type="email" class="form-control" placeholder="Enter your email">
								</div>
								<div class="col-auto">
									<button class="btn btn-primary">
										<span class="fa fa-paper-plane"></span>
									</button>
								</div>
							</form>

						</div>
					</div>
				</div>

				<div class="row g-5 mb-5">
					<div class="col-lg-4">
						<div class="mb-4 footer-logo-wrap">
							<a class="footer-logo" href="{{ url('/') }}"><img src="{{ asset('site/images/hargrio_favicon.png') }}" width="50" height="50" alt="Hargrio Logo"> Hargrio<span>.</span></a>
						</div>
						<p class="mb-4">
							Hargrio Limited is a UK-based food manufacturing company
							specialising in heritage and alternative grain products.
							Developing nutritious, wheat-free staple foods
							for modern households and businesses.
						</p>

						<ul class="list-unstyled custom-social">
							<li><a href="#"><span class="fa fa-brands fa-facebook-f"></span></a></li>
							<li><a href="#"><span class="fa fa-brands fa-twitter"></span></a></li>
							<li><a href="#"><span class="fa fa-brands fa-instagram"></span></a></li>
							<li><a href="#"><span class="fa fa-brands fa-linkedin"></span></a></li>
						</ul>
					</div>

					<div class="col-lg-8">
						<div class="row links-wrap">
							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<li><a href="#">About Hargrio</a></li>
									<!-- <li><a href="#">Services</a></li> -->
									<li><a href="#">Insights</a></li>
									<li><a href="#">Contact us</a></li>
								</ul>
							</div>

							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<li><a href="#">Support</a></li>
									<li><a href="#">Knowledge base</a></li>
									<li><a href="#">Live chat</a></li>
								</ul>
							</div>

							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<!-- <li><a href="#">Jobs</a></li>
									<li><a href="#">Our team</a></li>
									<li><a href="#">Leadership</a></li> -->
									<li><a href="#">Privacy Policy</a></li>
								</ul>
							</div>

							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<li><a href="#">Milla</a></li>
									<li><a href="#">MOAT</a></li>
									<li><a href="#">NutriCore</a></li>
								</ul>
							</div>
						</div>
					</div>

				</div>

				<div class="border-top copyright">
					<div class="row pt-4">
						<div class="col-lg-6">
							<p class="mb-2 text-center text-lg-start">
								Copyright &copy;<script>document.write(new Date().getFullYear());</script> Hargrio Limited. All Rights Reserved.
							</p>


						<div class="col-lg-6 text-center text-lg-end">
							<ul class="list-unstyled d-inline-flex ms-auto">
								<li class="me-4"><a href="#">Terms &amp; Conditions</a></li>
								<li><a href="#">Privacy Policy</a></li>
							</ul>
						</div>

					</div>
				</div>

			</div>
		</footer>
		<!-- End Footer Section -->	


		<script src="{{ asset('site/js/bootstrap.bundle.min.js') }}"></script>
		<script src="{{ asset('site/js/tiny-slider.js') }}"></script>
		<script src="{{ asset('site/js/custom.js') }}"></script>
	</body>

</html>
