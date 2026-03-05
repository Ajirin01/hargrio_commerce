@extends('layouts.site')

@section('content')
<div class="container py-12 lg:py-24">
    <div class="col-lg-10 mx-auto text-gray-800">

        {{-- Page Title --}}
        <h1 class="text-4xl lg:text-5xl font-bold text-accent mb-8">
            @yield('title')
        </h1>

        {{-- Page Content --}}
        <div class="legal-text space-y-6 leading-relaxed text-lg">
            @yield('legal_content')
        </div>

    </div>
</div>
@endsection