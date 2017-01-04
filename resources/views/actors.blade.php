@extends('layouts.app')

@section('content')
    <section style="background-color: aliceblue;">
        <div class="container">
                <h2>Number of actors:
                    @if($count_actors == 0)
                        There are no actors in database
                    @else
                        <strong>{{$count_actors}}</strong>
                    @endif
                </h2>

        </div>
    </section>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Actor</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('postActor') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('actor') ? ' has-error' : '' }}">
                                <label for="actor" class="col-md-4 control-label">Actor name:</label>

                                <div class="col-md-6">
                                    <input id="actor" type="text" class="form-control" name="actor" value="{{ old('actor') }}" required autofocus>

                                    @if ($errors->has('actor'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('actor') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{$errors->has('birth_year') ? 'has-error' : ''}}">
                                <label for="birth_year" class="col-md-4 control-label">Birth year:</label>
                                <div class="col-md-6">
                                    <input id="birth_year" type="text" class="form-control" name="birth_year" value="{{old('birth_year')}}" required autofocus>
                                    @if ($errors->has('birth_year'))
                                        <span class="help-block">
                                            <strong>{{$errors->first('birth_year')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{$errors->has('actor_image') ? 'has-error' : ''}}">
                                <label for="actor_image" class="col-md-4 control-label">Actor image(256x256):</label>
                                <div class="col-md-6">
                                    <input id="actor_image" type="file" class="form-control" name="actor_image" value="{{old('actor_image')}}" autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Add actor
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Search Actors</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="GET" action="{{route('getSearchActors')}}">


                            <div class="form-group{{ $errors->has('actor_name') ? ' has-error' : '' }}">
                                <label for="actor_name" class="col-md-4 control-label">Actor name:</label>

                                <div class="col-md-6">
                                    <input id="actor_name" type="text" class="form-control" name="actor_name" value="{{ old('actor_name') }}" required autofocus>

                                    @if ($errors->has('actor_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('actor_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Search actors
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section style="background-color: aliceblue;height: 600px">
        <div class="container">
            <div class="row">
                <h2>Actors that name begin with letter:</h2>
                <hr>
            </div>
            <div class="row">
                <div class="list-group">
                    @foreach(range('A','Z') as $letter)
                        <a href="{{route('letterActors',['letter'=>$letter])}}" class="list-group-item col-md-3 col-sm-4 col-xs-6 ">{{$letter}}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection