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
                <div class="col-lg-12">
                    <div class="intro-excerpt">
                        <h1>@yield('title')</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <div class="container py-5">
        <div class="col-lg-10 mx-auto text-gray-800">
        {{-- Page Content --}}
        <div class="legal-text space-y-6 leading-relaxed text-lg">
            @yield('legal_content')
        </div>

    </div>
</div>
@endsection