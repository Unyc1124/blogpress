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

        <a href="/">

            Blogs

        </a>

        <span>

            <i class="fa-solid fa-chevron-right"></i>

        </span>

        <span class="active">

            {{ $blog->title }}

        </span>

    </div>

</section>

{{-- =========================================
    BLOG DETAILS
========================================= --}}

<section class="blog-details-layout container">

    {{-- MAIN CONTENT --}}

    <div class="blog-main-content">

        {{-- HERO IMAGE --}}

        <div class="details-image-wrapper">
<!-- 
            <img src="{{ asset(
                $blog->featured_image) }}"

                 class="details-image"> -->

                 <img src="{{ $blog->featured_image }}"
     alt="{{ $blog->title }}"
     class="details-image">

        </div>

        {{-- CONTENT BOX --}}

        <div class="details-content">

            {{-- CATEGORY --}}

            <span class="blog-category">

                {{ strtoupper(
                    $blog->category?->name) }}

            </span>

            {{-- TITLE --}}

            <h1 class="details-title">

                {{ $blog->title }}

            </h1>

            {{-- META --}}

            <div class="blog-meta-row">

                <div class="meta-item">

                    <i class="fa-regular fa-user"></i>

                    <!-- {{ $blog->author?->name ?? 'Admin' }} -->
                      {{ $blog->author_name }}

                </div>

                <div class="meta-item">

                    <i class="fa-regular fa-calendar"></i>

                    {{ $blog->created_at
                        ->format('d M Y') }}

                </div>

            </div>

            {{-- ARTICLE BODY --}}

            <div class="details-body"

                 id="articleContent">

                {!! $blog->content !!}

            </div>

            {{-- TAGS --}}

            @if($blog->tags->count())

            <div class="tags-wrapper">

                @foreach($blog->tags as $tag)

                    <span class="tag-item">

                        {{ $tag->name }}

                    </span>

                @endforeach

            </div>

            @endif

        </div>

    </div>

    {{-- SIDEBAR --}}

    <aside class="details-sidebar">

        <div class="sidebar-card">

            <h3>

                On This Page

            </h3>

            <ul id="tocList">

            </ul>

        </div>

    </aside>

</section>
{{-- =========================================
    RELATED BLOGS
========================================= --}}

<section class="recent-section container">

    <h2 class="section-title">
        Related Articles
    </h2>

    <div class="blog-carousel">

        @isset($related)
            @foreach($related as $relatedBlog)

                <a href="{{ route('blog.details', $relatedBlog->slug) }}"
                   class="blog-card-link">

                    <div class="blog-card">

                        <img src="{{ $relatedBlog->featured_image }}"
                             alt="{{ $relatedBlog->title }}">

                        <div class="blog-content">

                            <span class="blog-category">
                                {{ strtoupper($relatedBlog->category?->name) }}
                            </span>

                            <h3>{{ $relatedBlog->title }}</h3>

                            <p>{{ $relatedBlog->excerpt }}</p>

                            <div class="blog-card-meta">
                                <span>{{ $relatedBlog->author?->name ?? 'Admin' }}</span>
                                <span class="meta-dot">•</span>
                                <span>{{ $relatedBlog->created_at->format('d/m/Y') }}</span>
                            </div>

                        </div>

                    </div>

                </a>

            @endforeach
        @endisset

    </div>

</section>
<script>

document.addEventListener('DOMContentLoaded', () => {

    const article =
        document.getElementById(
            'articleContent');

    const tocList =
        document.getElementById(
            'tocList');

    if(!article || !tocList){
        return;
    }

    const elements =
        article.querySelectorAll(
            'h1, h2, h3, strong, b');

    let count = 0;

    elements.forEach((el) => {

        const text =
            el.innerText.trim();

        if(!text){
            return;
        }

        const id =
            'toc-' + count;

        el.id = id;

        el.style.scrollMarginTop = '100px';

        const li =
            document.createElement('li');

        const a =
            document.createElement('a');

        a.href = '#' + id;

        a.innerText = text;

        {{-- Indent h2, h3 and bold slightly --}}
        if(el.tagName === 'H2'){
            a.classList.add('toc-subheading');
        }

        if(el.tagName === 'H3'){
            a.classList.add('toc-subheading');
            a.style.paddingLeft = '20px';
        }

        if(el.tagName === 'STRONG' ||
           el.tagName === 'B'){
            a.classList.add('toc-subheading');
            a.style.paddingLeft = '10px';
        }

        a.addEventListener('click', (e) => {

            e.preventDefault();

            const target =
                document.getElementById(id);

            if(target){

                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });

            }

        });

        li.appendChild(a);

        tocList.appendChild(li);

        count++;

    });

    if(count === 0){

        const card =
            tocList.closest(
                '.sidebar-card');

        if(card){
            card.style.display = 'none';
        }

    }

});

</script>

@endsection