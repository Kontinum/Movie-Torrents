@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <li>{{$error}}</li>
    @endforeach
@endif
@if(Session::has('success'))
    <div class="success">
        {{Session::get('success')}}
    </div>
@endif
@if(Session::has('fail'))
    <div class="fail">
        {{Session::get('fail')}}
    </div>
@endif