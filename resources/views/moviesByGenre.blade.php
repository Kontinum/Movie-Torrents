@extends('layouts.app')

@section('content')
    <section style="background-color: aliceblue;">
        <div class="container">
            <h2><strong>{{$genre->name}}</strong> movies</h2>
        </div>
    </section>
    <div class="container">
        <div class="row">
            <div class="browse-movies-pagination text-center">
                {{$movies->links()}}
            </div>
            @foreach($movies as $movie)
                <div class="col-lg-3 col-lg-offset-0 col-md-5 col-md-offset-1 col-sm-5 col-sm-offset-1 col-xs-12 col-xs-offset-0 ">
                    <div class="movie">
                        <a href="{{route('browseMovies',['movie_id'=>$movie->id])}}" class="movie-link">
                            <figure>
                                <img class="img-responsive image-list" src="/images/movies/{{$movie->name .'-'.$movie->year .'/' .$movie->pictures->poster_picture}}" alt="">
                                <figcaption class="hidden-sm hidden-xs">
                                    <br><br><br><br><br>
                                    <h4 class="rating">{{$movie->imdb_rating}}/10</h4>
                                    @foreach($movie->genres()->limit(2)->get() as $genre)
                                        <h4>{{$genre->name}}</h4>
                                    @endforeach
                                </figcaption>
                            </figure>
                        </a>
                        <div class="movie-bottom">
                            <a href="{{route('browseMovies',['movie_id'=>$movie->id])}}" class="movie-link-name">
                                @if(strlen($movie->name) > 18)
                                    {{substr($movie->name,0,25).'...'}}
                                @else
                                    {{$movie->name}}
                                @endif
                            </a>
                            <div class="movie-year">{{$movie->year}}</div>
                            <a href="{{route('downloadTorrent',['movie_id'=>$movie->id])}}" class="movie-link-download">
                                <i class="fa fa-2x fa-download"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="browse-movies-pagination text-center">
            {{$movies->links()}}
        </div>
    </div>
@endsection