@if(count($errors) > 0)
    <div class="info-box fail">
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </div>
@endif
@if(Session::has('success'))
    <div class="info-box success">
        <li>{{Session::get('success')}}</li>
    </div>
@endif
@if(Session::has('fail'))
    <div class="info-box fail">
        <li>{{Session::get('fail')}}</li>
    </div>
@endif