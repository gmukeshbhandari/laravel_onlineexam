@extends('layouts.master')

@section('title','View Profile')

@section('content')
    @if ($data->exists())

        <div class="container-fluid accordion" id="accordionExample">
            <div class="row profile">
                <div class="col-md-3 col-12"  style="margin-bottom: 10px">

                    <!-- START PROFILE_SIDEBAR -->
                    <div class="profile-sidebar"  >

                        <!-- SIDEBAR USERPIC -->
                        <div class="profile-userpic text-center" style="margin-bottom: 5px">
                                <img src="{{ URL::to('images/defaultprofileadmin.jpg') }}" class="img-fluid" alt="Image">

                        </div>

                        <!-- END SIDEBAR USERPIC -->
                        <!-- SIDEBAR USER TITLE -->

                        <div class="profile-usertitle">
                            <div class="profile-usertitle-name">
                                {{ $data->First_Name }} {{ '' }}  {{ isset($data->Middle_Name) ? $data->Middle_Name : ''}}{{ '' }} {{ $data->Last_Name }}
                            </div>
                            <div class="profile-usertitle-job">
                                Developer
                            </div>
                        </div>

                        <!-- END SIDEBAR USER TITLE -->
                        <!-- SIDEBAR BUTTONS -->
                        <div class="profile-userbuttons">
                            <div class="row">
                                <div class="col-md-6 col-6 text-right">
                                    <button type="button" class="btn btn-success btn-sm">Change Picture</button>
                                </div>
                                <div class="col-md-6 col-6 text-left">
                                    <button type="button" class="btn btn-danger btn-sm">Edit Profile</button>
                                </div>
                            </div>


                        </div>
                        <!-- END SIDEBAR BUTTONS -->
                        <!-- SIDEBAR MENU -->
                        <div class="profile-usermenu"  id="viewadminprofile">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a role="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseprofileoverview" aria-expanded="false" aria-controls="collapseprofileoverview">
                                        <span class="glyphicon glyphicon-home"></span>
                                        Profile Overview </a>
                                </li>
                                <li class="nav-item">
                                    <a role="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseaccountsetting" aria-expanded="false" aria-controls="collapseaccountsetting">
                                        <span class="glyphicon glyphicon-user"></span>
                                        Account Settings </a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a href="#" target="_blank">
                                        <span class="glyphicon glyphicon-ok"></span>
                                        Tasks </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#">
                                        <span class="glyphicon glyphicon-flag"></span>
                                        Help </a>
                                </li>--}}
                            </ul>
                        </div>

                        <!-- END MENU -->
                    </div>
                    <!-- END PROFILE SIDEBAR -->
                </div>

                <div class="position-static w-auto">
                    <div id="collapseprofileoverview" class="collapse show" data-parent="#accordionExample">
                        <div class="profile-content">

                                <div class="col-md-12 col-12" style="border-bottom:2px solid coral;margin-bottom: 10px">
                                    <h5> Name </h5>
                                    <p> <i>  {{ $data->First_Name }} {{ '' }}  {{ isset($data->Middle_Name) ? $data->Middle_Name : ''}}{{ '' }} {{ $data->Last_Name }} </i> </p>
                                </div>
                                <div class="col-md-12 col-12">
                                    <h5> Email </h5>
                                    <p> <i>{{ $data->email }}</i> </p>
                                </div>

                        </div>
                    </div>

                    <div id="collapseaccountsetting" class="collapse" data-parent="#accordionExample">
                        <div class="profile-content">
                          Account Settings Page Under Construction.
                        </div>
                    </div>

                </div>
            </div>
        </div>

    @endif

    @if (!$data->exists())
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-12">
                    <h1 class="text-center"> No Data Available </h1>
                </div>
            </div>

        </div>
    @endif



@endsection