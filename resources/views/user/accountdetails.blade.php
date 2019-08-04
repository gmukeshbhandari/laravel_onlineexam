@extends('layouts.master')

@section('title', 'My Account Details')
@section('content')
    @if (count($data) != 0)

        <table class="table table-responsive-sm">
            <thead class="thead-light">
            <tr>
                <th scope="col"> S.N  </th>
                <th scope="col"> Email </th>
                <th scope="col"> IP Address </th>
                <th scope="col"> MAC Address </th>
                <th scope="col"> Login Date and Time </th>
                <th scope="col"> Type of Login </th>
            </tr>
            </thead>
            @foreach($data as $datas)
                <tbody>
                <th scope="row"> {{ $colstart++  }}  </th>
                <td>  {{ $datas->email }}  </td>
                <td>  {{ $datas->IP_Address }}  </td>
                <td>  {{ $datas->MAC_Address }}  </td>
                <td>  {{ $datas->Login_DateandTime }}  </td>
                <td>  {{ $datas->Login_Type }} </td>
                </tbody>
            @endforeach
        </table>
    @endif

    @if (count($data) == 0)
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center"> No Data Available </h1>
                </div>
            </div>

        </div>
    @endif


@endsection