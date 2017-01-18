@extends('layouts.app')

@section('content')
    <section style="background-color:aliceblue;">
        <div class="container">
            <div class="row">
                <div class="search-movies col-lg-8 col-lg-offset-2">
                    <form action="" class="form-horizontal" method="get">
                        <div class="row">
                            <div class="col-lg-11">
                                <div class="form-group">
                                    <label class="pull-left control-label" for="movie_name">Movie name:</label>
                                    <input type="text" id="movie_name" name="movie_name" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="pull-left control-label" for="genre">Genre:</label>
                                    <select class="form-control" name="genre" id="genre">
                                        <option value="all">All</option>
                                        @foreach($genres as $genre)
                                            <option value="{{$genre->name}}">{{$genre->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-lg-offset-1">
                                <div class="form-group">
                                    <label class="pull-left control-label" for="rating">Rating:</label>
                                    <select class="form-control" name="rating" id="rating">
                                        <option value="">All</option>
                                        @for($i=10;$i>1;$i--)
                                            <option value="{{$i}}">{{$i.'+'}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-lg-offset-1">
                                <div class="form-group">
                                    <label class="pull-left control-label" for="year">Year:</label>
                                    <select class="form-control" name="year" id="year">
                                        <option value="">All</option>
                                        <option value="2000">2000+</option>
                                        @for($i=90;$i>40;$i-=10)
                                            <option value="{{'19'.$i}}">{{$i."'s"}}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button class="pull-right btn btn btn-primary">Search movies:</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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