<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>
<body>
    <h2>Hello, {{ $name }}</h2>
    <p>Thank you for registering. Please click the button below to verify your email:</p>
    <p>
        <a href="{{ $verificationLink }}" 
           style="display: inline-block; padding: 10px 20px; background-color: #109b01; color: #fff; text-decoration: none; border-radius: 5px;">
           Verify Email
        </a>
    </p>
    <p>If you did not register, please ignore this email.</p>
</body>
</html>
