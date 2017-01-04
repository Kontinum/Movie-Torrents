@extends('layouts.app')

@section('content')
    <section style="background-color: aliceblue;">
        <div class="container">
            <h2>Number of movies: {{($count_movies == 0) ? 'There are no movies in database' : '<strong>'.$count_movies.'</strong>'}}</h2>
        </div>
    </section>
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-lg-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Add movie</div>
                    <div class="panel-body">
                        <div class="col-lg-offset-1">
                            <form class="form-horizontal" role="form" method="POST" action="">
                                {{csrf_field()}}
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label for="movie_name">Movie name:</label>
                                        <input class="form-control" id="movie_name" name="movie_name" type="text">
                                    </div>
                                </div>

                                <div class="col-lg-5 col-lg-offset-1">
                                    <div class="form-group">
                                        <label for="movie_year">Movie year:</label>
                                        <input class="form-control" id="movie_year" name="movie_year" type="text">
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="movie_director">Movie director:</label>
                                        <input class="form-control" id="movie_director" name="movie_director" type="text">
                                    </div>
                                </div>

                                <div class="col-lg-3 col-lg-offset-1">
                                    <div class="form-group">
                                        <label for="youtube_trailer">Youtube trailer:</label>
                                        <input class="form-control" id="youtube_trailer" name="youtube_trailer" type="text">
                                    </div>
                                </div>

                                <div class="col-lg-3 col-lg-offset-1">
                                    <div class="form-group">
                                        <label for="imdb_rating">IMDB rating:</label>
                                        <input class="form-control" id="imdb_rating" name="imdb_rating" type="text">
                                    </div>
                                </div>

                                <div class="col-lg-11">
                                    <div class="form-group">
                                        <label for="movie_synopsis">Movie synopsis:</label>
                                        <textarea class="form-control" name="movie_synpsis" id="movie_synopsis" cols="30" rows="4"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-11">
                                    <div class="form-group">
                                        <label for="movie_genres">Movies genres (max 5):</label>
                                        <select class="form-control" name="" id="movie_genres">

                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-5">
                                   <div class="form-group">
                                       <label for="movie_actor_1">Actor 1</label>
                                       <select class="form-control" name="" id="movie_actor_1"></select>
                                   </div>
                                </div>
                                <div class="role-as col-lg-1">as</div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label for="actor_1_role">Role:</label>
                                        <input class="form-control" id="actor_1_role" name="actor_1_role" type="text">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection