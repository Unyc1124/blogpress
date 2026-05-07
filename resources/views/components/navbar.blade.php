<nav class="navbar">

    <div class="container navbar-container">

        {{-- LOGO --}}
        <div class="logo">

            <a href="/">

                <span class="logo-box">J</span>

                JobYaari

            </a>

        </div>

        {{-- NAVIGATION --}}
        <ul class="nav-links">

            <li>

                <a href="/">Home</a>

            </li>

            {{-- SEARCH BAR --}}
            <li>

                <!-- <form action="/"
      method="GET"
      class="search-form"> -->
      <form action="{{ route('blog.search') }}"
      method="GET"
      class="search-form">

    <div class="search-box">

        <i class="fas fa-search"></i>

        <input type="text"
               name="search"
               placeholder="Search articles..."
               value="{{ request('search') }}">

    </div>

</form>

            </li>

            <li>

                <a href="/login"
                   class="admin-btn">

                    Login

                </a>

            </li>

        </ul>

    </div>

</nav>