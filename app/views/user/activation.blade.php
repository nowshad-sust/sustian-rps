<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Verify Your Email Address</h2>

<div>
    Dear <b>{{ $fullName }}</b>, thanks for creating an account with the verification demo app.
    Please follow the link below to verify your email address
    {{ URL::to('register/activation/'.$confirmation_code) }}.<br/>

</div>

</body>
</html>