@extends('layouts.master')

@section('title','Recover Password')

@section('content')

    @if(isset($useremail))

    <div class="row">
        <div class="col-md-6 offset-md-3">

            <div class="card">
                <div class="card-header"> Recover Password </div>
                <div class="card-body">
                    @include('includes.error-message')
                    <p style="padding:10px;border-top: 1px solid gray;border-bottom: 1px solid gray;color:red"> Fields marked with * are mandatory </p>

                    @if($useremail == 'adminemail')
                        <form action="{{ route('checkrecoverPassword',['email' => $mail,'name' => 'adminemail']) }}" method="post">
                            @endif
                            @if($useremail == 'useremail')
                                <form action="{{ route('checkrecoverPassword',['email'=>$mail,'name' => 'useremail']) }}" method="post">
                                    @endif
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <label for="newpassword"> New Password </label>
                                                <input type="password" value="{{ old('newpassword') }}" maxlength="60" class="form-control" id="newpassword" name="newpassword" placeholder="Type Your New Password Here" autofocus required>
                                                <span toggle="#newpassword" class="glyphicon glyphicon-eye-open toggle-newpassword" style="float:right;margin-right: 10px;margin-top: -25px;position: relative;z-index: 2;cursor:pointer"> </span>
                                            </div>

                                            <div class="form-group">
                                                <label for="confirmnewpassword"> Confirm New Password </label>
                                                <input type="password" value="{{ old('confirmnewpassword') }}" maxlength="60" class="form-control" id="confirmnewpassword" name="confirmnewpassword" placeholder="Retype your new password to confirm it." required>
                                                <span toggle="#confirmnewpassword" class="glyphicon glyphicon-eye-open toggle-confirmnewpassword" style="float:right;margin-right: 10px;margin-top: -25px;position: relative;z-index: 2;cursor:pointer"> </span>
                                            </div>

                                            <input type="submit" class="btn btn-primary" style="margin-bottom:5px" value="Change Password">
                                        </form>
                </div>
            </div>

        </div>
    </div>
    @else
        <div class="row" style="border:2px solid gray;height:400px;text-align: center">
            <div class="col-md-6 ml-auto mr-auto">
                @if($msg = 'Sorry your email cannot be identified.')
                    <h3 style="color:red"> <i> Sorry, your email cannot be identified. </i> </h3>
                @else
                    <h3 style="color:red"> <i> Something went wrong. </i> </h3>
                @endif
            </div>
        </div>

    @endif



    <script>
        $(document).ready(function() {

            $('.toggle-newpassword').click(function (e) {
                e.preventDefault();
                $(this).toggleClass('glyphicon-eye-close');
                var input = $($(this).attr("toggle"));
                if (input.attr("type") == "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });

            $('.toggle-confirmnewpassword').click(function (e) {
                e.preventDefault();
                $(this).toggleClass('glyphicon-eye-close');
                var input = $($(this).attr("toggle"));
                if (input.attr("type") == "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });
        });
    </script>

@endsection