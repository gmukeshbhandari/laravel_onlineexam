@extends('layouts.master')

@section('title','Admin Registration')

@section('content')

    <div class="row">
        <div class="col-md-2">

        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background: #337ab7"> <span class="glyphicon glyphicon-log-in"> </span> Admin Registration  </div>

                <div class="card-body">
                    <p style="padding:10px;border-top: 1px solid gray;border-bottom: 1px solid gray;color:red"> Fields marked with * are mandatory </p>
                    @include('includes.error-message')

                    <form role="form" method="post" action="{{ route('admin_r_check') }}">
                        {{ csrf_field() }}

                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <label for="college_name"> College Name </label>
                                <span style="color: red"> * </span>
                                <input type="text" value="{{ old('college_name') }}" maxlength="60" placeholder="Enter College Name" class="form-control" name="college_name" id="college_name"  autofocus>
                            </div>


                            <div class="form-group col-md-6">
                                <label for="email"> Email </label>
                                <span style="color: red"> * </span>
                                <input type="email" maxlength="50" value="{{ old('email') }}" placeholder="Enter Email" class="form-control" name="email" id="email">

                                <span id="error_email"></span>
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="password"> Password</label>
                                <span style="color: red"> * </span>
                                <input type="password" maxlength="60" class="form-control" placeholder="Enter Password" name="password" id="password">
                                <span toggle="#password" class="glyphicon glyphicon-eye-open toggle-password" style="float:right;margin-right: 20px;margin-top: -25px;position: relative;z-index: 2;cursor:pointer"> </span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="confirmpassword"> Confirm Password</label>
                                <span style="color: red"> * </span>
                                <input type="password" maxlength="60" class="form-control" placeholder="Re-enter Password" name="confirmpassword" id="confirmpassword">
<span toggle="#confirmpassword" class="glyphicon glyphicon-eye-open toggle-confirmpassword" style="float:right;margin-right:20px;margin-top:-25px;position:relative;z-index:2;cursor:pointer"> </span>
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="country"> Country </label>
                                <span style="color: red"> * </span>
                                @include('includes.country')
                            </div>



                            <div class="form-group col-md-6">
                                <label for="college_id"> College ID </label>
                                <span style="color: red"> * </span>
                                <input type="number" value="{{ old('college_id') }}" min="1" max="99999999" placeholder="Enter College ID" class="form-control" name="college_id" id="college_id">
                            </div>

                        </div>

                        <div class="form-row" id="nepaldistrictshow" style="display:none;border-bottom:1px solid darksalmon;margin-bottom:10px;padding:5px">
                            <div class="col-md-12" style="border-top:1px solid darksalmon;margin-bottom:10px;padding:5px"> <h4> Permanent Address </h4></div>

                            <div class="form-group col-md-3">
                                <label for="zone"> Zone </label>
                                @include('includes.zone')

                            </div>
                            <div class="form-group col-md-3">
                                <label for="district"> District </label>
                                <select id="district"  class="form-control"  name="district">
                                    <option style="display:none" disabled selected value> Select District </option>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="village"> Village </label>
                                <select id="village"  class="form-control"  name="village">
                                    <option style="display:none" disabled selected value> Select Village </option>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="provinceno"> Province No </label>
                                <input type="number" class="form-control" id="provinceno" name="provinceno" placeholder="Enter Province No"  min="1" max="7" value="{{ old('provinceno') }}">
                            </div>



                            <div class="container">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="wardno"> Ward No </label>
                                            <input type="number" class="form-control" id="wardno" name="wardno" min="1" max="30" placeholder="Enter Ward No" value="{{ old('wardno') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="streetaddress"> Street Address </label>
                                <input type="text"  maxlength="60" placeholder="Enter Street Address" class="form-control" name="streetaddress" id="streetaddress">
                            </div>

                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="verificationcode">  Verification Code </label>
                                <input type="text" value="{{ old('verificationcode') }}" maxlength="15" placeholder="Enter Verification Code"  class="form-control" name="verificationcode" id="verificationcode">
                            </div>
                        </div>



                </div>

                <div class="card card-body bg-light" style="background:#C1C1C1">
                    <h3> What is Verification Code?</h3>
                    <p> Verification Code is a alphanumeric code. It helps us to make sure that your registration for admin on this online examination site is not by any random person. It is to verify that you are really team of some Company, Institute, Schools and College.</p>
                    <h3> How to Get Verification Code? </h3>
                    <p> You can get verification code by emailing the following documents at gmukeshbhandari@gmail.com </p>
                    <h6> Picture of Any Document of You Company or Institute or School or College which most include the following </h6>
                        <dd>- Stamp of Government </dd>
                        <dd> - Address of College </dd>
                        <dd> - Phone Number </dd>
                        <dd> - College ID </dd>
                        <dd> - All Other Required Information </dd>
                </div>

                <input type="submit"  name="register" id="register" class="btn btn-primary" style="margin-bottom:5px" value="Register">
                </form>

            </div>

        </div>
    </div>


    <div class="col-md-2">

    </div>
    </div>




    <script>



        $(document).ready(function(){

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

            $('.toggle-confirmpassword').click(function (e) {
                e.preventDefault();
                $(this).toggleClass('glyphicon-eye-close');
                var input = $($(this).attr("toggle"));
                if (input.attr("type") == "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });

            $('#email').blur(function(){
                var error_email = '';
                var email = $('#email').val();
                var _token = $('input[name="_token"]').val();
                var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if(!filter.test(email))
                {
                    $('#error_email').html('<label class="text-danger">Invalid Email</label>');
                    $('#email').addClass('is-invalid');
                    $('#register').attr('disabled', 'disabled');
                }
                else
                {
                    $.ajax({
                        url:"{{ route('checkaemailavailable') }}",
                        method:"POST",
                        data:{email:email, _token:_token},
                        success:function(result)
                        {
                            if(result == 'unique')
                            {
                                $('#error_email').html('<label class="text-success">Email Available</label>');
                                $('#email').removeClass('is-invalid');
                                $('#register').attr('disabled', false);
                            }
                            else
                            {
                                $('#error_email').html('<label class="text-danger">Email not Available</label>');
                                $('#email').addClass('is-invalid');
                                $('#register').attr('disabled', 'disabled');
                            }
                        }
                    })
                }
            });
        });
    </script>


@endsection



