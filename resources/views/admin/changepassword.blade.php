@extends('layouts.master')

@section('title','Change Password')

@section('content')

    <div class="row">
        <div class="col-md-6 offset-md-3">

            <div class="card">
                <div class="card-header"> Change Password </div>
                <div class="card-body">
                    @include('includes.error-message')
                    <p style="padding:10px;border-top: 1px solid gray;border-bottom: 1px solid gray;color:red"> Fields marked with * are mandatory </p>

                    @if($data == 'admin')
                    <form action="{{ route('checkchangeapassword') }}" method="post">
                        @endif
                        @if($data == 'user')
                            <form action="{{ route('checkchangeupassword') }}" method="post">
                                @endif
                                @if($data == 'superadmin')
                                <form action="{{ route('checkchangespassword') }}" method="post">
                                    @endif
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="currentpassword"> Current Password </label>
                            <input type="password" value="{{ old('currentpassword') }}" maxlength="60" class="form-control" id="currentpassword" name="currentpassword" placeholder="Enter Your Current Password">
                            <span toggle="#currentpassword" class="glyphicon glyphicon-eye-open toggle-currentpassword" style="float:right;margin-right: 10px;margin-top: -25px;position: relative;z-index: 2;cursor:pointer"> </span>

                        </div>

                        <div class="form-group">
                            <label for="newpassword"> New Password </label>
                            <input type="password" value="{{ old('newpassword') }}" maxlength="60" class="form-control" id="newpassword" name="newpassword" placeholder="Type Your New Password Here">
                            <span toggle="#newpassword" class="glyphicon glyphicon-eye-open toggle-newpassword" style="float:right;margin-right: 10px;margin-top: -25px;position: relative;z-index: 2;cursor:pointer"> </span>
                        </div>

                        <div class="form-group">
                            <label for="confirmnewpassword"> Confirm New Password </label>
                            <input type="password" value="{{ old('confirmnewpassword') }}" maxlength="60" class="form-control" id="confirmnewpassword" name="confirmnewpassword" placeholder="Retype your new password to confirm it.">
                            <span toggle="#confirmnewpassword" class="glyphicon glyphicon-eye-open toggle-confirmnewpassword" style="float:right;margin-right: 10px;margin-top: -25px;position: relative;z-index: 2;cursor:pointer"> </span>
                        </div>

                        <input type="submit" class="btn btn-primary" style="margin-bottom:5px" value="Update Password">
                    </form>
                </div>
            </div>

        </div>
    </div>



    <script>
        $(document).ready(function() {

            $('.toggle-currentpassword').click(function (e) {
                e.preventDefault();
                $(this).toggleClass('glyphicon-eye-close');
                var input = $($(this).attr("toggle"));
                if (input.attr("type") == "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });

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