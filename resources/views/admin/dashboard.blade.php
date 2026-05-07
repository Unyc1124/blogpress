@extends('layouts.app')

@section('content')

<section class="dashboard-section container">

    <div class="dashboard-header">

        <div>

            <h1>Blog Management</h1>

            <p>
                Create, edit and manage your blog posts
            </p>

        </div>

        <a href="#" class="new-post-btn">
            + New Blog Post
        </a>

    </div>

    <div class="dashboard-card">

        <h2>
            Welcome, {{ auth()->user()->name }}
        </h2>

        <p>
            You are successfully logged in.
        </p>

        <br>

        <a href="{{ route('logout') }}"
           class="logout-btn">
            Logout
        </a>

    </div>

</section>

@endsection