@extends('layouts.app')

@section('content')

<section class="dashboard-section container">

    <div class="form-header">

        <div>

            <h1>Edit Blog Post</h1>

            <p>
                Update and manage your article
            </p>

        </div>

        <a href="/admin"
           class="back-btn">

            Back

        </a>

    </div>

    {{-- VALIDATION ERRORS --}}
    @if ($errors->any())

        <div class="error-box">

            <ul>

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form action="{{ route(
            'blogs.update',
            $blog->id) }}"

          method="POST"

          enctype="multipart/form-data"

          class="blog-form">

        @csrf
        @method('PUT')

        {{-- TITLE --}}
        <div class="form-group">

            <label>Blog Title</label>

            <input type="text"

                   name="title"

                   id="title"

                   value="{{ old(
                        'title',
                        $blog->title) }}"

                   placeholder="Enter blog title">

        </div>

        {{-- SLUG --}}
        <div class="form-group">

            <label>Slug</label>

            <input type="text"

                   name="slug"

                   id="slug"

                   value="{{ old(
                        'slug',
                        $blog->slug) }}"

                   placeholder="Auto generated slug">

        </div>

        {{-- AUTHOR --}}
<div class="form-group">

    <label>Author Name</label>

    <input type="text"

           name="author_name"

           value="{{ old(
                'author_name',
                $blog->author_name) }}"

           placeholder="Enter author name">

</div>

        {{-- EXCERPT --}}
        <div class="form-group">

            <label>Excerpt</label>

            <textarea name="excerpt"
                      rows="4"
                      placeholder="Short blog summary">{{ old(
                            'excerpt',
                            $blog->excerpt) }}</textarea>

        </div>

        {{-- CONTENT --}}
        <div class="form-group">

            <label>Content</label>

            <textarea name="content"
                      id="editor">{{ old(
                            'content',
                            $blog->content) }}</textarea>

        </div>

        {{-- CATEGORY --}}
        <div class="form-group">

            <label>Category</label>

            <select name="category_id">

                <option value="">
                    Select Category
                </option>

                @foreach($categories as $category)

                    <option value="{{ $category->id }}"

                        {{ $blog->category_id ==
                           $category->id
                           ? 'selected'
                           : '' }}>

                        {{ $category->name }}

                    </option>

                @endforeach

            </select>

        </div>

        {{-- TAGS --}}
        <div class="form-group">

            <label>Tags</label>

            <input type="text"

                   name="tags"

                   value="{{ old(
                        'tags',
                        $blog->tags
                            ->pluck('name')
                            ->implode(', ')) }}"

                   placeholder="laravel, php, technology">

        </div>

        {{-- EXISTING IMAGE --}}
        @if($blog->featured_image)

            <div class="form-group">

                <label>Current Featured Image</label>

                <img src="{{ asset(
                    $blog->featured_image) }}"

                     class="preview-image"

                     style="
                     display:block;
                     margin-bottom:15px;
                     max-width:300px;">

            </div>

        @endif

        {{-- FEATURED IMAGE --}}
        <div class="form-group">

            <label>Change Featured Image</label>

            <input type="file"

                   name="featured_image"

                   id="imageInput">

            <img id="previewImage"
                 class="preview-image">

        </div>

        {{-- STATUS --}}
        <div class="form-group">

            <label>Status</label>

            <select name="status">

                <option value="draft"

                    {{ $blog->status ==
                       'draft'
                       ? 'selected'
                       : '' }}>

                    Draft

                </option>

                <option value="published"

                    {{ $blog->status ==
                       'published'
                       ? 'selected'
                       : '' }}>

                    Published

                </option>

            </select>

        </div>

        {{-- SUBMIT --}}
        <button type="submit"
                class="publish-btn">

            Update Blog

        </button>

    </form>

</section>

{{-- CKEDITOR --}}
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

<script>

    CKEDITOR.replace('editor');

</script>

@endsection