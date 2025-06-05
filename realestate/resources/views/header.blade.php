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
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/color1.css') }}">
</head>

<body>

    
    <!-- Header -->
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
                                    <div class="toggle-nav">
                                        <i class="fa fa-bars sidebar-bar"></i>
                                    </div>
                                    <ul class="nav-menu">
                                        <li class="dropdown"><a href="{{ config('app.url') }}" class="nav-link menu-title">Home</a></li>
                                        <li class="dropdown"><a href="{{ url('https://www.blog.pakearth.com') }}" class="nav-link menu-title">Blog</a></li>
                                          @if(session()->has('auth') && session('auth') === true)
                                        <li class="dropdown">
                                        <a href="{{ url('/property/create') }}" class="nav-link menu-title">Create Property</a></li>
                                        <li class="dropdown"><a href="{{ url('/favourite') }}" class="nav-link menu-title">Favourite</a></li>
                                         @endif
                                        <li class="dropdown"><a href="{{ url('/contactus') }}" class="nav-link menu-title">Contact Us</a></li>
                                      <li class="dropdown"><a href="{{ url('/about') }}" class="nav-link menu-title">About Us</a></li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                        <ul class="header-right">
                            <li>
                                @if(session()->has('auth') && session('auth') === true)
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

    <!-- Login & Sign Up Modal -->
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
                                    <!-- Login Tab -->
                                    <div id="login" class="tab-pane fade show active">
                                        <h4>Log In</h4>
                                        @if(session('error'))
                                            <div class="alert alert-danger">{{ session('error') }}</div>
                                        @endif
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-text"><i data-feather="mail"></i></div>
                                                    <input type="email" class="form-control" name="email" placeholder="Enter Email" required>
                                                </div>
                                                @error('email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
    <div class="input-group-text"><i data-feather="lock"></i></div>
    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
    <div class="input-group-text" onclick="togglePassword()" style="cursor: pointer;">
        <i data-feather="eye" id="eyeIcon"></i>
    </div>
</div>


                                                @error('password')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="d-flex">
                                                <label class="d-block mb-0" for="chk-ani">
                                                    <input class="checkbox_animated color-4" id="chk-ani"
                                                        type="checkbox"> Remember me
                                                </label>
                                                <a href="/forgot-password" class="font-rubik text-color-4">Forgot password ?</a>
                                            </div>
                                            <button type="submit" class="btn btn-gradient color-4 btn-flat">Log In</button>
                                        </form>
                                    </div>

                                    <!-- Signup Tab -->
                                    <div id="signup" class="tab-pane fade">
                                        <h4>Register</h4>
                                         @if(session('success'))
                                            <div class="alert alert-success">{{ session('success') }}</div>
                                        @endif
                                        @if(session('error'))
                                            <div class="alert alert-danger">{{ session('error') }}</div>
                                        @endif
                                       <form method="POST" action="{{ route('signup') }}">
                                            @csrf
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-text"><i data-feather="user"></i></div>
                                                    <input type="text" class="form-control" name="name" placeholder="Enter Your Name" required>
                                                </div>
                                                @error('name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-text"><i data-feather="mail"></i></div>
                                                    <input type="email" class="form-control" name="email" placeholder="Enter Email Address" required>
                                                </div>
                                                @error('email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
<div class="input-group">
    <div class="input-group-text"><i data-feather="lock"></i></div>
    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
    <div class="input-group-text" onclick="togglePassword()" style="cursor: pointer;">
        <i data-feather="eye" id="eyeIcon"></i>
    </div>
</div>


                                                @error('password')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="d-flex">
                                                <label class="d-block mb-0" for="chk-ani">
                                                    <input class="checkbox_animated color-4" id="chk-ani"
                                                        type="checkbox"> Remember me
                                                </label>
                                                <a href="/forgot-password" class="font-rubik text-color-4">Forgot password ?</a>
                                            </div>
                                            <button type="submit" class="btn btn-gradient color-4 btn-flat">Create Account</button>
                                        </form>
                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p>By creating an account, you agree to our <a href="/terms" class="font-rubik text-color-4">Terms & Conditions </a> and confirm you are at least 18 years old</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>


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
        feather.replace(); // Update Feather icons
    }
</script>

<script>
document.addEventListener("click", function (event) {
    let link = event.target.closest("a");

    if (!link || link.hasAttribute("data-bs-toggle")) return; // Ignore modal triggers

    const internalLinksToRedirect = [
        "/", "/contactus", "/about", "/faq", "/favourite", "/privacy",
        "/terms", "/verify-email", "/send-verification-email", "/property/create",
        "/dashboard", "/profile", "/forgot-password", "/reset-password",
        "/report",

        // Admin static GET routes
        "/admin/dashboard",
        "/admin/users",
        "/admin/reports",
        "/admin/register",
        "/admin/login",
        "/admin/logout"
    ];

    const dynamicRoutes = [
        /^\/property\/[\w-]+$/, 
        /^\/agent\/[\w-]+$/, 
        /^\/verify-email\/[\w-]+$/, 
        /^\/reset-password\/[\w-]+$/,  
        /^\/report\/[\w-]+$/,
        /^\/testsearch(?:\?.*)?$/
    ];

    const nuxtBaseURL = "{{ env('NUXT_URL') }}"; // Change to your Nuxt URL

    if (link) {
        const isExternal = link.hostname && link.hostname !== window.location.hostname;
        const linkPath = link.pathname + link.search + link.hash;
        const isInternalRedirect = internalLinksToRedirect.includes(link.pathname) || dynamicRoutes.some(regex => regex.test(link.pathname + link.search));

        if (isExternal) {
            event.preventDefault();
            window.top.location.href = link.href; // Open external links outside iframe
        } else if (isInternalRedirect) {
            event.preventDefault();
            window.top.location.href = nuxtBaseURL + linkPath; // Redirect to Nuxt
        }
    }
});
</script>

<!-- Loader (shared across pages) -->
<div id="loader" style="display:flex; position:fixed; top:0; left:0; width:100%; height:100%;
background:rgba(255,255,255,0.8); z-index:9999; align-items:center; justify-content:center;">
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
  // Hide loader once the page is fully loaded
  window.addEventListener('load', function () {
    const loader = document.getElementById('loader');
    if (loader) {
      loader.style.display = 'none';
    }
  });

  // Show loader before navigation or form submission
  document.addEventListener('DOMContentLoaded', function () {
    const loader = document.getElementById('loader');

    // For anchor links
    document.querySelectorAll('a[href]').forEach(link => {
      link.addEventListener('click', function (e) {
        const href = this.getAttribute('href');
        const hasToggle = this.hasAttribute('data-bs-toggle');

        if (!hasToggle && href && !href.startsWith('#') && !href.startsWith('javascript')) {
          loader.style.display = 'flex';
        }
      });
    });

    // For forms
    document.querySelectorAll('form').forEach(form => {
      form.addEventListener('submit', function (e) {
        const hasToggle = form.hasAttribute('data-bs-toggle') ||
                          form.querySelector('[data-bs-toggle]');
        if (!hasToggle) {
          // Show loader immediately
          loader.style.display = 'flex';

          // Slight delay to allow the loader to appear
          setTimeout(() => {
            form.submit(); // manually submit the form
          }, 100);

          // Prevent immediate default submission
          e.preventDefault();
        }
      });
    });
  });
</script>


 

  <script>
    
    document.addEventListener('DOMContentLoaded', function() {
      const buttons = document.querySelectorAll('button');

      buttons.forEach(function(button) {
        button.addEventListener('click', function() {
          // Change the button text to "loading..."
          button.textContent = 'loading...';
        });
      });
    });
  </script>
