                                                               @if (in_array(Route::currentRouteName(), ['userhomepage','userdashboard','detailaboutuaccount','admindashboard','detailaboutaaccount','user_list','super_admin','detailaboutsaccount','viewingadminprofile','viewinguserprofile','viewingsuperadminprofile','question_managing','userfeedback','viewfeedback','changeupassword','changeapassword','changespassword']))


<nav class="navbar navbar-inverse navbar-expand-lg navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

            @if (in_array(Route::currentRouteName(), ['userhomepage','detailaboutuaccount','userdashboard','viewinguserprofile','userfeedback','changeupassword']))
                @if (in_array(Route::currentRouteName(), ['userhomepage','userfeedback']))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">  <span class="glyphicon glyphicon-home"> </span>  Main Page </a>
                </li>

                    @if (in_array(Route::currentRouteName(), ['userhomepage']))
                    <li class="nav-item">
                        <a data-toggle="modal" data-target="#ourcontact" class="nav-link"> <span class="glyphicon glyphicon-envelope">  </span> Contact </a>
                    </li>



                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('userfeedback') }}"> <span class="glyphicon glyphicon-comment"></span> Feedback</a>
                    </li>
                        @endif
                @endif
                @if (in_array(Route::currentRouteName(), ['userdashboard','detailaboutuaccount','changeupassword','viewinguserprofile']))
                        @if (in_array(Route::currentRouteName(), ['userdashboard']))
                        <li class="nav-item active">
                            @else
                            <li class="nav-item">
                                @endif
                                <a class="nav-link" href="{{ route('userdashboard') }}">  <span class="glyphicon glyphicon-home"> </span> Home
                                    <span class="sr-only">(current)</span>
                                </a>


                        </li>

                    @endif







                   {{-- <li class="nav-item">
                        <a class="nav-link" href="#">Other Menu Options</a>
                    </li>--}}
        </ul>

        @if (in_array(Route::currentRouteName(), ['userdashboard','detailaboutuaccount','viewinguserprofile','changeupassword']))
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="{{ route('userdashboard') }}" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                   {{ Auth::user()->First_Name}} {{ '' }}
                    {{ isset(Auth::user()->Middle_Name) ? Auth::user()->Middle_Name : ''}}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('viewinguserprofile') }}">View Profile</a>
                    <a class="dropdown-item" href="{{ route('detailaboutuaccount') }}">Account Details</a>
                    @if (in_array(Route::currentRouteName(), ['userdashboard','detailaboutuaccount']))
                    <a class="dropdown-item" href="{{ route('changeupassword') }}">Change Password</a>
                    @endif
                    <a class="dropdown-item" href="{{ route('udelete_account') }}"> <span class="glyphicon glyphicon-trash"> </span> Delete My Account</a>
                    <a class="dropdown-item" href="{{route('ulog_out')}}"> <span class="glyphicon glyphicon-log-out"> </span>
 Logout</a>
                </div>
            </li>
        </ul>
            <ul>

            </ul>
        <ul>

        </ul>
        <ul>
        </ul>
                {{-- <ul class="navbar-nav">
                     <li class="nav-item">
                         <a class="nav-link" href="{{ route('log_out') }}"> Edit Profile </a>
                     </li>
                 <li class="nav-item">
                <a class="nav-link" href="{{ route('log_out') }}"> Logout </a>
                 </li>--}}
@endif
        @endif

                    @if (in_array(Route::currentRouteName(), ['admindashboard','user_list','detailaboutaaccount','viewingadminprofile','question_managing','changeapassword']))
            @if (in_array(Route::currentRouteName(), ['admindashboard']))
            <li class="nav-item active">
                @else
                <li class="nav-item">
                    @endif


                <a class="nav-link" href="{{ route('admindashboard') }}">  <span class="glyphicon glyphicon-home"> </span> Home<span class="sr-only">(current)</span></a>
            </li>
          {{--  <li class="nav-item">
                <a class="nav-link" href="#">Other Menu Options</a>
            </li>--}}
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="{{ route('admindashboard') }}" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="glyphicon glyphicon-wrench"> </span> Settings  </a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('viewingadminprofile') }}">View Profile</a>
                        <a class="dropdown-item" href="{{ route('detailaboutaaccount') }}">Account Details </a>

                        @if (in_array(Route::currentRouteName(), ['admindashboard','user_list','detailaboutaaccount','viewingadminprofile','question_managing']))
                        <a class="dropdown-item" href="{{ route('changeapassword') }}">Change Password</a>
                        @endif
                        <a class="dropdown-item"href="{{ route('adelete_account') }}"> <span class="glyphicon glyphicon-trash"> </span> Delete My Account</a>
                        <a class="dropdown-item" href="{{ route('alog_out') }}"> <span class="glyphicon glyphicon-log-out"> </span> Logout</a>
                    </div>
                </li>
            </ul>
                <ul>

                </ul>
                <ul>

                </ul>
                <ul>
                         {{--   Settings purai right ma gayera width 100% bhanda badi hune hatauna settings lai halka left ma lyauna //to bring settings on little bit left side from right part of screen--}}
                </ul>

                    @endif


                    @if(in_array(Route::currentRouteName(),['super_admin','detailaboutsaccount','viewfeedback','changespassword','viewingsuperadminprofile']))
                    @if (in_array(Route::currentRouteName(), ['super_admin']))
                        <li class="nav-item active">
                    @else
                        <li class="nav-item">
                            @endif

                            <a class="nav-link" href="{{ route('super_admin') }}">  <span class="glyphicon glyphicon-home"> </span> Home<span class="sr-only">(current)</span></a>
                        </li>
                    </ul>

                        @if (in_array(Route::currentRouteName(), ['super_admin','detailaboutsaccount','changespassword','viewingsuperadminprofile']))
                    <ul class="navbar-nav">
                        <li class="nav-item"> <a class="nav-link" href="{{ route('viewfeedback') }}"> <span class="glyphicon glyphicon-envelope"> </span> Feedbacks </a> </li>
                        </ul>
                    @endif

                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle"  href="{{ route('super_admin') }}" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::guard('superadmin')->user()->First_Name}} {{ '' }}
                                    {{ isset(Auth::guard('superadmin')->user()->Middle_Name) ? Auth::guard('superadmin')->user()->Middle_Name : ''}}
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="{{ route('viewingsuperadminprofile') }}">View Profile</a>
                                    <a class="dropdown-item" href="{{ route('detailaboutsaccount') }}">Account Details </a>
                                    @if(in_array(Route::currentRouteName(),['super_admin','detailaboutsaccount','viewfeedback']))
                                    <a class="dropdown-item" href="{{ route('changespassword') }}">Change Password</a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('slog_out') }}"> <span class="glyphicon glyphicon-log-out"> </span> Logout</a>
                                </div>
                            </li>
                        </ul>
                        <ul>

                        </ul>
                        <ul>
                            </ul>
                    @endif

                    </ul>

    </div>
</nav>

@endif

