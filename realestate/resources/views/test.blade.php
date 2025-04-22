<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Page</title>
</head>
<body>
    <h1>Session Test</h1>

    @if(session('auth'))
        <p>Name: {{ session('user') }}</p>
        <p>Email: {{ session('user_email') }}</p>
    @else
        <p>No user is logged in.</p>
    @endif

    <a href="{{ route('logout') }}">Logout</a>
</body>
</html>
