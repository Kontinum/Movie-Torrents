@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="info-box fail">
           <li>{{$error}}</li>
        </div>
    @endforeach
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