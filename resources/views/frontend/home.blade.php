\@extends('layouts.app')

@section('content')

{{-- HERO SECTION --}}

@if($heroBlogs)

{{-- HERO SLIDER --}}

<section class="hero-slider">

    @foreach($heroBlogs as $index => $hero)

        <div class="hero-slide

            {{ $index == 0 ? 'active' : '' }}"

            style="background-image:
            url('{{ asset($hero->featured_image) }}')">

            <div class="hero-overlay">

                <div class="hero-content container">

                    <span class="category-badge">

                        {{ $hero->category?->name }}

                    </span>

                    <h1>

                        {{ $hero->title }}

                    </h1>

                    <p>

                        {{ $hero->excerpt }}

                    </p>

                    <div class="hero-meta">

                        {{ $hero->created_at
                            ->format('d M Y') }}

                    </div>

                    <a href="{{ route(
                        'blog.details',
                        $hero->slug) }}"

                       class="read-more-btn">

                        Read More

                    </a>

                </div>

            </div>

        </div>

    @endforeach

    {{-- PREV BUTTON --}}
    <button class="slider-btn prev-btn">

        &#10094;

    </button>

    {{-- NEXT BUTTON --}}
    <button class="slider-btn next-btn">

        &#10095;

    </button>

</section>

@endif

{{-- RECENT ARTICLES --}}

<section class="recent-section container">

    <h2 class="section-title">

        Recent Articles

    </h2>

    <div class="blog-carousel">

        @foreach($blogs as $blog)

<a href="{{ route(
    'blog.details',
    $blog->slug) }}"

   class="blog-card-link">

    <div class="blog-card">

        <img src="{{ asset(
            $blog->featured_image) }}"

             alt="Blog">

        <div class="blog-content">

            <span class="blog-category">

                {{ strtoupper(
                    $blog->category?->name) }}

            </span>

            <h3>

                {{ $blog->title }}

            </h3>

            <p>

                {{ $blog->excerpt }}

            </p>

            <div class="blog-card-meta">

                <span>

                    <!-- {{ $blog->author?->name ?? 'Admin' }} -->
                      {{ $blog->author_name }}

                </span>

                <span class="meta-dot">

                    •

                </span>

                <span>

                    {{ $blog->created_at
                        ->format('d/m/Y') }}

                </span>

            </div>

        </div>

    </div>

</a>

        @endforeach

    </div>

    <br><br>

    {{ $blogs->links() }}

</section>

@endsection