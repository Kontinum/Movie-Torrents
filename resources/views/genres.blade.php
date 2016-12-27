@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Genre</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('postGenre') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('genre') ? ' has-error' : '' }}">
                                <label for="genre" class="col-md-4 control-label">Genre name:</label>

                                <div class="col-md-6">
                                    <input id="genre" type="text" class="form-control" name="genre" value="{{ old('genre') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Add genre
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <h2>List of genres:</h2>
            <hr>
            @if(count($genres) == 0)
                <p>The are no genres in database</p>
                @else
                @foreach($genres as $genre)
                    {{$genre->name}}
                @endforeach
            @endif
        </div>
    </div>
@endsection