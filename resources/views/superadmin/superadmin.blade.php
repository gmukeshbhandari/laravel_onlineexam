@extends('layouts.master')
@section('title','Super Admin - Master Controller of the Website')
@section('content')


    <div class="container-fluid" style="background:#DFD297;padding:20px">
        <div class="row">
            <div class="col-md-4" style="margin-bottom: 10px">
                <div class="card">
                    <div class="card-heading"  style="background: #337ab7;border-color: #337ab7;padding: 10px 15px"> Super Admin Login </div>



                    <div class="card-body">
                        <form role="form" action="{{ route('addverifycode') }}" method="POST">

                            {{ csrf_field() }}

                            @include('includes.error-message')

                            <div class="form-group">
                                <label for="verificationcode"> Verification Code </label>
                                <input class="form-control" type="text" maxlength="15" name="verificationcode" id="verificationcode" placeholder="Enter Verification Code" autofocus>
                            </div>

                            <input type="submit" class="btn btn-primary" style="margin-bottom:5px" value="ADD">
                        </form>
                    </div>
                </div>
            </div>


            <div class="col-md-8">

                @if(!$verificationcodes->isEmpty())
                <table class="table table-bordered table-responsive-sm">
                    @php
                    $i = 0
                    @endphp
                    <thead class="thead-light">
                        <tr>
                            <th> S.N  </th>
                            <th> Verification Code </th>
                            <th> Email </th>
                            <th> Status </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($verificationcodes as $verificationcode)
                        @php
                        $i++
                        @endphp
                        <tr>
                            <th>{{ $i }} </th>
                            <td>  {{ $verificationcode->Verification_Code }} </td>
                            <td> {{ $verificationcode->email }} </td>
                            <td>
                                @if ($verificationcode->Status == 1)

                                  <h5>   <span class="badge badge-success"  style="font-size:16px;padding:4px 8px"> Unused    </span> </h5>
                                @else
                                    <h5>   <span class="badge badge-warning"  style="font-size:16px;padding:4px 8px"> Used    </span> </h5>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-sm btn-info" href="{{ route('deleteverificationcode',['id' =>$verificationcode->id] )}}"> Delete </a>
                            </td>
                        </tr>
                    @endforeach()
                    </tbody>
                </table>
                    @endif
            </div>
        </div>
        </div>

    <div class="container-fluid" style="background:#daa520;padding:20px;margin-top: 30px">
@if(!$admindetails->isEmpty())
        <table class="table table-responsive-sm">
            <thead class="thead-light">
            @php $i = 0 @endphp
            <tr>
                <th scope="col"> S.N  </th>
                <th scope="col"> College Name</th>
                <th scope="col"> Email </th>
                <th scope="col"> Country </th>
                <th scope="col"> Zone </th>
                <th scope="col"> District </th>
                <th scope="col"> Village </th>
                <th scope="col"> Street Address </th>
                <th scope="col"> Ward No </th>
                <th scope="col"> College ID </th>
                <th scope="col"> Verification Status </th>
                <th scope="col"> Account Status </th>
            </tr>
            </thead>
            <tbody>
            @foreach($admindetails as $admindetail)
                @php $i++ @endphp
                <tr>
                    <th scope="row"> {{ $i  }}  </th>
                    <td>  {{ $admindetail->College_Name }}  </td>
                    <td>  {{ $admindetail->email }}  </td>
                    <td>  {{ $admindetail->Country }}  </td>
                    <td> {{ $admindetail->Zone}} </td>
                    <td> {{ $admindetail->District}} </td>
                    <td> {{ $admindetail->Village}} </td>
                    <td> {{ $admindetail->Street_Address}} </td>
                    <td> {{ $admindetail->Ward_No}} </td>
                    <td> {{ $admindetail->College_ID}} </td>
                    <td>
                        <h4>
                            @if($admindetail->Verified == 1)
                                <h5>   <span class="badge badge-success"  style="font-size:16px;padding:4px 8px"> Verified    </span> </h5>
                            @else
                                <h5>   <span class="badge badge-success"  style="font-size:16px;padding:4px 8px"> Unverified    </span> </h5>
                            @endif
                        </h4>

                    </td>

                    <td>
                        <h4>
                            @if($admindetail->flag_en_dis == 1)
                                <a class="btn btn-sm btn-info" href="{{ route('changeadminaccountflag',['id' =>$admindetail->id] )}}"> Inactivate </a>
                            @else
                                <a class="btn btn-sm btn-info" href="{{ route('changeadminaccountflag',['id' =>$admindetail->id] )}}"> Activate </a>
                            @endif
                        </h4>

                    </td>
                </tr>
                @endforeach
                </tr>
        </table>
        @endif
    </div>


@endsection






