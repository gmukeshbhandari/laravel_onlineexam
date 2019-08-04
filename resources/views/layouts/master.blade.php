<!DOCTYPE html>
<html>

<head>
    <title> @yield('title','Online Examination System') </title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ URL::to('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('css/glyphicon.css') }}">
    <link rel="stylesheet" href="{{ URL::to('css/flipclock.css') }}">
    <script src="{{ URL::to('js/jquery.min.js') }}"> </script>
    <script src="{{ URL::to('js/bootstrap.min.js') }}"> </script>
    <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/profilesidebar.css') }}">
    <script src="{{ URL::asset('js/main.js') }}"> </script>
    <script src="{{ URL::asset('js/sweetalert.min.js') }}"> </script>
    <script src="{{ URL::asset('js/jquery.countdown.js') }}"> </script>
    <script src="{{ URL::asset('js/flipclock.min.js') }}"> </script>
    <script src="{{ URL::asset('js/passwordshowhide.js') }}"> </script>

    <style>
        .sticky {
            position: fixed;
            top: 50px;
            width: 100%;

        }
    </style>

</head>

<body style="background:#C0C0C0">

<div class="container-fluid" id="myexamidforfullscreen" style="overflow:auto">
    @include('includes.jumbotron')

    @include('includes.navbar')

    <div class="container-fluid" style="padding:20px">
        @yield('content')
    </div>

    @include('includes.footer')
</div>


</body>
</html>