@extends('layouts.site')

@section('title', $post->title)

@section('content')

<!-- Hero Section -->
<div class="hero blog-hero position-relative overflow-hidden">
    {{-- Background Image (bokeh grains) --}}
    <img src="{{ asset('site/images/hero-grains-bokeh.png') }}" class="hero-bg-img" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:0;filter:brightness(0.35);">
    {{-- Layered Gradient Overlay --}}
    <div class="hero-overlay-gradient" style="position:absolute;inset:0;z-index:1;background:linear-gradient(135deg, rgba(27, 24, 23, 0.95) 0%, rgba(44, 34, 31, 0.65) 40%, rgba(92,71,66,0.55) 65%, rgba(30,18,14,0.85) 100%);"></div>
    {{-- Noise grain --}}
    <div style="position:absolute;inset:0;z-index:1;background-image:url(&quot;data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E&quot;);opacity:0.04;pointer-events:none;"></div>
    <div class="container text-center position-relative" style="z-index:3;">
        <h1 class="mb-3">{{ $post->title }}</h1>
        <p class="text-muted">
            Published on {{ $post->created_at->format('F d, Y') }}
        </p>
    </div>
</div>


<!-- Blog Content Section -->
<div class="blog-content-section py-5" style="margin-bottom: 100px">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-lg-8">

                <!-- Feature Image -->
                @if($post->feature_image)
                    <div class="mb-4">
                        <img src="{{ asset('public/' . $post->feature_image) }}" 
                             alt="{{ $post->title }}" 
                             class="img-fluid rounded shadow-sm w-100">
                    </div>
                @endif

                <!-- Excerpt -->
                @if($post->excerpt)
                    <div class="mb-4">
                        <p class="lead text-muted">
                            {{ $post->excerpt }}
                        </p>
                    </div>
                @endif

                <!-- Main Content -->
                <div class="blog-body">
                    {!! $post->content !!}
                </div>

                <!-- Divider -->
                <hr class="my-5">

                <!-- Back Button -->
                <div class="text-center">
                    <a href="{{ route('blog.index') }}" class="btn btn-outline-primary">
                        ← Back to All Posts
                    </a>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection