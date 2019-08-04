<!DOCTYPE html>
<html>
<body>
<h2> Hello, {{$user['Name']}}</h2>
<p> Namaste! </p>
You successfully registered on <b> oe.com </b> using your email address <i> <b> {{$user['email']}}</b></i>.<br/> <br/>
Please click on the link below to verify your email account.
<br/>
<a href="{{url('/verify', $user->token)}}">Verify Email</a>
<br/>
<br/>
Thank You.<br/>
Best Regards, <br/>
Online Examination System (oe.com) Team <br/>
</body>
</html>


