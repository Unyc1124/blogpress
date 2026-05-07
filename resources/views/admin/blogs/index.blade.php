@extends('layouts.app')

@section('content')

<section class="dashboard-section container">

    <div class="dashboard-header">

        <div>

            <h1>Blog Management</h1>

            <p>
                Create, edit and manage blogs
            </p>

        </div>

        <a href="{{ route('blogs.create') }}"
           class="new-post-btn">

            + New Blog Post

        </a>

    </div>

    <div class="table-wrapper">

        <table class="blog-table">

            <thead>

                <tr>

                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Author</th>
                    <th>Actions</th>

                </tr>

            </thead>

            <tbody>

                @forelse($blogs as $blog)

                    <tr>

                        <td>

                            {{ $blog->title }}

                        </td>

                        <td>

                            {{ $blog->category?->name }}

                        </td>

                        <td>

                            {{ $blog->status }}

                        </td>

                        <td>

                            {{ $blog->author_name ?? 'Admin' }}

                        </td>

                        <td>

                            <div class="action-buttons">

    <a href="{{ route(
        'blogs.edit',
        $blog->id) }}"

       class="action-btn edit-btn">

        ✏️

    </a>

    <form action="{{ route(
            'blogs.destroy',
            $blog->id) }}"

          method="POST">

        @csrf
        @method('DELETE')

        <button type="submit"

                class="action-btn delete-btn"

                onclick="return confirm(
                'Delete this blog?')">

            🗑️

        </button>

    </form>

</div>
                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5">

                            No blogs found

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</section>

@endsection