@extends('layouts.app')

@section('title')
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Jobyaari | Home</title>
@endsection

@section('content')

{{-- =========================================
    HERO SLIDER
========================================= --}}

@if($heroBlogs)

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

                    <h1>{{ $hero->title }}</h1>

                    <p>{{ $hero->excerpt }}</p>

                    <div class="hero-meta">
                        {{ $hero->created_at->format('d M Y') }}
                    </div>

                    <a href="{{ route('blog.details', $hero->slug) }}"
                       class="read-more-btn">
                        Read More
                    </a>

                </div>

            </div>

        </div>

    @endforeach

    <button class="slider-btn prev-btn">&#10094;</button>
    <button class="slider-btn next-btn">&#10095;</button>

</section>

@endif

{{-- =========================================
    FILTER BAR
========================================= --}}

<section class="filter-section container">

    {{-- CATEGORY FILTERS --}}
    <div class="filter-group">

        <span class="filter-label">
            <i class="fa-solid fa-tag"></i>
            Category:
        </span>

        <div class="filter-pills" id="categoryFilters">

            <button class="filter-pill active"
                    data-category="">
                All
            </button>

            @foreach($categories as $cat)

            <button class="filter-pill"
                    data-category="{{ $cat->slug }}">
                {{ $cat->name }}
            </button>

            @endforeach

        </div>

    </div>

    {{-- DATE FILTERS --}}
    <div class="filter-group">

        <span class="filter-label">
            <i class="fa-regular fa-calendar"></i>
            Date:
        </span>

        <div class="filter-pills" id="dateFilters">

            <button class="filter-pill active"
                    data-date="latest">
                Latest
            </button>

            <button class="filter-pill"
                    data-date="oldest">
                Oldest
            </button>

            <button class="filter-pill"
                    data-date="this_month">
                This Month
            </button>

            <button class="filter-pill"
                    data-date="this_year">
                This Year
            </button>

        </div>

    </div>

</section>

{{-- =========================================
    BLOG GRID (AJAX TARGET)
========================================= --}}

<section class="recent-section container">

    <h2 class="section-title">Recent Articles</h2>

    {{-- LOADING SPINNER --}}
    <div class="ajax-loader" id="ajaxLoader">
        <i class="fa-solid fa-spinner fa-spin"></i>
    </div>

    {{-- BLOG CARDS (replaced by AJAX) --}}
    <div class="blog-carousel" id="blogGrid">

        @include('blogs.partials.blog-cards')

    </div>

</section>

{{-- =========================================
    FILTER STYLES
========================================= --}}



{{-- =========================================
    JQUERY AJAX SCRIPT
========================================= --}}

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>

$(document).ready(function () {

    let activeCategory = '';
    let activeDate     = 'latest';

    // ── CATEGORY PILL CLICK ──
    $('#categoryFilters').on('click', '.filter-pill', function () {

        $('#categoryFilters .filter-pill').removeClass('active');
        $(this).addClass('active');

        activeCategory = $(this).data('category');

        fetchBlogs();

    });

    // ── DATE PILL CLICK ──
    $('#dateFilters').on('click', '.filter-pill', function () {

        $('#dateFilters .filter-pill').removeClass('active');
        $(this).addClass('active');

        activeDate = $(this).data('date');

        fetchBlogs();

    });

    // ── FETCH BLOGS VIA AJAX ──
    function fetchBlogs() {

        $('#ajaxLoader').show();
        $('#blogGrid').addClass('loading');

        $.ajax({
            url: '{{ route("blog.filter") }}',
            method: 'GET',
            data: {
                category : activeCategory,
                date     : activeDate,
            },
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function (html) {

                $('#blogGrid').html(html);

            },
            error: function () {

                $('#blogGrid').html(
                    '<p style="text-align:center;color:red;">Something went wrong. Please try again.</p>'
                );

            },
            complete: function () {

                $('#ajaxLoader').hide();
                $('#blogGrid').removeClass('loading');

            }
        });

    }

});

</script>

@endsection