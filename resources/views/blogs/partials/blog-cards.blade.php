@forelse($blogs as $blog)

<a href="{{ route('blog.details', $blog->slug) }}"
   class="blog-card-link">

    <div class="blog-card">

             <img src="{{ $blog->featured_image }}" alt="{{ $blog->title }}">

        <div class="blog-content">

            <span class="blog-category">
                {{ strtoupper($blog->category?->name) }}
            </span>

            <h3>{{ $blog->title }}</h3>

            <p>{{ $blog->excerpt }}</p>

            <div class="blog-card-meta">

                <span>{{ $blog->author_name }}</span>

                <span class="meta-dot">•</span>

                <span>{{ $blog->created_at->format('d/m/Y') }}</span>

            </div>

        </div>

    </div>

</a>

@empty

<div class="no-results">
    <i class="fa-solid fa-file-circle-question"></i>
    <p>No blogs found for the selected filters.</p>
</div>

@endforelse