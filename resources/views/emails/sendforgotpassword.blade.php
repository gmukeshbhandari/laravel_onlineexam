<!DOCTYPE html>
<html>
<body>
<h2> Hello, {{$user['Name']}}</h2>
<p> Namaste! </p>
Did you forgot your login password of <i> <b> {{$user['email']}}</b></i> on <b> oe.com </b>.<br/> <br/>
Please click on the link below to recover your password.
<br/>
<a href="{{route('abcrecoverpassword',['email '=> $user->email,'token' => $user->token])}}"> Recover My Password </a>
<br/>
<br/>
Thank You.<br/>
Best Regards, <br/>
Online Examination System (oe.com) Team <br/>
</body>
</html>