<!DOCTYPE html>
<html>
<head>
    <title>Email Verification</title>
</head>
<body>
    <h2>Welcome to our website</h2>
    <p>Please click the link below to verify your email address:</p>
    <a href="{{ route('verify', $token) }}">Verify Email</a>
</body>
</html>
