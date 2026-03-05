@extends('layouts.site')

@section('title', $post->title)

@section('content')

<!-- Hero Section -->
<div class="hero blog-hero">
    <div class="container text-center">
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