@if ($errors->any() || Session::has('errormsg') || Session::has('warning'))
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach

    {!! Session::has('errormsg') ? Session::get("errormsg") : '' !!}
                {!! Session::has('warning') ? Session::get("warning") : '' !!}
        </ul>
    </div>

@endif
