@extends('layouts.master')
@section('title','View Feedback')

@section('content')

    @if(!$feedbacks->isEmpty())
        <table class="table text-nowrap table-responsive-sm">
            @php $a = 0 @endphp
            <thead>
            <tr>
                <th> S.N </th>
                <th> Email </th>
                <th> Topic </th>
                <th> Description </th>
                <th> IP Address </th>
            </tr>
            </thead>
            <tbody>
            @foreach($feedbacks as $feedback)
                @php $a++ @endphp
            <tr>
                <th> {{ $a }} </th>
                <td> {{ $feedback->email }}</td>
                <td> {{ $feedback->Feedback_Topic }}</td>
                <td> {{ $feedback->Feedback_Description }}</td>
                <td> {{ $feedback->IP_Address }}</td>
            </tr>
                @endforeach
            </tbody>
        </table>

    @endif

    @if($feedbacks->isEmpty())
        <h3> No Feedback </h3>
    @endif



@endsection