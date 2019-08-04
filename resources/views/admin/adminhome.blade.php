@extends('layouts.master')

@section('title','Admin Home Page')

@section('content')

    <div class="container-fluid" style="background:#ADD8E6;padding:20px">
        <div class="row">
            <div class="col-md-4">

            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header" style="background: #337ab7"> <span class="glyphicon glyphicon-cog">  </span>  Admin Login </div>

                    <div class="card-body">
                        <form role="form" action="{{ route('checkingadminlogin') }}" method="POST">

                            {{ csrf_field() }}

                            @include('includes.error-message')


                            <div class="form-group">
                                <label for="email"> Email </label>
                                <input class="{!!   Session::has('errors')? 'is-invalid form-control' : 'form-control' !!}" type="email"  name="email" id="email" placeholder="Enter Email" autofocus>
                            </div>

                            <div class="form-group">
                                <label for="password"> Password </label>
                                <input type="password" class="{!!   Session::has('errors') ? 'is-invalid form-control' : 'form-control' !!}" name="password" id="password" placeholder="Enter Password">
                                <span toggle="#password" class="glyphicon glyphicon-eye-open toggle-password" style="float:right;margin-right: 10px;margin-top: -25px;position: relative;z-index: 2;cursor:pointer"> </span>

                            </div>
                            <input type="submit" class="btn btn-primary" style="margin-bottom:5px" value="Log In" name="adminlogin">
                            <!--<a class="btn btn-danger pull-right" data-toggle="tooltip" title="Did You Forgot Your Password? Click Here" href="forgotpassword.php" role="button"> Forgotten Password </a>-->
                        </form>
                    </div>
                    <div class="card-footer">

                        <div class="row">
                            <div class="col-md-6">
                                New Admin ? <a class="btn btn-info btn-lg" data-toggle="tooltip" title="Click Here to Sign Up" href="{{ route('registering_admin') }}" role="button">
                                    Register </a>
                            </div>
                            <div class="col-md-4 ml-auto">
                                <a class="btn btn-link" id="adminforgotpassword" href="{{ route('forgotpassword') }}"> Forgot Password?  </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">

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