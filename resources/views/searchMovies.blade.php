@extends('layouts.app')

@section('content')
    <section style="background-color: aliceblue;">
        <div class="container">
            <h2>Search results for <strong>{{$search_term}}</strong>: {{count($movies)}}</h2>
        </div>
    </section>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Search movies</div>
                    <div class="panel-body">
                        <form class="form-horizontal" action="{{route('getSearchMovies')}}" method="get">
                            <div class="form-group">
                                <label for="movie_name" class="col-md-4 control-label">Movie name:</label>
                                <div class="col-md-6">
                                    <input id="movie_name" type="text" class="form-control" name="movie_name" value="{{old('actor_name')}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <input type="submit" class="btn btn-primary" value="Search movies">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section style="background-color: aliceblue;">
        <div class="container">
            <div class="row">
                <ul class="list-group col-md-12">
                    @foreach($movies as $movie)
                        <li class="list-group-item col-md-3 col-sm-4 col-xs-6 text-center">
                            {{$movie->name}} - {{$movie->year}}
                            <img class="img-responsive" src="{{'/images/movies/'.$movie->pictures->images_directory_name.'/'.$movie->pictures->poster_picture}}" alt="{{$movie->name}} poster image">
                            <a href="{{route('getEditMovie',['movie_id'=>$movie->id])}}" title="Edit movie">
                                <i style="line-height:20px;" class="fa fa-lg fa-pencil-square-o list-icons" aria-hidden="true"></i>
                            </a>
                            <a style="line-height: 45px" href="{{route('deleteMovie',['movie_id'=>$movie->id])}}" title="Delete movie">
                                <i class="fa fa-lg fa-trash list-icons" aria-hidden="true"></i>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

@endsection