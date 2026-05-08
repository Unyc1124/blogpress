@extends('layouts.app')

@section('content')

{{-- =========================================
    BREADCRUMB
========================================= --}}

<section class="breadcrumb-section container">

    <div class="breadcrumb">

        <a href="/">

            <i class="fa-solid fa-house"></i>

            Home

        </a>

        <span>

            <i class="fa-solid fa-chevron-right"></i>

        </span>

        <span class="active">

            Search Results

        </span>

    </div>

</section>

{{-- =========================================
    SEARCH HERO
========================================= --}}

<section class="search-hero container">

    <div class="search-hero-inner">

        <p class="search-label">

            <i class="fa-solid fa-magnifying-glass"></i>

            Search Results

        </p>

        <h1 class="search-hero-title">

            @if($query)

                Results for
                <span class="search-query-highlight">
                    "{{ $query }}"
                </span>

            @else

                All Articles

            @endif

        </h1>

        <p class="search-count">

            @if($blogs->total() > 0)

                {{ $blogs->total() }}
                {{ Str::plural('article', $blogs->total()) }} found

            @else

                No articles found

            @endif

        </p>

        {{-- INLINE SEARCH AGAIN --}}
        <form action="{{ route('blog.search') }}"
              method="GET"
              class="search-hero-form">

            <div class="search-hero-box">

                <i class="fa-solid fa-magnifying-glass"></i>

                <input type="text"
                       name="search"
                       placeholder="Search articles..."
                       value="{{ $query }}">

                <button type="submit">

                    Search

                </button>

            </div>

        </form>

    </div>

</section>

{{-- =========================================
    RESULTS GRID
========================================= --}}

<section class="search-results-section container">

    @if($blogs->count())

        <div class="search-results-grid">

            @foreach($blogs as $blog)

            <a href="{{ route('blog.details', $blog->slug) }}"
               class="blog-card-link">

                <div class="blog-card">

                    <div class="blog-card-image-wrapper">

                        <!-- <img src="{{ asset($blog->featured_image) }}" -->
                         <img src="{{ $related->featured_image }}">
                             alt="{{ $blog->title }}">

                        <span class="blog-category">

                            {{ strtoupper($blog->category?->name ?? 'GENERAL') }}

                        </span>

                    </div>

                    <div class="blog-content">

                        <h3>{{ $blog->title }}</h3>

                        <p>{{ $blog->excerpt }}</p>

                        <div class="blog-card-meta">

                            <span>

                                <i class="fa-regular fa-user"></i>

                                <!-- {{ $blog->author?->name ?? 'Admin' }} -->
                                   {{ $blog->author_name }}

                            </span>

                            <span class="meta-dot">•</span>

                            <span>

                                <i class="fa-regular fa-calendar"></i>

                                {{ $blog->created_at->format('d M Y') }}

                            </span>

                        </div>

                    </div>

                </div>

            </a>

            @endforeach

        </div>

        {{-- PAGINATION --}}
        <div class="search-pagination">

            {{ $blogs->appends(['search' => $query])->links() }}

        </div>

    @else

        {{-- EMPTY STATE --}}
        <div class="search-empty-state">

            <div class="empty-icon">

                <i class="fa-solid fa-file-circle-question"></i>

            </div>

            <h2>No results found</h2>

            <p>
                We couldn't find any articles matching
                <strong>"{{ $query }}"</strong>.
                Try using different keywords or browse all articles.
            </p>

            <a href="/" class="empty-browse-btn">

                <i class="fa-solid fa-arrow-left"></i>

                Browse All Articles

            </a>

        </div>

    @endif

</section>

{{-- =========================================
    SEARCH PAGE STYLES
========================================= --}}

<style>

    /* ── SEARCH HERO ── */

    .search-hero {
        padding: 48px 0 36px;
        text-align: center;
    }

    .search-hero-inner {
        max-width: 640px;
        margin: 0 auto;
    }

    .search-label {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: 1.2px;
        text-transform: uppercase;
        color: var(--primary, #2563eb);
        margin-bottom: 12px;
    }

    .search-hero-title {
        font-size: clamp(24px, 4vw, 36px);
        font-weight: 700;
        color: var(--text-dark, #111827);
        line-height: 1.25;
        margin-bottom: 8px;
    }

    .search-query-highlight {
        color: var(--primary, #2563eb);
    }

    .search-count {
        font-size: 14px;
        color: var(--text-muted, #6b7280);
        margin-bottom: 24px;
    }

    /* ── INLINE SEARCH BOX ── */

    .search-hero-form {
        width: 100%;
    }

    .search-hero-box {
        display: flex;
        align-items: center;
        gap: 10px;
        background: #f9fafb;
        border: 1.5px solid #e5e7eb;
        border-radius: 12px;
        padding: 10px 16px;
        transition: border-color 0.2s;
    }

    .search-hero-box:focus-within {
        border-color: var(--primary, #2563eb);
        background: #fff;
    }

    .search-hero-box i {
        color: #9ca3af;
        font-size: 15px;
        flex-shrink: 0;
    }

    .search-hero-box input {
        flex: 1;
        border: none;
        background: transparent;
        outline: none;
        font-size: 15px;
        color: #111827;
    }

    .search-hero-box input::placeholder {
        color: #9ca3af;
    }

    .search-hero-box button {
        flex-shrink: 0;
        background: var(--primary, #2563eb);
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 8px 20px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
    }

    .search-hero-box button:hover {
        background: var(--primary-dark, #1d4ed8);
    }

    /* ── RESULTS GRID ── */

    .search-results-section {
        padding: 12px 0 60px;
    }

    .search-results-grid {
        display: grid;
        grid-template-columns:
            repeat(auto-fill, minmax(300px, 1fr));
        gap: 28px;
    }

    /* ── BLOG CARD IMAGE WRAPPER ── */

    .blog-card-image-wrapper {
        position: relative;
        overflow: hidden;
        border-radius: 12px 12px 0 0;
    }

    .blog-card-image-wrapper img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        display: block;
        transition: transform 0.35s ease;
    }

    .blog-card:hover .blog-card-image-wrapper img {
        transform: scale(1.04);
    }

    .blog-card-image-wrapper .blog-category {
        position: absolute;
        top: 12px;
        left: 12px;
    }

    /* ── PAGINATION ── */

    .search-pagination {
        margin-top: 40px;
        display: flex;
        justify-content: center;
    }

    /* ── EMPTY STATE ── */

    .search-empty-state {
        text-align: center;
        padding: 80px 20px;
        max-width: 480px;
        margin: 0 auto;
    }

    .empty-icon {
        font-size: 56px;
        color: #d1d5db;
        margin-bottom: 20px;
    }

    .search-empty-state h2 {
        font-size: 24px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 10px;
    }

    .search-empty-state p {
        font-size: 15px;
        color: #6b7280;
        line-height: 1.6;
        margin-bottom: 28px;
    }

    .empty-browse-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--primary, #2563eb);
        color: #fff;
        padding: 12px 24px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        transition: background 0.2s;
    }

    .empty-browse-btn:hover {
        background: var(--primary-dark, #1d4ed8);
    }

    /* ── RESPONSIVE ── */

    @media (max-width: 640px) {

        .search-results-grid {
            grid-template-columns: 1fr;
        }

        .search-hero {
            padding: 32px 0 24px;
        }

    }

</style>

@endsection