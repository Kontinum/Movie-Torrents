@extends('layouts.app')

@section('content')
    <section style="background-color: aliceblue;">
        <div class="container">
            <h2>Edit movie: <strong>{{$movie->name}}</strong></h2>
        </div>
    </section>
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-lg-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit movie
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-offset-1">
                            <form class="form-horizontal" role="form" method="POST" action="{{route('postEditMovie')}}" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <input type="hidden" name="movie_id" value="{{$movie->id}}">
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label for="movie_name">Movie name:</label>
                                        <input class="form-control" id="movie_name" name="movie_name" type="text" value="{{$movie->name}}">
                                    </div>
                                </div>

                                <div class="col-lg-5 col-lg-offset-1">
                                    <div class="form-group">
                                        <label for="movie_year">Movie year:</label>
                                        <input class="form-control" id="movie_year" name="movie_year" type="text" value="{{$movie->year}}">
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="movie_director">Movie director:</label>
                                        <input class="form-control" id="movie_director" name="movie_director" type="text" value="{{$movie->director}}">
                                    </div>
                                </div>

                                <div class="col-lg-3 col-lg-offset-1">
                                    <div class="form-group">
                                        <label for="youtube_trailer">Youtube trailer:</label>
                                        <input class="form-control" id="youtube_trailer" name="youtube_trailer" type="text" value="{{$movie->youtube_trailer}}">
                                    </div>
                                </div>

                                <div class="col-lg-3 col-lg-offset-1">
                                    <div class="form-group">
                                        <label for="imdb_rating">IMDB rating:</label>
                                        <input class="form-control" id="imdb_rating" name="imdb_rating" type="text" value="{{$movie->imdb_rating}}">
                                    </div>
                                </div>

                                <div class="col-lg-11">
                                    <div class="form-group">
                                        <label for="movie_synopsis">Movie synopsis:</label>
                                        <textarea class="form-control" name="movie_synopsis" id="movie_synopsis" cols="30" rows="4">{{$movie->synopsis}}</textarea>
                                    </div>
                                </div>

                                <div class="col-lg-11">
                                    <div class="form-group">
                                        <label for="movie_genres">Movie genres:</label>
                                        <select class="genre-select form-control" name="genres[]" id="movie_genres" multiple="multiple">
                                            @foreach($genres as $genre)
                                                <option value="{{$genre->id}}"
                                                    @foreach($movie->genres as $movie_genres)
                                                        @if($genre->id == $movie_genres->id)
                                                            selected
                                                        @endif
                                                    @endforeach
                                                >{{$genre->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label for="movie_actor_1">Actor 1:</label>
                                            <select class="actor-select form-control" name="movie_actor_1" id="movie_actor_1" multiple>
                                                @foreach($actors as $actor)
                                                    <option value="{{$actor->id}}"
                                                        @if($actor->id == $movie_actors[0]->id)
                                                            selected
                                                        @endif
                                                    >{{$actor->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="role col-lg-1">as</div>
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label for="actor_1_role">Role:</label>
                                            <input class="form-control" id="actor_1_role" name="actor_1_role" type="text" value="{{$movie_actors[0]->pivot->plays}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label for="movie_actor_2">Actor 2:</label>
                                            <select class="actor-select form-control" name="movie_actor_2" id="movie_actor_2" multiple>
                                                @foreach($actors as $actor)
                                                    <option value="{{$actor->id}}"
                                                            @if($actor->id == $movie_actors[1]->id)
                                                            selected
                                                            @endif
                                                    >{{$actor->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="role col-lg-1">as</div>
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label for="actor_2_role">Role:</label>
                                            <input class="form-control" id="actor_2_role" name="actor_2_role" type="text" value="{{$movie_actors[1]->pivot->plays}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label for="movie_actor_3">Actor 3:</label>
                                            <select class="actor-select form-control" name="movie_actor_3" id="movie_actor_3" multiple>
                                                @foreach($actors as $actor)
                                                    <option value="{{$actor->id}}"
                                                            @if($actor->id == $movie_actors[2]->id)
                                                            selected
                                                            @endif
                                                    >{{$actor->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="role col-lg-1">as</div>
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label for="actor_3_role">Role:</label>
                                            <input class="form-control" id="actor_3_role" name="actor_3_role" type="text" value="{{$movie_actors[2]->pivot->plays}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label for="movie_actor_4">Actor 4:</label>
                                            <select class="actor-select form-control" name="movie_actor_4" id="movie_actor_4" multiple>
                                                @foreach($actors as $actor)
                                                    <option value="{{$actor->id}}"
                                                            @if($actor->id == $movie_actors[3]->id)
                                                            selected
                                                            @endif
                                                    >{{$actor->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="role col-lg-1">as</div>
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label for="actor_4_role">Role:</label>
                                            <input class="form-control" id="actor_4_role" name="actor_4_role" type="text" value="{{$movie_actors[3]->pivot->plays}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group text-center">
                                        <label for="poster_image">Poster image</label><br>
                                        <img height="99px" src="{{'/images/movies/'.$movie->pictures->images_directory_name.'/'.$movie->pictures->poster_picture}}" alt="">
                                        <input id="poster_image" class="form-control" type="file" name="poster_image" value="{{old('poster_image')}}">
                                    </div>
                                </div>

                                <div class="col-lg-3 col-lg-offset-1">
                                    <div class="form-group">
                                        <label for="screenshot1">Screenshot 1:</label>
                                        <img class="img-responsive" src="{{'/images/movies/'.$movie->pictures->images_directory_name.'/'.$movie->pictures->screenshot1}}" alt="">
                                        <input id="screenshot1" class="form-control" type="file" name="screenshot1_image" value="{{old('screenshot1_image')}}">
                                    </div>
                                </div>

                                <div class="col-lg-3 col-lg-offset-1">
                                    <div class="form-group">
                                        <label for="screenshot2">Screenshot 2:</label>
                                        <img class="img-responsive" src="{{'/images/movies/'.$movie->pictures->images_directory_name.'/'.$movie->pictures->screenshot2}}" alt="">
                                        <input id="screenshot2" class="form-control" type="file" name="screenshot2_image" value="{{old('screenshot2_image')}}">
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="movie_length">Movie length:</label>
                                        <input class="form-control" id="movie_length" name="movie_length" type="text" value="{{$movie->torrent->length}}">
                                    </div>
                                </div>

                                <div class="col-lg-3 col-lg-offset-1">
                                    <div class="form-group">
                                        <label for="movie_size">Movie size:</label>
                                        <input class="form-control" id="movie_size" name="movie_size" type="text" value="{{$movie->torrent->size}}">
                                    </div>
                                </div>

                                <div class="col-lg-3 col-lg-offset-1">
                                    <div class="form-group">
                                        <label for="movie_resolution">Movie resolution:</label>
                                        <input class="form-control" id="movie_resolution" name="movie_resolution" type="text" value="{{$movie->torrent->resolution}}">
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="movie_audio">Movie audio:</label>
                                        <input class="form-control" id="movie_audio" name="movie_audio" type="text" value="{{$movie->torrent->audio}}">
                                    </div>
                                </div>

                                <div class="col-lg-3 col-lg-offset-1">
                                    <div class="form-group">
                                        <label for="movie_fps">Movie fps:</label>
                                        <input class="form-control" id="movie_fps" name="movie_fps" type="text" value="{{$movie->torrent->fps}}">
                                    </div>
                                </div>

                                <div class="col-lg-3 col-lg-offset-1">
                                    <div class="form-group">
                                        <label for="movie_pg">Movie parental guide:</label>
                                        <input class="form-control" id="movie_pg" name="movie_pg" type="text" value="{{$movie->torrent->pg}}">
                                    </div>
                                </div>

                                <div class="form-group col-lg-11">
                                    <input class="btn btn-primary" value="Edit movie" type="submit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $('.genre-select').select2({
            maximumSelectionLength: 5
        });
        $('.actor-select').select2({
            maximumSelectionLength: 1
        });
    </script>
@endsection