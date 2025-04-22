@include('header')
    <div class="container">
        <i class="icon fas fa-envelope"></i>
        <h2>Email Verification</h2>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($user && !$user['verified'])
            <p>Your email is <b>not verified</b>. You can still log in, but verification is recommended.</p>
            <a href="{{ url('/send-verification-email') }}" class="btn btn-success"> <i class="fas fa-paper-plane"></i> Resend Verification Email</a>
        @else
            <p>Your email is <b>verified</b>. Enjoy full access to all features!</p>
            <a href="{{ url('/') }}" class="btn btn-sucess"> <i class="fas fa-home"></i> Go to Homepage</a>
        @endif
    </div>
</body>
</html>
