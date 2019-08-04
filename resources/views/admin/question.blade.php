@extends('layouts.master')

@section('title','Manage Question')

@section('content')

<div class="container-fluid" style="margin-bottom: 10px">
<div class="row">
    <div class="col-md-12 col-12">

        <div class="card">

            <div class="card-header"> <span class="glyphicon glyphicon-cog"> </span>  Manage Questions </div>

            @include('includes.error-message')


<br/> <br/>
            <div  style="border-top:3px solid gray;padding-bottom:10px;padding-top:10px">
                <div class="col-md-5 col-12 offset-md-1 offset-0">
                    <h5 style="font-size:1.4vw"> Subject Name <span style="padding-left:13vw"> :  </span><i style="padding-left:10px"> {{ $subject->Subject_Name }}               </i>   </h5>
                    <h5 style="font-size:1.4vw"> Category <span style="padding-left:16vw">:</span> <i style="padding-left:10px"> {{ $subject->category->Category_Name }}    </i>   </h5>
                    <h5 style="font-size:1.4vw"> Duration  <span style="padding-left:16.2vw"> : </span> <i style="padding-left:10px"> {{ $subject->Duration }} minutes                   </i>   </h5>

                    <h5 style="font-size:1.4vw"> Full Marks  <span style="padding-left:15.2vw"> : </span> <i style="padding-left:10px"> {{ $subject->Full_Marks }}                   </i>   </h5>


                    <h5 style="font-size:1.4vw"> Pass Marks  <span style="padding-left:14.7vw"> : </span> <i style="padding-left:10px"> {{ $subject->Pass_Marks }}                   </i>   </h5>

                    <h5 style="font-size:1.4vw"> Total No of Question Added  <span style="padding-left:3.9vw"> : </span> <i style="padding-left:10px"> {{ \App\Question::where('Subject_ID',$subject->id)->count() }}                   </i>   </h5>
                </div>
<br/>
                <button type="button" id="btnaddnewquestion" style="margin-bottom: 10px" class="col-md-2 col-5 offset-md-1 offset-3 btn btn-info"> <span class="glyphicon glyphicon-plus"> </span> ADD NEW QUESTION </button>

                <div class="card-body"  id="addnewquestion">
                    <div class="col-md-10 offset-md-1">
                        <p style="padding:10px;border-top: 1px solid gray;border-bottom: 1px solid gray;color:red"> Fields marked with * are mandatory </p>

                        <form action="{{ route('adding_ques',$subject->id)  }}" method="post">
                        @include('includes.question-form')
                    </div>
                </div>

            </div>
            <br/>




{{--fsfsf--}}
            @if(!$questions->isEmpty())
                <div class="accordion" id="accordionExample">
                    <div class="card">
                    <div class="card-header"> <span class="glyphicon glyphicon-cog"></span> List of Added Questions</div>
                        @php $a = 0 @endphp
                        @foreach($questions as $question)
                           @php $a = $a + $question->Marks  @endphp
                        @endforeach
                        <h5 style="margin: 10px 0px 10px 10px;font-size:1.4vw"> Total Marks  <span style="padding-left:13vw"> :  </span><i style="padding-left:10px"> {{ $a }} </i>   </h5>
                        <div class="card-body">
                    @php
                    $i = 0
                    @endphp
                    @foreach($questions as $question)
                        @php
                        $i++
                        @endphp
                        <div class="card" style="margin-bottom: 10px">
                            <div class="card-header" id="heading{{ $question->id}}">
                                <h2 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{$i}}" aria-expanded="true" aria-controls="collapse{{$i}}">
                                        Question No. {{ $i }}
                                    </button>
                                    <span style="font-size: 15px"> {{ $question->Question }} </span>
                                </h2>
                            </div>

                            <div id="collapse{{$i}}" class="collapse hide" aria-labelledby="heading{{$i}}" data-parent="#accordionExample">
                                <div class="card-body">
                                    <p style="padding:10px;border-top: 1px solid gray;border-bottom: 1px solid gray;color:red"> Fields marked with * are mandatory </p>

                                    <form action="{{ route('edit_addedquestion',$question->id)  }}" method="post">
                                    @include('includes.question-form-edit')
                                </div>
                            </div>
                        </div>
                    @endforeach
                        </div>
                </div>
                </div>
            @endif

        </div>
    </div>
</div>
</div>


    <script>
        $('#addnewquestion').hide();
        $('#btnaddnewquestion').on('click', function(){
            $('#addnewquestion').slideDown();
        });
    </script>

@endsection