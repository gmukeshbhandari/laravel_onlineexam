@extends('layouts.master')

@section('title','User List')

@section('content')

    @if (count($data) != 0)

        <table class="table table-responsive-sm">
            <thead class="thead-light">
            <tr>
                <th scope="col"> S.N  </th>
                <th scope="col"> Name </th>
                <th scope="col"> Email </th>
                <th scope="col"> Gender </th>
                <th scope="col"> Country </th>
                <th scope="col"> Symbol </th>
                <th scope="col"> Zone </th>
                <th scope="col"> District </th>
                <th scope="col"> Village </th>
                <th scope="col"> Street Address </th>
                <th scope="col"> Ward No </th>
                <th scope="col"> Account Status </th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $datas)
                <tr>
                <th scope="row"> {{ $colstart++  }}  </th>
                <td>  {{ $datas->First_Name }} {{' '}} {{ $datas->Middle_Name }} {{' '}}   {{$datas->Last_Name }}   </td>
                <td>  {{ $datas->email }}  </td>
                <td>  {{ $datas->Gender }}  </td>
                <td>  {{ $datas->Country }}  </td>
                <td>  {{ $datas->Symbol_No }} </td>
                <td> {{ $datas->Zone}} </td>
                <td> {{ $datas->District}} </td>
                <td> {{ $datas->Village}} </td>
                <td> {{ $datas->Street_Address}} </td>
                <td> {{ $datas->Ward_No}} </td>
                <td>
                    <h4>
                        @if($datas->flag_en_dis == 1)
                            <a class="btn btn-sm btn-info" href="{{ route('changeflag',['id' =>$datas->id] )}}"> Inactivate </a>
                        @else
                            <a class="btn btn-sm btn-info" href="{{ route('changeflag',['id' =>$datas->id] )}}"> Activate </a>
                        @endif
                    </h4>

                </td>
               </tr>
            @endforeach
            </tr>
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