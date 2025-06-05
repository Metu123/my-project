<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sheltos - Filter search tab & fixed header home page">
    <meta name="keywords" content="sheltos">
    <meta name="author" content="sheltos">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <title>Sheltos - Filter search tab & fixed header home page</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,500,700" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/color1.css') }}">
</head>

<body>
<header class="header-4 fixed-header">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="menu">
                    <div class="brand-logo">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('assets/images/logo/2.png') }}" class="img-fluid for-light" alt="Logo">
                            <img src="{{ asset('assets/images/logo/4.png') }}" class="img-fluid for-dark" alt="Logo">
                        </a>
                    </div>
                    <nav>
                        <div class="main-navbar">
                            <div id="mainnav">
                                <div class="toggle-nav"><i class="fa fa-bars sidebar-bar"></i></div>
                                <ul class="nav-menu">
                                    <li class="dropdown"><a href="{{ config('app.url') }}" class="nav-link menu-title">Home</a></li>
                                    <li class="dropdown"><a href="https://www.blog.pakearth.com" class="nav-link menu-title">Blog</a></li>
                                    @if(session('auth') === true)
                                        <li class="dropdown"><a href="/property/create" class="nav-link menu-title">Create Property</a></li>
                                        <li class="dropdown"><a href="/favourite" class="nav-link menu-title">Favourite</a></li>
                                    @endif
                                    <li class="dropdown"><a href="/contactus" class="nav-link menu-title">Contact Us</a></li>
                                    <li class="dropdown"><a href="/about" class="nav-link menu-title">About Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                    <ul class="header-right">
                        <li>
                            @if(session('auth') === true)
                                <a href="{{ route('profile.show') }}"><i data-feather="user"></i> Welcome, {{ session('user') }}</a>
                                <a href="{{ route('logout') }}">Logout</a>
                            @else
                                <a href="#" data-bs-toggle="modal" data-bs-target="#login-modal"><i data-feather="user"></i></a>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Login/Register Modal -->
<div class="modal fade signup-modal" id="login-modal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body ratio_asos">
                <div class="row m-0">
                    <div class="col-lg-6 p-0">
                        <div class="login-img">
                            <img src="{{ asset('assets/images/property/15.jpg') }}" class="bg-img" alt="Login Image">
                        </div>
                    </div>
                    <div class="col-lg-6 p-0">
                        <div class="signup-tab theme-tab-4 log-in">
                            <ul class="nav nav-tabs" id="tabs">
                                <li class="nav-item"><a href="#login" data-bs-toggle="tab" class="nav-link active">Log In</a></li>
                                <li class="nav-item"><a href="#signup" data-bs-toggle="tab" class="nav-link">Register</a></li>
                            </ul>
                            <div class="tab-content" id="tabsContent">
                                <div id="login" class="tab-pane fade show active">
                                    <h4>Log In</h4>
                                    @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-text"><i data-feather="mail"></i></div>
                                                <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
                                            </div>
                                            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-text"><i data-feather="lock"></i></div>
                                                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                                                <div class="input-group-text" onclick="togglePassword()" style="cursor: pointer;">
                                                    <i data-feather="eye" id="eyeIcon"></i>
                                                </div>
                                            </div>
                                            @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="d-flex">
                                            <label><input class="checkbox_animated color-4" type="checkbox"> Remember me</label>
                                            <a href="/forgot-password" class="font-rubik text-color-4 ms-auto">Forgot password?</a>
                                        </div>
                                        <button type="submit" class="btn btn-gradient color-4 btn-flat">Log In</button>
                                    </form>
                                </div>
                                <div id="signup" class="tab-pane fade">
                                    <h4>Register</h4>
                                    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
                                    @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif
                                    <form method="POST" action="{{ route('signup') }}">
                                        @csrf
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-text"><i data-feather="user"></i></div>
                                                <input type="text" name="name" class="form-control" placeholder="Enter Your Name" required>
                                            </div>
                                            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-text"><i data-feather="mail"></i></div>
                                                <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
                                            </div>
                                            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-text"><i data-feather="lock"></i></div>
                                                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                                                <div class="input-group-text" onclick="togglePassword()" style="cursor: pointer;">
                                                    <i data-feather="eye" id="eyeIcon"></i>
                                                </div>
                                            </div>
                                            @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="d-flex">
                                            <label><input class="checkbox_animated color-4" type="checkbox"> Remember me</label>
                                            <a href="/forgot-password" class="font-rubik text-color-4 ms-auto">Forgot password?</a>
                                        </div>
                                        <button type="submit" class="btn btn-gradient color-4 btn-flat">Create Account</button>
                                    </form>
                                    <p class="mt-2">By creating an account, you agree to our <a href="/terms" class="font-rubik text-color-4">Terms & Conditions</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>
