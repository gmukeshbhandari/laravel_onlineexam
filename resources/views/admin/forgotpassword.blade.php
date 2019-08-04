@extends('layouts.master')

@section('title','Forgot Password')

@section('content')

<div class="row">
    <div class="col-md-6 ml-auto mr-auto"  >
    <div class="card">
        <div class="card-header" style="background: #337ab7"> Forgot Password </div>
        <div class="card-body">
            @include('includes.error-message')
            <form action="{{ route('checkforgotpassword') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="email"> Email </label>
                        <span style="color:red"> * </span>
                        <input type="email" class="form-control" value="{{ old('email') }}" maxlength="50" placeholder="Place your email here" id="email" name="email" password="email" autofocus required>

                    </div>
                    <input type="submit" class="btn btn-primary" value="Recover">
                </form>
        </div>
    </div>
    </div>
</div>


@endsection