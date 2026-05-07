@extends('layouts.app')

@section('content')

<section class="dashboard-section container">

    <div class="form-header">

        <div>

            <h1>Create Blog Post</h1>

            <p>
                Write and publish a new article
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

    <form action="{{ route('blogs.store') }}"
          method="POST"
          enctype="multipart/form-data"
          class="blog-form">

        @csrf

        {{-- TITLE --}}
        <div class="form-group">

            <label>Blog Title</label>

            <input type="text"
                   name="title"
                   id="title"
                   placeholder="Enter blog title">

        </div>

        {{-- SLUG --}}
        <div class="form-group">

            <label>Slug</label>

            <input type="text"
                   name="slug"
                   id="slug"
                   placeholder="Auto generated slug">

        </div>

        {{-- AUTHOR --}}
<div class="form-group">

    <label>Author Name</label>

    <input type="text"

           name="author_name"

           placeholder="Enter author name">

</div>

        {{-- EXCERPT --}}
        <div class="form-group">

            <label>Excerpt</label>

            <textarea name="excerpt"
                      rows="4"
                      placeholder="Short blog summary"></textarea>

        </div>

        {{-- CONTENT --}}
        <div class="form-group">

            <label>Content</label>

            <textarea name="content"
                      id="editor"></textarea>

        </div>

        {{-- CATEGORY --}}
        <div class="form-group">

            <label>Category</label>

            <select name="category_id">

                <option value="">
                    Select Category
                </option>

                @foreach($categories as $category)

                    <option value="{{ $category->id }}">

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
                   placeholder="laravel, php, technology">

        </div>

        {{-- FEATURED IMAGE --}}
        <div class="form-group">

            <label>Featured Image</label>

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

                <option value="draft">
                    Draft
                </option>

                <option value="published">
                    Published
                </option>

            </select>

        </div>

        {{-- SUBMIT --}}
        <button type="submit"
                class="publish-btn">

            Publish Blog

        </button>

    </form>

</section>

{{-- CKEDITOR --}}
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

<script>

    CKEDITOR.replace('editor');

</script>

@endsection