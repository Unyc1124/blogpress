<nav class="navbar">

    <div class="container navbar-container">

        {{-- LOGO --}}
        <div class="logo">

            <a href="/">

                <span class="logo-box">J</span>

                JobYaari

            </a>

        </div>

        {{-- HAMBURGER --}}
        <div class="hamburger" id="hamburger">

            <span></span>
            <span></span>
            <span></span>

        </div>

        {{-- NAV LINKS --}}
        <ul class="nav-links" id="navLinks">

            <li>

                <a href="/">Home</a>

            </li>

            <li>

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

<script>

    const hamburger =
        document.getElementById('hamburger');

    const navLinks =
        document.getElementById('navLinks');

    hamburger.addEventListener('click', () => {

        navLinks.classList.toggle('active');

        hamburger.classList.toggle('open');

    });

</script>