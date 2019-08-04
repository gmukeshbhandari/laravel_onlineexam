@extends('layouts.master')

@section('title','User Home Page')

<div id="ourcontact" class="modal" tabindex="-1" role="dialog" style="background:rgba(0,0,0,0.9)">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Contact Us</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <p style="padding:10px 20px 0px 20px"> <i> You can freely contact me for any work regarding Web Devlopment. </i> </p>
            <div class="modal-body">
                <table class="table">
                    <tbody>
                    <tr>
                        <td> <b> Mobile Number </b> </td>
                        <td> +9779818334852 </td>
                    </tr>

                    <tr>
                        <td> <b> Email </b> </td>
                        <td> gmukeshbhandari@gmail.com </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>






@section('content')

    <div class="container-fluid" style="background:#ADD8E6">
        <div class="row">
            <div class="col-md-6 col-12" style="margin-bottom:10px;margin-top: 10px">
                <h3> Welcome</h3>
                <p> Here you can give online exams for different subjects. You can view the result right after you
                    finish the exam and can even download the results. There will be Review of answer. So you will know what is the
                    correct answer, what mistake did you do.
                </p>
                <img src="{{ URL::to('images/onlineexam.png') }}" style="margin-bottom:5px" class="img-fluid"  alt="Images">
            </div>


            <div class="col-md-6 col-12" style="margin-bottom:10px;margin-top: 10px">
                <div class="card">
                    <div class="card-header"  style="background: #337ab7">  <span class="glyphicon glyphicon-cog">  </span> User Login </div>



                    <div class="card-body">
                        <form role="form" action="{{ route('checkinguserlogin') }}" method="POST">

                            {{ csrf_field() }}

                            @include('includes.error-message')

                            <div class="form-group">
                                <label for="email"> Email </label>
                                <input class="form-control" type="email"  name="email" id="email" value="{{Request::old('email')}}" placeholder="Enter Email" autofocus>
                            </div>

                            <div class="form-group">
                                <label for="password"> Password </label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password">
                                <span toggle="#password" class="glyphicon glyphicon-eye-open toggle-password" style="float:right;margin-right: 10px;margin-top: -25px;position: relative;z-index: 2;cursor:pointer"> </span>
                            </div>
                            <input type="submit" class="btn btn-primary" style="margin-bottom:5px" value="Log In" name="userlogin">
                        </form>
                    </div>



                    <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            New User ? <a class="btn btn-info btn-lg" data-toggle="tooltip" title="Click Here to Register if you haven't registered yet" href="{{ route('registering_user') }}" role="button">
                                Register </a>
                        </div>
                        <div class="col-md-4 ml-auto">
                            <a class="btn btn-link" id="userforgotpassword" href="{{ route('forgotpassword') }}"> Forgot Password?  </a>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h2 class="offset-md-5 offset-3" style="font-style:italic;margin-top: 10px"> Developer </h2>
<div class="container-fluid">
 <div class="row">

        <div class="col-md-4 col-12 offset-md-5 offset-3">
            <img src="{{ URL::asset('images/mukesh.jpg') }}" class="rounded-circle img-fluid" style="max-width:30%" alt="Image"> <br/>
            <address>
                 Mukesh Bhandari     <br/>
                Kathmandu, Nepal			<br/> <br/>
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#mukeshmodal"> More </button>
                <div id="mukeshmodal" class="modal" role="dialog" style="background:rgba(0,0,0,0.9)">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3> Personal Contact </h3>
                            </div>
                            <div class="modal-body" >
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td> Name </td>
                                        <td> Mukesh Bhandari</td>
                                    </tr>
                                    <tr>
                                        <td> Permanent Address </td>
                                        <td> Kathmandu, Nepal </td>
                                    </tr>
                                    <tr>
                                        <td> Email </td>
                                        <td> gmukeshbhandari@gmail.com </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <h4> Follow Me @ </h4>
                                <a target="_blank" href="https://www.twitter.com/tmukeshbhandari"> Twitter </a>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </address>
        </div>
    </div>
</div>
    <script>
        $('.toggle-password').click(function (e) {
            e.preventDefault();
            $(this).toggleClass('glyphicon-eye-close');
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>

@endsection