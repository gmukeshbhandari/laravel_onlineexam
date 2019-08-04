@extends('layouts.master')

@section('title','Feedback')

@section('content')

    <div class="row">

        <div class="col-md-6 offset-md-3">

            <div class="card">
                <div class="card-header"> <span class="glyphicon glyphicon-comment"> </span> Feedback </div>


            <div class="card-body">
                <p style="padding:10px;border-top: 1px solid gray;border-bottom: 1px solid gray;color:red"> Fields marked with * are mandatory </p>
                @include('includes.error-message')

                <form role="form" action="{{ route('checkingFeedback') }}" method="post">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="email"> Email </label>
                        <input type="email" maxlength="50" value="{{ old('email') }}" placeholder="Enter Email" class="form-control" name="email" id="email" autofocus>
                    </div>

                    <div class="form-group">
                        <label for="feedbacktopic"> Topic </label>
                        <input type="text" maxlength="50" value="{{ old('feedbacktopic') }}" placeholder="What is your feedback about?" class="form-control" name="feedbacktopic" id="feedbacktopic">
                    </div>

                    <div class="form-group">
                        <label for="feedbackdescription"> Topic </label>
                        <textarea placeholder="Shortly describe your problem here" class="form-control" maxlength="191"  name="feedbackdescription" id="feedbackdescription" cols="30" rows="4"></textarea>

                    </div>

                    <input type="submit" class="btn btn-primary" style="margin-bottom:5px" value="Submit">
                </form>
            </div>
            </div>
        </div>
    </div>
@endsection