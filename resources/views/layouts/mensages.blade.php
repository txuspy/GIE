@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{!! $message !!}</p>
    </div>
@endif
@if (!empty($success))
    <div class="alert alert-success">
        <p>{!! $success !!}</p>
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{!! $error !!}</li>
            @endforeach
        </ul>
    </div>
@endif