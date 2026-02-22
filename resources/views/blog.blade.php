@extends('layouts.site')
@section('content')
    <!-- Start Hero Section -->
		<div class="hero">
			<div class="container">
				<div class="row justify-content-between">
					<div class="col-lg-5">
						<div class="intro-excerpt">
							<h1>Insights & Knowledge Hub</h1>
							<p class="mb-4">
								Explore articles on heritage grains, wheat-free nutrition,
								traditional staple foods and modern food innovation.
								Hargrio shares practical knowledge, product insights and
								cooking guidance to support households, retailers and
								catering businesses.
							</p>
							<p>
								<a href="shop.html" class="btn btn-secondary me-2">Shop Products</a>
								<a href="about.html" class="btn btn-white-outline">About Hargrio</a>
							</p>
						</div>
					</div>
					<div class="col-lg-7">
						<div class="hero-img-wrap">
							<img src="{{ asset('site/images/hargrio_hero.png') }}" class="img-fluid" alt="Hargrio Heritage Grains">
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Hero Section -->


		

		<!-- Start Blog Section -->
		<div class="blog-section">
			<div class="container">
				<div class="row">

					<div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0">
						<div class="post-entry">
							<a href="#" class="post-thumbnail"><img src="{{ asset('site/images/post-1.jpg') }}" alt="Image" class="img-fluid"></a>
							<div class="post-content-entry">
								<h3><a href="#">Understanding Heritage Grains in Modern Diets</a></h3>
								<!-- <div class="meta">
									<span>by <a href="#">Kristin Watson</a></span> <span>on <a href="#">Dec 19, 2021</a></span>
								</div> -->
							</div>
						</div>
					</div>

					<div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0">
						<div class="post-entry">
							<a href="#" class="post-thumbnail"><img src="{{ asset('site/images/post-2.jpg') }}" alt="Image" class="img-fluid"></a>
							<div class="post-content-entry">
								<h3><a href="#">Wheat-Free Alternatives for Everyday Cooking</a></h3>
								<!-- <div class="meta">
									<span>by <a href="#">Robert Fox</a></span> <span>on <a href="#">Dec 15, 2021</a></span>
								</div> -->
							</div>
						</div>
					</div>

					<div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0">
						<div class="post-entry">
							<a href="#" class="post-thumbnail"><img src="{{ asset('site/images/post-3.jpg') }}" alt="Image" class="img-fluid"></a>
							<div class="post-content-entry">
								<h3><a href="#">Preparing Smooth Swallow with Hargrio Heritage Grain Blends</a></h3>
								<!-- <div class="meta">
									<span>by <a href="#">Kristin Watson</a></span> <span>on <a href="#">Dec 12, 2021</a></span>
								</div> -->
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		<!-- End Blog Section -->	
@endsection