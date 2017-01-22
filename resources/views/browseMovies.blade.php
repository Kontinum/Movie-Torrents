@extends('layouts.app')

@section('content')
    <section style="background-color:aliceblue;">
        <div class="container">
            <div class="row">
                <div class="search-movies col-lg-8 col-lg-offset-2">
                    <form action="{{route('userSearchMovies')}}" class="form-horizontal" method="get">
                        <div class="row">
                            <div class="col-lg-11">
                                <div class="form-group">
                                    <label class="pull-left control-label" for="movie_name">Movie name:</label>
                                    <input type="text" id="movie_name" name="movie_name" value="{{Request::old('movie_name')}}" class="form-control">
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
                                        <option value="1">All</option>
                                        @for($i=10;$i>1;$i--)
                                            <option value="{{$i}}"
                                            @if(Request::old('rating') == $i)
                                                selected
                                            @endif
                                            >{{$i.'+'}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-lg-offset-1">
                                <div class="form-group">
                                    <label class="pull-left control-label" for="order">Order by:</label>
                                    <select class="form-control" name="order" id="order">
                                        <option value="created_at:desc" selected>Latest</option>
                                        <option value="created_at:asc">Oldest</option>
                                        <option value="year:desc">Year</option>
                                        <option value="imdb_rating:desc">Rating</option>
                                        <option value="downloaded:desc">Downloads</option>
                                        <option value="name:asc">Alphabetical</option>
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
    @include('/partials/browseMovies')
@endsection