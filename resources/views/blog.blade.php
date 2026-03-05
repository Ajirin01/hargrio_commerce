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

					@forelse($posts as $post)

						<div class="col-12 col-sm-6 col-md-4 mb-4">
							<div class="post-entry">

								<a href="{{ route('blog.show', $post->slug) }}" class="post-thumbnail">
									<img src="{{ asset('public/' . ($post->feature_image ?? 'post-1.jpg')) }}" 
										alt="{{ $post->title }}" 
										class="img-fluid">
								</a>

								<div class="post-content-entry">
									<h3>
										<a href="{{ route('blog.show', $post->slug) }}">
											{{ $post->title }}
										</a>
									</h3>

									<p class="text-muted">
										{{ \Illuminate\Support\Str::limit($post->excerpt, 100) }}
									</p>

									<small class="text-muted">
										{{ $post->created_at->format('F d, Y') }}
									</small>
								</div>

							</div>
						</div>

					@empty
						<div class="col-12 text-center">
							<p class="text-muted">No blog posts available at the moment.</p>
						</div>
					@endforelse

					<div class="mt-5 d-flex justify-content-center">
						{{ $posts->links() }}
					</div>

				</div>
			</div>
		</div>
		<!-- End Blog Section -->	
@endsection