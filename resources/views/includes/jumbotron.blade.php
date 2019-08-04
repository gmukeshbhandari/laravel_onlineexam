<div class="jumbotron text-center" id="jumbotronclassid" style="margin-bottom:5px;background:#50d07d">
    <h1 style="font-size:3vw;"> <span class="glyphicon glyphicon-education"> Online Examination System <span class="glyphicon glyphicon-education"> </h1>
        @if (in_array(Route::currentRouteName(), ['userhomepage','registering_user','changeupassword','userdashboard','viewinguserprofile','userfeedback']))
            <br/>
        <p style="font-size:1vw;"> Give Online Exams For Any Subjects </p>
            <p style="font-size:1vw;"> Improve Your Skills </p>
        @endif
    @if (in_array(Route::currentRouteName(), ['givingexam']))
        @yield('givingexamdetail')
    @endif


    @if (in_array(Route::currentRouteName(), ['admindashboard','changeapassword','detailaboutaaccount','viewingadminprofile','question_managing','user_list']))

       {{-- $details = Auth::guard('admin')->user();--}} {{--get currently authenticated admin--}}
        {{--$collegename = $details['College_Name']; --}}{{--//get currently autheticated admin College Name--}}
    <p style="font-size:1vw;">  {{ Auth::guard('admin')->user()->College_Name }} </p>{{--get currently authenticated admin college name--}}
        @endif

    @if(in_array(Route::currentRouteName(),['super_admin','changespassword','viewfeedback','viewingsuperadminprofile','detailaboutsaccount']))
        <h4> System Management Interface </h4>
      <p style="font-size:1vw;"> {{Auth::guard('superadmin')->user()->First_Name}} {{' '}} {{isset(Auth::guard('superadmin')->user()->Middle_Name) ? Auth::guard('superadmin')->user()->Middle_Name: ' '}} {{ Auth::guard('superadmin')->user()->Last_Name }}</p>
    @endif
</div>
