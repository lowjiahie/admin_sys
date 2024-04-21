<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Password Recovery</title>
</head>

<body>
    <h1>Reset Your Password</h1>
    <p>Hello {{ $name }},</p>
    <p>We received a request to reset your password. Click the link below to reset your password:</p>
    <a href="{{ $resetLink }}" target="_blank">Reset Password</a>
    <p>If you didn't request a password reset, you can ignore this email.</p>
</body>

</html>