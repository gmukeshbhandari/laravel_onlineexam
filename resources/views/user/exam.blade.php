@extends('layouts.master')
@section('title','Online Examination System')

@section('givingexamdetail')

    <div class="row" id="afterjumbotronclassid">
        <div class="col-md-5 col-12 text-left"  style="background:chartreuse">
            <h5 style="font-size:1.4vw"> Subject Name <span style="padding-left:13vw"> :  </span><i style="padding-left:10px"> {{ $subjectinfos->Subject_Name }}               </i>   </h5>
            <h5 style="font-size:1.4vw"> Category <span style="padding-left:16vw">:</span> <i style="padding-left:10px"> {{ $subjectinfos->category->Category_Name }}    </i>   </h5>
            <h5 style="font-size:1.4vw"> Duration  <span style="padding-left:16.2vw"> : </span> <i style="padding-left:10px"> {{ $subjectinfos->Duration }} minutes                   </i>   </h5>

            <h5 style="font-size:1.4vw"> Full Marks  <span style="padding-left:15.2vw"> : </span> <i style="padding-left:10px"> {{ $subjectinfos->Full_Marks }}                   </i>   </h5>


            <h5 style="font-size:1.4vw"> Pass Marks  <span style="padding-left:14.7vw"> : </span> <i style="padding-left:10px"> {{ $subjectinfos->Pass_Marks }}                   </i>   </h5>

            <h5 style="font-size:1.4vw"> Total No of Question  <span style="padding-left:8.4vw"> : </span> <i style="padding-left:10px"> {{ \App\Question::where('Subject_ID',$subjectinfos->id)->count() }}                   </i>   </h5>
        </div>

        <div class="col-md-3 col-12 text-left" style="background:coral">
            <h5 style="font-size:1.4vw"> Name: <i> {{ Auth::user()->First_Name }} {{ isset(Auth::user()->Middle_Name) ? Auth::user()->Middle_Name : ''}} {{  Auth::user()->Last_Name }} </i></h5> <br/>
            <h5 style="font-size:1.4vw"> Symbol: <i> {{ Auth::user()->Symbol_No }} </i></h5>
        </div>

        <div class="col-md-4 col-12 ml-auto" style="background:chartreuse">
            <div id="timecounter" class="sticky"  style="padding-top:30px"> </div>
        </div>

    </div>


@endsection


@section('content')



<form action="{{ route('savequestions',$subjectinfos->id) }}" method="post" id="examof">
    {{ csrf_field() }}
            @php $a = 0 @endphp
            @foreach($questions as $question)
                @php $a = $a + 1 @endphp
                    <div style="padding:20px" class="jumbotron"  id="jumbotron{{ $a }}">
                                <h4> QUESTION {{ $a }} : </h4>
                                <p>  {{ $question->Question }} </p>

                                    <ul id="radioanswer{{ $a }}" style="list-style: none">


                                        <li>
                                            <div>
                                                <input type="radio"  name="option{{ $a }}" value="1" > {{$question->Option1}}
                                            </div>

                                            <div>
                                                <input type="radio" name="option{{ $a }}" value="2"> {{$question->Option2}}
                                            </div>

                                            <div>
                                                <input type="radio" name="option{{ $a }}" value="3"> {{$question->Option3}}
                                            </div>

                                            <div>
                                                <input type="radio" name="option{{ $a }}" value="4"> {{$question->Option4}}
                                            </div>
                                        </li>


                                      </ul>
                            <input type="hidden" name="question_id{{$a}}" value="{{ $question->id }}">
                    </div>
    @endforeach
        <input type="submit" name="submitquestion" id="submitquestion" class="btn btn-primary" value="Submit">

</form>

<script>

   /* $('#jumbotronclassid').addClass('fixed-top');*/

    // To disable F1 to F12 Key but F11 Key will still be enable
    document.onkeypress = function (event) {
        event = (event || window.event);
        if (event.keyCode >= 112 && event.keyCode <= 123) {
            return false;
        }
    }
    document.onmousedown = function (event) {
        event = (event || window.event);
        if (event.keyCode >= 112 && event.keyCode <= 123) {
//alert(‘No F-keys’);
            return false;
        }
    }
    document.onkeydown = function (event) {
        event = (event || window.event);
        if (event.keyCode >= 112 && event.keyCode <= 123) {
//alert(‘No F-keys’);
            return false;
        }
    }





    //TO DISABLE RIGHT CLICK
    $(document).ready(function(){
    $(document).bind("contextmenu",function(e){
        return false;
    });
    });



    var elem = document.getElementById("myexamidforfullscreen");

    function openFullscreen() {
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        } else if (elem.mozRequestFullScreen) { /* Firefox */
            elem.mozRequestFullScreen();
        } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
            elem.webkitRequestFullscreen();
        } else if (elem.msRequestFullscreen) { /* IE/Edge */
            elem.msRequestFullscreen();
        }
    }
    window.onload = openFullscreen;

    window.onscroll = function() {myFunction()};

    var header = document.getElementById("timecounter");
    var sticky = header.offsetTop;

    function myFunction() {
        if (window.pageYOffset > sticky) {
            header.classList.add("sticky");
        } else {
            header.classList.remove("sticky");
        }
    }


    $(function() {
        var clock = $('#timecounter').FlipClock({{ $duration*60 }}, {
            autoStart: false,
            countdown: true,
            clockFace: 'MinuteCounter',
            callbacks: {
                interval: function () {
                    var time = clock.getTime().time;
                    {{--@foreach($questions as $q)
                         $('#timetaken{{$q->id}}').val(time);
                    @endforeach--}}
               },
                stop: function(){
                    alert("The time has run out!");
                    document.getElementById("examof").submit();
                    //window.location.replace("{{ route('savequestions',$subjectinfos->id) }}");
                }

            }
        });
        clock.start();
    });
</script>

@endsection