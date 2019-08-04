@extends('layouts.master')

@section('title','User Dashboard')

@section('content')

    <div class="col-md-4">
        @include('includes.error-message')
    </div>


    <div class="row" style="margin-bottom: 20px">
        <div class="col-md-6">

            <form action="{{ route('givingexam') }}" method="post">
                {{ csrf_field() }}


                <select id="selectgiveexamsubjectcategory" name="selectgiveexamsubjectcategory" class="form-control">
                    <option style="display:none" disabled selected value> Choose the subject </option>
                    @if(isset($listofactivesubjects))
                    @foreach($listofactivesubjects as $listofactivesubject)
                        <option value="{{ $listofactivesubject->id }}"> {{ $listofactivesubject->Subject_Name  }} {{ '   ' }} ( {{ $listofactivesubject->category->Category_Name }}) </option>
                    @endforeach
                    @endif
                </select>
            <input type="submit" class="btn btn-primary btn-lg" style="margin-top: 10px" value="Start Exam">
            </form>

        </div>

    </div>

@if(!$results->isEmpty())

    <div class="card">
        <div class="card-header"> Results </div>
        <div class="card-body">
            <table class="table table-bordered table-responsive-sm">
                <thead class="thead-light">
                @php $a = 0 @endphp
                <tr>
                    <th> S.N </th>
                    <th> Category Name </th>
                    <th> Subject Name </th>
                    <th> Exam Date </th>
                    <th> Full Marks </th>
                    <th> Pass Marks </th>
                    <th> Result </th>
                    <th> Marks Obtained </th>
                    <th> Number of Correct Answer </th>
                    <th>  Number of Incorrect Answer </th>
                    <th>  Number of Leaved Answer </th>
                </tr>
                </thead>

                <tbody>
                @foreach($results as $result)
                    @php $a++ @endphp
                    <tr>
                        <th> {{ $a }} </th>
                        <td> {{ $result->Category_Name }} </td>
                        <td> {{ $result->Subject_Name }} </td>
                        <td> {{ $result->Exam_Date}} </td>
                        <td> {{ $result->Full_Marks}} </td>
                        <td> {{ $result->Pass_Marks}} </td>
                        <td> @if($result->Result == 0) {{ 'Fail' }} @else {{ 'Pass' }} @endif </td>
                        <td> {{ $result->Obtained_Marks}} </td>
                        <td> {{ $result->No_of_Correct_Answer}} </td>
                        <td> {{ $result->No_of_Incorrect_Answer}} </td>
                        <td> {{ $result->No_of_Leaved_Answer}} </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif

@endsection
