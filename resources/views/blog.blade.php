@extends('layouts.site')
@section('content')
    <!-- Start Hero Section -->
		<div class="hero position-relative overflow-hidden">
            {{-- Background Image (bokeh grains) --}}
            <img src="{{ asset('site/images/hero-grains-bokeh.png') }}" class="hero-bg-img" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:0;filter:brightness(0.35);">
            {{-- Layered Gradient Overlay --}}
            <div class="hero-overlay-gradient" style="position:absolute;inset:0;z-index:1;background:linear-gradient(135deg, rgba(27, 24, 23, 0.95) 0%, rgba(44, 34, 31, 0.65) 40%, rgba(92,71,66,0.55) 65%, rgba(30,18,14,0.85) 100%);"></div>
            {{-- Noise grain --}}
            <div style="position:absolute;inset:0;z-index:1;background-image:url(&quot;data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E&quot;);opacity:0.04;pointer-events:none;"></div>
			<div class="container position-relative" style="z-index:3;">
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
								<a href="{{ route('shop.index') }}" class="btn btn-secondary me-2">Shop Products</a>
								<a href="{{ route('about') }}" class="btn btn-white-outline">About Hargrio</a>
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