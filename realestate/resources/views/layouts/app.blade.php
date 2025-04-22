<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Laravel App')</title>
    
    <!-- Add any CSS links here -->
    <link rel="stylesheet" href="{{ asset('asset/css/app.css') }}">

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll("a").forEach((link) => {
                link.addEventListener("click", function (event) {
                    const isExternal = this.href.startsWith("http") && !this.href.includes(window.location.origin);
                    
                    if (!isExternal) { // Only handle internal links
                        event.preventDefault(); // Prevent default navigation
                        const newUrl = this.href;

                        // Send URL to Nuxt wrapper
                        window.parent.postMessage({ url: newUrl }, "*");

                        // Update Laravel iframe URL (for direct navigation)
                        window.location.href = newUrl;
                    }
                });
            });
        });
    </script>
</head>
<body>

    <header>
        <nav>
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ url('/about') }}">About</a></li>
                <li><a href="{{ url('/contactus') }}">Contact</a></li>
                <li><a href="{{ url('/faq') }}">FAQ</a></li>
                <li><a href="{{ url('/privacy') }}">Privacy Policy</a></li>
                <li><a href="{{ url('/terms') }}">Terms & Conditions</a></li>
                @if(session('user'))
                    <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ url('/logout') }}">Logout</a></li>
                @else
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/signup') }}">Signup</a></li>
                @endif
            </ul>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Laravel App. All rights reserved.</p>
    </footer>

    <!-- Add any JS files -->
    <script src="{{ asset('asset/js/app.js') }}"></script>

</body>
</html>
