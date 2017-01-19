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
    @include('/partials/browseMovies')
@endsection