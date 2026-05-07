@extends('layouts.app')

@section('content')

<section class="login-section">

    <div class="login-container">

        <div class="login-icon">
            <i class="fa-solid fa-lock"></i>
        </div>

        <h1>Admin Login</h1>

        <p>
            Access the blog management dashboard
        </p>

        {{-- ERROR MESSAGE --}}
        @if(session('error'))

            <div class="error-message">
                {{ session('error') }}
            </div>

        @endif

        <form method="POST" action="{{ route('login.submit') }}">

            @csrf

            <div class="form-group">

                <label>Email</label>

                <input type="email"
                       name="email"
                       placeholder="Enter email">

            </div>

            <div class="form-group">

                <label>Password</label>

                <input type="password"
                       name="password"
                       placeholder="Enter password">

            </div>

            <button type="submit" class="login-btn">
                Sign In
            </button>

        </form>

    </div>

</section>

@endsection