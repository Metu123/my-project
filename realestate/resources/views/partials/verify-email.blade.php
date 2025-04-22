@if(session('user_email'))
    @php
        $user = app('App\Http\Controllers\VerificationController')->collection
            ->findOne(['email' => session('user_email')]);
    @endphp

    @if($user && !$user['verified'])
        <div style="background: #ffeeba; padding: 10px; border: 1px solid #ffc107; color: #856404;">
            <p>Your email is <b>not verified</b>. Some features may be restricted.</p>
            <a href="{{ url('/send-verification-email') }}" style="color: #856404;">Send Verification Email</a>
        </div>
    @else
        <div style="background: #d4edda; padding: 10px; border: 1px solid #c3e6cb; color: #155724;">
            <p>Your email is <b>verified</b>. Enjoy full access!</p>
        </div>
    @endif
@endif