</div>

<!-- Loader -->
<div id="loader" style="display:flex; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(255,255,255,0.8); z-index:9999; align-items:center; justify-content:center;">
  <div class="spinner"></div>
</div>

<style>
  .spinner {
    width: 50px;
    height: 50px;
    border: 5px solid #ccc;
    border-top: 5px solid #333;
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
  }
  @keyframes spin {
    to { transform: rotate(360deg); }
  }
</style>

<script>
function togglePassword() {
    let passwordInput = document.getElementById("password");
    let eyeIcon = document.getElementById("eyeIcon");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.setAttribute("data-feather", "eye-off");
    } else {
        passwordInput.type = "password";
        eyeIcon.setAttribute("data-feather", "eye");
    }
    feather.replace();
}
</script>

<script>
document.addEventListener("click", function (event) {
    let link = event.target.closest("a");
    if (!link || link.hasAttribute("data-bs-toggle")) return;

    const internalRoutes = [
        "/", "/contactus", "/about", "/faq", "/favourite", "/privacy", "/terms",
        "/verify-email", "/send-verification-email", "/property/create", "/dashboard",
        "/profile", "/forgot-password", "/reset-password", "/report",
        "/admin/dashboard", "/admin/users", "/admin/reports", "/admin/register",
        "/admin/login", "/admin/logout"
    ];

    const dynamicRoutes = [
        /^\/property\/[\w-]+$/, /^\/agent\/[\w-]+$/, /^\/verify-email\/[\w-]+$/,
        /^\/reset-password\/[\w-]+$/, /^\/report\/[\w-]+$/, /^\/testsearch(?:\?.*)?$/
    ];

    const nuxtURL = "{{ env('NUXT_URL') }}";
    const isExternal = link.hostname && link.hostname !== window.location.hostname;
    const fullPath = link.pathname + link.search + link.hash;
    const isInternal = internalRoutes.includes(link.pathname) || dynamicRoutes.some(r => r.test(fullPath));

    if (isExternal) {
        event.preventDefault();
        window.top.location.href = link.href;
    } else if (isInternal) {
        event.preventDefault();
        window.top.location.href = nuxtURL + fullPath;
    }
});
</script>

<script>
window.addEventListener('load', () => {
    const loader = document.getElementById('loader');
    if (loader) loader.style.display = 'none';
});

document.addEventListener('DOMContentLoaded', () => {
    const loader = document.getElementById('loader');

    document.querySelectorAll('a[href]').forEach(link => {
        link.addEventListener('click', function () {
            if (!this.hasAttribute('data-bs-toggle') && !this.getAttribute('href').startsWith('#')) {
                loader.style.display = 'flex';
            }
        });
    });

    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function (e) {
            loader.style.display = 'flex';
            setTimeout(() => form.submit(), 100);
            e.preventDefault();
        });
    });

    document.querySelectorAll('button').forEach(button => {
        button.addEventListener('click', () => {
            button.textContent = 'loading...';
        });
    });
});
</script>I 
