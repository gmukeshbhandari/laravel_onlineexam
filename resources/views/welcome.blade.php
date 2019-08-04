@extends('layouts.master')
@section('content')
    <div class="container-fluid ">
        <div class="container-fluid custom">
             <div class="row">
                <div class="col-md-6 col-6 text-right">
                    <a role="button" class="btn btn-info btn-lg" href="{{ route('userhomepage') }}"> USER </a>
                </div>
                 <div class="col-md-6 col-6 text-left">
                     <a role="button" class="btn btn-info btn-lg" href="{{ route('adminhomepage') }}"> ADMIN </a>
                 </div>
            </div>
         </div>
    </div>

@endsection