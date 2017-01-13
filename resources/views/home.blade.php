@extends('layouts.app')

@section('content')

    <div class="jumbotron">
        <div class="container">
            <h1 class="text-center">1080p HD Movies</h1>
            <h3 class="text-center">Download fast movies with HD quality</h3>
        </div>
    </div>
    <section class="popular-movies-section">
        <div class="container">
            <div class="row">
                <h2><i class="fa fa-film" aria-hidden="true"></i>Popular movies</h2>
                <hr>
            </div>
            <div class="row">
                @foreach($popular_movies as $movie)
                    <div class="col-lg-3 col-lg-offset-0 col-md-5 col-md-offset-1 col-sm-5 col-sm-offset-1 col-xs-12 col-xs-offset-0 ">
                        <div class="movie">
                            <a href="#" class="movie-link">
                                <figure>
                                    <img class="img-responsive image-list" src="/images/movies/{{$movie->name .'-'.$movie->year .'/' .$movie->pictures->poster_picture}}" alt="ipman">
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
                                <a href="#" class="movie-link-name">
                                    @if(strlen($movie->name) > 18)
                                        {{substr($movie->name,0,25).'...'}}
                                        @else
                                        {{$movie->name}}
                                    @endif
                                </a>
                                <div class="movie-year">{{$movie->year}}</div>
                                <a href="{{route('downloadTorrent')}}" class="movie-link-download">
                                    <i class="fa fa-2x fa-download"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section style="background-color: aliceblue" class="new-movies-section">
        <div class="container">
            <div class="row">
                <h2><i class="fa fa-film" aria-hidden="true"></i>New Movies</h2>
                <hr>
            </div>
            <div class="row">
                @foreach($new_movies as $movie)
                    <div class="col-lg-3 col-lg-offset-0 col-md-5 col-md-offset-1 col-sm-5 col-sm-offset-1 col-xs-12 col-xs-offset-0 ">
                        <div class="movie">
                            <a href="#" class="movie-link">
                                <figure>
                                    <img class="img-responsive image-list" src="/images/movies/{{$movie->name .'-'.$movie->year .'/' .$movie->pictures->poster_picture}}" alt="ipman">
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
                                <a href="#" class="movie-link-name">
                                    @if(strlen($movie->name) > 18)
                                        {{substr($movie->name,0,25).'...'}}
                                    @else
                                        {{$movie->name}}
                                    @endif
                                </a>
                                <div class="movie-year">{{$movie->year}}</div>
                                <a href="{{route('downloadTorrent')}}" class="movie-link-download">
                                    <i class="fa fa-2x fa-download"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
