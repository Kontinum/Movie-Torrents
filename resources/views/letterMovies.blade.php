@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <h2>Movies that name begins with: <strong>{{$letter}}</strong></h2>
        </div>
    </section>
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
@endsection